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
        <span style="font-weight:200;">Nama Panel: <span style="font-weight:550;">LVDP-1 L8</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <span style="font-weight:550;">R. Trafo L8</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bulan: <span style="font-weight:550;"><?php echo $nama_bulan?></span></span>
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
                    'main_breaker' => 'Main Breaker',
                    'ge_11_1' => 'GE 11',
                    'ge_11_2' => 'GE 11',
                    'sn_13' => 'SN 13',
                    'sn_12' => 'SN 12',
                    'sn_11' => 'SN 11',
                    'sx_21' => 'SX 21',
                    'sx_31' => 'SX 31',
                    'sn_14' => 'SN 14',
                    'sef_1' => 'SEF 1',
                    'se_51' => 'SE 51',
                    'spare1' => 'Spare',
                    'seg_1' => 'SEG 1',
                    'sx_11' => 'SX 11',
                    'sx_41' => 'SX 41',
                    'spare2' => 'Spare',
                    'spare3' => 'Spare',
                    'ups_sg1' => 'UPS SG1',
                    'spare4' => 'Spare',
                    'spare5' => 'Spare',
                    'ups_sg_lighting' => 'UPS SG Lighting',
                    'spare6' => 'Spare',
                    'spare7' => 'Spare'
                );
                

                $capacity = array(
                    'main_breaker' => '4000',
                    'ge_11_1' => '1250',
                    'ge_11_2' => '1250',
                    'sn_13' => '630',
                    'sn_12' => '630',
                    'sn_11' => '630',
                    'sx_21' => '630',
                    'sx_31' => '630',
                    'sn_14' => '630',
                    'sef_1' => '630',
                    'se_51' => '400',
                    'spare1' => '250',
                    'seg_1' => '250',
                    'sx_11' => '400',
                    'sx_41' => '400',
                    'spare2' => '400',
                    'spare3' => '400',
                    'ups_sg1' => '25',
                    'spare4' => '25',
                    'spare5' => '16',
                    'ups_sg_lighting' => '16',
                    'spare6' => '16',
                    'spare7' => '16'
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
                    if($index == 'main_breaker'){
                        echo '<th>1</th>';
                    }
                    if($index == 'ge_11_1'){
                        echo '<th rowspan="2">2</th>';
                    }
                    if($index == 'sn_13'){
                        echo '<th rowspan="6">3</th>';
                    }
                    if($index == 'sef_1'){
                        echo '<th rowspan="14">4</th>';
                    }

                    echo '<th class="measure2" style="text-align: left;">' . $nama . '</th>';
                    echo '<th class="parameter">' . $capacity[$index] . '</th>';
                    
                    foreach ($fields as $field => $type) {
                        $fieldName = "{$index}_{$field}";
                        $fieldValue = isset($existing_record[$fieldName]) ? htmlspecialchars(formatValue($existing_record[$fieldName])) : '';

                        if ($existing_record && isset($existing_record[$fieldName])) {
                            $noteStyle = ($field === 'note') ? "style='text-align: left; padding: 5px 10px'" : '';
                            echo "<td $noteStyle>";

                            if ($type === 'select' && ($existing_record[$fieldName] == 1)) {
                                echo "<i class='fa fa-check'></i>";
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
