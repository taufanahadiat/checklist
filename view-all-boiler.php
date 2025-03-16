<?php

include 'database.php';

$tanggal = $_GET['selectedDate'];
$unit = 'boiler';

// Function to format the value
function formatValue($value) {
    if (is_numeric($value)) {
        // If the value is a float and has .00 as decimals, return it as an integer
        if (floor($value) == $value) {
            return number_format(intval($value));
        } else {
            // Return the value formatted with commas but preserving its decimal part
            return number_format($value, 2);
        }
    } else {
        // Otherwise, return the original value
        return $value;
    }
}

// Example usage:
$value = 10.00;
//echo formatValue($value); // Output: 10

$value = 10.50;
//echo formatValue($value); // Output: 10.5
?>


<!DOCTYPE html>
<html>
<head>
    <title>View Checklist Boiler</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../../img/icon.ico">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <style>
        body{
            height:100%;
        }
        table {
      width: 100%;
      height: 800px; /* Set the height of the scrollable area */
      overflow-y: auto; /* Enable vertical scrolling */
    }

    thead{
      position: sticky; /* Make the header sticky */
      top: 0; /* Stick to the top of the container */
      z-index: 2; /* Ensure the header is above the body content */
    }

    tbody th {
      position: sticky; /* Make the first column sticky */
      left: 0; /* Stick to the left of the container */
      z-index: 1; /* Lower z-index for the first column */
    }
    </style>

</head>
<body>
<?php include 'header.php'; ?>

    <main>

    <?php include 'switch-to-view-gas.php'?>
<div class="legend-container" style="z-index: 3;">
    <!-- Legend Button -->
    <button class="legend-btn" id="legendBtn" onclick="toggleLegend()">Show Legend</button>

    <!-- Legend Table -->
    <div class="legend-table" id="legendTable">
<table style="height: 200px;">
            <thead>
                <tr>
                    <th>Collumn</th>
                    <th>Parameter</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="2" style="text-align:center;">Rembesan Oli</td>
                    <td>K</td>
                    <td>Kering</td>
                </tr>
                <tr>
                    <td>B</td>
                    <td>Basah</td>
                </tr>
                <!-- Add more abbreviations as needed -->
            </tbody>
        </table>
    </div>
</div>

<?php 
$line_boiler = array(
    '4&5-a',
    '4&5-b',
    '6',
    '7',
    '6&7-central',
    '8',
    'bopet-a',
    'bopet-b',
    'coating-a',
    'coating-b',
    'coating-c',
    'coating-d'
);

