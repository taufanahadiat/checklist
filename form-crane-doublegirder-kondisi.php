<?php
$line = $_GET['selectedLine']; 
$unit = $_GET['selectedUnit']; 
require 'request-crane.php';

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
</head>
<body>
<?php include 'header.php'; ?>    
<main>

<h2>
    <strong>CRANE DOUBLE GIRDER</strong>
    <br>
    <span style="font-size: large;">PENGECEKAN KONDISI</span>

</h2>
    <h4 style="text-align:left;">UNIT: <?php
    // Convert the string to uppercase
    $formattedUnit = strtoupper($line);

    // Replace underscores with spaces
    $formattedUnit = str_replace('_', ' ', $formattedUnit);

    // Find the position of the first comma
    $commaPos = strpos($formattedUnit, ',');

    // If there is a comma, process it
    if ($commaPos !== false) {
        // Remove the first comma
        $formattedUnit = substr_replace($formattedUnit, '', $commaPos, 1);

        // Insert "AREA" and a line break before what was the first comma
        $formattedUnit = substr_replace($formattedUnit, "<br>AREA: ", $commaPos, 0);
        
        // Replace remaining commas with comma followed by a space
        $formattedUnit = str_replace(',', ', ', $formattedUnit);
    }

    echo $formattedUnit;
