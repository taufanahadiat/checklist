<?php

include 'database.php';
$tanggal = "" . $_GET['selectedDate'];
$t67bopet = 'chiller_trane_67bopet';
$h67bopet = 'chiller_hitachi_67bopet';
$t45met34 = 'chiller_trane_45met34';
$h45met34 = 'chiller_hitachi_45met34';
$tcoat14met12 = 'chiller_trane_coat14met12';
$hcoat14met12 = 'chiller_hitachi_coat14met12';
include 'request-view-all-chiller.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Checklist Chiller</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../../img/icon.ico">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <style>
        .measure2{
            width: 80px;
        }
        .parameter-setting{
            width: 30px;
        }
    </style>
</head>

<body>
<?php include 'header.php'?>
    <main>
    <div class="legend-container">
    <!-- Legend Button -->
    <button class="legend-btn" id="legendBtn" onclick="toggleLegend()">Show Legend</button>

    <!-- Legend Table -->
    <div class="legend-table" id="legendTable">
                    
<table>
            <thead>
                <tr>
                    <th>Collumn</th>
                    <th>Parameter</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="5" style="text-align:center;">Machine Status</td>
                    <td>RUN</td>
                    <td>RUNNING</td>
                </tr>
                <tr>
                    <td>SBY</td>
                    <td>STANDBY</td>
                </tr>
                <tr>
                    <td>U/L</td>
                    <td>UNLOAD</td>
                </tr>
                <tr>
                    <td>ST</td>
                    <td>STOP</td>
                </tr>
                <tr>
                    <td>B/D</td>
                    <td>BREAKDOWN</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div id="overlay_chart" style="display: none;">
                <div id="chart" style="width: 50%; height: 400px; display: none;">
                    <div id="chart-buttons">
                        <button onclick="closeChart()">Close</button>
                    </div>
                </div>
            </div>

        <br><br>
        <?php 
            echo "<h2 style='margin-top: -30px; text-decoration: underline;'>VIEW ALL CHILLER</h2>";
            echo "<h2 style='margin-top: -10px;'>CHILLER OPP 6~7 & BOPET</h2>";
            include 'pilih-tanggal.php';
            include 'view-chiller67bopet.php';
            echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
            echo "<h2>CHILLER OPP 4~5 & MET 3~4</h2>";
            include 'view-chiller45met34.php';
            echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
            echo "<h2>CHILLER COAT1~4 & MET 1~2</h2>";
            include 'view-chillercoat14met12.php';
        ?>
    </main>
    <script>
        document.getElementById("exit").onclick=function (){
            location.href = 'selection.php'
        }

        function clickToPlot(element) {
    const shift = element.getAttribute('data-shift');
    const field = element.getAttribute('data-field');
    const title_data = element.getAttribute('data-title');
    const unit = element.getAttribute('data-unit');

    // Fetch data using Fetch API
    fetch(`/checklist/getPlotData.php?shift=${encodeURIComponent(shift)}&field=${encodeURIComponent(field)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(graphData => {
            // Prepare data for the chart
            const times = ["1", "2", "3"];

// Flatten data for plotting
let allValues = [];
let allX = [];
let selectedDateValues = [];
let selectedDateIndices = [];
graphData.forEach(({ tanggal, values }) => {
    const dateObj = new Date(tanggal);
    const dateLabel = `${dateObj.getDate().toString().padStart(2, '0')} ${dateObj.toLocaleString('en-GB', { month: 'short' })} '${dateObj.getFullYear().toString().slice(-2)}`;
    
    // Only include data for the selected date
    if (tanggal === selectedDate) {
        allValues.push(...values);
        allX.push(...times.map(t => `<b>${t}</b> <span style="color: grey;">(${dateLabel})</span>`));
        selectedDateValues.push(...values);
        selectedDateIndices.push(...Array(times.length).keys().map(i => i + allX.length - times.length));
    } else {
        allValues.push(...values);
        allX.push(...times.map(t => `<b>${t}</b> <span style="color: grey;">(${dateLabel})</span>`));
    }
});

// Calculate min and max values for the selected date, excluding 0 or null values
const filteredValues = selectedDateValues.filter(value => value !== 0 && value !== null);
const yMin = Math.min(...filteredValues) - (0.02 * Math.min(...filteredValues));
const yMax = Math.max(...filteredValues) + (0.02 * Math.max(...filteredValues));

            // Trace for the data
            const trace = {
                x: allX,
                y: allValues,
                mode: 'lines+markers',
                name: label,
                line: { color: 'blue' },
                marker: { size: 8 },
            };

            // Layout configuration
            const layout = {
                title: `${title_data} (Boiler Line: ${line})`,
                xaxis: {
                    title: 'Time (Hours and Date)',
                    tickangle: 45,
                    automargin: true,
                    range: [selectedDateIndices[0], selectedDateIndices[selectedDateIndices.length - 1]], // Set initial range to the selected date
                },
                yaxis: {
                    title: unit,
                    range: [yMin, yMax], // Set Y-axis range based on filtered selected date values with adjustments
                },
            };

            // Render the plot
            Plotly.newPlot('chart', [trace], layout);

            // Display the chart overlay
            document.getElementById('overlay_chart').style.display = 'block';
            document.getElementById('chart').style.display = 'block';
        })
        .catch(error => console.error('Error fetching plot data:', error));
}

function closeChart() {
    document.getElementById('overlay_chart').style.display = 'none';
    document.getElementById('chart').style.display = 'none';
}
    </script>

</body>
</html>
