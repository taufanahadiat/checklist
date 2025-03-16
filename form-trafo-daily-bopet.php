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
            
<table> 
    <h2>PENGAMANAN TRAFO AREA BOPET</h2>

              <?php include 'pilih-unit-trafo.php' ?>

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
                    "", 
                    "Trafo 9 Utility", 
                    "Trafo 10 Produksi", 
                    "",
                    "Panel MVDP", 
                    "Panel LVDP", 
                    "Panel Capacitor Bank",                    
                    "Panel Lightning dan Power",                    
                    "", 
                    "Tray Cable", 
                    "Grounding", 
                    "Exhaust Fan", 
                    "Lampu-lampu", 
                    "Stop Kontak", 
                    "", 
                    "Sapu", 
                    "Alat Pel", 
                    "Kemoceng", 
                    "Pengki", 
                    "Tempat Sampah", 
                    "Papan Aktifitas 5R", 
                    "", 
                    "Level Oli TR 9 (IGBT)", 
                    "Level Oli TR 9 (Tank)",
                    "Level Oli TR 10 (IGBT)",
                    "Level Oli TR 20 (Tank)"
                );

                $fields = array(
                    'kunci_gembok_pintu1', 'kunci_gembok_pintu2', 'kunci_gembok_pintu3', 'kunci_gembok_pintu4', '',
                    'trafo_9_utility', 'trafo_10_produksi', '', 'panel_mvdp', 'panel_lvdp',
                    'panel_capacitor_bank', 'panel_lighting_dan_power', '', 'tray_cable', 'grounding',
                    'exhaust_fan', 'lampu', 'stop_kontak', '', 'sapu', 'alat_pel', 'kemoceng',
                    'pengki', 'tempat_sampah', 'papan_aktivitas_5r', '', 'level_oli_tr9_igbt', 
                    'level_oli_tr9_tank', 'level_oli_tr10_igbt', 'level_oli_tr20_tank'
                );
                
                $note = array('note_1', 'note_2', 'note_3', 'note_4', '', 'note_5', 'note_6', '', 'note_7', 
                'note_8', 'note_9', 'note_10', '', 'note_11', 'note_12', 'note_13', 'note_14', 'note_15', '', 
                'note_16', 'note_17', 'note_18', 'note_19', 'note_20', 'note_21', '', 'note_22', 'note_23', 
                'note_24', 'note_25'
                );

                $dec = array(5, 6, 10);
                $enum = array(26, 27, 28, 29);

                foreach ($description as $index => $desc) {
                    if ($desc == "") {
                        // Skip counting for empty description
                        echo '<tr><th class="parameter" colspan="5"></th></tr>';
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

       </script>
</body>
</html>
