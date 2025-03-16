<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
require 'database.php';
require 'request-capbank.php';
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
    <h2>
        <span style="font-weight:200;">CHECK SHEET</span>
        <br>
        <span style="text-decoration: underline;">PANEL LOW VOLTAGE (LV)</span>
        <br>
        <span style="font-weight:200;">Nama Panel: <span style="font-weight:550;">LVDP 1-2 L7</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <span style="font-weight:550;">R. Trafo L7</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bulan: <span style="font-weight:550;"><?php echo $nama_bulan?></span></span>
    </h2>
    <?php include 'pilih-unit-panel.php'; ?>
        <thead>
        <tr>
            <th style="width:2%;" rowspan="2">CUB</th>
            <th style="width:5%;" rowspan="2">Nama Breaker/MCB</th>
            <th style="width:2%;" rowspan="2">Capacity (A)</th>
            <th style="width:5%;" rowspan="2">Aktual Amp (A)</th>
            <th style="width:5%;" rowspan="2">Temp (°C)</th>
            <th colspan="2">Kondisi</th>
            <th style="width:12%;" rowspan="2">Keterangan</th>
        </tr>
        <tr>
            <th style="width:2%;">MCB</th>
            <th style="width:2%;">Kabel & Koneksi</th>
        </tr>
        </thead>
        <tbody>
        <form method="post">
        <?php
                require 'database.php';
                include 'request-view-capbank.php';

                $breaker = array(
                    'se_11' => 'SE 11',
                    'se_21' => 'SE 21',
                    'sh_41' => 'SH 41',
                    'sg_31' => 'SG 31',
                    'sg_51' => 'SG 51',
                    'sm_11' => 'SM 11',
                    'sn_4'  => 'SN 4',
                    'spare1' => 'Spare',
                    'sn_2'  => 'SN 2',
                    'sn_3'  => 'SN 3',
                    'sn_1'  => 'SN 1',
                    'utility_erema' => 'Utility Erema',
                    'se_31' => 'SE 31',
                    'se_41' => 'SE 41',
                    'se_51' => 'SE 51',
                    'sd_31' => 'SD 31',
                    'sh_31' => 'SH 31',
                    'sh_11' => 'SH 11',
                    'big_grinder' => 'Big Grinder',
                    'spq_11' => 'SPQ 11',
                    'ups_20_kva' => 'UPS 20 KVA',
                    'sn_5' => 'SN 5',
                    'smu_mdo' => 'SMU MDO',
                    'shredder' => 'Shredder',
                    'sc_1' => 'SC 1',
                    'spare2' => 'Spare',
                    'pluff_sylo_erema' => 'Pluff Sylo Erema',
                    'spare3' => 'Spare',
                    'spare4' => 'Spare',
                    'spare5' => 'Spare',
                    'inc_produksi' => 'Inc Produksi',
                );
                
                
                
                $capacity = array(
                    'se_11' => '',
                    'se_21' => '',
                    'sh_41' => '250/630',
                    'sg_31' => '250/630',
                    'sg_51' => '250/630',
                    'sm_11' => '250/630',
                    'sn_4'  => '250/630',
                    'spare1' => '250/630',
                    'sn_2'  => '160/400',
                    'sn_3'  => '160/400',
                    'sn_1'  => '250/630',
                    'utility_erema' => '800',
                    'se_31' => '800',
                    'se_41' => '800',
                    'se_51' => '800',
                    'sd_31' => '800',
                    'sh_31' => '800',
                    'sh_11' => '1000',
                    'big_grinder' => '1000',
                    'spq_11' => '1250',
                    'ups_20_kva' => '44/63',
                    'sn_5' => '175/250',
                    'smu_mdo' => '140/200',
                    'shredder' => '175/250',
                    'sc_1' => '175/250',
                    'spare2' => '175/250',
                    'pluff_sylo_erema' => '112/160',
                    'spare3' => '56/80',
                    'spare4' => '20',
                    'spare5' => '16',
                    'inc_produksi' => '5000',
                );
                
                $fields = array(
                    'amp' => 'input', 
                    'temp' => 'input', 
                    'mcb' => 'select', 
                    'kabel' => 'select', 
                    'note' => 'input'
                );
                
                foreach ($breaker as $index => $nama) {
                    echo '<tr>';
                    if($index == 'se_11'){
                        echo '<th colspan="8" style="background-color: grey;">LVDP 1/L7</th></tr>';
                        echo '<tr><th>1</th>';
                    }
                    if($index == 'se_21'){
                        echo '<th>2</th>';
                    }
                    if($index == 'sh_41'){
                        echo '<th colspan="8" style="background-color: grey;">LVDP 2/L7</th></tr>';
                        echo '<tr><th rowspan="9">1</th>';
                    }
                    if($index == 'utility_erema'){
                        echo '<th rowspan="6">2</th>';
                    }
                    if($index == 'sh_11'){
                        echo '<th rowspan="11">3</th>';
                    }
                    if($index == 'spare4' || $index == 'spare5' || $index == 'inc_produksi'){
                        echo '<th></th>';
                    }
                    echo '<th class="measure2" style="text-align: left;">' . $nama . '</th>';
                    echo '<th class="parameter">' . $capacity[$index] . '</th>';
                    
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
                                echo "<td><input type='number' class='input-field' name='{$fieldName}'</td>";
                            }
                        }
                    }
                    echo '</tr>';
                }

                ?>
                <tr>
                    <td style="border:none; background-color: white; text-align:left;"></td>

                    <td style="border:none; background-color: white; text-align:left;" colspan="2">
                    <?php if ($existing_record && isset($existing_record['kebersihandalampanel']) && $existing_record['kebersihandalampanel'] == 1) : ?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                        <span style="vertical-align: top;">Kebersihan Dalam Panel</span><button type="button" class="clear-btn" data-field="kebersihandalampanel">Del</button>
                    <?php else :?>
                    <input type="checkbox" class="big-checkbox" value="1" name="kebersihandalampanel"><span style="vertical-align: top;">Kebersihan Dalam Panel</span>
                    <?php endif;?>
                    </td>

                    <td style="border:none; background-color: white; text-align:left;" colspan="3">
                    <?php if ($existing_record && isset($existing_record['lampuindikator']) && $existing_record['lampuindikator'] == 1) :?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                        <span style="vertical-align: top;">Lampu Indikator</span><button type="button" class="clear-btn" data-field="lampuindikator">Del</button>
                    <?php else :?>
                    <input type="checkbox" class="big-checkbox" value="1" name="lampuindikator"><span style="vertical-align: top;">Lampu Indikator</span>
                    <?php endif;?>      
                    </td>
                    <td style="border:none; background-color: white; text-align:left;" colspan="2"></td>
                </tr>
                <tr>
                    <td style="border:none; background-color: white; text-align:left;"></td>

                    <td style="border:none; background-color: white; text-align:left;" colspan="2">
                    <?php if ($existing_record && isset($existing_record['kebersihanluarpanel']) && $existing_record['kebersihanluarpanel'] == 1) : ?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                        <span style="vertical-align: top;">Kebersihan Luar Panel</span><button type="button" class="clear-btn" data-field="kebersihanluarpanel">Del</button>
                        <?php else :?>           
                        <input type="checkbox" class="big-checkbox" value="1" name="kebersihanluarpanel"><span style="vertical-align: top;">Kebersihan Luar Panel</span>
                    <?php endif;?> 
                    </td>                    
                    <td style="border:none; background-color: white; text-align:left;" colspan="3">
                    <?php if ($existing_record && isset($existing_record['engselhandledankuncipintu']) && $existing_record['engselhandledankuncipintu'] == 1) : ?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                        <span style="vertical-align: top;">Engsel, Handle & Kunci Pintu</span><button type="button" class="clear-btn" data-field="engselhandledankuncipintu">Del</button>
                        <?php else :?>           
                    <input type="checkbox" class="big-checkbox" value="1" name="engselhandledankuncipintu"><span style="vertical-align: top;">Engsel, Handle & Kunci Pintu</span></td>
                    <?php endif;?> 
                    <td style="border:none; background-color: white; text-align:left;" colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="5" style="height:50px; text-align:left; vertical-align:top;">Catatan:<br>
                        <?php if ($existing_record && isset($existing_record['catatan'])) :?>
                            <span style="font-weight: 550;"><?php echo htmlspecialchars($existing_record['catatan']); ?></span>
                            <button type="button" class="clear-btn" data-field="catatan">X</button>
                        <?php else :?>           
                            <textarea name='catatan' style='height:30px;width:95%;padding:4px;'></textarea>
                        <?php endif;?> 
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
