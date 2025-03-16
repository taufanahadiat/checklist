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
        <span style="font-weight:200;">Nama Panel: <span style="font-weight:550;">LVDP Office</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <span style="font-weight:550;">Basement</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bulan: <span style="font-weight:550;"><?php echo $nama_bulan?></span></span>
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
                    'incoming' => 'Incoming',
                    'breaker_mcb' => 'Breaker/MCB',
                    'kantin' => 'Kantin',
                    'hydrant' => 'Hydrant',
                    'lp_taman_b' => 'LP Taman B',
                    'lp_taman_a' => 'LP Taman A',
                    'lp_taman_a_copy' => '',
                    'fuse' => 'Fuse',
                    'ups_pabx' => 'UPS PABX',
                    'panel_control' => 'Panel Control',
                    'panel_control_copy1' => '',
                    'panel_control_copy2' => '',
                    'lp_atap' => 'LP Atap',
                    'lift' => 'Lift',
                    'booster' => 'Booster',
                    'ac_lt4' => 'AC (LT.4)',
                    'lp3_lt3' => 'LP3 (LT.3)',
                    'lp2_lt2' => 'LP2 (LT.2)',
                    'ac' => 'AC',
                    'ac_copy' => '',
                    'ac2_lt4' => 'AC2 (LT.4)',
                    'lp1_lt1' => 'LP1 (LT.1)',
                    'cap_bank' => 'Cap Bank'
                );                

                $capacity = array(
                    'incoming' => '800',
                    'breaker_mcb' => '400',
                    'kantin' => '60',
                    'hydrant' => '125',
                    'lp_taman_b' => '32',
                    'lp_taman_a' => '16',
                    'lp_taman_a_copy' => '63',
                    'fuse' => '3 X 2',
                    'ups_pabx' => '32',
                    'panel_control' => '20',
                    'panel_control_copy1' => '20',
                    'panel_control_copy2' => '80',
                    'lp_atap' => '63',
                    'lift' => '63',
                    'booster' => '40',
                    'ac_lt4' => '100',
                    'lp3_lt3' => '100',
                    'lp2_lt2' => '100',
                    'ac' => '200',
                    'ac_copy' => '125',
                    'ac2_lt4' => '125',
                    'lp1_lt1' => '100',
                    'cap_bank' => '400'
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
                    if($index == 'incoming'){
                        echo '<th rowspan="8">1</th>';
                    }
                    if($index == 'ups_pabx'){
                        echo '<th rowspan="14">2</th>';
                    }
                    if($index == 'cap_bank'){
                        echo '<th>3</th>';
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