foreach ($line_boiler as $line): ?>
<?php include 'request-view-boiler.php';?>
    <h2><?php echo strtoupper("BOILER GAS LINE $line"); ?></h2>
    <?php 
    if ($line == '4&5-a'){
        $area = 'boiler';
        include 'pilih-tanggal.php';
        echo '<br>';
        include 'verification-form.php';
    }
     ?>
            <div id="overlay_chart" style="display: none;">
                <div id="chart" style="width: 50%; height: 400px; display: none;">
                    <div id="chart-buttons">
                        <button onclick="closeChart()">Close</button>
                    </div>
                </div>
            </div>

        <?php if ($article === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>
            <?php if ($line === '4&5-a'): ?>    
            <br>

            <?php endif;?> 
                    
<table>
            <thead>
                <tr>
                    <th rowspan="3"style="width:5%; padding: 2px 10px">Time</th>
                    <th colspan="3">Oil Temp (°C)</th>
                <?php if ($line == 'coating-a' || $line == 'coating-b' || $line == 'coating-c' || $line == 'coating-d' || $line == 'bopet-a' || $line == 'bopet-b') :?>
                    <th rowspan="2">Chimney Temp (°C)</th>
                    <th>Burner (%)</th>
                <?php else: ?>
                    <th colspan="2">Burner (%)</th>
                <?php endif;?>
                    <th colspan="2">Oil Pressure Bar (Bar)</th>
                    <th colspan="2">Gas Counter</th>
                    <th colspan="2">Differential Pressure (Bar)</th>
                    <th colspan="2">Oil Level (%)</th>
                    <th colspan="2">Rembesan Oli</th>
                    <th rowspan="3" style="width:8%; padding: 2px 20px">NOTE</th>
                    <th rowspan="3" style="width:8%; padding: 2px 45px">PIC</th>
                </tr>
                <tr>
                    <th>Inlet</th>
                    <th>Outlet</th>
                    <th>Set Point</th>
                <?php if ($line != 'coating-a' && $line != 'coating-b' && $line != 'coating-c' && $line != 'coating-d' && $line != 'bopet-a' && $line != 'bopet-b') :?>
                    <th>Flame Burner</th>
                <?php endif;?>
                    <th>Load Burner</th>
                    <th>Suction Pump</th>
                    <th>Disch Pump</th>
                    <th>Pressure (mBar)</th>
                    <th>Volume (m3)</th>
                    <th>D1</th>
                    <th>D2</th>
                    <th>Storage Tank</th>
                    <th>Expantion Tank</th>
                    <th style="width:2%">Pompa</th>
                    <th style="width:2%">Jalur Pipa</th>
                </tr>
                <tr>
                <?php if ($line == '4&5-a' || $line == '4&5-b'): ?>
                    <th>260±10</th>
                    <th>270±10</th>
                    <th>270±10</th>
                    <th>min 70%</th>
                    <th>10-100%</th>
                    <th>>0</th>
                    <th>4~7</th>
                <?php elseif ($line == '8'): ?>
                    <th>256±5</th>
                    <th>260±5</th>
                    <th>260±5</th>
                    <th>min 70%</th>
                    <th>10-100%</th>
                    <th>>0</th>
                    <th>5~7</th>
                <?php elseif ($line == 'coating-a' || $line == 'coating-b' || $line == 'coating-c' || $line == 'coating-d'): ?>
                    <th>220±10</th>
                    <th>250±15</th>
                    <th>250±5</th>
                    <th>&lt;350</th>
                    <th>35-85%</th>
                    <th>&gt;0</th>
                    <th>4~7</th>
                <?php elseif ($line == 'bopet-a'): ?>
                    <th>295±5</th>
                    <th>305±5</th>
                    <th>305±5</th>
                    <th>&lt;400</th>
                    <th>30-55%</th>
                    <th>1~2</th>
                    <th>5.5~7</th>
                <?php elseif ($line == 'bopet-b'): ?>
                    <th>295±5</th>
                    <th>308±5</th>
                    <th>308±5</th>
                    <th>&lt;400</th>
                    <th>20-70%</th>
                    <th>1~2</th>
                    <th>5.5~7</th>
                <?php elseif ($line == '6&7-central'): ?>
                    <th>260±5</th>
                    <th>270±5</th>
                    <th>270±5</th>
                    <th>min 70%</th>
                    <th>10-80%</th>
                    <th>&gt;0</th>
                    <th>4~7</th>
                <?php elseif ($line == '6' || $line == '7'): ?>
                    <?php if ($line == '7'): ?>
                    <th>250±5</th>
                    <?php else: ?>
                    <th>246±5</th>
                    <?php endif; ?>
                    <th>260±5</th>
                    <th>260±5</th>
                    <th>min 70%</th>
                    <th>10-60%</th>
                    <th>&gt;0</th>
                    <th>4~7</th>
                <?php endif; ?>

                    <th>10-500</th>
                    <th></th>
                    <th colspan="2">0.1~0.6</th>
                    <th colspan="2">35-65%</th>
                    <th colspan="2">Kering</th>
                
                </tr>
            </thead>
                <article>
                <tbody>
                <?php
                    $times = array(
                        "8.00", "9.00", "10.00", "11.00", "12.00", "13.00", "14.00",
                        "15.00", "16.00", "17.00", "18.00", "19.00", "20.00", "21.00", "22.00",
                        "23.00", "0.00", "1.00", "2.00", "3.00", "4.00", "5.00", "6.00", "7.00"
                    );
                    
                    $fields = array(
                        'oiltemp_inlet' => array('title' => 'Oil Temperature Inlet', 'unit' => 'Temperature (°C)'),
                        'oiltemp_outlet' => array('title' => 'Oil Temperature Outlet', 'unit' => 'Temperature (°C)'),
                        'oiltemp_setpoint' => array('title' => 'Oil Temperature Setpoint', 'unit' => 'Temperature (°C)'),
                        'flameburner' => array('title' => 'Flame Burner', 'unit' => 'Burner (%)'),
                        'loadburner' => array('title' => 'Load Burner', 'unit' => 'Burner (%)'),
                        'press_suctionpump' => array('title' => 'Oil Pressure Suction Pump', 'unit' => 'Pressure (Bar)'),
                        'press_discpump' => array('title' => 'Oil Pressure Disc Pump', 'unit' => 'Pressure (Bar)'),
                        'counter_press' => array('title' => 'Gas Counter Pressure', 'unit' => 'Pressure (mBar)'),
                        'counter_vol' => array('title' => 'Gas Counter Volume', 'unit' => 'Volume (L)'),
                        'difpress_d1' => array('title' => 'Differential Pressure D1', 'unit' => 'Pressure (Bar)'),
                        'difpress_d2' => array('title' => 'Differential Pressure D2', 'unit' => 'Pressure (Bar)'),
                        'lvl_storage' => array('title' => 'Oil Level Storage Tank', 'unit' => 'Level (%)'),
                        'lvl_exp' => array('title' => 'Oil Level Expansion Tank', 'unit' => 'Level (%)'),
                        'rembes_pompa' => array('title' => 'N/A', 'unit' => 'N/A'),
                        'rembes_pipa' => array('title' => 'N/A', 'unit' => 'N/A'),
                        'note' => array('title' => 'Note', 'unit' => 'N/A'),
                        'pic' => array('title' => 'Person in Charge', 'unit' => 'N/A')
                    );
                    
                    
                ?>

                <?php foreach ($times as $time) : ?>
                    <tr>
                    <th class="measure2" style="width:100px"><?php echo $time; ?></th>
                            <?php
                            foreach ($fields as $field => $data) {
                                $title = $data['title'];
                                $unit = $data['unit'];

                                if (($line == 'coating-a' || $line == 'coating-b' || $line == 'coating-c' || $line == 'coating-d' || $line == 'bopet-a' || $line == 'bopet-b') && $field === 'flameburner') {
                                    $field = 'chimney_temp';
                                }
                                $fieldName = $field .'_'.str_replace(".00", "", $time);
                                if ($line == '4&5-a' || $line == '4&5-b'){
                                    include 'indicator-boiler-45.php';
                                } elseif ($line == '8'){
                                    include 'indicator-boiler-8.php'; 
                                } elseif ($line == 'coating-a' || $line == 'coating-b' || $line == 'coating-c' || $line == 'coating-d'){
                                    include 'indicator-boiler-coat.php'; 
                                } elseif ($line == 'bopet-a' || $line == 'bopet-b'){
                                    include 'indicator-boiler-bopet.php'; 
                                } elseif ($line == '6&7-central'){
                                    include 'indicator-boiler-67central.php'; 
                                } elseif ($line == '6' || $line == '7'){
                                    include 'indicator-boiler-67.php'; 
                                }
                                
                                if($field === 'pic'){
                                    $time_fields = 'time'.'_'.str_replace(".00", "", $time);
                                    echo "<td class='pic'>";
                                    echo "<div>" . htmlspecialchars(formatValue($article[$fieldName])) . "</div>";
                                    echo "<div>" . htmlspecialchars(formatValue($article[$time_fields])) . "</div>";
                                    echo "</td>";
                                } else{
                                    if ($field === 'note' || $field === 'pic' || $field === 'rembes_pompa' || $field === 'rembes_pipa') {
                                        echo "<td $style>";
                                    } else {
                                        echo "<td $style class='clickToPlot' 
                                        data-label='" . htmlspecialchars($field) . "' 
                                        data-title='" . htmlspecialchars($title) . "' 
                                        data-unit='" . htmlspecialchars($unit) . "' 
                                        data-line='" . htmlspecialchars($line) . "'  
                                        data-tooltip='Click to show plot' 
                                        onclick='clickToPlot(this)'>";  
                                    }
                                    echo htmlspecialchars(formatValue($article[$fieldName]));
                                    echo "</td>";
                                }    
                            }
                            ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                </article>
        </table>
        <span class="legalDoc" style="margin-top: -20px;">
            <?php if ($line == 'coating-a'){
                echo 'H1-OCB-02-24R0';
            } elseif ($line == 'coating-b'){
                echo 'H1-OCB-01-24R0';
            } elseif ($line == 'coating-c'){
                echo 'H1-OCB-01-24R0';
            } elseif ($line == 'coating-d'){
                echo 'H1-OCB-04-24R0';
            } elseif ($line == '4&5-a'){
                echo 'H1-OCB-04-24R0';
            } elseif ($line == '4&5-b'){
                echo 'H1-OCB-06-24R0';
            } elseif ($line == '6'){
                echo 'H1-OCB-07-24R0';
            } elseif ($line == '7'){
                echo 'H1-OCB-08-24R0';
            } elseif ($line == '6&7-central'){
                echo 'H1-OCB-09-24R0';
            } elseif ($line == '8'){
                echo 'H1-OCB-10-24R0';
            } elseif ($line == 'bopet-a'){
                echo 'H1-OCB-10-24R0';
            } elseif ($line == 'bopet-b'){
                echo 'H1-OCB-12-24R0';
            }
        ?></span>
<br><br>
        <?php endif; ?>
        <hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">

        <?php endforeach; ?>

    </main>
    <script type="text/javascript" src="js/plotly.min.js"></script>
    <script>
        document.getElementById("exit").onclick=function (){
            location.href = 'selection.php'
        }
    </script>
    <script>
        // Get the selected date from the URL parameter
const urlParams = new URLSearchParams(window.location.search);
const selectedDate = urlParams.get('selectedDate');

function clickToPlot(element) {
    const line = element.getAttribute('data-line');
    const label = element.getAttribute('data-label');
    const title_data = element.getAttribute('data-title');
    const unit = element.getAttribute('data-unit');

    // Fetch data using Fetch API
    fetch(`/checklist/getPlotData.php?line=${encodeURIComponent(line)}&field=${encodeURIComponent(label)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.json();
        })
        .then(graphData => {
            // Prepare data for the chart
            const times = [
                "8.00", "9.00", "10.00", "11.00", "12.00", "13.00", "14.00",
                "15.00", "16.00", "17.00", "18.00", "19.00", "20.00", "21.00", "22.00",
                "23.00", "0.00", "1.00", "2.00", "3.00", "4.00", "5.00", "6.00", "7.00"
            ];

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
