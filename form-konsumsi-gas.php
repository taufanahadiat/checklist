<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
require_once 'database.php';
require 'request-konsumsi-gas.php';

// The allowed IP address
$allowed_ip = array('131.107.7.210', '131.107.109.42');
// Get the user's IP address
$user_ip = $_SERVER['REMOTE_ADDR'];

// Check if the user's IP matches the allowed IP
if ($_SESSION["type_user"] !== '2' && !in_array($user_ip, $allowed_ip)) {
    // If not, set an error message and redirect to selection.php
    echo "<script>alert('Anda sedang tidak terhubung dengan WiFi di area Genset. Pastikan koneksi WiFi anda tidak terputus'); window.location.href = './selection.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Report Konsumsi Gas</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../../img/icon.ico">
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <style>
        td {
            text-align: center;
        }
        .enum, .input-field {
            width: 100%;
            max-width: 65px;
            height: 25px;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
        }
        .input-field {
            cursor: text;
        }
 
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h2>FORM REPORT KONSUMSI GAS<br>Bulan: <?php echo $monthName; ?></h2>
    <table style="overflow-x: auto; display: block; width: 100%; max-height: 700px; overflow-y: auto; table-layout: auto;">
    <form method="post">
        <thead>
            <tr>
                <th rowspan="2" style="min-width:80px;">Lokasi</th>
                <th colspan="<?php echo $daysInMonth; ?>">Tanggal</th>
                <th rowspan="2">Total (m³)</th>
                <th rowspan="2">Total (Sm³)</th>
                <th rowspan="2">Total (MMBTU)</th>
                <th rowspan="2">Jumlah Hari Running</th>
                <th rowspan="2">Persentase Pemakaian Gas / Unit</th>
                <th rowspan="2">Total Persentase / lokasi tapping</th>
            </tr>
            <tr>
                <?php     
                    for ($i = 1; $i <= $daysInMonth; $i++) {
                        echo "<th style='min-width:30px;'>$i</th>";
                    }
                ?>
            </tr>
        </thead>
            <tbody>
            <?php 
$lines = array(
    'coating-a',
    'coating-b',
    'coating-c',
    'coating-d',
    '4&5-a',
    '4&5-b',
    '8',
    'bopet-a',
    'bopet-b',
    '6',
    '7',
    '6&7-central'
);


// Define the mapping of lines to database columns
$lineToColumnMap = array(
    'coating-a' => 'bgcc_a',
    'coating-b' => 'bgcc_b',
    'coating-c' => 'bgcc_c',
    'coating-d' => 'bgcc_d',
    '4&5-a' => 'bg45_a',
    '4&5-b' => 'bg45_b',
    '8' => 'bg8',
    'bopet-a' => 'bgpet_a',
    'bopet-b' => 'bgpet_b',
    '6' => 'bg6',
    '7' => 'bg7',
    '6&7-central' => 'bg67_central'
);


$currentMonthToday = date('Y-m'); // Get today month's date
$totalPerDay = array(); // To hold total per day
$total_mmbtu_values = array(); // To store total mmbtu for each line

foreach ($lines as $line) {
    echo "<th style='cursor: pointer; white-space: nowrap;' onclick=\"goToViewBoiler('$line', '$currentMonthToday')\">BG $line</th>";

    // Loop through each day of the month
    for ($i = 1; $i <= $daysInMonth; $i++) {
        // Create the date for the current loop iteration
        $currentDate = date('Y-m-') . str_pad($i, 2, '0', STR_PAD_LEFT); // Format the day as 'YYYY-MM-DD'

        // Check if the line exists in the mapping
        if (array_key_exists($line, $lineToColumnMap)) {
            $column = $lineToColumnMap[$line]; // Get the corresponding column name

            // Prepare the SQL query
            $sql = "SELECT $column FROM $unit WHERE tanggal = '$currentDate'";
            $result = mysqli_query($conn, $sql); // Assuming $conn is your MySQL connection

            if ($result) {
                $row = mysqli_fetch_assoc($result); // Fetch the result row
            
                // Check if the row has the mapped column and if it's NULL, display "-"
                $value = isset($row[$column]) && $row[$column] !== NULL ? (int)$row[$column]  : '-';
            } else {
                $value = '-'; // Handle case where query fails or row doesn't exist
            }
        } else {
            $value = ''; // Handle case where line is not mapped
        }

        // Output the value in the table cell
        echo "<td class='hover-enabled' onclick='editCell(this, \"$currentDate\", \"$column\")'>$value</td>";
    }
    // Total m3 for the current line and month
    $sql_total_m3 = "SELECT SUM($column) AS total_m3 FROM $unit WHERE DATE_FORMAT(tanggal, '%Y-%m') = DATE_FORMAT(NOW(), '%Y-%m')";
    $result_total_m3 = mysqli_query($conn, $sql_total_m3);
    $row_total_m3 = mysqli_fetch_assoc($result_total_m3);
    $total_m3 = isset($row_total_m3['total_m3']) ? round($row_total_m3['total_m3']) : 0;

    // Output total m3 in the table cell
    echo "<td>$total_m3</td>";

    // Calculate total sm3 using the formula
    $total_sm3 = round($total_m3 * ((1.01325 + 2) / 1.01559) * (288.71 / (273.15 + 31)) * (1 + (0.0002 * 2)));

    // Output total sm3 in the table cell
    echo "<td>$total_sm3</td>";

    // Calculate total MMBTU using total_sm3 divided by 27.4954
    $total_mmbtu = round($total_sm3 / 27.4954);
    $total_mmbtu_values[] = $total_mmbtu; // Store for later percentage calculation

    // Output total mmbtu in the table cell
    echo "<td>$total_mmbtu</td>";

    // Count how many values are greater than 0 for the current line in the current month
    $sql_count_greater_than_zero = "SELECT COUNT($column) AS count_gt_zero FROM $unit WHERE $column > 0 AND DATE_FORMAT(tanggal, '%Y-%m') = DATE_FORMAT(NOW(), '%Y-%m')";
    $result_count_gt_zero = mysqli_query($conn, $sql_count_greater_than_zero);
    $row_count_gt_zero = mysqli_fetch_assoc($result_count_gt_zero);
    $count_gt_zero = isset($row_count_gt_zero['count_gt_zero']) ? $row_count_gt_zero['count_gt_zero'] : 0;

    // Output the count in the table cell
    echo "<td>$count_gt_zero</td>";
    echo "<td class='percentage-cell' data-line-index='" . (count($total_mmbtu_values) - 1) . "'></td>"; // Placeholder for JavaScript to fill

    // For totalPercent1 (rows spanning from coating-a to bopet-b)
    if ($line === 'coating-a') {
        echo '<td class="total-percent1-cell" rowspan="9"></td>'; // Placeholder for total percentages
    }

    // For totalPercent2 (rows spanning from 6 to 6&7-central)
    if ($line === '6') {
        echo '<td class="total-percent2-cell" rowspan="3"></td>'; // Placeholder for total percentages
    }


    // Close the line row
    echo "</tr>";
}

?>

<?php
$columns = array(
    'total_pemakaian_m3' => 'Total Pemakaian per hari (m³)',
    'total_pemakaian_sm3' => 'Total Pemakaian per hari (Sm³)',
    'mmbtu' => 'MMBTU/day',
);

foreach ($columns as $column => $header) {
    echo "<tr>";
    echo "<th style='font-size:13px;'>$header</th>";

    for ($i = 1; $i <= $daysInMonth; $i++) {
        $currentDate = date('Y-m-') . str_pad($i, 2, '0', STR_PAD_LEFT); // Format the day as 'YYYY-MM-DD'

        // Fetch the stored value from the database for this date and column
        $query = "SELECT $column FROM konsumsi_gas WHERE tanggal = '$currentDate'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $value = isset($row[$column]) ? $row[$column] : 0;

        echo "<td>{$value}</td>";
    }

    if($column === 'total_pemakaian_m3'){
        echo "<td style='border: none; background-color: #c1d6f3;'></td>";
        echo "<td style='border: none; background-color: #c1d6f3;'></td>";
        echo "<td style='background-color: yellow;' id='mmbtuDisplay'></td>";
    }
    if($column === 'total_pemakaian_sm3'){
        echo "<td style='border: none; background-color: #c1d6f3;'></td>";
        echo "<td style='border: none; background-color: #c1d6f3;'></td>";
        echo "<td style='border: none; background-color: #c1d6f3; font-size:11px; vertical-align: top; font-weight:550;'>Total per Bulan</td>";
    }

    echo "</tr>";
}
// Pass total MMBTU values to JavaScript
$linesJson = json_encode($lines);
echo "<script>
    var totalMmbtuValues = " . json_encode($total_mmbtu_values) . ";
    var totalMmbtuAllLines = " . array_sum($total_mmbtu_values) . ";
    
    // Convert PHP lines to JavaScript array
    var lines = $linesJson;

    // Arrays to hold percentages
    var totalPercent1 = [];
    var totalPercent2 = [];

    // Function to calculate percentages
    function calculatePercentages() {
        var percentageCells = document.querySelectorAll('.percentage-cell');
        percentageCells.forEach(function(cell, index) {
            var value = totalMmbtuValues[index];
            var percentage = totalMmbtuAllLines > 0 ? ((value / totalMmbtuAllLines) * 100).toFixed(2) : 0;

            // Store percentage in the appropriate array
            if (['coating-a', 'coating-b', 'coating-c', 'coating-d', '4&5-a', '4&5-b', '8', 'bopet-a', 'bopet-b'].includes(lines[index])) {
                totalPercent1.push(parseFloat(percentage));
            } else if (['6', '7', '6&7-central'].includes(lines[index])) {
                totalPercent2.push(parseFloat(percentage));
            }

            // Set percentage cell value
            cell.innerHTML = percentage + '%';
        });

        // Calculate total percentages for each category
        var totalPercent1Sum = totalPercent1.reduce((a, b) => a + b, 0).toFixed(2);
        var totalPercent2Sum = totalPercent2.reduce((a, b) => a + b, 0).toFixed(2);

        // Output the total percentages in the corresponding cells
        document.querySelector('.total-percent1-cell').innerHTML = totalPercent1Sum + '%';
        document.querySelector('.total-percent2-cell').innerHTML = totalPercent2Sum + '%';
    }

    // Call the function after the DOM is loaded
    document.addEventListener('DOMContentLoaded', calculatePercentages);
</script>";

?>

<tr>
    <th style="font-size:13px;">Data Harian Widar</th>
    <?php
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $currentDate = date('Y-m-') . str_pad($i, 2, '0', STR_PAD_LEFT); // Format the day as 'YYYY-MM-DD'
        
        // Fetch the existing value for data_harian_widar for the current date
        $query = "SELECT data_harian_widar FROM konsumsi_gas WHERE tanggal = '$currentDate'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        
        // Check if a value exists
        if (isset($row['data_harian_widar']) && $row['data_harian_widar'] !== NULL && $row['data_harian_widar'] != 0) {
            $existingValue = htmlspecialchars($row['data_harian_widar']); // Sanitize output
            echo "<td class='hover-enabled' onclick='editCell(this, \"$currentDate\", \"data_harian_widar\")'>$existingValue</td>"; // Correctly display the existing value
        } else {
            echo '<td><input style="min-width:60px;" class="input-field" type="number" name="data_harian_widar[' . $currentDate . ']" step="0.01"></td>';
        }
    }
    ?>
