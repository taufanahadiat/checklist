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
                <th style="width:2%;">No</th>
                <th style="width:22%;" colspan="2">DESCRIPTION</th>
                <th colspan="2">L1</th>
                <th colspan="2">L2</th>
                <th colspan="2">L3</th>
                <th>Keterangan</th>
            </tr>
        </thead>
        <form method="post">
            <tbody>
            <?php
            require 'database.php';
            include 'request-view-crane.php';
            $fields = array(
                '1_hoist_tegangan_l1a', '1_hoist_tegangan_l1b', '1_hoist_tegangan_l2a', '1_hoist_tegangan_l2b', 
                '1_hoist_tegangan_l3a', '1_hoist_tegangan_l3b', '1_hoist_arusfast_l1a', '1_hoist_arusfast_l1b', 
                '1_hoist_arusfast_l2a', '1_hoist_arusfast_l2b', '1_hoist_arusfast_l3a', '1_hoist_arusfast_l3b', 
                '1_hoist_aruslow_l1a', '1_hoist_aruslow_l1b', '1_hoist_aruslow_l2a', '1_hoist_aruslow_l2b', 
                '1_hoist_aruslow_l3a', '1_hoist_aruslow_l3b', '1_hoist_brake','1_kontaktor_periksa', 
                '1_panel_periksa', '1_pendant_pb', '1_pendant_kabel'
            );
            

            $desc = array(
                "Tegangan (V)", "Arus Motor Fast (A)", "Arus Motor Slow (A)", "Brake System",
                "Periksa & Cleaning", "Periksa & Kencangkan", "Push Button", "Kabel"
            );
        // Keterangan fields array
        $notes = array(
            '1_note_1', '1_note_2', '1_note_3', '1_note_4', '1_note_5', 
            '1_note_6', '1_note_7', '1_note_8'
        );

        // Index to track which set of fields to use
        $fieldIndex = 0;

        // Loop through each description
        foreach ($desc as $index => $description) {
            // Determine whether to start a new group (Hoist/Cross/etc.)
            if ($index % 4 == 0 || $index == 5 || $index == 6) {
                echo '<tr>';
                // Set the first column as "Hoist" or "Cross"
                if ($index == 0) {
                    echo '<th class="parameter" rowspan="4">1</th>';
                    echo '<th class="measure2" rowspan="4">Hoist</th>';
                } elseif ($index == 4){
                    echo '<th class="parameter">3</th>';
                    echo '<th class="measure2">Kontaktor</th>';
                } elseif ($index == 5){
                    echo '<th class="parameter">4</th>';
                    echo '<th class="measure2">Koneksi Panel</th>';
                } elseif ($index == 6){
                    echo '<th class="parameter" rowspan="2">5</th>';
                    echo '<th class="measure2" rowspan="2">Pendant Switch</th>';
                } 

            }

            // Add the description and corresponding fields
            echo '<th style="width:12%;">' . $description . '</th>';
            for ($i = 0; $i < 6; $i++) {
                if (strpos($fields[$fieldIndex], '_brake') !== false || $index == 4 || $index == 5 || $index == 6 || $index == 7) {

                    if ($existing_record && isset($existing_record[$fields[$fieldIndex]])) {
                        echo "<td colspan='6'>";
                        echo htmlspecialchars(formatValue($existing_record[$fields[$fieldIndex]]));
                        echo "<button type='button' class='clear-btn' data-field='$fields[$fieldIndex]'>X</button>";
                        echo "</td>";
                        $fieldIndex++;
                        break;
                    } else{
                    echo '<td colspan="6"><input type="number" step="0.01" class="input-field" name="' . $fields[$fieldIndex] . '"></td>';
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
