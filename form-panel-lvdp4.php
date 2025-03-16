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
        <span style="font-weight:200;">Nama Panel: <span style="font-weight:550;">LVDP 4</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <span style="font-weight:550;">Line 4</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bulan: <span style="font-weight:550;"><?php echo $nama_bulan?></span></span>
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
                    'dc_II' => 'DC II', 
                    'dc_I' => 'DC I', 
                    'ac_I' => 'AC I', 
                    'dc_III' => 'DC III', 
                    'ac_II' => 'AC II', 
                    'ac_III' => 'AC III', 
                    'produksi' => 'PRODUKSI', 
                    'cos' => 'COS', 
                    'inc_tr7' => 'INC TR7', 
                    'coupler_tr' => 'COUPLER TR', 
                    'inc_tr4' => 'INC TR4', 
                    'grinder_l4' => 'GRINDER L4', 
                    'pp_II' => 'PP II', 
                    'lp_coating_II' => 'LP COATING II', 
                    'p_pompa_chiller' => 'P POMPA CHILLER', 
                    'chiller_l4' => 'CHILLER L4', 
                    'pp_I_l4' => 'PP I/L4', 
                    'chiller_l5' => 'CHILLER L5', 
                    'lp_II_lp_f' => 'LP II/LP F', 
                    'p_lp_l4' => 'P LP/L4', 
                    'p_roop_fan' => 'P ROOP FAN', 
                    'breaker_3p' => 'BREAKER 3P', 
                    'mesin_v_pvdc' => 'MESIN V/PVDC'
                );

                $capacity = array(
                    'dc_II' => '800', 
                    'dc_I' => '1250', 
                    'ac_I' => '800', 
                    'dc_III' => '1600', 
                    'ac_II' => '800', 
                    'ac_III' => '1250', 
                    'produksi' => '3200', 
                    'cos' => '', 
                    'inc_tr7' => '3200', 
                    'coupler_tr' => '3150', 
                    'inc_tr4' => '2500', 
                    'grinder_l4' => '250', 
                    'pp_II' => '160', 
                    'lp_coating_II' => '250', 
                    'p_pompa_chiller' => '100', 
                    'chiller_l4' => '800', 
                    'pp_I_l4' => '630', 
                    'chiller_l5' => '1600', 
                    'lp_II_lp_f' => '100', 
                    'p_lp_l4' => '100', 
                    'p_roop_fan' => '250', 
                    'breaker_3p' => '70', 
                    'mesin_v_pvdc' => ''
                );
                
                $fields = array(
                    'amp' => 'input', 
                    'temp' => 'input', 
                    'mcb' => 'select', 
                    'kabel' => 'select', 
                    'note' => 'input'
                );
                $cubindex =1;
                foreach ($breaker as $index => $nama) {
                    echo '<tr>';
                    if($index == 'dc_I' || $index == 'dc_III' || $index == 'ac_III' || $index == 'pp_II' || $index == 'p_pompa_chiller' || $index == 'pp_I_l4'|| $index == 'breaker_3p') {
                        echo '<th style="border-top:none;"></th>';
                    }else{
                        echo '<th style="border-bottom:none;">' . $cubindex . '</th>';
                        $cubindex++;
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
