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
 
        .rectangle-box {
            width: 75px; /* Width of the rectangle */
            height: 30px; /* Height of the rectangle */
            background-color: #f0f0f0; /* Background color of the rectangle */
            border: 1px solid #ccc; /* Optional: border color */
            display: flex;
            margin: auto;
            align-items: center;
            justify-content: center;
            border-radius: 5px; /* Optional: rounded corners for a softer look */
        }

        .rectangle-value {
            font-size: 14px; /* Adjust font size for the value */
            color: #000; /* Text color */
        }

    </style>

</head>

<body>
<?php include 'header.php'; ?>
<main>
<table style="width:75%;"> 
    <h2>
        <span style="font-weight:200;">CHECK SHEET</span>
        <br>
        <span style="text-decoration: underline;">CAPACITOR BANK</span>
        <br>
        <span style="font-weight:200;">Lokasi: <span style="font-weight:550;">LVDP L3</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bulan: <span style="font-weight:550;"><?php echo $nama_bulan?></span></span>
    </h2>

    <form name="select-form-trafo" onsubmit="handleFormSubmit(event, 'option-form-capbank')">
        <div class="custom-label-form" style="margin-top:-30px;"> 
        <label for="unit-trafo">Change Line:</label>
          <div class="unitfield-form">
            <select class="selection-genset" name="unit-trafo" id="option-form-capbank">
              <?php include 'pilih-unit-capbank.php' ?>
            </select>
          </div>
          <input style="margin-top: 20px" class="btn-form" type="submit" value="SUBMIT">
          </div>
      </form>
        <thead>
        <tr>
            <th style="width:5%;">Nomor Unit</th>
            <th style="width:8%;">Arus (A)</th>
            <th style="width:7%;">Capacitor</th>
            <th style="width:7%;">Reaktor</th>
            <th style="width:7%;">Fuse/Breaker</th>
            <th style="width:7%;">Contactor</th>
            <th style="width:7%;">Kabel & Koneksi</th>
            <th style="width:8%;">Temp (°C)</th>
            <th style="width:8%;">Keterangan</th>
        </tr>
        </thead>
        <tbody>
        <form method="post">
        <?php
                require 'database.php';
                include 'request-view-capbank.php';

                $noUnit = array(
                    "1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"
                );

                $arus = array(
                    'arus_1', 'arus_2', 'arus_3', 'arus_4', 'arus_5', 
                    'arus_6', 'arus_7', 'arus_8', 'arus_9', 'arus_10', 
                    'arus_11', 'arus_12'
                );
                
                $capacitor = array(
                    'capacitor_1', 'capacitor_2', 'capacitor_3', 'capacitor_4', 
                    'capacitor_5', 'capacitor_6', 'capacitor_7', 'capacitor_8', 
                    'capacitor_9', 'capacitor_10', 'capacitor_11', 'capacitor_12'
                );
                
                $reaktor = array(
                    'reaktor_1', 'reaktor_2', 'reaktor_3', 'reaktor_4', 
                    'reaktor_5', 'reaktor_6', 'reaktor_7', 'reaktor_8', 
                    'reaktor_9', 'reaktor_10', 'reaktor_11', 'reaktor_12'
                );
                
                $fuse = array(
                    'fuse_1', 'fuse_2', 'fuse_3', 'fuse_4', 'fuse_5', 
                    'fuse_6', 'fuse_7', 'fuse_8', 'fuse_9', 'fuse_10', 
                    'fuse_11', 'fuse_12'
                );
                
                $contactor = array(
                    'contactor_1', 'contactor_2', 'contactor_3', 'contactor_4', 
                    'contactor_5', 'contactor_6', 'contactor_7', 'contactor_8', 
                    'contactor_9', 'contactor_10', 'contactor_11', 'contactor_12'
                );
                
                $kabel = array(
                    'kabel_1', 'kabel_2', 'kabel_3', 'kabel_4', 'kabel_5', 
                    'kabel_6', 'kabel_7', 'kabel_8', 'kabel_9', 'kabel_10', 
                    'kabel_11', 'kabel_12'
                );
                
                $temp = array(
                    'temp_1', 'temp_2', 'temp_3', 'temp_4', 'temp_5', 
                    'temp_6', 'temp_7', 'temp_8', 'temp_9', 'temp_10', 
                    'temp_11', 'temp_12'
                );
                
                $note = array(
                    'note_1', 'note_2', 'note_3', 'note_4', 'note_5', 
                    'note_6', 'note_7', 'note_8', 'note_9', 'note_10', 
                    'note_11', 'note_12'
                );
                                
                $fields = array(
                    'arus' => 'input', 
                    'capacitor' => 'select', 
                    'reaktor' => 'select', 
                    'fuse' => 'select', 
                    'contactor' => 'select', 
                    'kabel' => 'select', 
                    'temp' => 'input', 
                    'note' => 'input'
                );
                
                foreach ($noUnit as $index => $no) {
                    echo '<tr>';
                    echo '<th class="measure2">' . $no . '</th>';
                    
                    foreach ($fields as $field => $type) {
                        $fieldName = "{$field}_{$no}";
                        $fieldValue = isset($existing_record[$fieldName]) ? htmlspecialchars(formatValue($existing_record[$fieldName])) : '';
                        
                        if ($existing_record && isset($existing_record[$fieldName])) {
                            $noteStyle = ($field === 'note') ? "style='text-align: left; padding: 5px 10px'" : '';
                            echo "<td $noteStyle>";

                            if ($type === 'select' && ($existing_record[$fieldName] == 1 || $existing_record[$fieldName] == 0)) {
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
                                echo "<td><select class='enum' name='{$fieldName}'>";
                                include 'enum-capbank.php';
                                echo "</select></td>";
                            } else if ($field === 'note'){
                                echo "<td><input type='text' class='input-field' name='{$fieldName}' style='min-width:200px; text-align:left;'></td>";
                            } else {
                                echo "<td><input type='number' class='input-field' name='{$fieldName}'</td>";
                            }
                        }
                    }
                }

                ?>
                <tr>
                    <td style="border:none; background-color: white; text-align:left;"></td>

                    <td style="border:none; background-color: white; text-align:left;" colspan="2">
                    <?php if ($existing_record && isset($existing_record['kebersihan_dalam']) && $existing_record['kebersihan_dalam'] == 1) : ?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                        <span style="vertical-align: top;">Kebersihan Dalam Panel</span><button type="button" class="clear-btn" data-field="kebersihan_dalam">Del</button>
                    <?php else :?>
                    <input type="checkbox" class="big-checkbox" value="1" name="kebersihan_dalam"><span style="vertical-align: top;">Kebersihan Dalam Panel</span>
                    <?php endif;?>
                    </td>

                    <td style="border:none; background-color: white; text-align:left;" colspan="2">
                    <?php if ($existing_record && isset($existing_record['lampu']) && $existing_record['lampu'] == 1) :?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                        <span style="vertical-align: top;">Lampu Indikator</span><button type="button" class="clear-btn" data-field="lampu">Del</button>
                    <?php else :?>
                    <input type="checkbox" class="big-checkbox" value="1" name="lampu"><span style="vertical-align: top;">Lampu Indikator</span>
                    <?php endif;?>      
                    </td>
                    
                    <td style="border:none; background-color: white; text-align:left;" colspan="3">
                    <?php if ($existing_record && isset($existing_record['tombol']) && $existing_record['tombol'] == 1) :?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                        <span style="vertical-align: top;">Tombol & Selector Switch</span><button type="button" class="clear-btn" data-field="tombol">Del</button>
                    <?php else :?>
                    <input type="checkbox" class="big-checkbox" value="1" name="tombol"><span style="vertical-align: top;">Tombol & Selector Switch</span>
                    <?php endif;?> 
                    </td>

                    <td style="border:none; background-color: white; text-align: center; position: relative; vertical-align: middle;" rowspan="2">cos φ<br>
                    <?php if ($existing_record && isset($existing_record['cos'])) :?>
                        <div class="rectangle-box">
                            <span class="rectangle-value"><?php echo htmlspecialchars(formatValue($existing_record['cos'])); ?></span>
                            &nbsp;
                            <button type="button" class="clear-btn" data-field="cos">X</button>
                        </div>
                    <?php else :?>           
                    <input type="number" step="0.01" class="input-field" name="cos">
                    <?php endif;?> 
                    </td>
                </tr>
                <tr>
                    <td style="border:none; background-color: white; text-align:left;"></td>

                    <td style="border:none; background-color: white; text-align:left;" colspan="2">
                    <?php if ($existing_record && isset($existing_record['kebersihan_luar']) && $existing_record['kebersihan_luar'] == 1) : ?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                        <span style="vertical-align: top;">Kebersihan Luar Panel</span><button type="button" class="clear-btn" data-field="kebersihan_luar">Del</button>
                        <?php else :?>           
                        <input type="checkbox" class="big-checkbox" value="1" name="kebersihan_luar"><span style="vertical-align: top;">Kebersihan Luar Panel</span>
                    <?php endif;?> 
                    </td>

                    <td style="border:none; background-color: white; text-align:left;" colspan="2">
                    <?php if ($existing_record && isset($existing_record['exhaust']) && $existing_record['exhaust'] == 1) : ?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                        <span style="vertical-align: top;">Exhaust Fan</span><button type="button" class="clear-btn" data-field="exhaust">Del</button>
                        <?php else :?>           
                    <input type="checkbox" class="big-checkbox" value="1" name="exhaust"><span style="vertical-align: top;">Exhaust Fan</span>
                    <?php endif;?> 
                    </td>
                    
                    <td style="border:none; background-color: white; text-align:left;" colspan="3">
                    <?php if ($existing_record && isset($existing_record['pintu']) && $existing_record['pintu'] == 1) : ?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                        <span style="vertical-align: top;">Engsel, Handle & Kunci Pintu</span><button type="button" class="clear-btn" data-field="pintu">Del</button>
                        <?php else :?>           
                    <input type="checkbox" class="big-checkbox" value="1" name="pintu"><span style="vertical-align: top;">Engsel, Handle & Kunci Pintu</span></td>
                    <?php endif;?> 
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

    function handleFormSubmit(event, selectId) {
    event.preventDefault();

    var selectElement = document.getElementById(selectId);
    var selectedUnit = selectElement.value;    
              
            console.log('Selected <select> ID:', selectId);
            console.log('Selected Value:', selectedUnit);

            switch (selectedUnit) {
              case 'capbank_lvdp3':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp3.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdp4_prod':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp4prod.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdp4_uty':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp4uty.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_trafo5':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafo5.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_trafo6':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafo6.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_trafo7':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafo7.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdp8':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp8.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_trafopet_prod':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafopetprod.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_trafopet_uty':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafopetuty.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdpmet2':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdpmet2.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdpmet3':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdpmet3.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdpoffice':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdpoffice.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdpcpp':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdpcpp.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
                default:
                    break;
            }
        }
    </script>
</body>
</html>
