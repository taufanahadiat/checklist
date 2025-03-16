<?php
$unit = $_GET['selectedUnit']; 
$period = $_GET['selectedPeriod']; 

$current_year = date("Y");
if ($period == 'grounding_1') {
    $tahun = $current_year . '_1';
} elseif ($period == 'grounding_2') {
    $tahun = $current_year . '_2';
}

require 'database.php';
require 'request-grounding.php';


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

    <h2>
        <span style="font-weight:200;">DATA PENGUKURAN BOX GROUNDING</span>
        <br>
        <span style="font-weight:200;">
            Tanggal: <span style="font-weight:550;"><?php echo date("d F Y"); ?></span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            Selector Pengukuran: <span style="font-weight:550;">20 ohm - 200 ohm</span>
        </span>
    </h2>
                
<table style=" margin-top:5px;"> 
        <thead>
        <tr>
            <th style="width:2%;">No</th>
            <th style="width:5%;">Lokasi</th>
            <th style="width:2%;">Hasil Ukur</th>
            <th style="width:2%;">Koneksi</th>
            <th style="width:2%;">Tombak</th>
            <th style="width:12%;">Keterangan</th>
        </tr>
        </thead>
        <tbody>
        <form method="post">
        <?php
                require 'database.php';
                include 'request-view-grounding.php';

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
                
                $indexnumber =0;
                foreach ($lokasi as $index => $nama) {
                    $indexnumber++;
                    echo '<th>'.$indexnumber.'</th>';
                    echo '<th class="measure2" style="text-align: left;">' . $nama . '</th>';
                    
                    foreach ($fields as $field => $type) {
                        $fieldName = "{$index}_{$field}";
                        $fieldValue = isset($existing_record[$fieldName]) ? htmlspecialchars(formatValue($existing_record[$fieldName])) : '';

                        if ($existing_record && isset($existing_record[$fieldName])) {
                            $noteStyle = ($field === 'note') ? "style='text-align: left; padding: 5px 10px'" : '';
                            echo "<td $noteStyle>";

                            if ($type === 'select') {
                                if ($existing_record[$fieldName] == 1) {
                                    echo "<i class='fa fa-check'></i>";
                                } else {
                                    echo "<i class='fa fa-times'></i>";
                                }
                            } else {
                                echo $fieldValue;
                            }
                            echo "<button type='button' class='clear-btn' data-field='{$fieldName}'>X</button>";
                            echo "</td>";
                        } else {    
                            if ($type === 'select') {
                                echo "<td>";
                                echo "<input type='hidden' value='0' name='{$fieldName}' />";
                                echo "<input type='checkbox' class='big-checkbox' value='1' name='{$fieldName}' />";
                                echo "</td>";
                            } else if ($field === 'note'){
                                echo "<td><input type='text' class='input-field' name='{$fieldName}' style='min-width:300px; text-align:left;'></td>";
                            } else {
                                echo "<td><input type='number' step='0.01' class='input-field' name='{$fieldName}'</td>";
                            }
                        }
                    }
                    echo '</tr>';
                }

                ?>
                <tr>
                    </td>
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
                    echo '<input type="hidden" name="tanggal" value="' . date('Y-m-d') . '">';
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
