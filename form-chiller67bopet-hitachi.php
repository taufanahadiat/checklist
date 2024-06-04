<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
require 'database.php';
require 'request.php';
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

    <h2>CHILLER OPP 6~7 & BOPET</h2>

    <div id="select-unit-chiller" class="custom-label-sub">
        <form name="select-unit-chiller" onsubmit="handleFormSubmit(event, 'option-unit-chiller')">
            <div class="">
                <label for="option-unit-chiller" >Unit: </label>
                <select class="selection-chiller" name="unit-chiller" id="option-unit-chiller">
                    <option value="chiller_hitachi_67bopet">Hitachi</option>
                    <option value="chiller_trane_67bopet">Trane</option>
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
    $models = array("hitachi33", "hitachi34", "hitachi35");
    $categories = array("c1", "c2");
    $modelNames = array("Hitachi 33", "Hitachi 34", "Hitachi 35");
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
                $fieldName = $model  . $category . "_" . $field;
                $rowSpan = ($index === 5 || $index === 6) ? "rowspan='2'" : "";
                $inputType = ($index === 5 || $index === 6) ? "number" : "number step='0.01'";
                $inputName = ($index === 5 || $index === 6) ? $model . "_" . $field : $fieldName;
                if ($category === "c2" && ($field === "temp_set" || $field === "onoff_diff")) {
                    continue;
                }
                echo "<td $rowSpan><input type='$inputType' class='input-field' name='$inputName'></td>";
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

            console.log('Selected <select> ID:', selectId);
            console.log('Selected Value:', selectedUnit);

            switch (selectedUnit) {
                case 'chiller_trane_67bopet':
                        location.href = 'form-chiller67bopet-trane.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                        break;
                case 'chiller_hitachi_67bopet':
                        location.href = 'form-chiller67bopet-hitachi.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    break;      
                default:
                    break;
                }
            }

    </script>
</body>
</html>
