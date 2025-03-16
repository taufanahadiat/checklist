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
    <strong>CRANE MONORAIL</strong>
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




<table>
<?php include 'pilih-form-crane.php'; ?>

        <thead>
            <tr>
                <th>Hoisting Unit</th>
                <td>Check</td>
                <th>Troley Unit</th>
                <td>Check</td>
                <th>Structure</th>
                <td>Check</td>
                <th>Electrical System</th>
                <td>Check</td>
            </tr>
        </thead>
        <form method="post">
            <tbody>
            <?php
            require 'database.php';
            include 'request-view-crane.php';
            $hoist_field = array(
                '2_hoist_body', '2_hoist_panel', '2_chain', '2_chain_pinion', '2_chain_guide',
                '2_chain_bucket', '2_hoist_limit', '', '2_hoist_gear_noise', '2_hoist_gear_leakage', '',
                '2_hoist_motor_rectifier', '2_hoist_motor_coil', '2_hoist_motor_disc',
                '2_hoist_motor_bearing', '2_hoist_motor_fan'
              );
                          
            $hoist_desc = array(
                "1. Hoisting Body Condition", "2. Hoist Panel Condition", "3. Chain", "4. Chain Pinion", "5. Chain Guide",
                "6. Chain Bucket", "7. Hoisting Limit Switch", "8. Hoisting Gearbox", "&nbsp;&nbsp;&nbsp;a. Noise", 
                "&nbsp;&nbsp;&nbsp;b. Leakage", "9. Hoisting Motor", "&nbsp;&nbsp;&nbsp;a. Rectifier", "&nbsp;&nbsp;&nbsp;b. Brale Coil",
                "&nbsp;&nbsp;&nbsp;c. Brake Disc", "&nbsp;&nbsp;&nbsp;d. Bearings", "&nbsp;&nbsp;&nbsp;e. Fan & Cover"
            );

            $trolley_field = array(
                '', '2_trolley_gear_noise','2_trolley_gear_leakage', '', '2_trolley_motor_rectifier', '2_trolley_motor_coil',
                '2_trolley_motor_disc', '2_trolley_motor_bearing', '2_trolley_motor_fan',
                '2_crab_trolley', '', '2_trolley_driving_bearing', '2_trolley_driving_wheel', '',
                '2_trolley_idle_bearing', '2_trolley_idle_wheel'
            );

            $trolley_desc = array (
                "1. Trolley Gearbox", "&nbsp;&nbsp;&nbsp;a. Noise", "&nbsp;&nbsp;&nbsp;b. Leakage", "2. Trolley Motor",
                "&nbsp;&nbsp;&nbsp;a. Rectifier", "&nbsp;&nbsp;&nbsp;b. Brake Coil", "&nbsp;&nbsp;&nbsp;c. Brake Disc",
                "&nbsp;&nbsp;&nbsp;d. Bearings", "&nbsp;&nbsp;&nbsp;e. Fan & Cover", "3. Crab / Trolley condition",
                "4. Trolley Driving Wheel", "&nbsp;&nbsp;&nbsp;a. Bearings", "&nbsp;&nbsp;&nbsp;b. Wheel", "5. Trolley Idle Wheel",
                "&nbsp;&nbsp;&nbsp;a. Bearings", "&nbsp;&nbsp;&nbsp;b. Wheel"
            );

            $structure_field = array (
                '2_girder_welding', '2_girder_plate', '2_runway_rail',
            );

            $structure_desc = array (
                "1. Girder Structure Welding", "2. Girder's Joint Plate", "3. Runway Rail"
            );

            $electrical_field = array (
                '2_main_panel', '2_hoist_troley_panel', '', '2_contactor_hoist', '2_contactor_troley',
                '2_contactor_main', '2_main_breaker', '2_fuses', '2_current_colector',
                '2_inverter_trolley', '2_monitoring', '2_terminal', '2_festoon', '2_bridge_power',
                '2_control_station', '2_cable_other', 
            );

            $electrical_desc = array (
                "1. Main Panel", "2. Hoist and Trolley Panel", "3. Contactors", "&nbsp;&nbsp;&nbsp;a. Hoisting", 
                "&nbsp;&nbsp;&nbsp;b. Trolley", "&nbsp;&nbsp;&nbsp;c. Main", "5. Main Breaker", "6. Fuses", "7. Current Collector",
                "8. Inverter Trolley", "9. Condition Monitoring", "10. Terminals", "11. Festoon System", "12. Bridge Power Supply",
                "13. Control Station (pendant)", "14. Cables (other)"
            );

    // Function to generate dropdown for each field
    function generateDropdown($name) {
        echo '<select class="enum" name="' . htmlspecialchars($name) . '">';
        echo '<option value="1">1</option>';
        echo '<option value="2">2</option>';
        echo '<option value="3">3</option>';
        echo '</select>';
    }

    $max_rows = max(count($hoist_desc), count($trolley_desc), count($structure_desc), count($electrical_desc));

    for ($i = 0; $i < $max_rows; $i++) {
        echo '<tr>';

        if (isset($hoist_desc[$i])) {
            echo '<th class="measure" style="text-align:left">' . $hoist_desc[$i] . '</th>';
            if ($existing_record && isset($existing_record[$hoist_field[$i]])) {
                echo "<td>";
                echo htmlspecialchars(formatValue($existing_record[$hoist_field[$i]]));
                echo "<button type='button' class='clear-btn' data-field='$hoist_field[$i]'>X</button>";
                echo "</td>";
            } else{
                if($hoist_desc[$i] !== "8. Hoisting Gearbox" && $hoist_desc[$i] !== "9. Hoisting Motor"){
            echo '<td>';
            if (isset($hoist_field[$i])) {
                generateDropdown($hoist_field[$i]);
            }
            echo '</td>';
        }else{
            echo '<td></td>';
        }
        }
        } else {
            echo '<td></td><td></td>';
        }

        if (isset($trolley_desc[$i])) {
            echo '<th class="measure" style="text-align:left">' . $trolley_desc[$i] . '</th>';
            if ($existing_record && isset($existing_record[$trolley_field[$i]])) {
                echo "<td>";
                echo htmlspecialchars(formatValue($existing_record[$trolley_field[$i]]));
                echo "<button type='button' class='clear-btn' data-field='$trolley_field[$i]'>X</button>";
                echo "</td>";
            } else{
            if($trolley_desc[$i] !== "1. Trolley Gearbox" && $trolley_desc[$i] !== "2. Trolley Motor"  && $trolley_desc[$i] !== "4. Trolley Driving Wheel"  && $trolley_desc[$i] !== "5. Trolley Idle Wheel"){
                echo '<td>';
                if (isset($trolley_field[$i])) {
                    generateDropdown($trolley_field[$i]);
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
            if($electrical_desc[$i] !== "3. Contactors"){
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
                    location.href = 'form-crane-monorail-datasheet.php?selectedUnit=crane_monorail&selectedLine=' + encodeURIComponent(selectedLine);
                    break;
                case 'cek_kondisi':
                    location.href = 'form-crane-monorail-kondisi.php?selectedUnit=crane_monorail&selectedLine=' + encodeURIComponent(selectedLine);
                    break;      
                default:
                    break;
                }
            }

    </script>
</body>
</html>
