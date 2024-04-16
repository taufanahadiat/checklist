<?php


$dbhost = "localhost";
$dbname = "checklistnew_24";
$dbuser = "root";
$dbpass = "blank";


$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
}

$sql = "SELECT *
        FROM genset_wartsila_01
        ORDER BY tanggal";

$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $article = mysqli_fetch_all($results, MYSQLI_ASSOC);
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>My blog</title>
    <meta charset="utf-8">
<style>
    table, th, td {
    border: 1px solid black;
    }
</style>

</head>
<body>

    <header>
        <h1>Genset Wartsila 01</h1>
    </header>

    <main>
        <?php if (empty($article)): ?>
            <p>No articles found.</p>
        <?php else: ?>

                                   
            <table>
                <tr>
                    <th>Time</th>
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
                </tr>
                
                </tr>
                <article>
                <tr>
                    <td>Running Hours</td>
                    <td style="text-align: center">-</td>
                    <td>Hour</td>
                    <td colspan="4" style="text-align:center"><?= $article['running_hrs_8:14']; ?></td>
                    <td colspan="4" style="text-align:center"><?= $article['running_hrs_16:22']; ?></td>
                    <td colspan="4" style="text-align:center"><?= $article['running_hrs_0:6']; ?></td>
                </tr>
                <tr>
                    <td>Lube Oil Sump Level</td>
                    <td>14~17</td>
                    <td>Cm</td>
                    <td colspan="4" style="text-align:center"><?= $article['lube_oil_sump_lvl_8:14']; ?></td>
                    <td colspan="4" style="text-align:center"><?= $article['lube_oil_sump_lvl_16:22']; ?></td>
                    <td colspan="4" style="text-align:center"><?= $article['lube_oil_sump_lvl_0:6']; ?></td>
                </tr>
                <tr>
                    <td>Air Condenstion Heater</td>
                    <td style="text-align: center">-</td>
                    <td>On</td>
                    <td colspan="4" style="text-align:center"><?= $article['anti_cond_heater_8:14']; ?></td>
                    <td colspan="4" style="text-align:center"><?= $article['anti_cond_heater_16:22']; ?></td>
                    <td colspan="4" style="text-align:center"><?= $article['anti_cond_heater_0:6']; ?></td>
                </tr>
                <tr>
                    <td>Pre lube Pump</td>
                    <td style="text-align: center">-</td>
                    <td>On</td>
                    <td style="text-align: center"><?= $article['prelube_pump_8']; ?></td>
                    <td style="text-align: center"><?= $article['prelube_pump_10']; ?></td>
                    <td style="text-align: center"><?= $article['prelube_pump_12']; ?></td>
                    <td style="text-align: center"><?= $article['prelube_pump_14']; ?></td>
                    <td style="text-align: center"><?= $article['prelube_pump_16']; ?></td>
                    <td style="text-align: center"><?= $article['prelube_pump_18']; ?></td>
                    <td style="text-align: center"><?= $article['prelube_pump_20']; ?></td>
                    <td style="text-align: center"><?= $article['prelube_pump_22']; ?></td>
                    <td style="text-align: center"><?= $article['prelube_pump_0']; ?></td>
                    <td style="text-align: center"><?= $article['prelube_pump_2']; ?></td>
                    <td style="text-align: center"><?= $article['prelube_pump_4']; ?></td>
                    <td style="text-align: center"><?= $article['prelube_pump_6']; ?></td>
                </tr>
                <tr>
                    <td>Pre lube Pump Press</td>
                    <td>>0.5</td>
                    <td>Bar</td>
                    <td><?= $article['prelube_pump_press_8']; ?></td>
                    <td><?= $article['prelube_pump_press_10']; ?></td>
                    <td><?= $article['prelube_pump_press_12']; ?></td>
                    <td><?= $article['prelube_pump_press_14']; ?></td>
                    <td><?= $article['prelube_pump_press_16']; ?></td>
                    <td><?= $article['prelube_pump_press_18']; ?></td>
                    <td><?= $article['prelube_pump_press_20']; ?></td>
                    <td><?= $article['prelube_pump_press_22']; ?></td>
                    <td><?= $article['prelube_pump_press_0']; ?></td>
                    <td><?= $article['prelube_pump_press_2']; ?></td>
                    <td><?= $article['prelube_pump_press_4']; ?></td>
                    <td><?= $article['prelube_pump_press_6']; ?></td>
                </tr>
                <tr>
                <td>Kebocoran Oil</td>
                <td>A/TA/RS</td>
                <td style="text-align: center">-</td>
                <td style="text-align: center"><?= $article['kebocoran_oil_8']; ?></td>
                <td style="text-align: center"><?= $article['kebocoran_oil_10']; ?></td>
                <td style="text-align: center"><?= $article['kebocoran_oil_12']; ?></td>
                <td style="text-align: center"><?= $article['kebocoran_oil_14']; ?></td>
                <td style="text-align: center"><?= $article['kebocoran_oil_16']; ?></td>
                <td style="text-align: center"><?= $article['kebocoran_oil_18']; ?></td>
                <td style="text-align: center"><?= $article['kebocoran_oil_20']; ?></td>
                <td style="text-align: center"><?= $article['kebocoran_oil_22']; ?></td>
                <td style="text-align: center"><?= $article['kebocoran_oil_0']; ?></td>
                <td style="text-align: center"><?= $article['kebocoran_oil_2']; ?></td>
                <td style="text-align: center"><?= $article['kebocoran_oil_4']; ?></td>
                <td style="text-align: center"><?= $article['kebocoran_oil_6']; ?></td>
                </tr>
                <tr>
                    <td>Preheating Unit</td>
                    <td style="text-align: center">-</td>
                    <td>On</td>
                    <td style="text-align: center;"><?= $article['preheat_unit_8'] ?></td>
                    <td style="text-align: center;"><?= $article['preheat_unit_10'] ?></td>
                    <td style="text-align: center;"><?= $article['preheat_unit_12'] ?></td>
                    <td style="text-align: center;"><?= $article['preheat_unit_14'] ?></td>
                    <td style="text-align: center;"><?= $article['preheat_unit_16'] ?></td>
                    <td style="text-align: center;"><?= $article['preheat_unit_18'] ?></td>
                    <td style="text-align: center;"><?= $article['preheat_unit_20'] ?></td>
                    <td style="text-align: center;"><?= $article['preheat_unit_22'] ?></td>
                    <td style="text-align: center;"><?= $article['preheat_unit_0'] ?></td>
                    <td style="text-align: center;"><?= $article['preheat_unit_2'] ?></td>
                    <td style="text-align: center;"><?= $article['preheat_unit_4'] ?></td>
                    <td style="text-align: center;"><?= $article['preheat_unit_6'] ?></td>
                </tr>
                <tr>
                    <td>HT Water Outlet Temp</td>
                    <td>>50</td>
                    <td>°C</td>
                    <td><?= $article['ht_water_outlet_temp_8'] ?></td>
                    <td><?= $article['ht_water_outlet_temp_10'] ?></td>
                    <td><?= $article['ht_water_outlet_temp_12'] ?></td>
                    <td><?= $article['ht_water_outlet_temp_14'] ?></td>
                    <td><?= $article['ht_water_outlet_temp_16'] ?></td>
                    <td><?= $article['ht_water_outlet_temp_18'] ?></td>
                    <td><?= $article['ht_water_outlet_temp_20'] ?></td>
                    <td><?= $article['ht_water_outlet_temp_22'] ?></td>
                    <td><?= $article['ht_water_outlet_temp_0'] ?></td>
                    <td><?= $article['ht_water_outlet_temp_2'] ?></td>
                    <td><?= $article['ht_water_outlet_temp_4'] ?></td>
                    <td><?= $article['ht_water_outlet_temp_6'] ?></td>
                </tr>
                <tr>
                    <td>LT Expantion Tank lvl</td>
                    <td>50~95</td>
                    <td>Cm</td>
                    <td colspan="4" style="text-align: center";><?= $article['ht_expantion_tank_lvl_8:14'] ?></td>
                    <td colspan="4" style="text-align: center";><?= $article['ht_expantion_tank_lvl_16:22'] ?></td>
                    <td colspan="4" style="text-align: center";><?= $article['ht_expantion_tank_lvl_0:6'] ?></td>

                </tr>
                <tr>
                    <td>HT Expantion Tank lvl</td>
                    <td>50~95</td>
                    <td>Cm</td>
                    <td colspan="4" style="text-align: center";><?= $article['lt_expantion_tank_lvl_8:14'] ?></td>
                    <td colspan="4" style="text-align: center";><?= $article['lt_expantion_tank_lvl_16:22'] ?></td>
                    <td colspan="4" style="text-align: center";><?= $article['lt_expantion_tank_lvl_0:6'] ?></td>
                </tr>
                    <td>Warming Up</td>
                    <td>2~3</td>
                    <td>Week</td>
                    <td colspan="4" style="text-align: center"><?= $article['warming_up_8:14'] ?></td>
                    <td colspan="4" style="text-align: center"><?= $article['warming_up_16:22'] ?></td>
                    <td colspan="4" style="text-align: center"><?= $article['warming_up_0:6'] ?></td>
                <tr>
                    <td>Fuel Oil Inlet Temp</td>
                    <td style="text-align: center;">-</td>
                    <td>°C</td>
                    <td><?= $article['fuel_oil_inlet_temp_8'] ?></td>
                    <td><?= $article['fuel_oil_inlet_temp_10'] ?></td>
                    <td><?= $article['fuel_oil_inlet_temp_12'] ?></td>
                    <td><?= $article['fuel_oil_inlet_temp_14'] ?></td>
                    <td><?= $article['fuel_oil_inlet_temp_16'] ?></td>
                    <td><?= $article['fuel_oil_inlet_temp_18'] ?></td>
                    <td><?= $article['fuel_oil_inlet_temp_20'] ?></td>
                    <td><?= $article['fuel_oil_inlet_temp_22'] ?></td>
                    <td><?= $article['fuel_oil_inlet_temp_0'] ?></td>
                    <td><?= $article['fuel_oil_inlet_temp_2'] ?></td>
                    <td><?= $article['fuel_oil_inlet_temp_4'] ?></td>
                    <td><?= $article['fuel_oil_inlet_temp_6'] ?></td>
                </tr>
                <tr>
                    <td>Fuel Oil Inlet Pressure</td>
                    <td>4.0~7.0</td>
                    <td>Bar</td>
                    <td><?= $article['fuel_oil_inlet_pressure_8'] ?></td>
                    <td><?= $article['fuel_oil_inlet_pressure_10'] ?></td>
                    <td><?= $article['fuel_oil_inlet_pressure_12'] ?></td>
                    <td><?= $article['fuel_oil_inlet_pressure_14'] ?></td>
                    <td><?= $article['fuel_oil_inlet_pressure_16'] ?></td>
                    <td><?= $article['fuel_oil_inlet_pressure_18'] ?></td>
                    <td><?= $article['fuel_oil_inlet_pressure_20'] ?></td>
                    <td><?= $article['fuel_oil_inlet_pressure_22'] ?></td>
                    <td><?= $article['fuel_oil_inlet_pressure_0'] ?></td>
                    <td><?= $article['fuel_oil_inlet_pressure_2'] ?></td>
                    <td><?= $article['fuel_oil_inlet_pressure_4'] ?></td>
                    <td><?= $article['fuel_oil_inlet_pressure_6'] ?></td>
                </tr>
                <tr>
                    <td>Kebocoran Fuel</td>
                    <td>A/TA/RS</td>
                    <td style="text-align: center;">-</td>
                    <td style="text-align: center;"><?= $article['kebocoran_fuel_8'] ?></td>
                    <td style="text-align: center;"><?= $article['kebocoran_fuel_10'] ?></td>
                    <td style="text-align: center;"><?= $article['kebocoran_fuel_12'] ?></td>
                    <td style="text-align: center;"><?= $article['kebocoran_fuel_14'] ?></td>
                    <td style="text-align: center;"><?= $article['kebocoran_fuel_16'] ?></td>
                    <td style="text-align: center;"><?= $article['kebocoran_fuel_18'] ?></td>
                    <td style="text-align: center;"><?= $article['kebocoran_fuel_20'] ?></td>
                    <td style="text-align: center;"><?= $article['kebocoran_fuel_22'] ?></td>
                    <td style="text-align: center;"><?= $article['kebocoran_fuel_0'] ?></td>
                    <td style="text-align: center;"><?= $article['kebocoran_fuel_2'] ?></td>
                    <td style="text-align: center;"><?= $article['kebocoran_fuel_4'] ?></td>
                    <td style="text-align: center;"><?= $article['kebocoran_fuel_6'] ?></td>
                </tr>
                </article>
        </table>

        <?php endif; ?>
    </main>
</body>
</html>