</tr>
<tr>
    <th style="font-size:13px;">Selisih Sm³</th>
    <?php
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $currentDate = date('Y-m-') . str_pad($i, 2, '0', STR_PAD_LEFT); // Format the day as 'YYYY-MM-DD'

        // Fetch the existing value from the database
        $query = "SELECT selisih_sm3 FROM konsumsi_gas WHERE tanggal = '$currentDate'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // Display the selisih_sm3 value if it exists, otherwise display a placeholder
        if (isset($row['selisih_sm3'])) {
            $existingSelisihSm3 = htmlspecialchars($row['selisih_sm3']); // Sanitize output
            echo '<td>' . $existingSelisihSm3 . '</td>';
        } else {
            echo '<td>-</td>'; // Display 'N/A' if no value exists
        }
    }
    ?>
</tr>
<tr>
    <th style="font-size:13px;">MMBTU Widar</th>
    <?php
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $currentDate = date('Y-m-') . str_pad($i, 2, '0', STR_PAD_LEFT); // Format the day as 'YYYY-MM-DD'
        
        // Fetch the existing value for mmbtu_widar for the current date
        $query = "SELECT mmbtu_widar FROM konsumsi_gas WHERE tanggal = '$currentDate'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        
        // Check if a value exists
        if (isset($row['mmbtu_widar']) && $row['mmbtu_widar'] !== NULL && $row['mmbtu_widar'] != 0) {
            $existingValue = htmlspecialchars($row['mmbtu_widar']); // Sanitize output
            echo "<td class='hover-enabled' onclick='editCell(this, \"$currentDate\", \"mmbtu_widar\")'>$existingValue</td>"; // Correctly display the existing value
        } else {
            echo '<td><input style="min-width:60px;" class="input-field" type="number" name="mmbtu_widar[' . $currentDate . ']" step="0.01"></td>';
        }
    }
    ?>
