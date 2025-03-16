<?php
$unit = htmlspecialchars($_GET['selectedUnit']); // Sanitize the 'unit' parameter from the query string
require 'database.php';
require 'request.php';

// The allowed IP address
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

$unit_headings = array(
    "genset_wartsila_01" => "Genset Wartsila 01",
    "genset_wartsila_02" => "Genset Wartsila 02"
);

if (array_key_exists($unit, $unit_headings)):
    ?>
    <h2><?php echo $unit_headings[$unit]; ?></h2>
<?php else: ?>
    <h2>Unknown Unit</h2>
<?php endif; ?>

                    
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
            <tbody>
            <form method="post">
        <?php
            require 'database.php';
            include 'request-view.php';
                $parameters = array(
                    array("Running Hours", "-", "Hour", "running_hrs"),
                    array("Lube Oil Sump Level", "14~17", "Cm", "lube_oil_sump_lvl"),
                    array("Air Condensation Heater", "-", "On", "anti_cond_heater"),
                    array("Pre lube Pump", "-", "On", "prelube_pump", true),
                    array("Pre lube Pump Press", ">0.5", "Bar", "prelube_pump_press"),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil", true),
                    array("Preheating Unit", "-", "On", "preheat_unit", true),
                    array("HT Water Outlet Temp", ">50", "°C", "ht_water_outlet_temp"),
                    array("HT Expantion Tank lvl", "50~95", "Cm", "ht_expantion_tank_lvl"),
                    array("LT Expantion Tank lvl", "50~95", "Cm", "lt_expantion_tank_lvl"),
                    array("Warming Up", "2~3", "Week", "warming_up"),
                    array("Fuel Oil Inlet Temp", "-", "°C", "fuel_oil_inlet_temp"),
                    array("Fuel Oil Inlet Pressure", "4.0~7.0", "Bar", "fuel_oil_inlet_pressure"),
                    array("Kebocoran Fuel", "A/TA/RS", "-", "kebocoran_fuel", true)
                );

                foreach ($parameters as $parameter) {
                    $name = $parameter[0];
                    $param = $parameter[1];
                    $setting = $parameter[2];
                    $field_name = $parameter[3];
                    $is_select = isset($parameter[4]) ? $parameter[4] : false;
                    $times = array("8_14", "16_22", "0_6"); // Times for the fields
                    echo "<tr>";
                    echo "<th class='measure'>$name</th>";
                    echo "<th class='parameter'>$param</th>";
                    echo "<th class='parameter-setting'>$setting</th>";

                    
                    if ($is_select) {
                        for ($i = 8; $i <= 22; $i += 2) {
                            $field_key = "{$field_name}_$i";
                            include 'indicator-genset.php';                
                            $field_data = isset($existing_record[$field_key]) ? htmlspecialchars($existing_record[$field_key]) : '';
                            if ($field_data !== '') {
                                echo "<td $style>" . htmlspecialchars(formatValue($field_data));
                                echo "<button type='button' class='clear-btn' data-field='{$field_name}_$i'>X</button>";
                                echo    '</td>';
                                } else {                            
                            echo "<td $style><select class='enum' name='{$field_name}_$i'>";
                            include $field_name === "kebocoran_oil" || $field_name === "kebocoran_fuel" ? 'enum-kebocoran.php' : 'enum-on-off.php';
                            echo "</select></td>";
                                }
                        }
                        for ($i = 0; $i <= 6; $i += 2) {
                            $field_key = "{$field_name}_$i";
                            include 'indicator-genset.php';                
                            $field_data = isset($existing_record[$field_key]) ? htmlspecialchars($existing_record[$field_key]) : '';                
                            if ($field_data !== '') {
                                echo "<td $style>" . htmlspecialchars(formatValue($field_data));
                                echo "<button type='button' class='clear-btn' data-field='{$field_name}_$i'>X</button>";
                                echo    '</td>';
                                } else {                            
                            echo "<td $style><select class='enum' name='{$field_name}_$i'>";
                            include $field_name === "kebocoran_oil" || $field_name === "kebocoran_fuel" ? 'enum-kebocoran.php' : 'enum-on-off.php';
                            echo "</select></td>";
                                }
                        }
                    } else {
                        // Add colspan for specific fields
                        if (in_array($name, array("Running Hours", "Lube Oil Sump Level", "HT Expantion Tank lvl", "LT Expantion Tank lvl"))) {
                            foreach ($times as $time) {
                                $field_key = "{$field_name}_$time";
                                include 'indicator-genset.php';                
                                if ($existing_record && isset($existing_record[$field_key])) {
                                    echo "<td colspan='4' $style>" . htmlspecialchars(formatValue($existing_record[$field_key]));
                                    echo "<button type='button' class='clear-btn' data-field='$field_key'>X</button>";
                                    echo    '</td>';
                                    } else {        
                                echo "<td colspan='4'><input type='number' step='0.01' class='input-field' name='{$field_name}_{$time}'></td>";
                                    }
                            }
                        } else if ($name === "Air Condensation Heater") {
                            foreach ($times as $time) {
                                $field_key = "{$field_name}_$time";
                                include 'indicator-genset.php';                
                                if ($existing_record && isset($existing_record[$field_key])) {
                                    echo "<td colspan='4' $style>" . htmlspecialchars(formatValue($existing_record[$field_key]));
                                    echo "<button type='button' class='clear-btn' data-field='$field_key'>X</button>";
                                    echo    '</td>';
                                    } else {        
                                echo "<td colspan='4'><select class='enum' name='{$field_name}_{$time}'>";
                                include 'enum-on-off.php'; 
                                echo "</select></td>";
                                    }
                            }                            
                        } else if ($name === "Warming Up") {
                            foreach ($times as $time) {
                                $field_key = "{$field_name}_$time";
                                include 'indicator-genset.php';                
                                if ($existing_record && isset($existing_record[$field_key])) {
                                    echo "<td colspan='4' $style>" . htmlspecialchars(formatValue($existing_record[$field_key]));
                                    echo "<button type='button' class='clear-btn' data-field='$field_key'>X</button>";
                                    echo    '</td>';
                                    } else {        
                                echo "<td colspan='4'><select class='enum' name='{$field_name}_{$time}'>";
                                include 'enum-yes-no.php'; 
                                echo "</select></td>";
                                    }
                            }                        
                        } else {
                            for ($i = 8; $i <= 22; $i += 2) {
                                $field_key = "{$field_name}_$i";
                                include 'indicator-genset.php';                
                                $field_data = isset($existing_record[$field_key]) ? htmlspecialchars($existing_record[$field_key]) : '';                
                                if ($field_data !== '') {
                                    echo "<td $style>" . htmlspecialchars(formatValue($field_data));
                                    echo "<button type='button' class='clear-btn' data-field='{$field_name}_$i'>X</button>";
                                    echo    '</td>';
                                    } else {                          
                                echo "<td $style><input type='number' step='0.01' class='input-field' name='{$field_name}_$i'></td>";
                                    }
                            }
                            for ($i = 0; $i <= 6; $i += 2) {
                                $field_key = "{$field_name}_$i";
                                include 'indicator-genset.php';                
                                $field_data = isset($existing_record[$field_key]) ? htmlspecialchars($existing_record[$field_key]) : '';                
                                if ($field_data !== '') {
                                    echo "<td $style>" . htmlspecialchars(formatValue($field_data));
                                    echo "<button type='button' class='clear-btn' data-field='{$field_name}_$i'>X</button>";
                                    echo    '</td>';
                                    } else {                           
                                echo "<td $style><input type='number' step='0.01' class='input-field' name='{$field_name}_$i'></td>";
                                    }
                            }
                        }
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
    document.getElementById("exit").onclick=function (){
    location.href = 'selection.php'
    }
    $(document).ready(function() {
        $(".enum").prop("selectedIndex", -1);
    });

</script>
</body>
</html>