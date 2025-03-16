<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
$shift = $_GET['selectedShift'];
require 'database.php';
require 'request-chiller.php';

// The allowed IP address
$allowed_ip = array('131.107.7.214', '131.107.7.211');

// Get the user's IP address
$user_ip = $_SERVER['REMOTE_ADDR'];

// Check if the user's IP matches the allowed IP
if ($_SESSION["id"] !== '1' && !in_array($user_ip, $allowed_ip)) {
    // If not, set an error message and redirect to selection.php
    echo "<script>alert('Anda sedang tidak terhubung dengan WiFi di area Chiller 6&7 & BOPET. Pastikan koneksi WiFi anda tidak terputus'); window.location.href = './selection.php';</script>";
    exit();
}
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
</head>

<body>
<?php include 'header.php'; ?>
<main>

    <h2>CHILLER OPP 6~7 & BOPET</h2>
    <h4>SHIFT <?php echo $shift;?></h4>

    <div id="select-unit-chiller" class="custom-label-sub">
        <form name="select-unit-chiller" onsubmit="handleFormSubmit(event, 'option-unit-chiller')">
            <div class="custom-label-form">
                <label for="option-unit-chiller" >Unit:</label>
                <select style="margin-left: 10px" class="selection-line" name="unit-chiller" id="option-unit-chiller">
                <option value="chiller_hitachi_67bopet">Hitachi</option>
                <option value="chiller_trane_67bopet">Trane</option>
            </div>
            <div>
                <input style="margin-top: 20px; margin-left: 10px;" type="submit" class="btn-form" value="SUBMIT">
            </div>
        </form>
    </div>

    
                
