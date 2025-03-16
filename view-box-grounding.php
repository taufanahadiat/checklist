<?php
$unit = $_GET['selectedUnit']; 
$tahun = $_GET['selectedYear']; 
require 'database.php';
include 'request-view-grounding.php';


// Function to format the value
function formatValue($value) {
    if (is_numeric($value)) {
        // If the value is a float and has .00 as decimals, return it as an integer
        if (floor($value) == $value) {
            return number_format(intval($value));
        } else {
            // Return the value formatted with commas but preserving its decimal part
            return number_format($value, 2);
        }
    } else {
        // Otherwise, return the original value
        return $value;
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>View Checklist</title>
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
    <h2>
        <span style="font-weight:200;">DATA PENGUKURAN BOX GROUNDING</span>
        <br>
        <span style="font-weight:200;">
        Tahun: <span style="font-weight:550;"><?php echo $tahun; ?>
        </span>
    </h2>
    <br>
    <?php if ($article_1 && $article_2 == null): ?>
        <br>
            <p style="font-weight:550">----- Form ini belum terisi -----</p>
        <?php else: ?>
        <?php
            function renderArticleTable($article, $lokasi, $fields) {
            if (isset($article)) {
                echo '<h3><span style="font-weight:200;">';
                echo 'Tanggal: <span style="font-weight:550;">' . date('d F Y', strtotime($article['tanggal'])) . '</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                echo 'Selector Pengukuran: <span style="font-weight:550;">20 ohm - 200 ohm</span>';
                echo '</span></h3>';
            
                echo '            
<table style=" margin-left:0; margin-right:0; float:left;">';
                echo '<thead><tr>';
                echo '<th style="width:2%;">No</th>';
                echo '<th style="width:5%;">Lokasi</th>';
                echo '<th style="width:2%;">Hasil Ukur</th>';
                echo '<th style="width:2%;">Koneksi</th>';
                echo '<th style="width:2%;">Tombak</th>';
                echo '<th style="width:12%;">Keterangan</th>';
                echo '</tr></thead>';
                echo '<tbody>';
            
                $indexnumber = 0;
                foreach ($lokasi as $index => $nama) {
                    $indexnumber++;
                    echo '<tr><th>' . $indexnumber . '</th>';
                    echo '<th class="measure2" style="text-align: left;">' . $nama . '</th>';
                
                    foreach ($fields as $field => $type) {
                        $fieldName = "{$index}_{$field}";
                        $fieldValue = isset($article[$fieldName]) ? htmlspecialchars(formatValue($article[$fieldName])) : '';
                    
                        if (isset($article[$fieldName])) {
                            $noteStyle = ($field === 'note') ? "style='text-align: left; padding: 5px 10px'" : '';
                            echo "<td $noteStyle>";
                        
                            if ($type === 'select' && ($article[$fieldName] == 1 || $article[$fieldName] == 0)) {
                                echo $article[$fieldName] == 1 ? "<i class='fa fa-check'></i>" : "<i class='fa fa-times'></i>";
                            } else {
                                echo $fieldValue;
                            }
                            echo "</td>";
                        } else {
                            echo "<td></td>";
                        }
                    }
                    echo '</tr>';
                }
            
                // Display 'Entry By' row
                echo '<tr>';
                echo '<th class="parameter" colspan="2">Entry By</th>';
                if (isset($article['pic'])) {
                    echo "<td colspan='12' style='text-align:left; color:grey; padding: 5px 10px'>";
                    echo htmlspecialchars(formatValue($article['pic'])) . "&nbsp;&nbsp;";
                    echo htmlspecialchars(formatValue($article['time']));
                    echo "</td>";
                } else {
                    echo "<td colspan='12'></td>";
                }
                echo '</tr>';
            
                echo '</tbody></table>';
            }
        }

        // Define the common location and fields data
        $lokasi = array(
            'line7_whfg' => 'Line 7 WH FG',
            'gedung_baru' => 'Gedung Baru',
            'hrd' => 'HRD',
            'line1_whfg_opp2_5' => 'Line 1 WH FG OPP 2-5',
            'line5' => 'Line 5',
            'cerobong_gas_boiler_l6' => 'Cerobong Gas Boiler L6',
            'pos_depan' => 'Pos Depan (Timbangan)',
            'tangki_solar1_2_l6' => 'Tangki Solar 1 dan 2 L6',
            'mixing1_line1' => 'Mixing 1 Line 1',
            'pet_wh_packing' => 'PET WH Packing',
            'pet_produksi' => 'PET Produksi',
            'compressor' => 'Compressor',
            'waterpump1' => 'Waterpump 1',
            'tanki_solar_genset' => 'Tanki Solar Genset',
            'kantor_kuwera_gs' => 'Kantor Kuwera/GS',
            'boiler1' => 'Boiler 1 (Cerobong)',
            'met12' => 'MET 1/2',
            'coating34' => 'Coating 3/4',
            'line8_depan' => 'Line 8 Depan',
            'line8_belakang' => 'Line 8 Belakang',
            'line8_silo' => 'Line 8 Silo',
            'boiler_sentral_coating' => 'Boiler Sentral Coating',
        );

        $fields = array(
            'ukur' => 'input', 
            'koneksi' => 'select', 
            'tombak' => 'select', 
            'note' => 'input'
        );

        // Call the function for each article
        renderArticleTable($article_1, $lokasi, $fields);
        renderArticleTable($article_2, $lokasi, $fields);
        ?>
        <?php endif;?>
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
