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

    <h2>CHILLER OPP 6~7 & BOPET</h2>
    <h4>SHIFT <?php echo $shift;?></h4>

    <div id="select-unit-chiller" class="custom-label-sub">
        <form name="select-unit-chiller" onsubmit="handleFormSubmit(event, 'option-unit-chiller')">
            <div class="custom-label-form">
                <label for="option-unit-chiller" >Unit:</label>
                <select style="margin-left: 10px" class="selection-line" name="unit-chiller" id="option-unit-chiller">
                <option value="chiller_trane_67bopet">Trane</option>
                <option value="chiller_hitachi_67bopet">Hitachi</option>
            </div>
            <div>
                <input style="margin-top: 20px; margin-left: 10px;" type="submit" class="btn-form" value="SUBMIT">
            </div>
        </form>
    </div>
    
    <table>
        <thead>
            <tr>
                <th rowspan="2">DESCRIPTION</th>
                <th rowspan="2">MACHINE <br>STATUS</th>
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
                <td>-</td>
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
            require 'database.php';
            include 'request-view-chiller.php';
            $trane_units = array(
                "Trane 31", "Trane 32", "Trane 39", "Trane 42", "Trane 43", "Trane 44", "Trane 45"
            );

            $field_names = array(
                "machine_status", "evap_tempcel", "evap_tempcol", "cond_tempin", "cond_tempout",
                "evap_pressin", "evap_pressout", "cond_pressin", "cond_pressout",
                "temp_set", "rla", "approach_temp"
            );
            ?>

            <?php foreach ($trane_units as $unit) : ?>
                <tr>
                    <th class="measure2"><?php echo $unit; ?></th>
                    <?php foreach ($field_names as $field) : ?>
                        <?php $inputName = strtolower(str_replace(' ', '', $unit)) . '_' . $field; ?>
                    <?php
                    if ($existing_record && isset($existing_record[$inputName])) {
                        echo "<td>";
                        echo htmlspecialchars(formatValue($existing_record[$inputName]));
                        echo "<button type='button' class='clear-btn' data-field='$inputName'>X</button>";
                        echo "</td>";
                    } else if ($field === 'machine_status'){
                        echo "<td>";
                        echo "<select class='enum_long' name='{$inputName}'>"; 
                        include 'enum-running-standby.php';
                        echo "</select>";
                        echo "</td>";
                    } else {
                        ?>
                        <td>
                            <input type="number" step="0.01" class="input-field" name="<?php echo $inputName; ?>">
                        </td>
                        <?php
                    }
                    ?>
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
                default:
                    break;
                }
            }

    </script>
</body>
</html>
