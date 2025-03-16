<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
$bulan = date("Y-m");
require 'database.php';
require 'request-trafo-monthly.php';
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
        td {
            text-align: center;
        }
        .enum, .input-field {
            width: 100%;
            max-width: 65px;
            height: 25px;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
        }
        .input-field {
            cursor: text;
        }
 
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h2>PM TRANSFORMATOR (BULANAN)</h2>

                
<table style="overflow-x: auto; display: block; width:100%; table-layout: auto;">

        <thead>
            <tr>
                <th rowspan="2" style="padding:2px 5px;">No</th>
                <th rowspan="2" style="padding:2px 20px;">Tanggal</th>
                <th rowspan="2" style="width:10%;">Nama Mesin</th>
                <th rowspan="2" style="padding:2px 10px;">KVA</th>
                <th colspan="3">Current<br></th>
                <th colspan="4">Temperature</th>
                <th rowspan="2" style="white-space:nowrap; padding: 2px 15px;">Level Oli</th>
                <th rowspan="2">Kebersihan Unit</th>
                <th rowspan="2">Kebersihan Area</th>
                <th rowspan="2" style="width:8%;">Keterangan</th>
                <th rowspan="2" style="padding:2px 50px; white-space:nowrap;">Entry By</th>
                <th rowspan="2"></th>
            </tr>
            <tr>
                <th>R</th>
                <th>S</th>
                <th>T</th>
                <th>Ruangan</th>
                <th>Oil</th>
                <th>Kabel MV</th>
                <th>Kabel LV</th>
            </tr>
        </thead>
            <tbody>
                <?php 
                //require 'database.php';
                //include 'request-view-trafo-monthly.php';

                $field = array(
                    'tr1' => array('desc' => 'TR-1 (PLN)', 'kva' => 630),
                    'tr2' => array('desc' => 'TR-2 (PLN)', 'kva' => 1600),
                    'tr3' => array('desc' => 'TR-3 (PLN)', 'kva' => 1600),
                    'tr4' => array('desc' => 'TR-4 (PLN)', 'kva' => 1600),
                    'tr5' => array('desc' => 'TR-5 (PLN)', 'kva' => 1600),
                    'tr6' => array('desc' => 'TR-6 (PLN)', 'kva' => 1600),
                    'tr7' => array('desc' => 'TR-7 (PLN)', 'kva' => 2000),
                    'tr8' => array('desc' => 'TR-8 (PLN)', 'kva' => 1600),
                    'tr9' => array('desc' => 'TR-9 (PLN)', 'kva' => 2500),
                    'tr10' => array('desc' => 'TR-10 (PLN)', 'kva' => 2500),
                    'tr11' => array('desc' => 'TR-11 (PLN)', 'kva' => 2000),
                    'tr12' => array('desc' => 'TR-12 (PLN)', 'kva' => 3000),
                    'tr13' => array('desc' => 'TR-13 (PLN)', 'kva' => 1600),
                    'tr14' => array('desc' => 'TR-14 (PLN)', 'kva' => 2500),
                    'tr15' => array('desc' => 'TR-15 (PLN)', 'kva' => 630),
                    'tr16' => array('desc' => 'TR-16 (PLN)', 'kva' => 630),
                    'tr16a' => array('desc' => 'TR-16a (PLN)', 'kva' => 630),
                    'tr17' => array('desc' => 'TR-17 (PLN)', 'kva' => 3150),
                    'tr18' => array('desc' => 'TR-18 (PLN)', 'kva' => 3150),
                    'tr19' => array('desc' => 'TR-19 (PLN)', 'kva' => 630),
                    'tr20' => array('desc' => 'TR-20 (PLN)', 'kva' => 3150),
                    'tr21' => array('desc' => 'TR-21 (PLN)', 'kva' => 3150),
                    'tr22' => array('desc' => 'TR-22 (PLN)', 'kva' => 3150),
                    'tr23' => array('desc' => 'TR-23 (PLN)', 'kva' => 2500),
                    'tr24' => array('desc' => 'TR-24 (PLN)', 'kva' => 2500),
                    'tr25' => array('desc' => 'TR-25 (PLN)', 'kva' => 2500),
                    'trg3' => array('desc' => 'TRG-3 (GENSET)', 'kva' => 2500),
                    'trg4' => array('desc' => 'TRG-4 (GENSET)', 'kva' => 2500),
                    'trg5' => array('desc' => 'TRG-5 (GENSET)', 'kva' => 5000),
                    'trg6' => array('desc' => 'TRG-6 (GENSET)', 'kva' => 2500),
                    'trg7' => array('desc' => 'TRG-7 (GENSET)', 'kva' => ''),
                    'trg8' => array('desc' => 'TRG-8 (GENSET)', 'kva' => 1000),
                    'trg9' => array('desc' => 'TRG-9 (GENSET)', 'kva' => 3150),
                    'trg10' => array('desc' => 'TRG-10 (GENSET)', 'kva' => 3150),
                    'trg11' => array('desc' => 'TRG-11 (GENSET)', 'kva' => 3150),
                );

                $inputNames = array(
                    'current_r',
                    'current_s',
                    'current_t',
                    'temp_ruangan',
                    'temp_oil',
                );

                $fileInput = array('temp_val_kabel_mv', 'temp_val_kabel_lv');
                $enumNames = array('level_oli', 'kebersihan_unit', 'kebersihan_area');

                $no = 1;
                foreach ($field as $key => $info) {
                    echo "<form method='post' enctype='multipart/form-data'>";  // Open a new form for each transformer
                    echo "<tr>";
                    echo "<th class='measure2' style='width:5px;'>{$no}</th>";
                    echo "<td class='measure2' style='width:25px; color:white; font-weight: 550; white-space:nowrap; text-align: left;'>";
                    if (isset(${"record_$key"}) && isset(${"record_$key"}['tanggal'])) {
                        $tanggal = date("d M 'y", strtotime(${"record_$key"}['tanggal']));
                        echo htmlspecialchars($tanggal);
                    }
                    echo "<input type='hidden' name='tanggal' value='" . date("Y-m-d") . "'></td>";
                    echo "<th class='parameter' style='text-align:left; white-space:nowrap;'>{$info['desc']}</th>";
                    echo "<th class='parameter-setting'>{$info['kva']}</th>";

                    foreach ($inputNames as $fieldName) {
                        echo "<td>";
                        if (isset(${"record_$key"}) && isset(${"record_$key"}[$fieldName])) {
                            echo htmlspecialchars(formatValue(${"record_$key"}[$fieldName]));
                            echo "<button type='button' class='clear-btn' data-key='{$key}' onclick='clearField(this)' data-field='{$fieldName}'>X</button>";
                        } else {
                            echo "<input class='input-field' type='number' name='{$fieldName}' data-key='{$key}'>";
                        }
                        echo "</td>";
                    }

                    foreach ($fileInput as $fieldName) {
                        echo "<td>";
                        if (isset(${"record_$key"}) && isset(${"record_$key"}[$fieldName])) {
                            echo htmlspecialchars(formatValue(${"record_$key"}[$fieldName]));
                            echo "<button type='button' class='clear-btn' data-key='{$key}' onclick='clearField(this)' data-field='{$fieldName}'>X</button><br>";
                        } else {
                            echo "<input class='input-field' type='number' name='{$fieldName}' data-key='{$key}'><br>";
                        }
                    
                        if ($fieldName == 'temp_val_kabel_mv') {
                            $imageFileName = isset(${"record_$key"}['temp_img_kabel_mv']) ? ${"record_$key"}['temp_img_kabel_mv'] : '';
                            $column = 'temp_img_kabel_mv';
                        } else {
                            $imageFileName = isset(${"record_$key"}['temp_img_kabel_lv']) ? ${"record_$key"}['temp_img_kabel_lv'] : '';
                            $column = 'temp_img_kabel_lv';
                        }
                    
                        $uploadDir = "/checklist/uploadTrafo/";
                        $imagePathJpg = $uploadDir . $imageFileName . ".jpg";
                        $imagePathPng = $uploadDir . $imageFileName . ".png";
                    
                        if ($imageFileName && (file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePathJpg) || file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePathPng))) {
                            $imagePath = file_exists($_SERVER['DOCUMENT_ROOT'] . $imagePathJpg) ? $imagePathJpg : $imagePathPng;
                            echo "<div class='form-row'>";
                            echo "<button class='btn' style='font-size:10px; white-space:nowrap; padding:4px; margin-bottom: 0px; margin-top: 2px;' onclick=\"window.open('$imagePath', '_blank')\">Show Image</button>";
                            
                            echo "<button type='button' class='clear-btn' style='font-size:10px; padding:4px; margin-top:2px;' onclick=\"deleteImage('{$column}', '{$imageFileName}', '{$key}')\">Del img</button>";
                            echo "</div>";
                        } else {
                            echo "<input style='font-size:10px;' type='file' name='{$fieldName}' data-key='{$key}' accept='image/*'>";
                            echo "<input type='hidden' name='file_key_" . (($fieldName == 'temp_val_kabel_mv') ? 'mv' : 'lv') . "' value='{$key}'>";
                        }
                        echo "</td>";
                    }
                    
                    foreach ($enumNames as $fieldName) {
                        echo "<td>";
                        if (isset(${"record_$key"}) && isset(${"record_$key"}[$fieldName])) {
                            if ($fieldName == 'level_oli'){
                            echo htmlspecialchars(formatValue(${"record_$key"}[$fieldName]));
                            } else {
                                if (${"record_$key"}[$fieldName] == 1) {
                                    echo "<i class='fa fa-check'></i>";
                                } else {
                                    echo "<i class='fa fa-times'></i>";
                                }
                            }
                            echo "<button type='button' class='clear-btn' data-key='{$key}' onclick='clearField(this)' data-field='{$fieldName}'>X</button>";
                        } else {
                            echo "<select class='enum' name='{$fieldName}' data-key='{$key}'>";
                            if ($fieldName == 'level_oli'){
                                include 'enum-trafo.php';
                            } else {
                                include 'enum-capbank.php';
                            }
                            echo "</select>";                         
                        }
                        echo "</td>";                        
                    }

                    if (isset(${"record_$key"}) && isset(${"record_$key"}['keterangan'])){
                        echo "<td>";
                        echo htmlspecialchars(formatValue(${"record_$key"}['keterangan']));
                        echo "<button type='button' class='clear-btn' data-key='{$key}' onclick='clearField(this)' data-field='keterangan'>X</button></td>";
                    } else {
                        echo "<td style='padding: 5px;'><input style='width:200px; height: 20px;' type='text' name='keterangan' data-key='{$key}'></td>";
                    }
                    echo "<td style='width:155px; text-align:left; color:grey; padding: 5px 10px;'><input type='hidden' name='trafo' value='{$key}'>";
                    if (isset(${"record_$key"}) && isset(${"record_$key"}['pic'])){
                        echo htmlspecialchars(formatValue(${"record_$key"}['pic']));
                        echo "<br>";
                        echo htmlspecialchars(formatValue(${"record_$key"}['time']));
                    } else {
                        echo "<input type='hidden' data-key='{$key}' name='time' value='" . date('d/m/Y H:i') . "'>";
                        echo "<input type='hidden' data-key='{$key}' name='pic' value='" . htmlspecialchars($baris[0]) . "'>";
                    }
                    echo "</td>";  
                    echo "<td colspan='15'><button class='btn' style='white-space:nowrap; padding:5px; margin-bottom: 0px;' type='submit'>Submit for " . strtoupper($key) . "</button></td>";  // Submit button specific to each trafo
                    echo "</form>";  // Close the form
                    $no++;
                }                
                ?>
            </tbody>
    </table>
    <br>
