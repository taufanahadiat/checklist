<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
require 'database.php';
require 'request-trafo.php';
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
<table style="width:55%;"> 
    <h2>PENGAMANAN TRAFO AREA LINE 4</h2>

    <form name="select-form-trafo" onsubmit="handleFormSubmit(event, 'option-form-trafo')">
        <div class="custom-label-form"> 
        <label for="unit-trafo">Change Line:</label>
          <div class="unitfield-form">
            <select class="selection-genset" name="unit-trafo" id="option-form-trafo">
              <?php include 'pilih-unit-trafo.php' ?>
            </select>
          </div>
          <input style="margin-top: 20px" class="btn-form" type="submit" value="SUBMIT">
          </div>
      </form>
        <thead>
        <tr>
            <th style="width:3%;">No</th>
            <th style="width:15%;">Description</th>
            <th style="width:10%;">Form Entry</th>
            <th style="width:20%;">Notes</th>
        </tr>
        </thead>
        <tbody>
        <form method="post">
        <?php
                require 'database.php';
                include 'request-view.php';

                $currentNumber = 0;

                $description = array(
                    "Kunci (gembok) Pintu 1", 
                    "Kunci (gembok) Pintu 2", 
                    "Kunci (gembok) Pintu 3", 
                    "Kunci (gembok) Pintu 4", 
                    "Kunci (gembok) Pintu 5", 
                    "", 
                    "Suhu Ruangan", 
                    "Trafo 13", 
                    "Trafo 14", 
                    "Trafo 7", 
                    "Trafo 4", 
                    "TRG 3", 
                    "TRG 4", 
                    "TRG 5", 
                    "Panel MVDP", 
                    "Panel LVDP", 
                    "Panel Capacitor Bank",                    
                    "", 
                    "Tray Cable", 
                    "Grounding", 
                    "Exhaust Fan", 
                    "Lampu-lampu", 
                    "Stop Kontak", 
                    "", 
                    "Level Oli TR 4 (IGBT)", 
                    "Level Oli TR 7 (IGBT)", 
                    "Level Oli TR 13 (IGBT)", 
                    "Level Oli TR 14 (IGBT)", 
                    "Level Oli TR 4 (TANK)", 
                    "Level Oli TR 7 (TANK)", 
                    "Level Oli TRG 3 (IGBT)", 
                    "Level Oli TRG 4 (IGBT)", 
                    "Level Oli TRG 5 (IGBT)", 
                    "Level Oli TRG 3 (TANK)", 
                    "Level Oli TRG 4 (TANK)", 
                    "Level Oli TRG 5 (TANK)", 
                );

                $fields = array('kunci_gembok_pintu1', 'kunci_gembok_pintu2', 'kunci_gembok_pintu3', 
                    'kunci_gembok_pintu4', 'kunci_gembok_pintu5', '', 'ruangan', 'trafo_13', 'trafo_14', 
                    'trafo_7', 'trafo_4', 'trg_3', 'trg_4', 'trg_5', 'panel_mvdp', 'panel_lvdp', 
                    'panel_capacitor_bank', '', 'tray_cable', 'grounding', 'exhaust_fan', 'lampu-lampu', 
                    'stop_kontak', '', 'level_oli_tr_igbt_4', 'level_oli_tr_igbt_7', 'level_oli_tr_igbt_13', 'level_oli_tr_igbt_14', 
                    'level_oli_tr_tank_4', 'level_oli_tr_tank_7', 'level_oli_trg_igbt_3', 'level_oli_trg_igbt_4', 
                    'level_oli_trg_igbt_5', 'level_oli_trg_tank_3', 'level_oli_trg_tank_4', 'level_oli_trg_tank_5'
                );
            
            
                
                $note = array('note_1', 'note_2', 'note_3', 'note_4', 'note_5', '', 'note_6', 'note_7', 
                    'note_8', 'note_9', 'note_10', 'note_11', 'note_12', 'note_13', 'note_14', 'note_15', '',
                    'note_16', 'note_17', 'note_18', 'note_19', 'note_20', '', 'note_21', 'note_22', 'note_23',
                    'note_24', 'note_25', 'note_26', 'note_27', 'note_28', 'note_29', 'note_30', 'note_31', 'note_32', 'note_33'
                );

                $dec = array(6, 7, 8, 9, 10, 11, 12, 13, 16);
                $enum = array(23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35);

                foreach ($description as $index => $desc) {
                    if ($desc == "") {
                        // Skip counting for empty description
                        echo '<tr><th class="parameter" colspan="5"></tj></tr>';
                        continue;
                    }

                    $currentNumber++;
                    echo '<th class="measure2">' . $currentNumber . '</th>';    
                    echo '<th style="text-align:left" class="parameter-setting">' . htmlspecialchars($desc) . '</th>';
                
                    $field = $fields[$index];
                    $noteField = $note[$index];
                    $inputType = in_array($index, $enum) ? 'select' : (in_array($index, $dec) ? 'number' : 'checkbox');
                    
                    if ($existing_record && isset($existing_record[$field])) {
                        if ($inputType == 'checkbox') {
                            $checkboxValue = $existing_record[$field] ? '<i class="fa-solid fa-check"></i>' : '<i class="fa-solid fa-minus"></i>';
                            echo '<td>' . $checkboxValue;
                            echo "<button type='button' class='clear-btn' data-field='$field'>X</button>";
                            echo '</td>';
                        } else {
                            echo '<td>' . htmlspecialchars(formatValue($existing_record[$field]));
                            echo "<button type='button' class='clear-btn' data-field='$field'>X</button>";
                            echo '</td>';
                        }
                    } else {
                        switch ($inputType) {
                            case 'select':
                                echo "<td><select class='enum' name='$field'>";
                                include 'enum-trafo.php';
                                echo "</select></td>";
                                break;
                            case 'number':
                                echo "<td><input type='number' step='0.01' class='input-field' name='$field'/></td>";
                                break;
                            case 'checkbox':
                                echo "<td>";
                                echo "<input type='hidden' name='$field' value='0'>";
                                echo "<input type='checkbox' class='big-checkbox' value='1' name='$field' />";
                                echo "</td>";
                                break;
                        }
                    }
                
                    if ($existing_record && isset($existing_record[$noteField])) {
                        echo '<td>' . htmlspecialchars(formatValue($existing_record[$noteField]));
                        echo "<button type='button' class='clear-btn' data-field='$noteField'>X</button>";
                        echo '</td>';
                    } else {
                        echo '<td><input type="text" name="' . $noteField . '" /></td>';
                    }
                    echo '</tr>';
                }
                ?>
                <tr>
                    <th class="parameter" colspan="2">Entry By</th>
                    <?php 
                    if ($existing_record && isset($existing_record['pic'])){
                        echo "<td colspan='12'style='text-align:left; color:grey; padding: 5px 10px'>";
                        echo htmlspecialchars(formatValue($existing_record['pic']));
                        echo "&nbsp&nbsp";
                        echo htmlspecialchars(formatValue($existing_record['time']));
                        echo "</td>";
                    }
                    else{
                        echo "<td colspan='12'></td>";
                    }
                    echo "<input type='hidden' name='pic' value='" . htmlspecialchars($baris[0]) . "'>";
                    echo '<input type="hidden" name="time" value="' . date('d/m/Y H:i') . '">';
                    ?>
                </tr>
        </tbody>
        </table>
        <button class="btn" id="save-button">SAVE</button>
    </form>
</main>
<script>
        document.getElementById("exit").onclick=function (){
            location.href = 'selection.php'
        }
        $(".enum").prop("selectedIndex", -1);
        $(".input-field").val('');

    function handleFormSubmit(event, selectId) {
    event.preventDefault();

    var selectElement = document.getElementById(selectId);
    var selectedUnit = selectElement.value;    
              
            console.log('Selected <select> ID:', selectId);
            console.log('Selected Value:', selectedUnit);

            switch (selectedUnit) {
                case 'trafo_daily_office':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-office.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
                case 'trafo_daily_coating':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-coating.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                case 'trafo_daily_bopet':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-bopet.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;    
                case 'trafo_daily_met2':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-met2.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;    
                case 'trafo_daily_met34':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-met34.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;    
                case 'trafo_daily_line4':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-line4.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;    
                case 'trafo_daily_line5':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-line5.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;    
                default:
                    break;
            }
        }
    </script>
</body>
</html>
