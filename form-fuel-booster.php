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
    
    <h2>Fuel Booster Unit</h2>

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

                $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                $time_ranges = array("8_14", "16_22", "0_6");
                ?>
                <tr>
                <th class="measure">Operating Pump#1</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "operating_pump1_$time";
                            if ($existing_record && isset($existing_record[$field_name])) {
                                echo htmlspecialchars(formatValue($existing_record[$field_name]));
                                echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                                echo    '</td>';
                                } else {
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-on-off.php';
                                echo "</select></td>";
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
                            echo "<td>";
                            $field_name = "kebocoran_fuel1_$time";
                            if ($existing_record && isset($existing_record[$field_name])) {
                                echo htmlspecialchars(formatValue($existing_record[$field_name]));
                                echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                                echo    '</td>';
                                } else {
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
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "operating_pump2_$time";
                            if ($existing_record && isset($existing_record[$field_name])) {
                                echo htmlspecialchars(formatValue($existing_record[$field_name]));
                                echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                                echo    '</td>';
                                } else {
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-on-off.php';
                                echo "</select></td>";
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
                            echo "<td>";
                            $field_name = "kebocoran_fuel2_$time";
                            if ($existing_record && isset($existing_record[$field_name])) {
                                echo htmlspecialchars(formatValue($existing_record[$field_name]));
                                echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                                echo    '</td>';
                                } else {
                            echo "<select class='enum' name='$field_name'>";
                            include 'enum-kebocoran.php';
                            echo "</select></td>";
                                }
                        }
                    ?>
                </tr>
                <tr>  
                    <th class="measure">Flowrate (Booster Unit)</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Liter</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            echo "<td colspan='4'>";
                            $field_name = "flowrate_booster_$range";
                            if ($existing_record && isset($existing_record[$field_name])) {
                                echo htmlspecialchars(formatValue($existing_record[$field_name]));
                                echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                                echo    '</td>';
                                } else {
                                echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                                echo "</select>";
                            echo "</td>";
                                }
                        }
                    ?>
                </tr>
                <tr>  
                    <th class="measure">Flowrate (Monitor)</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Liter</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            echo "<td colspan='4'>";
                            $field_name = "flowrate_monitor_$range";
                            if ($existing_record && isset($existing_record[$field_name])) {
                                echo htmlspecialchars(formatValue($existing_record[$field_name]));
                                echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                                echo    '</td>';
                                } else {
                                echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                                echo "</select>";
                            echo "</td>";
                                }
                        }
                    ?>
                </tr>
                <tr>  
                    <th class="measure">HFO/LFO</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            echo "<td colspan='4'>";
                            $field_name = "hfo_lfo_$range";
                            if ($existing_record && isset($existing_record[$field_name])) {
                                echo htmlspecialchars(formatValue($existing_record[$field_name]));
                                echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                                echo    '</td>';
                                } else {
                            echo "<select class='enum' name='$field_name'>";
                            include 'enum-hfo-lfo.php';
                            echo "</select></td>";
                                }
                        }
                    ?>
                </tr>
                <tr>
                <th class="measure">Feed Pressure</th>
                    <th class="parameter">3.5~5.0</th>
                    <th class="parameter-setting">Bar</th>
                    <?php
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "feed_pressure_$time";
                            if ($existing_record && isset($existing_record[$field_name])) {
                                echo htmlspecialchars(formatValue($existing_record[$field_name]));
                                echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                                echo    '</td>';
                                } else {
                            echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                            echo "</td>";
                                }
                        }
                    ?>
                </tr>                                                                                               
                <tr>
                <th class="measure">Outlet Pressure</th>
                    <th class="parameter">4.0~5.0</th>
                    <th class="parameter-setting">Bar</th>
                    <?php
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "outlet_pressure_$time";
                            if ($existing_record && isset($existing_record[$field_name])) {
                                echo htmlspecialchars(formatValue($existing_record[$field_name]));
                                echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                                echo    '</td>';
                                } else {
                            echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                            echo "</td>";
                                }
                        }
                    ?>
                </tr>                                                                                               
                <tr>
                <th class="measure">Fuel Temperature</th>
                    <th class="parameter">80~110</th>
                    <th class="parameter-setting">°C</th>
                    <?php
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "fuel_temp_$time";
                            if ($existing_record && isset($existing_record[$field_name])) {
                                echo htmlspecialchars(formatValue($existing_record[$field_name]));
                                echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                                echo    '</td>';
                                } else {
                            echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                            echo "</td>";
                                }
                        }
                    ?>
                </tr>
                <tr>
                <th class="measure">Fuel Viscosity</th>
                    <th class="parameter">0~16</th>
                    <th class="parameter-setting">cSt</th>
                    <?php
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "fuel_visc_$time";
                            if ($existing_record && isset($existing_record[$field_name])) {
                                echo htmlspecialchars(formatValue($existing_record[$field_name]));
                                echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                                echo    '</td>';
                                } else {
                            echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                            echo "</td>";
                                }
                        }
                    ?>
                </tr>                                                                                               
                <tr>
                <th class="measure">Flushing Counter</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Cycl</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            echo "<td colspan='4'>";
                            $field_name = "flushing_count_$range";
                            if ($existing_record && isset($existing_record[$field_name])) {
                                echo htmlspecialchars(formatValue($existing_record[$field_name]));
                                echo "<button type='button' class='clear-btn' data-field='$field_name'>X</button>";
                                echo    '</td>';
                                } else {
                            echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                            echo "</td>";
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