</main>
<script>
document.getElementById("exit").onclick = function() {
    location.href = 'selection.php';
}
$(".enum").prop("selectedIndex", -1);
$(".input-field").val('');

function deleteImage(column, filename, primaryKeyValue) {
    if (confirm('Are you sure you want to delete this image?')) {
        // AJAX request to delete image
        fetch('delete_image.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `column=${column}&filename=${filename}&primaryKeyValue=${primaryKeyValue}`
        })
        .then(response => response.text())
        .then(data => {
            location.reload(); // Refresh the page to reflect changes
        })
        .catch(error => console.error('Error:', error));
    }
}

function clearField(button) {
    const fieldToClear = button.getAttribute('data-field');
    const trafo = button.getAttribute('data-key');
    const unit = '<?php echo $unit; ?>';  
    const bulan = '<?php echo $bulan; ?>';

    if (confirm('Are you sure you want to clear this field?')) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'clear_field.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        
        const data = `field_to_clear=${encodeURIComponent(fieldToClear)}&trafo=${encodeURIComponent(trafo)}&unit=${encodeURIComponent(unit)}&bulan=${encodeURIComponent(bulan)}`;
        
        xhr.onload = function() {
            if (xhr.status === 200) {
                location.reload();  
            } else {
                alert('Error: ' + xhr.statusText);
            }
        };

        xhr.onerror = function() {
            alert('Request failed');
        };

        xhr.send(data);
    }
}

</script>
</body>
</html>
