<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
require 'database.php';
require 'request.php';

$allowed_ip = array('131.107.7.210');
// Get the user's IP address
$user_ip = $_SERVER['REMOTE_ADDR'];

// Check if the user's IP matches the allowed IP
if ($_SESSION["id"] !== '1' && !in_array($user_ip, $allowed_ip)) {
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
        td{
            text-align: center;
        }
        .enum , .input-field{
            width: 100%;
            max-width: 65px;
            height: 25px;
            text-align: center;
            font-weight:700;
            cursor: pointer;
        }
        .input-field{
            cursor: text;
        }
 
    </style>

</head>

<body>
<?php include 'header.php'; ?>
<main>
    
<?php
// Define an associative array mapping $unit values to headings
$unit_headings = array(
    "hfo_unloading_pump_unit" => "HFO Unloading Pump Unit",
    "fuel_transfer_pump_unit" => "Fuel Transfer Pump Unit",
    "hfo_separator_pump_unit"=> "HFO Separator Pump Unit",
    "lfo_unloading_pump_unit"=> "LFO Unloading Pump Unit"
);

// Check if the $unit exists in the array keys
if (array_key_exists($unit, $unit_headings)):
    ?>
    <h2><?php echo $unit_headings[$unit]; ?></h2>
<?php endif; ?>

                
<table>
<?php include 'pilih-unit-genset.php' ?>
    
        <thead>
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
    </thead>
    <form method="post">
            <tbody>
                <?php
                require 'database.php';
                include 'request-view.php';         

                $time_ranges = array('8_14', '16_22', '0_6');
                $times = array('8', '10', '12', '14', '16', '18', '20', '22', '0', '2', '4', '6');

                ?>
                <tr>
                <th class="measure">Operating Pump#1</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "operating_pump1_$range";

                            if ($existing_record && isset($existing_record[$field_name])) {
                            echo '<td colspan="4">' . htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';
                            } else {
                                echo "<td colspan='4'>";
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-on-off.php';
                                echo "</select>";
                            echo "</td>";
                            }
                        }                    
                    ?>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "kebocoran_fuel1_$time";

                            if ($existing_record && isset($existing_record[$field_name])) {
                            echo '<td>' . htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';

                            } else {
                                echo "<td>";
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-kebocoran.php';
                                echo "</select></td>";
                            }
                        }
                    ?>
                </tr>
                <tr>  
                    <th class="measure">Operating Pump#2</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "operating_pump2_$range";

                            if ($existing_record && isset($existing_record[$field_name])) {
                            echo '<td colspan="4">' . htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';
                            } else {
                                echo "<td colspan='4'>";
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-on-off.php';
                                echo "</select>";
                            echo "</td>";
                            }
                        }                   
                    ?>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "kebocoran_fuel2_$time";

                            if ($existing_record && isset($existing_record[$field_name])) {
                            echo '<td>' . htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';
                            } else {
                                echo "<td>";
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-kebocoran.php';
                                echo "</select></td>";
                            }
                        }
                    ?>
                </tr>
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
    <span class="legalDoc" style="margin-top: -25px;">
            <?php if ($unit == 'hfo_unloading_pump_unit'){
                echo 'H1-GHUP-27-24R0';
            } elseif ($unit == 'fuel_transfer_pump_unit'){
                echo 'H1-GFTP-28-24R0';
            } elseif ($unit == 'hfo_separator_pump_unit'){
                echo 'H1-HFSP-36-24R0';
            } elseif ($unit == 'lfo_unloading_pump_unit'){
                echo 'H1-LUUP-37-24R0';
            } 
        ?></span>
    <br>
    <button class="btn" id="save-button">SAVE</button>
    </form>
</main>
<script>
        document.getElementById("exit").onclick=function (){
            location.href = 'selection.php'
        }
        $(".enum").prop("selectedIndex", -1);
        $(".input-field").val('');

    </script>
</body>
</html>