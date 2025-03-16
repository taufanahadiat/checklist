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
        <span style="font-weight:200;">Nama Panel: <span style="font-weight:550;">LVDP-3 L6</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <span style="font-weight:550;">R. Trafo L6</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bulan: <span style="font-weight:550;"><?php echo $nama_bulan?></span></span>
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
                    'cap_bank1' => 'Cap. Bank',
                    'cap_bank2' => 'Cap. Bank',
                    'main_breaker' => 'Main Breaker',
                    'coupler_cap_bank' => 'Coupler Cap. Bank',
                    'coupler_pp_rf' => 'Coupler PP RF',
                    'pp_boiler' => 'PP-Boiler',
                    'spare1' => 'Spare',
                    'dp_b2' => 'DP-B2',
                    'dp_g1' => 'DP-G1',
                    'dp_pump' => 'DP-Pump',
                    'pp_lift1' => 'PP-Lift 1',
                    'pp_lift2' => 'PP-Lift 2',
                    'olp' => 'OLP',
                    'mcc_ct' => 'MCC-CT',
                    'dp_ahu_1a' => 'DP-AHU 1A',
                    'dp_ahu_1b' => 'DP-AHU 1B',
                    'dp_ahu_2' => 'DP-AHU 2',
                    'spare2' => 'Spare',
                    'dp_b1' => 'DP-B1',
                    'pp_fire_pump' => 'PP-Fire Pump',
                    'pp_sfg' => 'PP-SFG',
                    'spare3' => 'Spare',
                    'pp_rf1' => 'PP-RF1',
                    'pp_rf2' => 'PP-RF2',
                    'pp_rf3' => 'PP-RF3',
                    'spare4' => 'Spare',
                    'ups_sbr1' => 'UPS-SBR1',
                    'mcc_ch_chp' => 'MCC-CH & CHP',
                    'pp_slitter1' => 'PP-Slitter1',
                    'pp_slitter2' => 'PP-Slitter2',
                    'booster_p_boiler' => 'Booster P. Boiler',
                    'spare5' => 'Spare',
                    'dp_g2' => 'DP-G2'
                );


                $capacity = array(
                    'cap_bank1' => '',
                    'cap_bank2' => '',
                    'main_breaker' => '5000',
                    'coupler_cap_bank' => '2500',
                    'coupler_pp_rf' => '2500',
                    'pp_boiler' => '125/160',
                    'spare1' => '125/160',
                    'dp_b2' => '100/125',
                    'dp_g1' => '80/100',
                    'dp_pump' => '63/80',
                    'pp_lift1' => '50/63',
                    'pp_lift2' => '50/63',
                    'olp' => '20/25',
                    'mcc_ct' => '250/630',
                    'dp_ahu_1a' => '160/400',
                    'dp_ahu_1b' => '160/400',
                    'dp_ahu_2' => '160/400',
                    'spare2' => '160/400',
                    'dp_b1' => '160/400',
                    'pp_fire_pump' => '250/630',
                    'pp_sfg' => '160/400',
                    'spare3' => '125/160',
                    'pp_rf1' => '125/160',
                    'pp_rf2' => '125/160',
                    'pp_rf3' => '125/160',
                    'spare4' => '125/160',
                    'ups_sbr1' => '50/63',
                    'mcc_ch_chp' => '2000',
                    'pp_slitter1' => '160/400',
                    'pp_slitter2' => '160/400',
                    'booster_p_boiler' => '200/250',
                    'spare5' => '200/250',
                    'dp_g2' => '160/200'
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
                    if($index == 'cap_bank1'){
                        echo '<th>1</th>';
                    }
                    if($index == 'cap_bank2'){
                        echo '<th>2</th>';
                    }
                    if($index == 'main_breaker'){
                        echo '<th rowspan="3">3</th>';
                    }
                    if($index == 'pp_boiler'){
                        echo '<th rowspan="22">4</th>';
                    }
                    if($index == 'mcc_ch_chp'){
                        echo '<th rowspan="6">5</th>';
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