<table>
        <thead>
            <tr>
            <th rowspan="2" colspan="2">DESCRIPTION</th>
            <th rowspan="2">MACHINE <br>STATUS</th>
            <th>DISCHARGE</th>
            <th colspan="2">EVAPORATOR TEMP.</th>
            <th colspan="2">CONDENSER TEMP.</th>
            <th>TEMP.</th>
            <th>ON/OFF</th>
            <th colspan="2">EVAPORATOR PRESS.</th>
            <th colspan="2">CONDENSER PRESS.</th>
            </tr>
            <tr class="head">
                <td>PRESS</td>
                <td>CEL</td>
                <td>COL</td>
                <td>IN</td>
                <td>OUT</td>
                <td>SETTING</td>
                <td>DIFF.</td>
                <td>IN</td>
                <td>OUT</td>
                <td>IN</td>
                <td>OUT</td>
            </tr>
            <tr class="head">
                <td colspan="2">Standard</td>
                <td></td>
                <td>&lt;2.45</td>
                <td>&lt;20</td>
                <td>5</td>
                <td>27~37</td>
                <td>32~42</td>
                <td>5~10</td>
                <td>1~2</td>
                <td>4~7</td>
                <td>3.5~6</td>
                <td>1~3</td>
                <td>0.5~2.5</td>
            </tr>

        </thead>
        <thead class="head">
        <tr style="background-color:dimgray">
                <td colspan="2">Uom</td>
                <td>-</td>
                <td>Mpa</td>
                <td>°C</td>
                <td>°C</td>
                <td>°C</td>
                <td>°C</td>
                <td>°C</td>
                <td>°C</td>
                <td>Bar</td>
                <td>Bar</td>
                <td>Bar</td>
                <td>Bar</td>
            </tr>
        </thead>
        <form method="post">
        <tbody>
    <?php
    require 'database.php';
    include 'request-view-chiller.php';
    $models = array("hitachi27", "hitachi34", "hitachi35");
    $categories = array("c1", "c2");
    $modelNames = array("Hitachi 27", "Hitachi 34", "Hitachi 35");
    $categoryNames = array("C#1", "C#2");
    
    $fields = array(
        "machine_status",
        "disc_press",
        "evap_tempcel",
        "evap_tempcol",
        "cond_tempin",
        "cond_tempout",
        "temp_set",
        "onoff_diff",
        "evap_pressin",
        "evap_pressout",
        "cond_pressin",
        "cond_pressout"
    );

    foreach ($models as $key => $model) {
        echo "<tr>";
        echo "<th rowspan='2' class='measure2'>" . ucfirst($modelNames[$key]) . "</th>";

        foreach ($categories as $index => $category) {
            echo "<th class='parameter-setting'>" . ucfirst($categoryNames[$index]) . "</th>";
            foreach ($fields as $index => $field) {
                $fieldName = $model  . $category . "_" . $field;
                $rowSpan = ($index === 6 || $index === 7) ? "rowspan='2'" : "";
                $inputType = ($index === 6 || $index === 7) ? "number" : "number step='0.01'";
                $inputName = ($index === 6 || $index === 7) ? $model . "_" . $field : $fieldName;
                if ($category === "c2" && ($field === "temp_set" || $field === "onoff_diff")) {
                    continue;
                }
                include 'indicator-chiller67hitachi.php';
                if ($existing_record && isset($existing_record[$inputName])) {
                    echo    "<td $rowSpan $style>";
                    echo htmlspecialchars(formatValue($existing_record[$inputName]));
                    echo "<button type='button' class='clear-btn' data-field='$inputName'>X</button>";
                    echo    "</td>";
                } else if ($field === 'machine_status'){
                    echo "<td $rowSpan>";
                    echo "<select class='enum_long' name='{$inputName}'>"; 
                    include 'enum-running-standby.php';
                    echo "</select>";
                    echo "</td>";
                } else {
                echo "<td $rowSpan><input type='$inputType' class='input-field' name='$inputName'></td>";
                    }
            }
            echo "</tr><tr>";
        }
        echo "</tr>";
    }
    ?>
            <tr>
                <th class="measure2" colspan="2">Entry By</th>
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

            <tr>
            <th class="measure2" colspan="2">Notes
            </th>

            <?php 
            $current_note = '';
            if ($existing_record && isset($existing_record['note'])) {
                $current_note = $existing_record['note']; // Set current_note to the existing note
                echo "<td colspan='12' id='note-container' style='text-align:left; padding: 5px 10px'>";
                echo htmlspecialchars(formatValue($existing_record['note']));
                echo "<button type='button' class='clear-btn' data-field='note'>X</button>";
                echo "<button type='button' class='edit-btn' data-current-note='" . htmlspecialchars($current_note, ENT_QUOTES) . "'>EDIT</button>";
                echo "</td>";
            } else {
                echo "<td colspan='12' style='text-align:left; padding: 4px 0.8%;'><textarea name='note' id='note-textarea' style='height:30px;width:90%;padding:4px;'></textarea></td>";
            }
            ?>
            </tr>
</tbody>
    </table>
    <br>
    <button class="btn" id="save-button">SAVE</button>
    </form>
</main>
<script>
        document.getElementById("exit").onclick=function (){
            location.href = 'selection.php'
        }
        $(".enum").prop("selectedIndex", -1);
        $(".enum_long").prop("selectedIndex", -1);
        $(".input-field").val('');

        function handleFormSubmit(event, selectId) {
        event.preventDefault();

        var selectElement = document.getElementById(selectId);
        var selectedUnit = selectElement.value;
        var selectedShift = '<?php echo $shift; ?>'; 

            console.log('Selected <select> ID:', selectId);
            console.log('Selected Value:', selectedUnit);
            console.log('Selected Shift:', selectedShift);

            switch (selectedUnit) {
                case 'chiller_trane_67bopet':
                        location.href = 'form-chiller67bopet-trane.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift);
                        break;
                case 'chiller_hitachi_67bopet':
                        location.href = 'form-chiller67bopet-hitachi.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift);
                    break;     
                case 'chiller_trane_67pc':
                        location.href = 'form-chiller67-tranepc.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift);
                    break;       
                default:
                    break;
                }
            }

    </script>
</body>
</html>