?></h4>




    <div id="select-unit-crane" class="custom-label-sub">
        <form name="select-unit-crane" onsubmit="handleFormSubmit(event, 'option-unit-crane')">
            <div class="custom-label-form">
                <label for="option-unit-crane" >Form:</label>
                <select style="margin-left: 10px" class="selection-line" name="unit-crane" id="option-unit-crane">
                <option value="cek_kondisi">Pengecekan Kondisi</option>
                <option value="data_sheet">Data Sheet</option>
            </div>
            <div>
                <input style="margin-top: 20px; margin-left: 10px;" type="submit" class="btn-form" value="SUBMIT">
            </div>
        </form>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>Hoisting Unit A</th>
                <td>Check</td>
                <th>Hoisting Unit B</th>
                <td>Check</td>
                <th>Troley Unit A</th>
                <td>Check</td>
                <th>Troley Unit B</th>
                <td>Check</td>
            </tr>
        </thead>
        <form method="post">
            <tbody>
            <?php
            require 'database.php';
            include 'request-view-crane.php';
            $hoista_field = array(
                '2_hoista_body', '2_hoista_panel', '2_hoista_wire_rope', '2_hoista_end_rope', '2_hoista_rope_guide',
                '2_hoista_drum_hoisting', '2_hoista_limit','', '2_hoista_gear_noise', '2_hoista_gear_leakage', '', 
                '2_hoista_motor_rectifier', '2_hoista_motor_coil', '2_hoista_motor_disc', '2_hoista_motor_bearing', 
                '2_hoista_motor_fan'
              );
                          
            $hoista_desc = array(
                "1. Hoisting Body Condition", "2. Wire Rope Condition", "3. End Rope", "4. Rope Guide", "5. Rope Guide Spring",
                "6. Drum Hoisting", "7. Hoisting Limit Switch", "8. Hoisting Gearbox", "&nbsp;&nbsp;&nbsp;a. Noise", 
                "&nbsp;&nbsp;&nbsp;b. Leakage", "9. Hoisting Motor", "&nbsp;&nbsp;&nbsp;a. Rectifier", "&nbsp;&nbsp;&nbsp;b. Brake Coil",
                "&nbsp;&nbsp;&nbsp;c. Brake Disc", "&nbsp;&nbsp;&nbsp;d. Bearings", "&nbsp;&nbsp;&nbsp;e. Fan & Cover"
            );

            $hoistb_field = array(
                '2_hoistb_body', '2_hoistb_panel', '2_hoistb_wire_rope', '2_hoistb_end_rope', '2_hoistb_rope_guide',
                '2_hoistb_drum_hoisting', '2_hoistb_limit','', '2_hoistb_gear_noise', '2_hoistb_gear_leakage', '', 
                '2_hoistb_motor_rectifier', '2_hoistb_motor_coil', '2_hoistb_motor_disc', '2_hoistb_motor_bearing', 
                '2_hoistb_motor_fan'
              );
                          
            $hoistb_desc = array(
                "1. Hoisting Body Condition", "2. Wire Rope Condition", "3. End Rope", "4. Rope Guide", "5. Rope Guide Spring",
                "6. Drum Hoisting", "7. Hoisting Limit Switch", "8. Hoisting Gearbox", "&nbsp;&nbsp;&nbsp;a. Noise", 
                "&nbsp;&nbsp;&nbsp;b. Leakage", "9. Hoisting Motor", "&nbsp;&nbsp;&nbsp;a. Rectifier", "&nbsp;&nbsp;&nbsp;b. Brake Coil",
                "&nbsp;&nbsp;&nbsp;c. Brake Disc", "&nbsp;&nbsp;&nbsp;d. Bearings", "&nbsp;&nbsp;&nbsp;e. Fan & Cover"
            );

            $trolleya_field = array(
                '', '2_trolleya_gear_noise', '2_trolleya_gear_leakage', '', '2_trolleya_motor_rectifier', '2_trolleya_motor_coil',
                '2_trolleya_motor_disc', '2_trolleya_motor_bearing', '2_trolleya_motor_fan', '2_trolleya_crab', '',
                '2_trolleya_driving_bearing', '2_trolleya_driving_wheel', '', '2_trolleya_idle_bearing', 
                '2_trolleya_idle_wheel',
            );

            $trolleya_desc = array (
                "1. Trolley Gearbox", "&nbsp;&nbsp;&nbsp;a. Noise", "&nbsp;&nbsp;&nbsp;b. Leakage", "2. Trolley Motor",
                "&nbsp;&nbsp;&nbsp;a. Rectifier", "&nbsp;&nbsp;&nbsp;b. Brake Coil", "&nbsp;&nbsp;&nbsp;c. Brake Disc",
                "&nbsp;&nbsp;&nbsp;d. Bearings", "&nbsp;&nbsp;&nbsp;e. Fan & Cover", "3. Crab / Trolley condition",
                "4. Trolley Driving Wheel", "&nbsp;&nbsp;&nbsp;a. Bearings", "&nbsp;&nbsp;&nbsp;b. Wheel", "5. Trolley Idle Wheel",
                "&nbsp;&nbsp;&nbsp;a. Bearings", "&nbsp;&nbsp;&nbsp;b. Wheel"
            );

            $trolleyb_field = array(
                '', '2_trolleyb_gear_noise', '2_trolleyb_gear_leakage', '', '2_trolleyb_motor_rectifier', '2_trolleyb_motor_coil',
                '2_trolleyb_motor_disc', '2_trolleyb_motor_bearing', '2_trolleyb_motor_fan', '2_trolleyb_crab', '',
                '2_trolleyb_driving_bearing', '2_trolleyb_driving_wheel', '', '2_trolleyb_idle_bearing', 
                '2_trolleyb_idle_wheel',
            );

            $trolleyb_desc = array (
                "1. Trolley Gearbox", "&nbsp;&nbsp;&nbsp;a. Noise", "&nbsp;&nbsp;&nbsp;b. Leakage", "2. Trolley Motor",
                "&nbsp;&nbsp;&nbsp;a. Rectifier", "&nbsp;&nbsp;&nbsp;b. Brake Coil", "&nbsp;&nbsp;&nbsp;c. Brake Disc",
                "&nbsp;&nbsp;&nbsp;d. Bearings", "&nbsp;&nbsp;&nbsp;e. Fan & Cover", "3. Crab / Trolley condition",
                "4. Trolley Driving Wheel", "&nbsp;&nbsp;&nbsp;a. Bearings", "&nbsp;&nbsp;&nbsp;b. Wheel", "5. Trolley Idle Wheel",
                "&nbsp;&nbsp;&nbsp;a. Bearings", "&nbsp;&nbsp;&nbsp;b. Wheel"
            );

            $bridge_field = array(
                '', '2_bridge_gear_noise','2_bridge_gear_leakage', '', '2_bridge_motor_rectifier', '2_bridge_motor_coil',
                '2_bridge_motor_disc', '2_bridge_motor_bearing', '2_bridge_motor_fan',
                '2_end_carriage_frame', '', '2_bridge_driving_bearing', '2_bridge_driving_wheel',
                '', '2_bridge_idle_bearing', '2_bridge_idle_wheel'
            );

            $bridge_desc = array (
                "1. Bridge Gearbox", "&nbsp;&nbsp;&nbsp;a. Noise", "&nbsp;&nbsp;&nbsp;b. Leakage", "2. Bridge Motor",
                "&nbsp;&nbsp;&nbsp;a. Rectifier", "&nbsp;&nbsp;&nbsp;b. Brake Coil", "&nbsp;&nbsp;&nbsp;c. Brake Disc",
                "&nbsp;&nbsp;&nbsp;d. Bearings", "&nbsp;&nbsp;&nbsp;e. Fan & Cover", "3. End Carriage Frame Condition",
                "4. Bridge Driving Wheel", "&nbsp;&nbsp;&nbsp;a. Bearings", "&nbsp;&nbsp;&nbsp;b. Wheel",
                "4. Bridge Idle Wheel", "&nbsp;&nbsp;&nbsp;a. Bearings", "&nbsp;&nbsp;&nbsp;b. Wheel"
            );

            $structure_field = array (
                '2_girder_structure', '2_girder_plate', '2_trolley_rail', '2_runway_rail', '2_stopper'
            );

            $structure_desc = array (
                "1. Girder Structure Condition", "2. Girder's Joint Plate", "Troley Rail (if any)", "4. Runway Rail", "5. Stopper"
            );

            $electrical_field = array (
                '2_main_panel', '2_hoist_troley_panel', '', '2_contactor_hoist', '2_contactor_troley', '2_contactor_bridge',
                '2_contactor_main', '2_main_breaker', '2_fuses', '', '2_inverter_trolley', '2_inverter_bridge',
                '2_monitoring', '2_terminal', '', '2_festoon_troley', '2_festoon_ctrack', '2_bridge_power',
                '2_control_station', '2_current_colector', '2_power_rail', '2_cable_other'
            );

            $electrical_desc = array (
                "1. Main Panel Conditon", "2. Hoist and Trolley Panel", "3. Contactors", "&nbsp;&nbsp;&nbsp;a. Hoisting", 
                "&nbsp;&nbsp;&nbsp;b. Trolley", "&nbsp;&nbsp;&nbsp;c. Bridge", "&nbsp;&nbsp;&nbsp;d. Main", "4. Main Breaker", "5. Fuses",
                "6. Inverters", "&nbsp;&nbsp;&nbsp;a. Troley", "&nbsp;&nbsp;&nbsp;b. Bridge", "7. Condition Monitoring", "8. Terminals", "9. Festoon System", 
                "&nbsp;&nbsp;&nbsp;a. Troley Cable", "&nbsp;&nbsp;&nbsp;b. C-Track", "10. Bridge Power Supply",
                "11. Control Station (pendant)", "12. Current Collector", "13. Power Rail Konduktor", "14. Cables (other)"
            );

    // Function to generate dropdown for each field
    function generateDropdown($name) {
        echo '<select class="enum" name="' . htmlspecialchars($name) . '">';
        echo '<option value="1">1</option>';
        echo '<option value="2">2</option>';
        echo '<option value="3">3</option>';
        echo '</select>';
    }

    $max_row1 = max(count($hoista_desc), count($hoistb_desc), count($trolleya_desc), count($trolleyb_desc));

    for ($i = 0; $i < $max_row1; $i++) {
        echo '<tr>';

        if (isset($hoista_desc[$i])) {
            echo '<th class="measure" style="text-align:left">' . $hoista_desc[$i] . '</th>';
            if ($existing_record && isset($existing_record[$hoista_field[$i]])) {
                echo "<td>";
                echo htmlspecialchars(formatValue($existing_record[$hoista_field[$i]]));
                echo "<button type='button' class='clear-btn' data-field='$hoista_field[$i]'>X</button>";
                echo "</td>";
            } else{
                if($hoista_desc[$i] !== "8. Hoisting Gearbox" && $hoista_desc[$i] !== "9. Hoisting Motor"){
            echo '<td>';
            if (isset($hoista_field[$i])) {
                generateDropdown($hoista_field[$i]);
            }
            echo '</td>';
        }else{
            echo '<td></td>';
        }
        }
        } else {
            echo '<td></td><td></td>';
        }

        if (isset($hoistb_desc[$i])) {
            echo '<th class="measure" style="text-align:left">' . $hoistb_desc[$i] . '</th>';
            if ($existing_record && isset($existing_record[$hoistb_field[$i]])) {
                echo "<td>";
                echo htmlspecialchars(formatValue($existing_record[$hoistb_field[$i]]));
                echo "<button type='button' class='clear-btn' data-field='$hoistb_field[$i]'>X</button>";
                echo "</td>";
            } else{
                if($hoistb_desc[$i] !== "8. Hoisting Gearbox" && $hoistb_desc[$i] !== "9. Hoisting Motor"){
            echo '<td>';
            if (isset($hoistb_field[$i])) {
                generateDropdown($hoistb_field[$i]);
            }
            echo '</td>';
        }else{
            echo '<td></td>';
        }
        }
        } else {
            echo '<td></td><td></td>';
        }

        if (isset($trolleya_desc[$i])) {
            echo '<th class="measure" style="text-align:left">' . $trolleya_desc[$i] . '</th>';
            if ($existing_record && isset($existing_record[$trolleya_field[$i]])) {
                echo "<td>";
                echo htmlspecialchars(formatValue($existing_record[$trolleya_field[$i]]));
                echo "<button type='button' class='clear-btn' data-field='$trolleya_field[$i]'>X</button>";
                echo "</td>";
            } else{
            if($trolleya_desc[$i] !== "1. Trolley Gearbox" && $trolleya_desc[$i] !== "2. Trolley Motor"  && $trolleya_desc[$i] !== "4. Trolley Driving Wheel"  && $trolleya_desc[$i] !== "5. Trolley Idle Wheel"){
                echo '<td>';
                if (isset($trolleya_field[$i])) {
                    generateDropdown($trolleya_field[$i]);
                }
                echo '</td>';
            }else{
                echo '<td></td>';
            }
            }
        } else {
            echo '<td></td><td></td>';
        }

        if (isset($trolleyb_desc[$i])) {
            echo '<th class="measure" style="text-align:left">' . $trolleyb_desc[$i] . '</th>';
            if ($existing_record && isset($existing_record[$trolleyb_field[$i]])) {
                echo "<td>";
                echo htmlspecialchars(formatValue($existing_record[$trolleyb_field[$i]]));
                echo "<button type='button' class='clear-btn' data-field='$trolleyb_field[$i]'>X</button>";
                echo "</td>";
            } else{
            if($trolleyb_desc[$i] !== "1. Trolley Gearbox" && $trolleyb_desc[$i] !== "2. Trolley Motor"  && $trolleyb_desc[$i] !== "4. Trolley Driving Wheel"  && $trolleyb_desc[$i] !== "5. Trolley Idle Wheel"){
                echo '<td>';
                if (isset($trolleyb_field[$i])) {
                    generateDropdown($trolleyb_field[$i]);
                }
                echo '</td>';
            }else{
                echo '<td></td>';
            }
            }
        } else {
            echo '<td></td><td></td>';
        }

        echo '</tr>';
    }
    ?>

    <thead>
            <tr>
                <th>Bridge Unit</th>
                <td>Check</td>
                <th>Structure</th>
                <td>Check</td>
                <th>Electrical System</th>
                <td>Check</td>
                <td colspan="2"></td>
            </tr>
    </thead>

    <?php
    $max_row2 = max(count($bridge_desc), count($structure_desc), count($electrical_desc));
    for ($i = 0; $i < $max_row2; $i++) {
        echo '<tr>';
        if (isset($bridge_desc[$i])) {
            echo '<th class="measure" style="text-align:left">' . $bridge_desc[$i] . '</th>';
            if ($existing_record && isset($existing_record[$bridge_field[$i]])) {
                echo "<td>";
                echo htmlspecialchars(formatValue($existing_record[$bridge_field[$i]]));
                echo "<button type='button' class='clear-btn' data-field='$bridge_field[$i]'>X</button>";
                echo "</td>";
            } else{
            if($bridge_desc[$i] !== "1. Bridge Gearbox" && $bridge_desc[$i] !== "2. Bridge Motor"  && $bridge_desc[$i] !== "4. Bridge Driving Wheel"  && $bridge_desc[$i] !== "5. Bridge Idle Wheel"){
                echo '<td>';
                if (isset($bridge_field[$i])) {
                    generateDropdown($bridge_field[$i]);
                }
                echo '</td>';
            }else{
                echo '<td></td>';
            }
            }
        } else {
            echo '<td></td><td></td>';
        }

        if (isset($structure_desc[$i])) {
            echo '<th class="measure" style="text-align:left">' . $structure_desc[$i] . '</th class="measure" style="text-align:left">';
            if ($existing_record && isset($existing_record[$structure_field[$i]])) {
                echo "<td>";
                echo htmlspecialchars(formatValue($existing_record[$structure_field[$i]]));
                echo "<button type='button' class='clear-btn' data-field='$structure_field[$i]'>X</button>";
                echo "</td>";
            } else{
            echo '<td>';
            if (isset($structure_field[$i])) {
                generateDropdown($structure_field[$i]);
            }
            echo '</td>';
        }
        } else {
            echo '<td></td><td></td>';
        }

        if (isset($electrical_desc[$i])) {
            echo '<th class="measure" style="text-align:left">' . $electrical_desc[$i] . '</th class="measure" style="text-align:left">';
            if ($existing_record && isset($existing_record[$electrical_field[$i]])) {
                echo "<td>";
                echo htmlspecialchars(formatValue($existing_record[$electrical_field[$i]]));
                echo "<button type='button' class='clear-btn' data-field='$electrical_field[$i]'>X</button>";
                echo "</td>";
            } else{
            if($electrical_desc[$i] !== "3. Contactors" && $electrical_desc[$i] !== "7. Inverters"){
                echo '<td>';
                if (isset($electrical_field[$i])) {
                    generateDropdown($electrical_field[$i]);
                }
                echo '</td>';
            }else{
                echo '<td></td>';
            }
        }
        } else {
            echo '<td></td><td></td>';
        }
        echo '<td colspan="2"></td>';
        echo '</tr>';
    }
        ?>
        
            <tr>
                <th class="parameter" colspan="2">Entry By</th>
               <?php 
                if ($existing_record && isset($existing_record['2_pic'])){
                    echo "<td colspan='12'style='text-align:left; color:grey; padding: 5px 10px'>";
                    echo htmlspecialchars(formatValue($existing_record['2_pic']));
                    echo "&nbsp&nbsp";
                    echo htmlspecialchars(formatValue($existing_record['2_time']));
                    echo "</td>";
                }
                else{
                    echo "<td colspan='12'></td>";
                }
                echo "<input type='hidden' name='2_pic' value='" . htmlspecialchars($baris[0]) . "'>";
                echo '<input type="hidden" name="2_time" value="' . date('d/m/Y H:i') . '">';
                ?>
            </tr>  

            <tr>
            <th class="parameter" colspan="2">Note Anomali
            </th>

            <?php 
            $current_note = '';
            if ($existing_record && isset($existing_record['2_note_anomali'])) {
                $current_note = $existing_record['2_note_anomali']; // Set current_note to the existing note
                echo "<td colspan='12' id='note-container' style='text-align:left; padding: 5px 10px'>";
                echo htmlspecialchars(formatValue($existing_record['2_note_anomali']));
                echo "<button type='button' class='clear-btn' data-field='2_note_anomali'>X</button>";
                echo "<button type='button' class='edit-btn' data-current-note='" . htmlspecialchars($current_note, ENT_QUOTES) . "'>EDIT</button>";
                echo "</td>";
            } else {
                echo "<td colspan='12' style='text-align:left; padding: 4px 0.8%;'><textarea name='2_note_anomali' id='note-textarea' style='height:30px;width:90%;padding:4px;'></textarea></td>";
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
        $(".enum").prop("selectedIndex", -1);
        $(".enum_long").prop("selectedIndex", -1);
        $(".input-field").val('');

        function handleFormSubmit(event, selectId) {
        event.preventDefault();

        var selectElement = document.getElementById(selectId);
        var selectedUnit = selectElement.value;
        var selectedLine = '<?php echo $line; ?>';

            switch (selectedUnit) {
                case 'data_sheet':
                    location.href = 'form-crane-doublegirder-datasheet.php?selectedUnit=crane_double_girder&selectedLine=' + encodeURIComponent(selectedLine);
                    break;
                case 'cek_kondisi':
                    location.href = 'form-crane-doublegirder-kondisi.php?selectedUnit=crane_double_girder&selectedLine=' + encodeURIComponent(selectedLine);
                    break;      
                default:
                    break;
                }
            }

    </script>
</body>
</html>
