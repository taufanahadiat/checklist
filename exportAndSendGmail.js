const puppeteer = require('puppeteer');
const fs = require('fs');
const path = require('path');
const axios = require('axios');

const downloadPath = 'C:\\wamp\\www\\checklist\\email\\';
const downloadedFilePath = path.join(downloadPath, 'checker_report.xlsx');

(async () => {
    const browser = await puppeteer.launch({
        headless: false, // Debugging mode
        devtools: true, // Open DevTools
        args: [
            '--no-sandbox',
            '--disable-web-security',
            '--allow-running-insecure-content',
            '--disable-popup-blocking',
            '--disable-blink-features=AutomationControlled',
            '--disable-features=IsolateOrigins,site-per-process'
        ]
    });

    const page = await browser.newPage();

    // Allow automatic downloads
    const client = await page.target().createCDPSession();
    await client.send('Page.setDownloadBehavior', {
        behavior: 'allow',
        downloadPath: downloadPath
    });

    console.log('Navigating to the report page...');
    await page.goto('http://localhost:8081/checklist/weeklyReport.php', { waitUntil: 'domcontentloaded' });

    // Wait for the export button
    await page.waitForSelector('#exportButton', { timeout: 10000 });
    console.log('Export button found.');

    // Wait 30 seconds before clicking
    console.log('Waiting 30 seconds before clicking the export button...');
    await new Promise(resolve => setTimeout(resolve, 30000));

    // Click the export button using JavaScript execution
    await page.evaluate(() => {
        document.querySelector('#exportButton').click();
    });
    console.log('Export button clicked.');

    // Check if the file appears
    const waitForFile = async (filePath, timeout = 30000) => {
        const startTime = Date.now();
        while (Date.now() - startTime < timeout) {
            if (fs.existsSync(filePath)) {
                return true;
            }
            await new Promise(resolve => setTimeout(resolve, 1000));
        }
        return false;
    };

    // Wait for the file to appear
    if (await waitForFile(downloadedFilePath)) {
        console.log('File downloaded successfully:', downloadedFilePath);
    } else {
        console.error('Downloaded file not found:', downloadedFilePath);
        await browser.close();
        return;
    }

    // Run the PHP email script after download
    try {
        const response = await axios.get('http://localhost:8081/checklist/email/send_gmail_trial.php');
        console.log('Email script executed successfully:', response.data);
    } catch (error) {
        console.error('Error executing email script:', error.message);
    }

    await browser.close();
})();
