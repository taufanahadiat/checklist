<?php
$unit = 'trafo_daily_line6';
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

<h2>PENGAMANAN TRAFO AREA LINE 6</h2>
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
                    "Trafo 16 Extruder", 
                    "Trafo 22 Produksi", 
                    "Trafo 18 Utility", 
                    "Trafo 5 Spare", 
                    "Trafo 16a Spare", 
                    "",
                    "Panel MVDP", 
                    "Panel LVDP 1 Extruder", 
                    "Panel LVDP 2 Produksi", 
                    "Panel LVDP 3 Utility", 
                    "Panel Capacitor Bank",                    
                    "Panel Lightning",                    
                    "Panel Fan",                    
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
                    "FCU 1", 
                    "FCU 2", 
                    "Level Oli TR 16 (IGBT)", 
                    "Level Oli TR 16a (IGBT)", 
                    "Level Oli TR 22 (IGBT)", 
                    "Level Oli TR 18 (IGBT)", 
                );

                $fields = array('kunci_gembok_pintu_1', 'kunci_gembok_pintu_2', 'kunci_gembok_pintu_3', 
                    'kunci_gembok_pintu_4', 'kunci_gembok_pintu_5', '', 'trafo_16_extruder', 'trafo_22_produksi', 
                    'trafo_18_utility', 'trafo_5_spare', 'trafo_16a_spare', '', 'panel_mvdp', 'panel_lvdp_1_extruder', 
                    'panel_lvdp_2_produksi', 'panel_lvdp_3_utility', 'panel_cap_bank', 'panel_lighting',
                    'panel_fan', '', 'tray_cable', 'grounding', 'exhaust_fan', 'lampu_lampu', 'stop_kontak', '',
                    'sapu', 'alat_pel', 'kemoceng', 'pengki', 'tempat_sampah', 'papan_aktivitas_5r', '',
                    'fcu_1', 'fcu_2', 'level_oli_tr_16_igbt', 'level_oli_tr_16a_igbt', 
                    'level_oli_tr_22_igbt', 'level_oli_tr_18_igbt'
                );     
                
                $note = array('note_1', 'note_2', 'note_3', 
                    'note_4', 'note_5', '', 'note_6', 'note_7', 'note_8', 'note_9', 'note_10', '',
                    'note_11', 'note_12', 'note_13', 'note_14', 'note_15', 'note_16', 'note_17', '', 
                    'note_18', 'note_19', 'note_20', 'note_21', 'note_22', '', 'note_23', 'note_24', 
                    'note_25', 'note_26', 'note_27', 'note_28', '', 'note_29', 'note_30', 'note_31', 
                    'note_32', 'note_33', 'note_34'
                );

                $dec = array(6, 7, 8, 9, 10, 16, 33);
                $enum1 = array(34);
                $enum2 = array(35, 36, 37, 38);

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
                    if (in_array($index, $enum1)) {
                        $inputType = 'select-on';
                    } elseif (in_array($index, $enum2)) {
                        $inputType = 'select-full';
                    } elseif (in_array($index, $dec)) {
                        $inputType = 'number';
                    } else {
                        $inputType = 'checkbox';
                    }                    
                    
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
        <span class="legalDoc" style="margin-top: -15px;">H1-ETL6-46-24R0</span><br><br>
        </main>
    <script>
        document.getElementById("exit").onclick=function (){
            location.href = 'selection.php'
        }
    </script>

</body>
</html>