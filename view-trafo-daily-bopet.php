<?php

include 'database.php';
$tanggal = "" . $_GET['selectedDate'];
$unit = "" . $_GET['selectedUnit'];

include 'request-view-trafo.php';

?>


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

<h2>PENGAMANAN TRAFO AREA BOPET</h2>
    <?php include 'pilih-tanggal.php'; ?>

    <?php if ($article === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>

            <?php include 'verification-form.php'?>
    
            <table style="width: 55%;">
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
                    'exhaust_fan', 'lampu-lampu', 'stop_kontak', '', 'sapu', 'alat_pel', 'kemoceng',
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

        </main>
    <script>
        document.getElementById("exit").onclick=function (){
            location.href = 'selection.php'
        }
    </script>

</body>
</html>