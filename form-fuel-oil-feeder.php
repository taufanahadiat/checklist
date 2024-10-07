<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
require 'database.php';
require 'request.php';

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
    <title>Form Checklist</title>
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
    <h2>Fuel Oil Feeder Unit</h2>
    <table>
<?php include 'pilih-unit-genset.php' ?>
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
                include 'request-view.php';

            $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");

            $measures = array(
                array("Operating Pump#1", "ON/OFF", "-", "operating_pump1", 'enum-on-off.php'),
                array("Kebocoran Fuel", "A/TA/RS", "-", "kebocoran_fuel1", 'enum-kebocoran.php'),
                array("Operating Pump#2", "ON/OFF", "-", "operating_pump2", 'enum-on-off.php'),
                array("Kebocoran Fuel", "A/TA/RS", "-", "kebocoran_fuel2", 'enum-kebocoran.php'),
                array("Outlet Pressure", "3.0~5.0", "Bar", "outlet_pressure", null),
                array("Outlet Temperature", "50~80", "°C", "outlet_temp", null),
            );

            foreach ($measures as $measure) {
                echo "<tr>";
                echo "<th class='measure'>{$measure[0]}</th>";
                echo "<th class='parameter'>{$measure[1]}</th>";
                echo "<th class='parameter-setting'>{$measure[2]}</th>";

                foreach ($times as $time) {
                    $field_name = "{$measure[3]}_$time";
                    include 'indicator-fuel-oil-feeder.php';
                    echo "<td $style>";
                    if ($existing_record && isset($existing_record[$field_name])) {
                        echo htmlspecialchars(formatValue($existing_record[$field_name]));
                        echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                        echo    '</td>';
                        } else {
                    if ($measure[4]) {
                        echo "<select class='enum' name='$field_name'>";
                        include $measure[4];
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
            <tr>
                <th class="measure2" colspan="3">Entry By</th>
                <?php
                $pic_fields = array('pic_8', 'pic_10', 'pic_12', 'pic_14', 'pic_16', 'pic_18', 'pic_20', 'pic_22', 'pic_0', 'pic_2', 'pic_4', 'pic_6');
                $time_fields = array('time_8', 'time_10', 'time_12', 'time_14', 'time_16', 'time_18', 'time_20', 'time_22', 'time_0', 'time_2', 'time_4', 'time_6');

                foreach ($pic_fields as $pic_field) {
                    // Determine the corresponding time field
                    $time_field = str_replace('pic_', 'time_', $pic_field);
                    
                    echo "<td class='pic'>";
                    
                    // Display the pic field value
                    if ($existing_record && isset($existing_record[$pic_field])) {
                        echo "<div>" . htmlspecialchars(formatValue($existing_record[$pic_field])) . "</div>";
                    }
                    
                    // Display the time field value if it exists
                    if ($existing_record && isset($existing_record[$time_field])) {
                        echo "<div>" . htmlspecialchars(formatValue($existing_record[$time_field])) . "</div>";
                    }
                    
                    echo "</td>";
                }
                ?>

            </tr>  
            
            <tr>
                <th class="measure2" colspan="3">Notes</th>

                <?php 
            $current_note = '';
            if ($existing_record && isset($existing_record['note'])) {
                $current_note = $existing_record['note']; // Set current_note to the existing note
                echo "<td colspan='12' id='note-container' style='text-align:left; padding: 5px 10px'>";
                echo htmlspecialchars(formatValue($existing_record['note']));
                echo "<button type='button' class='clear-btn' data-field='note'>X</button>";
                echo "<button type='button' class='edit-btn' data-current-note='" . htmlspecialchars($current_note, ENT_QUOTES) . "'>EDIT</button>";
                echo "</td>";
            } else {
                echo "<td colspan='12' style='text-align:left; padding: 4px 0.8%;'><textarea name='note' id='note-textarea' style='height:30px;width:90%;padding:4px;'></textarea></td>";
            }
            ?>
            </tr>
            </tbody>
    </table>
    <br>
    <button class="btn" id="save-button">SAVE</button>
    </form>
</main>
<script>
    document.getElementById("exit").onclick = function () {
        location.href = 'selection.php'
    }
    $(".enum").prop("selectedIndex", -1);
    $(".input-field").val('');

</script>
</body>
</html>
