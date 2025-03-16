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
        <span style="font-weight:200;">Nama Panel: <span style="font-weight:550;">LVDP PET</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <span style="font-weight:550;">R. Trafo PET</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bulan: <span style="font-weight:550;"><?php echo $nama_bulan?></span></span>
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
                    'outgoing' => 'Outgoing',
                    'coupler' => 'Coupler',
                    'from_trafo_gen' => 'From Trafo Gen',
                    'coupler2' => 'Coupler',
                    'outgoing2' => 'Outgoing',
                    'ppg1' => 'PPG-1',
                    'ppg1_copy' => '',
                    'pp1_2' => 'PP1-2',
                    'pp1_1' => 'PP1-1',
                    'mini_coex' => 'Mini Coex',
                    'ppg2' => 'PPG-2',
                    'pp1_4' => 'PP1-4',
                    'pp1_3' => 'PP1-3',
                    'dc1' => 'DC-1',
                    'ac1' => 'AC-1',
                    'dc2' => 'DC-2',
                    'ac2' => 'AC-2',
                    'dc3' => 'DC-3',
                    'cap_bank1' => 'Cap Bank',
                    'from_tr10_prod' => 'From TR10 (Prod)',
                    'coupler3' => 'Coupler',
                    'from_tr9_uty' => 'From TR9 (Uty)',
                    'p_fc' => 'P-FC',
                    'cap_bank2' => 'Cap Bank',
                    'p_sl' => 'P-SL',
                    'p_chiller' => 'P Chiller',
                    'plb' => 'PLB',
                    'spare' => 'Spare',
                    'plg1' => 'PLG-1',
                    'charger' => 'Charger',
                    'clips' => 'Clips',
                    'plg2' => 'PLG-2',
                    'pl1_1' => 'PL1-1',
                    'pl1_2' => 'PL1-2',
                    'p_hb' => 'P-HB',
                    'chiller_hitachi' => 'Chiller Hitachi',
                    'p_gs' => 'P-GS',
                    'p_gr' => 'P-GR',
                );
                
                

                $capacity = array(
                    'outgoing' => '3900',
                    'coupler' => '',
                    'from_trafo_gen' => '3900',
                    'coupler2' => '',
                    'outgoing2' => '3900',
                    'ppg1' => '250',
                    'ppg1_copy' => '160',
                    'pp1_2' => '400',
                    'pp1_1' => '400',
                    'mini_coex' => '250',
                    'ppg2' => '160',
                    'pp1_4' => '1250',
                    'pp1_3' => '400',
                    'dc1' => '1250',
                    'ac1' => '1600',
                    'dc2' => '1250',
                    'ac2' => '1600',
                    'dc3' => '800',
                    'cap_bank1' => '2000',
                    'from_tr10_prod' => '3900',
                    'coupler3' => '',
                    'from_tr9_uty' => '3900',
                    'p_fc' => '800',
                    'cap_bank2' => '2000',
                    'p_sl' => '1000',
                    'p_chiller' => '1600',
                    'plb' => '160',
                    'spare' => '160',
                    'plg1' => '160',
                    'charger' => '160',
                    'clips' => '160',
                    'plg2' => '160',
                    'pl1_1' => '160',
                    'pl1_2' => '160',
                    'p_hb' => '400',
                    'chiller_hitachi' => '630',
                    'p_gs' => '400',
                    'p_gr' => '630',
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
                    if($index == 'ppg1_copy' || $index == 'pp1_2' || $index == 'pp1_1' || $index == 'ppg2' || $index == 'pp1_4' || $index == 'pp1_3' || $index == 'ac1' || $index == 'ac2' || $index == 'cap_bank1' || $index == 'cap_bank2' || $index == 'p_chiller') {
                        echo '<th style="border-top:none; border-bottom:none;"></th>';
                    }else if($cubindex == 16 && $index  == 'plb'){
                        echo '<th rowspan="8">' . $cubindex . '</th>';
                    }else if ($cubindex < 16){
                        echo '<th style="border-bottom:none;">' . $cubindex . '</th>';
                            $cubindex++;
                    } 

                    if ($index == 'p_hb' || $index == 'p_gs') {
                        $cubindex++;
                        echo '<th style="border-bottom:none;">' . $cubindex . '</th>';
                    } else if ($index == 'chiller_hitachi' || $index == 'p_gr') {
                        echo '<th style="border-top:none;"></th>';
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
