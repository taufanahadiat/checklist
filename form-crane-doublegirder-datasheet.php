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
    <span style="font-size: large;">DATA SHEET PREVENTIVE MAINTENANCE</span>

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
                <th style="width:2.5%;">No</th>
                <th style="width:25%;" colspan="2">DESCRIPTION</th>
                <th>L1</th>
                <th>L2</th>
                <th>L3</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <form method="post">
            <tbody>
            <?php
            require 'database.php';
            include 'request-view-crane.php';
            $fields = array(
                '1_hoista_tegangan_l1', '1_hoista_tegangan_l2', '1_hoista_tegangan_l3',
                '1_hoista_arusfast_l1', '1_hoista_arusfast_l2', '1_hoista_arusfast_l3',
                '1_hoista_aruslow_l1', '1_hoista_aruslow_l2', '1_hoista_aruslow_l3',
                '1_hoista_brake', '1_hoistb_tegangan_l1', '1_hoistb_tegangan_l2',
                '1_hoistb_tegangan_l3', '1_hoistb_arusfast_l1', '1_hoistb_arusfast_l2',
                '1_hoistb_arusfast_l3', '1_hoistb_aruslow_l1', '1_hoistb_aruslow_l2',
                '1_hoistb_aruslow_l3', '1_hoistb_brake', '1_crossa_tegangan_l1',
                '1_crossa_tegangan_l2', '1_crossa_tegangan_l3', '1_crossa_arusfast_l1',
                '1_crossa_arusfast_l2', '1_crossa_arusfast_l3', '1_crossa_aruslow_l1',
                '1_crossa_aruslow_l2', '1_crossa_aruslow_l3', '1_crossa_brake',
                '1_crossb_tegangan_l1', '1_crossb_tegangan_l2', '1_crossb_tegangan_l3',
                '1_crossb_arusfast_l1', '1_crossb_arusfast_l2', '1_crossb_arusfast_l3',
                '1_crossb_aruslow_l1', '1_crossb_aruslow_l2', '1_crossb_aruslow_l3',
                '1_crossb_brake', '1_long_tegangan_l1', '1_long_tegangan_l2',
                '1_long_tegangan_l3', '1_long_arusfast_l1', '1_long_arusfast_l2',
                '1_long_arusfast_l3', '1_long_aruslow_l1', '1_long_aruslow_l2',
                '1_long_aruslow_l3', '1_long_brake', '1_kontaktor_periksa',
                '1_panel_periksa', '1_pendant_pb', '1_pendant_kabel'
            );
            
            

            $desc = array(
                "Tegangan (V)", "Arus Motor Fast (A)", "Arus Motor Slow (A)", "Brake System",
                "Tegangan (V)", "Arus Motor Fast (A)", "Arus Motor Slow (A)", "Brake System",
                "Tegangan (V)", "Arus Motor Fast (A)", "Arus Motor Slow (A)", "Brake System",
                "Tegangan (V)", "Arus Motor Fast (A)", "Arus Motor Slow (A)", "Brake System",
                "Tegangan (V)", "Arus Motor Fast (A)", "Arus Motor Slow (A)", "Brake System",
                "Periksa & Cleaning", "Periksa & Kencangkan", "Push Button", "Kabel"
            );
        // Keterangan fields array
        $notes = array(
            '1_note_1', '1_note_2', '1_note_3', '1_note_4', '1_note_5', '1_note_6', '1_note_7', '1_note_8',
            '1_note_9', '1_note_10', '1_note_11', '1_note_12', '1_note_13', '1_note_14', '1_note_15',
            '1_note_16', '1_note_17', '1_note_18', '1_note_19', '1_note_20',
            '1_note_21', '1_note_22', '1_note_23', '1_note_24', '1_note_25',
        );

        // Index to track which set of fields to use
        $fieldIndex = 0;

        // Loop through each description
        foreach ($desc as $index => $description) {
            // Determine whether to start a new group (Hoist/Cross/etc.)
            if ($index % 4 == 0 || $index == 21 || $index == 22) {
                echo '<tr>';
                // Set the first column as "Hoist" or "Cross"
                if ($index == 0) {
                    echo '<th class="parameter" rowspan="4">1</th>';
                    echo '<th class="measure2" rowspan="4">Hoist A</th>';
                } elseif ($index == 4) {
                    echo '<th class="parameter" rowspan="4">2</th>';
                    echo '<th class="measure2" rowspan="4">Hoist B</th>';
                } elseif ($index == 8) {
                    echo '<th class="parameter" rowspan="4">3</th>';
                    echo '<th class="measure2" rowspan="4">Cross Travel A</th>';
                } elseif ($index == 12) {
                    echo '<th class="parameter" rowspan="4">4</th>';
                    echo '<th class="measure2" rowspan="4">Cross Travel B</th>';
                } elseif ($index == 16) {
                    echo '<th class="parameter" rowspan="4">5</th>';
                    echo '<th class="measure2" rowspan="4">Long Travel</th>';
                } elseif ($index == 20){
                    echo '<th class="parameter">6</th>';
                    echo '<th class="measure2">Kontaktor</th>';
                } elseif ($index == 21){
                    echo '<th class="parameter">7</th>';
                    echo '<th class="measure2">Koneksi Panel</th>';
                } elseif ($index == 22){
                    echo '<th class="parameter" rowspan="2">8</th>';
                    echo '<th class="measure2" rowspan="2">Pendant Switch</th>';
                } 
            }

            // Add the description and corresponding fields
            echo '<th style="width:14%;">' . $description . '</th>';
            for ($i = 0; $i < 3; $i++) {
                if (strpos($fields[$fieldIndex], '_brake') !== false || $index == 20 || $index == 21 || $index == 22 || $index == 23) {

                    if ($existing_record && isset($existing_record[$fields[$fieldIndex]])) {
                        echo "<td colspan='3'>";
                        echo htmlspecialchars(formatValue($existing_record[$fields[$fieldIndex]]));
                        echo "<button type='button' class='clear-btn' data-field='$fields[$fieldIndex]'>X</button>";
                        echo "</td>";
                        $fieldIndex++;
                        break;
                    } else{
                    echo '<td colspan="3"><input type="number" step="0.01" class="input-field" name="' . $fields[$fieldIndex] . '"></td>';
                    $fieldIndex++; 
                    break;
                    }
                }else{
                    if ($existing_record && isset($existing_record[$fields[$fieldIndex]])) {
                        echo "<td>";
                        echo htmlspecialchars(formatValue($existing_record[$fields[$fieldIndex]]));
                        echo "<button type='button' class='clear-btn' data-field='$fields[$fieldIndex]'>X</button>";
                        echo "</td>";
                        $fieldIndex++;
                    } else{
                    echo '<td><input type="number" step="0.01" class="input-field" name="' . $fields[$fieldIndex] . '"></td>';
                    $fieldIndex++;
                    }
                }
            }
            // Add the corresponding Keterangan field
            if ($existing_record && isset($existing_record[$notes[$index]])) {
                echo "<td>";
                echo htmlspecialchars(formatValue($existing_record[$notes[$index]]));
                echo "<button type='button' class='clear-btn' data-field='$notes[$index]'>X</button>";
                echo "</td>";
            }else{
            echo '<td><input type="text" name="' . $notes[$index] . '"></td>';
            }
            echo '</tr>';
            
        }
        ?>
            <tr>
                <th class="measure2" colspan="3">Entry By</th>
               <?php 
                if ($existing_record && isset($existing_record['1_pic'])){
                    echo "<td colspan='12'style='text-align:left; color:grey; padding: 5px 10px'>";
                    echo htmlspecialchars(formatValue($existing_record['1_pic']));
                    echo "&nbsp&nbsp";
                    echo htmlspecialchars(formatValue($existing_record['1_time']));
                    echo "</td>";
                }
                else{
                    echo "<td colspan='12'></td>";
                }
                echo "<input type='hidden' name='1_pic' value='" . htmlspecialchars($baris[0]) . "'>";
                echo '<input type="hidden" name="1_time" value="' . date('d/m/Y H:i') . '">';
                ?>
            </tr>  

            <tr>
            <th class="measure2" colspan="3">Note Anomali
            </th>

            <?php 
            $current_note = '';
            if ($existing_record && isset($existing_record['1_note_anomali'])) {
                $current_note = $existing_record['1_note_anomali']; // Set current_note to the existing note
                echo "<td colspan='12' id='note-container' style='text-align:left; padding: 5px 10px'>";
                echo htmlspecialchars(formatValue($existing_record['1_note_anomali']));
                echo "<button type='button' class='clear-btn' data-field='1_note_anomali'>X</button>";
                echo "<button type='button' class='edit-btn' data-current-note='" . htmlspecialchars($current_note, ENT_QUOTES) . "'>EDIT</button>";
                echo "</td>";
            } else {
                echo "<td colspan='12' style='text-align:left; padding: 4px 0.8%;'><textarea name='1_note_anomali' id='note-textarea' style='height:30px;width:90%;padding:4px;'></textarea></td>";
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
