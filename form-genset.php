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
<div class="header-img">
      <img id="logo" src="css/logo.png" alt="Logo Argha"><br>
      <img id="exit" src="css/exit.png" alt="Exit"><br>
      </div>
    <header>
      <h1>ONLINE CHECKLIST</h1>
    </header>
<main>
    
<?php

$unit_headings = [
    "genset_wartsila_01" => "Genset Wartsila 01",
    "genset_wartsila_02" => "Genset Wartsila 02"
];

if (array_key_exists($unit, $unit_headings)):
    ?>
    <h2><?php echo $unit_headings[$unit]; ?></h2>
<?php endif; ?>

    <table>
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
                <tr>  
                    <th class="measure">Running Hours</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Hour</th>
                    <td colspan="4"><input type="number" step="0.01" class="input-field" name="running_hrs_8_14"/></td>
                    <td colspan="4"><input type="number" step="0.01" class="input-field" name="running_hrs_16_22"/></td>
                    <td colspan="4"><input type="number" step="0.01" class="input-field" name="running_hrs_0_6"/></td>
                </tr>
                <tr>
                    <th class="measure">Lube Oil Sump Level</th>
                    <th class="parameter">14~17</th>
                    <th class="parameter-setting">Cm</th>
                    <td colspan="4"><input type="number" step="0.01" class="input-field" name="lube_oil_sump_lvl_8_14"/></td>
                    <td colspan="4"><input type="number" step="0.01" class="input-field" name="lube_oil_sump_lvl_16_22"/></td>
                    <td colspan="4"><input type="number" step="0.01" class="input-field" name="lube_oil_sump_lvl_0_6"/></td>
                </tr>
                <tr>
                    <th class="measure">Air Condensation Heater</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">On</th>
                    <td colspan="4"><select class="enum" name="anti_cond_heater_8_14"><?= require 'enum-on-off.php'?></td>
                    <td colspan="4"><select class="enum" name="anti_cond_heater_16_22"><?= require 'enum-on-off.php'?></td>
                    <td colspan="4"><select class="enum" name="anti_cond_heater_0_6"><?= require 'enum-on-off.php'?></td>
                </tr>
                <tr>
                    <th class="measure">Pre lube Pump</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">On</th>
                    <td><select class="enum" name="prelube_pump_8"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="prelube_pump_10"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="prelube_pump_12"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="prelube_pump_14"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="prelube_pump_16"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="prelube_pump_18"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="prelube_pump_20"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="prelube_pump_22"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="prelube_pump_0"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="prelube_pump_2"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="prelube_pump_4"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="prelube_pump_6"><?= require 'enum-on-off.php'?></td>
                </tr>
                <tr>
                    <th class="measure">Pre lube Pump Press</th>
                    <th class="parameter">>0.5</th>
                    <th class="parameter-setting">Bar</th>
                    <td><input type="number"step="0.01" class="input-field" name="prelube_pump_press_8" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="prelube_pump_press_10"></td>
                    <td><input type="number"step="0.01" class="input-field" name="prelube_pump_press_12"></td>
                    <td><input type="number"step="0.01" class="input-field" name="prelube_pump_press_14"></td>
                    <td><input type="number"step="0.01" class="input-field" name="prelube_pump_press_16"></td>
                    <td><input type="number"step="0.01" class="input-field" name="prelube_pump_press_18"></td>
                    <td><input type="number"step="0.01" class="input-field" name="prelube_pump_press_20"></td>
                    <td><input type="number"step="0.01" class="input-field" name="prelube_pump_press_22"></td>
                    <td><input type="number"step="0.01" class="input-field" name="prelube_pump_press_0" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="prelube_pump_press_2" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="prelube_pump_press_4" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="prelube_pump_press_6" ></td>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Oil</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <td><select class="enum" name="kebocoran_oil_8" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_oil_10"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_oil_12"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_oil_14"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_oil_16"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_oil_18"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_oil_20"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_oil_22"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_oil_0" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_oil_2" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_oil_4" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_oil_6" ><?= require 'enum-kebocoran.php'?></td>
                </tr>
                <tr>
                    <th class="measure">Preheating Unit</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">On</th>
                    <td><select class="enum" name="preheat_unit_8"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="preheat_unit_10"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="preheat_unit_12"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="preheat_unit_14"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="preheat_unit_16"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="preheat_unit_18"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="preheat_unit_20"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="preheat_unit_22"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="preheat_unit_0"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="preheat_unit_2"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="preheat_unit_4"><?= require 'enum-on-off.php'?></td>
                    <td><select class="enum" name="preheat_unit_6"><?= require 'enum-on-off.php'?></td>                    
                </tr>
                <tr>
                    <th class="measure">HT Water Outlet Temp</th>
                    <th class="parameter">>50</th>
                    <th class="parameter-setting">°C</th>
                    <td><input type="number"step="0.01" class="input-field" name="ht_water_outlet_temp_8" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="ht_water_outlet_temp_10"></td>
                    <td><input type="number"step="0.01" class="input-field" name="ht_water_outlet_temp_12"></td>
                    <td><input type="number"step="0.01" class="input-field" name="ht_water_outlet_temp_14"></td>
                    <td><input type="number"step="0.01" class="input-field" name="ht_water_outlet_temp_16"></td>
                    <td><input type="number"step="0.01" class="input-field" name="ht_water_outlet_temp_18"></td>
                    <td><input type="number"step="0.01" class="input-field" name="ht_water_outlet_temp_20"></td>
                    <td><input type="number"step="0.01" class="input-field" name="ht_water_outlet_temp_22"></td>
                    <td><input type="number"step="0.01" class="input-field" name="ht_water_outlet_temp_0" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="ht_water_outlet_temp_2" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="ht_water_outlet_temp_4" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="ht_water_outlet_temp_6" ></td>
                </tr>
                <tr>
                    <th class="measure">HT Expantion Tank lvl</th>
                    <th class="parameter">50~95</th>
                    <th class="parameter-setting">Cm</th>
                    <td colspan="4"><input type="number" step="0.01" class="input-field" name="ht_expantion_tank_lvl_8_14"/></td>
                    <td colspan="4"><input type="number" step="0.01" class="input-field" name="ht_expantion_tank_lvl_16_22"/></td>
                    <td colspan="4"><input type="number" step="0.01" class="input-field" name="ht_expantion_tank_lvl_0_6"/></td>
                </tr>
                <tr>
                    <th class="measure">LT Expantion Tank lvl</th>
                    <th class="parameter">50~95</th>
                    <th class="parameter-setting">Cm</th>
                    <td colspan="4"><input type="number" step="0.01" class="input-field" name="lt_expantion_tank_lvl_8_14"/></td>
                    <td colspan="4"><input type="number" step="0.01" class="input-field" name="lt_expantion_tank_lvl_16_22"/></td>
                    <td colspan="4"><input type="number" step="0.01" class="input-field" name="lt_expantion_tank_lvl_0_6"/></td>
                </tr>
                <tr>
                    <th class="measure">Warming Up</th>
                    <th class="parameter">2~3</th>
                    <th class="parameter-setting">Week</th>
                    <td colspan="4"><input type="number" step="0.01" class="input-field" name="warming_up_8_14"/></td>
                    <td colspan="4"><input type="number" step="0.01" class="input-field" name="warming_up_16_22"/></td>
                    <td colspan="4"><input type="number" step="0.01" class="input-field" name="warming_up_0_6"/></td>
                </tr>
                <tr>
                <th class="measure">Fuel Oil Inlet Temp</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">°C</th>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_temp_8" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_temp_10"></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_temp_12"></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_temp_14"></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_temp_16"></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_temp_18"></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_temp_20"></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_temp_22"></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_temp_0" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_temp_2" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_temp_4" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_temp_6" ></td>
                </tr>
                <tr>
                <th class="measure">Fuel Oil Inlet Pressure</th>
                    <th class="parameter">4.0~7.0</th>
                    <th class="parameter-setting">Bar</th>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_pressure_8" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_pressure_10"></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_pressure_12"></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_pressure_14"></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_pressure_16"></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_pressure_18"></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_pressure_20"></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_pressure_22"></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_pressure_0" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_pressure_2" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_pressure_4" ></td>
                    <td><input type="number"step="0.01" class="input-field" name="fuel_oil_inlet_pressure_6" ></td>
                </tr>
                <tr>
                <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <td><select class="enum" name="kebocoran_fuel_8" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel_10"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel_12"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel_14"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel_16"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel_18"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel_20"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel_22"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel_0" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel_2" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel_4" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel_6" ><?= require 'enum-kebocoran.php'?></td>
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
    </script>
</body>
</html>
