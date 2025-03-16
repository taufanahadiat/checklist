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
    <strong>CRANE CARGO LIFT</strong>
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
                <th>Electrical System</th>
                <td>Check</td>
                <th>Structure</th>
                <td>Check</td>
            </tr>
        </thead>
        <form method="post">
            <tbody>
            <?php
            require 'database.php';
            include 'request-view-crane.php';
            $hoist_field = array(
                '2_hoist_body', '2_hoist_panel', '2_chain', '2_chain_pinion', '2_drum_housing', '2_hoist_limit', '',
                '2_hoist_gear_noise', '2_hoist_gear_leakage', '', '2_hoist_motor_rectifier', 
                '2_hoist_motor_coil', '2_hoist_motor_disc', '2_hoist_motor_bearing', 
                '2_hoist_motor_fan', '', '2_bottom_safety', '2_bottom_pulley', '2_bottom_bearing'
              );
                          
            $hoist_desc = array(
                "1. Hoisting Body Condition", "2. Hoist Panel Condition", "3. Wire Rope/Chain", "4. Rope End/Chain Pinion", 
                "5. Drum Housing", "6. Hoisting Limit Switch", "7. Hoisting Gearbox", "&nbsp;&nbsp;&nbsp;a. Noise", 
                "&nbsp;&nbsp;&nbsp;b. Leakage", "8. Hoisting Motor", "&nbsp;&nbsp;&nbsp;a. Rectifier", "&nbsp;&nbsp;&nbsp;b. Brake Coil",
                "&nbsp;&nbsp;&nbsp;c. Brake Disc", "&nbsp;&nbsp;&nbsp;d. Bearings", "&nbsp;&nbsp;&nbsp;e. Fan & Cover",
                "9. Bottom Block", "a.Safety Latch", "b. Pulley Bottom Block", "c. Bearing Bottom Block"
            );

            $electrical_field = array (
                '2_main_panel', '2_supply_power', '2_power_control', '2_kontaktor_hoist', 
                '2_relay_control', '2_main_breaker', '2_fuse', '2_terminal', '2_kabel_control', 
                '2_wiring_control', '2_emergency', '2_pb_control', '2_indikator'
            );

            $electrical_desc = array (
                "1. Main Panel", "2. Supply Power", "3. Power Control", "4. Contactor Hoisting", "5. Relay Control",
                "6. Main Breaker", "7. Fuses", "8. Terminal", "9. Cable Control", "10. Wiring Control", "11. Tombol Emergency", 
                "12. Push Button Control", "13. Lampu Indikator"
            );

            $structure_field = array (
                '2_safety_brake', '2_hanger_hook_pin', '2_kondisi_kabin', '2_kunci_kabin', 
                '2_pintu_kabin_atas', '2_pintu_kabin_bawah', '2_pintu_dalam_kabin', '2_limit_switch_pintu', 
                '2_limit_switch_upper', '2_limit_switch_lower', '2_rail_track', '2_wheel_guide', 
                '2_struktur_utama', '2_note_anomali', '2_pic', '2_time'
            );

            $structure_desc = array (
                "1. Safety Brake", "2. Hanger Hook Pin", "3. Kabin Kondisi", "4. Kunci Kabin",
                "5. Pintu Kabin Atas", "6. Pintu Kabin Atas", "7. Pintu Kabin Bawah", "9. Pintu Dalam Kabin",
                "10. Limit Switch Pintu", "11. Rail Track", "12. Wheel Guide", "13. Struktur Utama"
            );

    // Function to generate dropdown for each field
    function generateDropdown($name) {
        echo '<select class="enum" name="' . htmlspecialchars($name) . '">';
        echo '<option value="1">1</option>';
        echo '<option value="2">2</option>';
        echo '<option value="3">3</option>';
        echo '</select>';
    }

    $max_rows = max(count($hoist_desc), count($electrical_desc), count($structure_desc));

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
                if($hoist_desc[$i] !== "7. Hoisting Gearbox" && $hoist_desc[$i] !== "8. Hoisting Motor" && $hoist_desc[$i] !== "9. Bottom Block"){
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
                    location.href = 'form-crane-cargolift-datasheet.php?selectedUnit=crane_cargo_lift&selectedLine=' + encodeURIComponent(selectedLine);
                    break;
                case 'cek_kondisi':
                    location.href = 'form-crane-cargolift-kondisi.php?selectedUnit=crane_cargo_lift&selectedLine=' + encodeURIComponent(selectedLine);
                    break;      
                default:
                    break;
                }
            }

    </script>
</body>
</html>
