<?php
$unit = 'trafo_daily_line4';
include 'database.php';
$tanggal = "" . $_GET['selectedDate'];

include 'request-view-trafo.php';

?>

<?php if(isset($_GET['selectedUnit'])):?>

<!DOCTYPE html>
<html>
<head>
    <title>View Checklist Trafo</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../../img/icon.ico">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <style>
        td {
            text-align: center;
            width: 300px;
        }
    </style>
</head>

<body>
<?php include 'header.php'?>
<main>
<?php endif;?>

<h2>PENGAMANAN TRAFO AREA LINE 4</h2>
<?php 
    if(isset($_GET['selectedUnit'])){
        include 'pilih-tanggal.php';
    }?>

    <?php if ($article === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>

            <?php 
                if (isset($_GET['selectedUnit'])){
                    $area = 'trafo';
                    echo '<br><br>';
                    echo '<div class="verif">';
                     include 'verification-show.php';
                     echo '</div>';
                }
            ?>    
    
                        
<table >
            <thead>
        <tr>
            <th style="width:3%;">No</th>
            <th style="width:15%;">Description</th>
            <th style="width:10%;">Form Entry</th>
            <th style="width:20%;">Notes</th>
        </tr>
        </thead>
        <article>
        <tbody>
        <?php
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
                    'panel_capacitor_bank', '', 'tray_cable', 'grounding', 'exhaust_fan', 'lampu_lampu', 
                    'stop_kontak', '', 'level_oli_tr_igbt_4', 'level_oli_tr_igbt_7', 'level_oli_tr_igbt_13', 'level_oli_tr_igbt_14', 
                    'level_oli_tr_tank_4', 'level_oli_tr_tank_7', 'level_oli_trg_igbt_3', 'level_oli_trg_igbt_4', 
                    'level_oli_trg_igbt_5', 'level_oli_trg_tank_3', 'level_oli_trg_tank_4', 'level_oli_trg_tank_5'
                );
            
            
                
                $note = array('note_1', 'note_2', 'note_3', 'note_4', 'note_5', '', 'note_6', 'note_7', 
                    'note_8', 'note_9', 'note_10', 'note_11', 'note_12', 'note_13', 'note_14', 'note_15',
                    'note_16', '', 'note_17', 'note_18', 'note_19', 'note_20', 'note_21', '', 'note_22', 'note_23',
                    'note_24', 'note_25', 'note_26', 'note_27', 'note_28', 'note_29', 'note_30', 'note_31', 'note_32', 'note_33'
                );

                $dec = array(6, 7, 8, 9, 10, 11, 12, 13, 16);
                $enum = array(23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35);


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
                    
                        if ($inputType == 'checkbox') {
                            $checkboxValue = $article[$field] ? '<i class="fa-solid fa-check"></i>' : '<i class="fa-solid fa-minus"></i>';
                            echo '<td>' . $checkboxValue;
                            echo '</td>';
                        } else {
                            echo '<td>' . htmlspecialchars(formatValue($article[$field]));
                            echo '</td>';
                        }      

                        echo '<td>' . htmlspecialchars(formatValue($article[$noteField]));
                        echo '</td>';
                    echo '</tr>';
                }
        ?>
            <tr>
                <th class="parameter" colspan="2">Entry By</th>
               <?php 
                    echo "<td colspan='12'style='text-align:left; color:grey; padding: 5px 10px'>";
                    echo htmlspecialchars(formatValue($article['pic']));
                    echo "&nbsp&nbsp";
                    echo htmlspecialchars(formatValue($article['time']));
                    echo "</td>";
                ?>
            </tr>  

        </tbody>
        </article>
        </table>
        <?php endif; ?>
        <span class="legalDoc" style="margin-top: -15px;">H1-ETL4-44-24R0</span><br><br>
        </main>
    <script>
        document.getElementById("exit").onclick=function (){
            location.href = 'selection.php'
        }
    </script>

</body>
</html>