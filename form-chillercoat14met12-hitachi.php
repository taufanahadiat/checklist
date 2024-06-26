<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
$shift = $_GET['selectedShift'];
require 'database.php';
require 'request-chiller.php';
?>


<!DOCTYPE html>
<html>
<head>
    <title>Form Checklist</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.7.1.min.js"></script>

</head>

<body>
<?php include 'header.php'; ?>
<main>

    <h2>CHILLER COAT 1~4 & MET 1~2</h2>
    <h4>SHIFT <?php echo $shift;?></h4>

    <div id="select-unit-chiller" class="custom-label-sub">
        <form name="select-unit-chiller" onsubmit="handleFormSubmit(event, 'option-unit-chiller')">
            <div class="custom-label-form">
                <label for="option-unit-chiller" >Unit:</label>
                <select style="margin-left: 10px" class="selection-line" name="unit-chiller" id="option-unit-chiller">
                    <option value="chiller_hitachi_coat14met12">Hitachi</option>
                    <option value="chiller_trane_coat14met12">Trane</option>

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

        </thead>
        <thead class="head">
            <tr>
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

    $models = array("bitzer31", "clima48", "hitachi30", "hitachi36");
    $categories = array("c1", "c2");
    $modelNames = array("Bitzer", "Clima 48", "Hitachi 30", "Hitachi 36");
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
        if ($model === "clima48") {
            echo "<th colspan='2' class='measure2'>" . ucfirst($modelNames[$key]) . "</th>";
        } else {
            echo "<th rowspan='2' class='measure2'>" . ucfirst($modelNames[$key]) . "</th>";
        }    
        foreach ($categories as $index => $category) {
            if ($model === "clima48" && $category === "c2") {
                continue; // Skip this category for clima48 model
            }

            if ($model !== "clima48") {
                echo "<th class='parameter-setting'>" . ucfirst($categoryNames[$index]) . "</th>";
            }            
            foreach ($fields as $index => $field) {
                if ($model === "clima48") {
                    $inputName = $model . "_" . $field;                
                        if ($existing_record && isset($existing_record[$inputName])) {
                            echo "<td>";
                            echo htmlspecialchars(formatValue($existing_record[$inputName]));
                            echo "<button type='button' class='clear-btn' data-field='$inputName'>X</button>";
                            echo "</td>";
                        } else if ($field === 'machine_status'){
                            echo "<td>";
                            echo "<select class='enum' name='{$inputName}'>"; 
                            include 'enum-running-standby.php';
                            echo "</select>";
                            echo "</td>";
                        } else {
                            echo "<td><input type=number step='0.01' class='input-field' name='$inputName'></td>";
                        }
                    continue; // Skip the rest of the loop iteration
                }
                $fieldName = $model . $category . "_" . $field;
                $rowSpan = ($index !== 0 && $index !== 1 && $model !== "bitzer31") ? "rowspan='2'" : "";
                $inputName = ($index !== 0 && $index !== 1 && $model !== "bitzer31") ? $model . "_" . $field : $fieldName;                
                if ($model !== "bitzer31" && $category === "c2" && $field !== "disc_press" && $field !== "machine_status") {
                    continue;
                } 
                if ($existing_record && isset($existing_record[$inputName])) {
                    echo "<td $rowSpan>";
                    echo htmlspecialchars(formatValue($existing_record[$inputName]));
                    echo "<button type='button' class='clear-btn' data-field='$inputName'>X</button>";
                    echo "</td>";
                } else if ($field === 'machine_status'){
                    echo "<td $rowSpan>";
                    echo "<select class='enum_long' name='{$inputName}'>"; 
                    include 'enum-running-standby.php';
                    echo "</select>";
                    echo "</td>";
                } else {
                echo "<td $rowSpan><input type=number step='0.01' class='input-field' name='$inputName'></td>";
                }
            }
            echo "</tr><tr>";
        }
        echo "</tr>";
    }
    ?>    
</tbody>
    </table>
    <br>
    <button class="btn">SAVE</button>
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
                case 'chiller_trane_coat14met12':
                        location.href = 'form-chillercoat14met12-trane.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift);
                        break;
                case 'chiller_hitachi_coat14met12':
                        location.href = 'form-chillercoat14met12-hitachi.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift);
                    break;      
                default:
                    break;
                }
            }

    </script>
</body>
</html>
