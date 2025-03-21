<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
$bulan = $_GET['selectedMonth'];
require_once 'database.php';
require 'request-konsumsi-gas.php';

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
    <h2>VIEW REPORT KONSUMSI GAS<br>Bulan: <?php echo $monthName; ?></h2>
    <button class="btn" style="float:left; margin:0;" onclick="exportTableToExcel('tableGas', 'data_report', <?php echo $daysInMonth; ?>);">Export to Excel</button>
                
<table id="tableGas" style="overflow-x: auto; display: block; width: 100%; max-height: 700px; overflow-y: auto; table-layout: auto;">
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



$totalPerDay = array(); // To hold total per day
$total_mmbtu_values = array(); // To store total mmbtu for each line

foreach ($lines as $line) {
    echo "<th style='cursor: pointer; white-space: nowrap;' onclick=\"goToViewBoiler('$line', '$bulan')\">BG $line</th>";

    // Loop through each day of the month
    for ($i = 1; $i <= $daysInMonth; $i++) {
        // Format $i to ensure it has two digits (e.g., 01, 02, ... 31)
        $day = str_pad($i, 2, '0', STR_PAD_LEFT);

        // Combine $tanggal (yyyy-mm) with $day to create the full yyyy-mm-dd format
        $full_date = "$bulan-$day";
        
        if (array_key_exists($line, $lineToColumnMap)) {
            $column = $lineToColumnMap[$line]; // Get the corresponding column name

            // Prepare the SQL query
            $sql = "SELECT $column FROM $unit WHERE tanggal = '$full_date'";
            $result = mysqli_query($conn, $sql); // Assuming $conn is your MySQL connection

            if ($result) {
                $row = mysqli_fetch_assoc($result); // Fetch the result row

                // Check if the row has the mapped column and if it's NULL, display "-"
                if (isset($row[$column]) && $row[$column] !== NULL) {
                    $value = (int)$row[$column];
                } else {
                    $value = '-';
                }
            } else {
                $value = '-'; // Handle case where query fails or row doesn't exist
            }
        } else {
            $value = ''; // Handle case where line is not mapped
        }

        // Output the value in the table cell
        echo "<td class='edit_cell' data-date='$full_date' data-column='$column'>$value</td>";
    }
    // Total m3 for the current line and month
    $sql_total_m3 = "SELECT SUM($column) AS total_m3 FROM $unit WHERE DATE_FORMAT(tanggal, '%Y-%m') = '$bulan'";
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
    $sql_count_greater_than_zero = "SELECT COUNT($column) AS count_gt_zero FROM $unit WHERE $column > 0 AND DATE_FORMAT(tanggal, '%Y-%m') = '$bulan'";
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
    echo "<th class='measure' style='font-size:13px;'>$header</th>";

    for ($i = 1; $i <= $daysInMonth; $i++) {
        $day = str_pad($i, 2, '0', STR_PAD_LEFT);

        // Combine $tanggal (yyyy-mm) with $day to create the full yyyy-mm-dd format
        $full_date = "$bulan-$day";

        // Fetch the stored value from the database for this date and column
        $query = "SELECT $column FROM konsumsi_gas WHERE tanggal = '$full_date'";
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
    <th style="font-size:13px;" class="measure">Data Harian Widar</th>
    <?php
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $day = str_pad($i, 2, '0', STR_PAD_LEFT);

        // Combine $tanggal (yyyy-mm) with $day to create the full yyyy-mm-dd format
        $full_date = "$bulan-$day";
        
        // Fetch the existing value for data_harian_widar for the current date
        $query = "SELECT data_harian_widar FROM konsumsi_gas WHERE tanggal = '$full_date'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        
        // Check if a value exists
        if (isset($row['data_harian_widar']) && $row['data_harian_widar'] !== NULL && $row['data_harian_widar'] != 0) {
            $existingValue = htmlspecialchars($row['data_harian_widar']); // Sanitize output
            echo "<td class='edit_cell' data-date='$full_date' data-column='data_harian_widar'>$existingValue</td>"; 
        } else {
            echo '<td><input style="display: none; min-width:60px" class="input-field" type="number" data-date="'.$full_date.'" name="data_harian_widar[' . $full_date . ']" step="0.01"></td>';
        }
    }
    ?>
</tr>
<tr>
    <th style="font-size:13px;" class="measure">Selisih Sm³</th>
    <?php
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $day = str_pad($i, 2, '0', STR_PAD_LEFT);

        $full_date = "$bulan-$day";

        // Fetch the existing value from the database
        $query = "SELECT * FROM konsumsi_gas WHERE tanggal = '$full_date'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // Display the selisih_sm3 value if it exists, otherwise display a placeholder
        if (isset($row['data_harian_widar'])) {
            $selisihSm3 = $row['data_harian_widar'] - $row['total_pemakaian_sm3']; // Sanitize output
            echo '<td>' . $selisihSm3 . '</td>';
        } else {
            echo '<td>-</td>'; // Display 'N/A' if no value exists
        }
    }
    ?>
