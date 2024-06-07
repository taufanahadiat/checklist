<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
require 'database.php';
require 'request.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Checklist</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.7.1.min.js"></script>
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
        .clear-btn {
            float: right;
            background: none;
            border: none;
            color: red;
            font-size: 16px;
            cursor: pointer;
        }
        .clear-btn:hover {
            border: 1px solid red;
            border-radius: 4px;
        }
    </style>
</head>
<body>
<div class="header-img">
    <img id="logo" src="css/logo.png" alt="Logo Argha"><br>
    <img id="exit" src="css/exit.png" alt="Exit"><br>
</div>
<header>
    <h1>ONLINE CHECKLIST</h1>
</header>
<main>
    <h2>Heater Oil Unit</h2>
    <table>
        <thead>
            <tr>
                <th colspan="3">Time</th>
                <th>08.00</th>
                <th>10.00</th>
                <th>12.00</th>
                <th>14.00</th>
                <th>16.00</th>
                <th>18.00</th>
                <th>20.00</th>
                <th>22.00</th>
                <th>0.00</th>
                <th>2.00</th>
                <th>4.00</th>
                <th>6.00</th>
            </tr>
        </thead>
        <form method="post">
            <tbody>
                <?php
                require 'database.php';
                date_default_timezone_set('Asia/Jakarta'); // Replace 'YOUR_TIMEZONE' with the appropriate timezone

                // Determine if the current time is between 00:00-06:00
                $currentHour = (int) date('H');
                if ($currentHour >= 0 && $currentHour < 6) {
                    $tanggal = date("Y-m-d", strtotime("-1 day")); // Yesterday's date
                } else {
                    $tanggal = date("Y-m-d"); // Today's date
                }
                $sql_select = "SELECT * FROM $unit WHERE tanggal = CURDATE()";
                $result_select = mysqli_query($conn, $sql_select);
                if (!$result_select) {
                    die("Query failed: " . mysqli_error($conn));
                }                
                $existing_record = mysqli_fetch_assoc($result_select);
                $measurements = array(
                    array("Operating Pump#1", "ON/OFF", "-", "operating_pump1_", "enum-on-off.php"),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil1_", "enum-kebocoran.php"),
                    array("Operating Pump#2", "ON/OFF", "-", "operating_pump2_", "enum-on-off.php"),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil2_", "enum-kebocoran.php"),
                    array("Inlet Pressure", "1.5~3.0", "Bar", "inlet_pressure_", null),
                    array("Heater Temp. Tank #1", "70~90", "°C", "heater_temp_tank1_", null),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil_tank1_", "enum-kebocoran.php"),
                    array("Heater Temp. Tank #2", "70~90", "°C", "heater_temp_tank2_", null),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil_tank2_", "enum-kebocoran.php"),
                    array("Oil Temperature Supply", "60~90", "°C", "oil_temp_supply_", null),
                    array("Oil Temperature Return", "50~80", "°C", "oil_temp_return_", null),
                    array("HFO Outlet Temp", "60~90", "°C", "hfo_outlet_temp_", null),
                    array("HFO Day Tank Temp", "60~90", "°C", "hfo_tank_temp_", null)
                );

                $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");

                foreach ($measurements as $measurement) {
                    echo "<tr>";
                    echo "<th class='measure'>{$measurement[0]}</th>";
                    echo "<th class='parameter'>{$measurement[1]}</th>";
                    echo "<th class='parameter-setting'>{$measurement[2]}</th>";

                    foreach ($times as $time) {
                        echo "<td>";
                        $field_name = $measurement[3] . $time;
                        if ($existing_record && isset($existing_record[$field_name])) {
                            echo htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';
                            } else {
                        if ($measurement[4] !== null) {
                            echo "<select class='enum' name='$field_name'>";
                            include $measurement[4];
                            echo "</select>";
                        } else {
                            echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                        }
                    }
                        echo "</td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
    </table>
    <br>
    <button class="btn">SAVE</button>
    </form>
</main>
<script>
document.getElementById("exit").onclick = function() {
    location.href = 'selection.php';
}
$(".enum").prop("selectedIndex", -1);
$(".input-field").val('');

$(document).ready(function() {
        $('.clear-btn').click(function() {
            var fieldToClear = $(this).data('field');
            var confirmed = confirm('Are you sure you want to clear this field?');

            if (confirmed) {
                // Send an AJAX request to update the field to NULL
                $.ajax({
                    url: 'clear_field.php',
                    method: 'POST',
                    data: {
                        field_to_clear: fieldToClear,
                        unit: '<?php echo $unit; ?>' // Pass the unit parameter
                    },
                    success: function(response) {
                        // Reload the page after clearing the field
                        location.reload();
                    },
                    error: function(xhr, status, error) {
                        // Handle error
                        console.error(xhr.responseText);
                    }
                });
            }
        });
    });
</script>
</body>
</html>
