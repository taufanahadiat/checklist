<?php

include 'database.php';

$tanggal = "" . $_GET['selectedDate'];
$unit = "" . $_GET['selectedUnit'];
$sql = "SELECT *
        FROM $unit
        where tanggal LIKE '%{$tanggal}%'";

$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
    //echo "not connect";
} else {
    $article = mysqli_fetch_assoc($results);
    //echo "connect";
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>Checklist</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">


</head>

<body>
    <div class="header-img">
      <img id="logo" src="css/logo.png" alt="Logo Argha"><br>
      <img id="exit" src="css/exit.png" alt="Exit"><br>
    </div>
<header>
      <h1>ONLINE CHECKLIST</h1>
</header>
<?php
$unit_headings = array(
    "genset_wartsila_01" => "Genset Wartsila 01",
    "genset_wartsila_02" => "Genset Wartsila 02"
);

if (array_key_exists($unit, $unit_headings)):
    ?>
    <h2><?php echo $unit_headings[$unit]; ?></h2>
<?php endif; ?>

    <?php include 'pilih-tanggal.php'; ?>

    <main>
        <?php if ($article === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>
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
                <article>
                <tbody>
                <tr>  
                    <th class="measure">Running Hours</th>
                    <th class="parameter" style="text-align: center">-</th>
                    <th class="parameter-setting">Hour</th>
                    <td colspan="4" style="text-align:center"><?php echo $article['running_hrs_8_14']; ?></td>
                    <td colspan="4" style="text-align:center"><?php echo $article['running_hrs_16_22']; ?></td>
                    <td colspan="4" style="text-align:center"><?php echo $article['running_hrs_0_6']; ?></td>
                </tr>
                <tr>
                    <th class="measure">Lube Oil Sump Level</th>
                    <th class="parameter">14~17</th>
                    <th class="parameter-setting">Cm</th>
                    <td colspan="4" style="text-align:center"><?php echo $article['lube_oil_sump_lvl_8_14']; ?></td>
                    <td colspan="4" style="text-align:center"><?php echo $article['lube_oil_sump_lvl_16_22']; ?></td>
                    <td colspan="4" style="text-align:center"><?php echo $article['lube_oil_sump_lvl_0_6']; ?></td>
                </tr>
                <tr>
                    <th class="measure">Air Condenstion Heater</th>
                    <th class="parameter" style="text-align: center">-</th>
                    <th class="parameter-setting">On</th>
                    <td colspan="4" style="text-align:center"><?php echo $article['anti_cond_heater_8_14']; ?></td>
                    <td colspan="4" style="text-align:center"><?php echo $article['anti_cond_heater_16_22']; ?></td>
                    <td colspan="4" style="text-align:center"><?php echo $article['anti_cond_heater_0_6']; ?></td>
                </tr>
                <tr>
                    <th class="measure">Pre lube Pump</th>
                    <th class="parameter" style="text-align: center">-</th>
                    <th class="parameter-setting">On</th>
                    <td style="text-align: center"><?php echo $article['prelube_pump_8']; ?></td>
                    <td style="text-align: center"><?php echo $article['prelube_pump_10']; ?></td>
                    <td style="text-align: center"><?php echo $article['prelube_pump_12']; ?></td>
                    <td style="text-align: center"><?php echo $article['prelube_pump_14']; ?></td>
                    <td style="text-align: center"><?php echo $article['prelube_pump_16']; ?></td>
                    <td style="text-align: center"><?php echo $article['prelube_pump_18']; ?></td>
                    <td style="text-align: center"><?php echo $article['prelube_pump_20']; ?></td>
                    <td style="text-align: center"><?php echo $article['prelube_pump_22']; ?></td>
                    <td style="text-align: center"><?php echo $article['prelube_pump_0']; ?></td>
                    <td style="text-align: center"><?php echo $article['prelube_pump_2']; ?></td>
                    <td style="text-align: center"><?php echo $article['prelube_pump_4']; ?></td>
                    <td style="text-align: center"><?php echo $article['prelube_pump_6']; ?></td>
                </tr>
                <tr>
                    <th class="measure">Pre lube Pump Press</th>
                    <th class="parameter">>0.5</th>
                    <th class="parameter-setting">Bar</th>
                    <td><?php echo $article['prelube_pump_press_8']; ?></td>
                    <td><?php echo $article['prelube_pump_press_10']; ?></td>
                    <td><?php echo $article['prelube_pump_press_12']; ?></td>
                    <td><?php echo $article['prelube_pump_press_14']; ?></td>
                    <td><?php echo $article['prelube_pump_press_16']; ?></td>
                    <td><?php echo $article['prelube_pump_press_18']; ?></td>
                    <td><?php echo $article['prelube_pump_press_20']; ?></td>
                    <td><?php echo $article['prelube_pump_press_22']; ?></td>
                    <td><?php echo $article['prelube_pump_press_0']; ?></td>
                    <td><?php echo $article['prelube_pump_press_2']; ?></td>
                    <td><?php echo $article['prelube_pump_press_4']; ?></td>
                    <td><?php echo $article['prelube_pump_press_6']; ?></td>
                </tr>
                <tr>
                <th class="measure">Kebocoran Oil</th>
                <th class="parameter">A/TA/RS</th>
                <th class="parameter-setting">-</th>
                <td style="text-align: center"><?php echo $article['kebocoran_oil_8']; ?></td>
                <td style="text-align: center"><?php echo $article['kebocoran_oil_10']; ?></td>
                <td style="text-align: center"><?php echo $article['kebocoran_oil_12']; ?></td>
                <td style="text-align: center"><?php echo $article['kebocoran_oil_14']; ?></td>
                <td style="text-align: center"><?php echo $article['kebocoran_oil_16']; ?></td>
                <td style="text-align: center"><?php echo $article['kebocoran_oil_18']; ?></td>
                <td style="text-align: center"><?php echo $article['kebocoran_oil_20']; ?></td>
                <td style="text-align: center"><?php echo $article['kebocoran_oil_22']; ?></td>
                <td style="text-align: center"><?php echo $article['kebocoran_oil_0']; ?></td>
                <td style="text-align: center"><?php echo $article['kebocoran_oil_2']; ?></td>
                <td style="text-align: center"><?php echo $article['kebocoran_oil_4']; ?></td>
                <td style="text-align: center"><?php echo $article['kebocoran_oil_6']; ?></td>
                </tr>
                <tr>
                    <th class="measure">Preheating Unit</th>
                    <th class="parameter" style="text-align: center">-</th>
                    <th class="parameter-setting">On</th>
                    <td style="text-align: center;"><?php echo $article['preheat_unit_8'] ?></td>
                    <td style="text-align: center;"><?php echo $article['preheat_unit_10'] ?></td>
                    <td style="text-align: center;"><?php echo $article['preheat_unit_12'] ?></td>
                    <td style="text-align: center;"><?php echo $article['preheat_unit_14'] ?></td>
                    <td style="text-align: center;"><?php echo $article['preheat_unit_16'] ?></td>
                    <td style="text-align: center;"><?php echo $article['preheat_unit_18'] ?></td>
                    <td style="text-align: center;"><?php echo $article['preheat_unit_20'] ?></td>
                    <td style="text-align: center;"><?php echo $article['preheat_unit_22'] ?></td>
                    <td style="text-align: center;"><?php echo $article['preheat_unit_0'] ?></td>
                    <td style="text-align: center;"><?php echo $article['preheat_unit_2'] ?></td>
                    <td style="text-align: center;"><?php echo $article['preheat_unit_4'] ?></td>
                    <td style="text-align: center;"><?php echo $article['preheat_unit_6'] ?></td>
                </tr>
                <tr>
                    <th class="measure">HT Water Outlet Temp</th>
                    <th class="parameter">>50</th>
                    <th class="parameter-setting">°C</th>
                    <td><?php echo $article['ht_water_outlet_temp_8'] ?></td>
                    <td><?php echo $article['ht_water_outlet_temp_10'] ?></td>
                    <td><?php echo $article['ht_water_outlet_temp_12'] ?></td>
                    <td><?php echo $article['ht_water_outlet_temp_14'] ?></td>
                    <td><?php echo $article['ht_water_outlet_temp_16'] ?></td>
                    <td><?php echo $article['ht_water_outlet_temp_18'] ?></td>
                    <td><?php echo $article['ht_water_outlet_temp_20'] ?></td>
                    <td><?php echo $article['ht_water_outlet_temp_22'] ?></td>
                    <td><?php echo $article['ht_water_outlet_temp_0'] ?></td>
                    <td><?php echo $article['ht_water_outlet_temp_2'] ?></td>
                    <td><?php echo $article['ht_water_outlet_temp_4'] ?></td>
                    <td><?php echo $article['ht_water_outlet_temp_6'] ?></td>
                </tr>
                <tr>
                    <th class="measure">HT Expantion Tank lvl</th>
                    <th class="parameter">50~95</th>
                    <th class="parameter-setting">Cm</th>
                    <td colspan="4" style="text-align: center";><?php echo $article['lt_expantion_tank_lvl_8_14'] ?></td>
                    <td colspan="4" style="text-align: center";><?php echo $article['lt_expantion_tank_lvl_16_22'] ?></td>
                    <td colspan="4" style="text-align: center";><?php echo $article['lt_expantion_tank_lvl_0_6'] ?></td>
                </tr>
                <tr>
                    <th class="measure">LT Expantion Tank lvl</th>
                    <th class="parameter">50~95</th>
                    <th class="parameter-setting">Cm</th>
                    <td colspan="4" style="text-align: center";><?php echo $article['ht_expantion_tank_lvl_8_14'] ?></td>
                    <td colspan="4" style="text-align: center";><?php echo $article['ht_expantion_tank_lvl_16_22'] ?></td>
                    <td colspan="4" style="text-align: center";><?php echo $article['ht_expantion_tank_lvl_0_6'] ?></td>

                </tr>
                    <th class="measure">Warming Up</th>
                    <th class="parameter">2~3</th>
                    <th class="parameter-setting">Week</th>
                    <td colspan="4" style="text-align: center"><?php echo $article['warming_up_8_14'] ?></td>
                    <td colspan="4" style="text-align: center"><?php echo $article['warming_up_16_22'] ?></td>
                    <td colspan="4" style="text-align: center"><?php echo $article['warming_up_0_6'] ?></td>
                <tr>
                    <th class="measure">Fuel Oil Inlet Temp</th>
                    <th class="parameter" style="text-align: center;">-</th>
                    <th class="parameter-setting">°C</th>
                    <td><?php echo $article['fuel_oil_inlet_temp_8'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_temp_10'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_temp_12'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_temp_14'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_temp_16'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_temp_18'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_temp_20'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_temp_22'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_temp_0'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_temp_2'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_temp_4'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_temp_6'] ?></td>
                </tr>
                <tr>
                    <th class="measure">Fuel Oil Inlet Pressure</th>
                    <th class="parameter">4.0~7.0</th>
                    <th class="parameter-setting">Bar</th>
                    <td><?php echo $article['fuel_oil_inlet_pressure_8'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_pressure_10'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_pressure_12'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_pressure_14'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_pressure_16'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_pressure_18'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_pressure_20'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_pressure_22'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_pressure_0'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_pressure_2'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_pressure_4'] ?></td>
                    <td><?php echo $article['fuel_oil_inlet_pressure_6'] ?></td>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th>
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <td style="text-align: center;"><?php echo $article['kebocoran_fuel_8'] ?></td>
                    <td style="text-align: center;"><?php echo $article['kebocoran_fuel_10'] ?></td>
                    <td style="text-align: center;"><?php echo $article['kebocoran_fuel_12'] ?></td>
                    <td style="text-align: center;"><?php echo $article['kebocoran_fuel_14'] ?></td>
                    <td style="text-align: center;"><?php echo $article['kebocoran_fuel_16'] ?></td>
                    <td style="text-align: center;"><?php echo $article['kebocoran_fuel_18'] ?></td>
                    <td style="text-align: center;"><?php echo $article['kebocoran_fuel_20'] ?></td>
                    <td style="text-align: center;"><?php echo $article['kebocoran_fuel_22'] ?></td>
                    <td style="text-align: center;"><?php echo $article['kebocoran_fuel_0'] ?></td>
                    <td style="text-align: center;"><?php echo $article['kebocoran_fuel_2'] ?></td>
                    <td style="text-align: center;"><?php echo $article['kebocoran_fuel_4'] ?></td>
                    <td style="text-align: center;"><?php echo $article['kebocoran_fuel_6'] ?></td>
                </tr>
                </tbody>
                </article>
        </table>

        <?php endif; ?>
    </main>
    <script>
        document.getElementById("exit").onclick=function (){
            location.href = 'selection.php'
        }
    </script>

</body>
</html>