</tr>
<tr>
    <th style="font-size:13px;">Selisih MMBTU</th>
    <?php
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $currentDate = date('Y-m-') . str_pad($i, 2, '0', STR_PAD_LEFT); // Format the day as 'YYYY-MM-DD'

        // Fetch the existing value from the database
        $query = "SELECT selisih_mmbtu FROM konsumsi_gas WHERE tanggal = '$currentDate'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // Display the selisih_mmbtu value if it exists, otherwise display a placeholder
        if (isset($row['selisih_mmbtu'])) {
            $existingSelisihMMBTU = htmlspecialchars($row['selisih_mmbtu']); // Sanitize output
            echo '<td>' . $existingSelisihMMBTU . '</td>';
        } else {
            echo '<td>-</td>'; // Display 'N/A' if no value exists
        }
    }
    ?>
</tr>
            </tbody>
    </table>
    <button type="submit" name="synchronize" class="btn">Synchronize</button>

    </form>
</main>
<script>
document.getElementById("exit").onclick = function() {
    location.href = 'selection.php';
}
$(".enum").prop("selectedIndex", -1);
$(".input-field").val('');

document.getElementById("mmbtuDisplay").innerText = totalMmbtuAllLines;

function goToViewBoiler(selectedLine, selectedMonth) {
    // Construct the date in YYYY-MM-01 format
    var selectedDate = selectedMonth + '-01';
    // Redirect to the specified URL
    location.href = 'view-boiler.php?selectedUnit=boiler&selectedLine=' + encodeURIComponent(selectedLine) + '&selectedDate=' + encodeURIComponent(selectedDate);
}

