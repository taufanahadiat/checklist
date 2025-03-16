async function exportTableToExcel(tableID, filename) {
    const hiddenTable = document.getElementById('hiddenTable');
    hiddenTable.style.display = 'block';
    // Load ExcelJS Workbook
    const workbook = new ExcelJS.Workbook();
    await workbook.xlsx.load(fetch("Template/dailyMonthlyCheck.xlsx").then(res => res.arrayBuffer()));

    try {
        const worksheet = workbook.getWorksheet('Sheet1');
        if (!worksheet) {
            console.error("Worksheet tidak ditemukan!");
            return;
        }

        const table = document.getElementById(tableID);
        const rows = table.querySelectorAll("tr");

        // Daily checklist: Start at row 4, column 2
        let startRow = 4;
        let startCol = 2;

        // Add date headers to the Excel sheet for the daily checklist
        const headerRow = rows[1]; // The second row contains the date headers
        const headerCells = headerRow.querySelectorAll("th.head-check");

        headerCells.forEach((cell, index) => {
            let excelCell = worksheet.getCell(startRow, startCol + index);
            excelCell.value = cell.innerText; // Set the date as the header value
        });

        startRow++; // Move to the next row for data

        // Add daily checklist rows
        const areaRows = rows[2].parentElement.querySelectorAll("tr"); // Skip the header rows
        areaRows.forEach((row) => {
            const cells = row.querySelectorAll("td");
            cells.forEach((cell, cellIndex) => {
                let excelCell = worksheet.getCell(startRow, startCol + cellIndex);
                excelCell.value = cell.innerText; // Copy cell values
            });

            startRow++;
        });

        // Monthly checklist: Add space after daily checklist
        startRow += 3; // Leave some rows of space between daily and monthly sections
        startCol += 1;

        // Add month table headers to the Excel sheet
        const monthTable = document.getElementById('monthTable');
        const monthRows = monthTable.querySelectorAll("tr");

        const monthHeaderRow = monthRows[1]; // The second row contains the month headers
        const monthHeaderCells = monthHeaderRow.querySelectorAll("th.head-check");

        monthHeaderCells.forEach((cell, index) => {
            let excelCell = worksheet.getCell(startRow, startCol + index);
            excelCell.value = cell.innerText; // Set the month as the header value
        });

        startRow++; // Move to the next row for data

        // Add month table rows
        const monthAreaRows = monthRows[2].parentElement.querySelectorAll("tr"); // Skip the header rows
        monthAreaRows.forEach((row) => {
            const cells = row.querySelectorAll('.monthCheck');
            cells.forEach((cell, cellIndex) => {
                let excelCell = worksheet.getCell(startRow, startCol + cellIndex);
                excelCell.value = cell.innerText; // Copy cell values
            });

            startRow++;
        });

        startRow -= 1;
        // Add hidden table headers to the Excel sheet
        const hiddenRows = hiddenTable.querySelectorAll("tr");

        // Add hidden table rows
        const hiddenAreaRows = hiddenRows[2].parentElement.querySelectorAll("tr"); // Skip the header rows
        hiddenAreaRows.forEach((row) => {
            const cells = row.querySelectorAll('.craneHidden');
            cells.forEach((cell, cellIndex) => {
                let excelCell = worksheet.getCell(startRow, startCol + cellIndex);
                excelCell.value = cell.innerText; // Copy cell values
            });

            startRow++;
        });

        // Write the workbook to a buffer
        const buffer = await workbook.xlsx.writeBuffer();
        const blob = new Blob([buffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });

        // Create download link and trigger download
        const link = document.createElement("a");
        link.href = URL.createObjectURL(blob);
        link.download = filename + ".xlsx";
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);

        return link.href; // Return the file URL

    } catch (error) {
        console.error("Export failed:", error);
    } finally {
        // Revert the display of hiddenTable to none
        hiddenTable.style.display = 'none';
    }
}