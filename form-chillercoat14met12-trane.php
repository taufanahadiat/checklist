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

    <h2>CHILLER COAT 1~4 Met 1~2</h2>

    <div id="select-unit-chiller" class="custom-label-sub">
        <form name="select-unit-chiller" onsubmit="handleFormSubmit(event, 'option-unit-chiller')">
            <div>
                <label for="unit-chiller" >Unit: </label>
                <select class="selection-chiller" name="unit-chiller" id="option-unit-chiller">
                    <option value="chiller_trane_coat14met12">Trane</option>
                    <option value="chiller_hitachi_coat14met12">Hitachi</option>
                <input type="submit" class="btn-view" value="SUBMIT">
            </div>
        </form>
    </div>

    
    <table>
        <thead>
            <tr>
                <th rowspan="2">DESCRIPTION</th>
                <th colspan="2">EVAPORATOR TEMP.</th>
                <th colspan="2">CONDENSER TEMP.</th>
                <th colspan="2">EVAPORATOR PRESS.</th>
                <th colspan="2">CONDENSER PRESS.</th>
                <th>TEMP.</th>
                <th rowspan="2">%RLA</th>
                <th>APPROACH</th>
            </tr>
            <tr class="head">
                <td>CEL</td>
                <td>COL</td>
                <td>IN</td>
                <td>OUT</td>
                <td>IN</td>
                <td>OUT</td>
                <td>IN</td>
                <td>OUT</td>
                <td>SETTING</td>
                <td>TEMP</td>
            </tr>

        </thead>
        <thead class="head">
            <tr>
                <td>Uom</td>
                <td>°C</td>
                <td>°C</td>
                <td>°C</td>
                <td>°C</td>
                <td>Bar</td>
                <td>Bar</td>
                <td>Bar</td>
                <td>Bar</td>
                <td>°C</td>
                <td>%</td>
                <td>°C</td>
            </tr>
        </thead>
        <form method="post">
            <tbody>
            <?php
            $trane_units = array(
                "Trane 46"
            );

            $field_names = array(
                "evap_tempcel", "evap_tempcol", "cond_tempin", "cond_tempout",
                "evap_pressin", "evap_pressout", "cond_pressin", "cond_pressout",
                "temp_set", "rla", "approach_temp"
            );
            ?>

            <?php foreach ($trane_units as $unit) : ?>
                <tr>
                    <th class="measure2"><?php echo $unit; ?></th>
                    <?php foreach ($field_names as $field) : ?>
                        <td><input type="number" step="0.01" class="input-field" name="<?php echo strtolower(str_replace(' ', '', $unit)) . '_' . $field; ?>"></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>

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