function editCell(td, date, column) {
    const currentValue = td.innerText;
    const input = document.createElement('input');
    input.type = 'number';
    input.value = currentValue === '-' ? '' : currentValue;
    input.classList.add('input-field');

    td.innerHTML = ''; // Clear the cell
    td.appendChild(input);
    input.focus();

    // Create the save button
    const saveButton = document.createElement('button');
    saveButton.innerText = 'Save';
    saveButton.onclick = function() {
        let newValue = parseFloat(input.value); // Convert input to a number

        if (!isNaN(newValue)) {
            newValue = (newValue + 0.1).toFixed(1); // Add 0.1 to the input value and format it to 1 decimal place
        } else {
            newValue = ''; // If the input value is not a number, handle it gracefully
        }

        // AJAX request to save the new value
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update-konsumsi-gas.php', true); // URL to your PHP save script
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Check the response from the server
                if (xhr.responseText.trim() === 'Success') {
                    const integerValueToShow = Math.floor(newValue); // Convert to integer for display
                    td.innerHTML = integerValueToShow || '-'; // Update the cell with the new value
                } else {
                    alert('Error saving value. Please try again.'); // Error message
                    td.innerHTML = currentValue; // Restore the original value on error
                }
            } else {
                alert('Error saving value. Please try again.'); // General error message
                td.innerHTML = currentValue; // Restore the original value on error
            }
        };
        xhr.send('date=' + encodeURIComponent(date) + '&column=' + encodeURIComponent(column) + '&value=' + encodeURIComponent(newValue));
    };

    td.appendChild(saveButton);
}
</script>
</body>
</html>
