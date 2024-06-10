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

    <h2>CHILLER OPP 4~5 & MET 1~2</h2>

    <div id="select-unit-chiller" class="custom-label-sub">
        <form name="select-unit-chiller" onsubmit="handleFormSubmit(event, 'option-unit-chiller')">
            <div class="">
                <label for="option-unit-chiller" >Unit: </label>
                <select class="selection-chiller" name="unit-chiller" id="option-unit-chiller">
                    <option value="chiller_hitachi_45met34">Hitachi</option>
                    <option value="chiller_trane_45met34">Trane & Clivet</option>
                <input type="submit" class="btn-view" value="SUBMIT">
            </div>
        </form>
    </div>

    
    <table>
        <thead>
            <tr>
            <th rowspan="2" colspan="2">DESCRIPTION</th>
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

    $models = array("hitachi37", "hitachi38");
    $categories = array("c1", "c2");
    $modelNames = array("Hitachi 37", "Hitachi 38");
    $categoryNames = array("C#1", "C#2");
    
    $fields = array(
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
                $fieldName = $model . $category . "_" . $field;
                $rowSpan = ($index !== 0) ? "rowspan='2'" : "";
                $inputName = ($index !== 0) ? $model . "_" . $field : $fieldName;                
                if ($category === "c2" && $field !== "disc_press") {
                    continue;
                }
                if ($existing_record && isset($existing_record[$inputName])) {
                    echo    "<td $rowSpan>";
                    echo htmlspecialchars(formatValue($existing_record[$inputName]));
                    echo "<button type='button' class='clear-btn' data-field='$inputName'>X</button>";
                    echo    "</td>";
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
                case 'chiller_trane_45met34':
                        location.href = 'form-chiller45met34-trane.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift);
                        break;
                case 'chiller_hitachi_45met34':
                        location.href = 'form-chiller45met34-hitachi.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift);
                    break;      
                default:
                    break;
                }
            }

    </script>
</body>
</html>
