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
        .clear-btn {
            float: right;
            background: none;
            border: none;
            color: red;
            font-size: 16px;
            cursor: pointer;
        }
        .clear-btn:hover {
            border: 1px solid red;
            border-radius: 4px;
        }
    </style>

</head>

<body>
<?php include 'header.php'; ?>
<main>
    
<?php
// Define an associative array mapping $unit values to headings
$unit_headings = array(
    "hfo_unloading_pump_unit" => "HFO Unloading Pump Unit",
    "fuel_transfer_pump_unit" => "Fuel Transfer Pump Unit",
    "hfo_separator_pump_unit"=> "HFO Separator Pump Unit",
    "lfo_unloading_pump_unit"=> "LFO Unloading Pump Unit"
);

// Check if the $unit exists in the array keys
if (array_key_exists($unit, $unit_headings)):
    ?>
    <h2><?php echo $unit_headings[$unit]; ?></h2>
<?php endif; ?>

    <table>
    <form name="select-form-genset" onsubmit="handleFormSubmit(event, 'option-form-genset')">
        <div class="custom-label-form"> 
        <label for="unit-genset">Change Unit:</label>
          <div class="unitfield-form">
            <select class="selection-genset" name="unit-genset" id="option-form-genset">
              <?php include 'pilih-unit-genset.php' ?>
            </select>
          </div>
          <input style="margin-top: 20px" class="btn-form" type="submit" value="SUBMIT">
          </div>
    </form>
    
        <thead>
            <th colspan="3">Time</th>
            <th>08.00</th>
            <th>10.00</th>
            <th>12.00</th>
            <th>14.00</th>
            <th>16.00</th>
            <th>18.00</th>
            <th>20.00</th>
            <th>22.00</th>
            <th>0.00</th>
            <th>2.00</th>
            <th>4.00</th>
            <th>6.00</th>
    </thead>
    <form method="post">
            <tbody>
                <?php
                require 'database.php';
                include 'request-view.php';         

                $time_ranges = array('8_14', '16_22', '0_6');
                $times = array('8', '10', '12', '14', '16', '18', '20', '22', '0', '2', '4', '6');

                ?>
                <tr>
                <th class="measure">Operating Pump#1</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "operating_pump1_$range";

                            if ($existing_record && isset($existing_record[$field_name])) {
                            echo '<td colspan="4">' . htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';
                            } else {
                                echo "<td colspan='4'>";
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-on-off.php';
                                echo "</select>";
                            echo "</td>";
                            }
                        }                    
                    ?>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "kebocoran_fuel1_$time";

                            if ($existing_record && isset($existing_record[$field_name])) {
                            echo '<td>' . htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';

                            } else {
                                echo "<td>";
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-kebocoran.php';
                                echo "</select></td>";
                            }
                        }
                    ?>
                </tr>
                <tr>  
                    <th class="measure">Operating Pump#2</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "operating_pump2_$range";

                            if ($existing_record && isset($existing_record[$field_name])) {
                            echo '<td colspan="4">' . htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';
                            } else {
                                echo "<td colspan='4'>";
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-on-off.php';
                                echo "</select>";
                            echo "</td>";
                            }
                        }                   
                    ?>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "kebocoran_fuel2_$time";

                            if ($existing_record && isset($existing_record[$field_name])) {
                            echo '<td>' . htmlspecialchars($existing_record[$field_name]);
                            echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                            echo    '</td>';
                            } else {
                                echo "<td>";
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-kebocoran.php';
                                echo "</select></td>";
                            }
                        }
                    ?>
                </tr>
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
                case 'fuel_transfer_pump_unit':
                case 'hfo_separator_pump_unit':
                case 'hfo_unloading_pump_unit':
                case 'lfo_unloading_pump_unit':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-hfo-lfo-fuel.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } break;
                case 'common_unit':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-common-unit.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } break;
                case 'fuel_booster':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-fuel-booster.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } break;     
                  case 'fuel_oil_feeder':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-fuel-oil-feeder.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } break;                                   
                case 'heater_oil':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-heater-oil.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } break;
                case 'genset_man':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-genset-man.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } break;                  
                case 'genset_wartsila_01':
                case 'genset_wartsila_02':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } break;
                case 'kebocoran_fuel_tank':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-kebocoran-fuel-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } break;
                default:
                    break;
            }
        }

    </script>
</body>
</html>