</tr>
<tr>
    <th style="font-size:13px;" class="measure">MMBTU Widar</th>
    <?php
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $day = str_pad($i, 2, '0', STR_PAD_LEFT);

        // Combine $tanggal (yyyy-mm) with $day to create the full yyyy-mm-dd format
        $full_date = "$bulan-$day";
        
        // Fetch the existing value for mmbtu_widar for the current date
        $query = "SELECT mmbtu_widar FROM konsumsi_gas WHERE tanggal = '$full_date'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        
        // Check if a value exists
        if (isset($row['mmbtu_widar']) && $row['mmbtu_widar'] !== NULL) {
            $existingValue = htmlspecialchars($row['mmbtu_widar']); // Sanitize output
            echo "<td class='edit_cell' data-date='$full_date' data-column='data_harian_widar'>$existingValue</td>"; // Correctly display the existing value
        } else {
            echo '<td><input style="display: none; min-width:60px" class="input-field" type="number" data-date="'.$full_date.'" name="mmbtu_widar[' . $full_date . ']" step="0.01"></td>';
        }
    }
    ?>
</tr>
<tr>
    <th style="font-size:13px;" class="measure">Selisih MMBTU</th>
    <?php
    for ($i = 1; $i <= $daysInMonth; $i++) {
        $day = str_pad($i, 2, '0', STR_PAD_LEFT);

        $full_date = "$bulan-$day";

        // Fetch the existing value from the database
        $query = "SELECT * FROM konsumsi_gas WHERE tanggal = '$full_date'";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // Display the selisih_sm3 value if it exists, otherwise display a placeholder
        if (isset($row['mmbtu_widar'])) {
            $selisihMMBTU = $row['mmbtu_widar'] - $row['mmbtu']; // Sanitize output
            echo '<td>' . $selisihMMBTU . '</td>';
        } else {
            echo '<td>-</td>'; // Display 'N/A' if no value exists
        }
    }
    ?>
</tr>
            </tbody>
    </table>
    <span class="legalDoc" style="margin-top: -20px;">H1-RKG-13-24R0</span><br>
    <button type="submit" id='sync' name="synchronize" class="btn" style="display: none;">Synchronize</button>
    <button id='editButton' onclick='enableEditMode(event)' class="btn">Edit</button>

    </form>
</main>
<script src="js/exceljs.min.js"></script>
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

    function enableEditMode(event) {
        // Prevent the default button behavior
        event.preventDefault();

        document.getElementById('sync').style.display = 'inline-block'; 
        document.getElementById('editButton').style.display = 'none'; 
        
        const cells = document.querySelectorAll('.edit_cell');
        const inputFields = document.querySelectorAll('.input-field');

        cells.forEach(cell => {
        cell.dataset.editable = 'true'; // Mark the cell as editable
        cell.onclick = function() { editCell(this); }; // Assign click event to editCell

        // Find the corresponding input fields using both data-date and name attributes
        const dataHarianField = document.querySelector(`.input-field[data-date='${cell.dataset.date}'][name^="data_harian_widar"]`);
        const mmbtuField = document.querySelector(`.input-field[data-date='${cell.dataset.date}'][name^="mmbtu_widar"]`);

        // If fields exist, make them visible
        if (dataHarianField) {
            dataHarianField.style.display = 'inline-block';
        }
        if (mmbtuField) {
            mmbtuField.style.display = 'inline-block';
        }

        cell.classList.add('hover-enabled');
    });
    }

    function editCell(td) {
        // Check if the cell is editable
        if (td.dataset.editable === 'true') {
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
                xhr.send('date=' + encodeURIComponent(td.dataset.date) + '&column=' + encodeURIComponent(td.dataset.column) + '&value=' + encodeURIComponent(newValue));
            };

            // Append the save button to the cell
            td.appendChild(saveButton);
            td.dataset.editable = 'false'; // Mark the cell as not editable anymore
        }
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

async function exportTableToExcel(tableID, filename, daysInMonth) {
    // Determine the correct template based on daysInMonth
    let templateFile;
    switch (daysInMonth) {
        case 31:
            templateFile = "Template/konsumsiGas31.xlsx";
            break;
        case 30:
            templateFile = "Template/konsumsiGas30.xlsx";
            break;
        case 29:
            templateFile = "Template/konsumsiGas29.xlsx";
            break;
        case 28:
            templateFile = "Template/konsumsiGas28.xlsx";
            break;
        default:
            console.error("Invalid daysInMonth value!");
            return;
    }

    // Load ExcelJS Workbook
    const workbook = new ExcelJS.Workbook();
    await workbook.xlsx.load(fetch(templateFile).then(res => res.arrayBuffer()));

    const worksheet = workbook.getWorksheet('Sheet1');
    if (!worksheet) {
        console.error("Worksheet tidak ditemukan!");
        return;
    }

    const table = document.getElementById(tableID);
    const rows = table.querySelectorAll("tr");

    let startRow = 3;
    let startCol = 2;
    rows.forEach((row) => {
        const cells = row.querySelectorAll("td");
        cells.forEach((cell, cellIndex) => {
            let excelCell = worksheet.getCell(startRow, startCol + cellIndex);
            excelCell.value = cell.innerText;
        });

        startRow++;
    });

    const buffer = await workbook.xlsx.writeBuffer();
    const blob = new Blob([buffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
    
    // Create download link and trigger download
    const link = document.createElement("a");
    link.href = URL.createObjectURL(blob);
    link.download = filename + ".xlsx";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}
</script>
</body>
</html>
