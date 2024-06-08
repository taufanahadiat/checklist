<?php

include 'database.php';

$tanggal = $_GET['selectedDate'];
$unit = $_GET['selectedUnit'];
include 'request-view.php';

?>


<!DOCTYPE html>
<html>
<head>
    <title>Checklist</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">


</head>

<?php
include 'header.php';
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
               <?php 
                $time_ranges = array('8_14', '16_22', '0_6');
                $time = array(8, 10, 12, 14, 16, 18, 20, 22, 0, 2, 4, 6);
                ?>
                <tr>  
                    <th class="measure">Running Hours</th>
                    <th class="parameter" style="text-align: center">-</th>
                    <th class="parameter-setting">Hour</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_name = "running_hrs_$range";
                        echo '<td colspan="4" style="text-align:center">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Lube Oil Sump Level</th>
                    <th class="parameter">14~17</th>
                    <th class="parameter-setting">Cm</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_name = "lube_oil_sump_lvl_$range";
                        echo '<td colspan="4" style="text-align:center">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Air Condenstion Heater</th>
                    <th class="parameter" style="text-align: center">-</th>
                    <th class="parameter-setting">On</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_name = "anti_cond_heater_$range";
                        echo '<td colspan="4" style="text-align:center">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Pre lube Pump</th>
                    <th class="parameter" style="text-align: center">-</th>
                    <th class="parameter-setting">On</th>
                    <?php
                    foreach ($time as $t) {
                        $field_name = "prelube_pump_$t";
                        echo '<td style="text-align: center;">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Pre lube Pump Press</th>
                    <th class="parameter">>0.5</th>
                    <th class="parameter-setting">Bar</th>
                    <?php
                    foreach ($time as $t) {
                        $field_name = "prelube_pump_press_$t";
                        echo '<td>' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Kebocoran Oil</th>
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                    foreach ($time as $t) {
                        $field_name = "kebocoran_oil_$t";
                        echo '<td style="text-align: center;">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Preheating Unit</th>
                    <th class="parameter" style="text-align: center">-</th>
                    <th class="parameter-setting">On</th>
                    <?php
                    foreach ($time as $t) {
                        $field_name = "preheat_unit_$t";
                        echo '<td style="text-align: center;">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">HT Water Outlet Temp</th>
                    <th class="parameter">>50</th>
                    <th class="parameter-setting">°C</th>
                    <?php
                    foreach ($time as $t) {
                        $field_name = "ht_water_outlet_temp_$t";
                        echo '<td>' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">HT Expantion Tank lvl</th>
                    <th class="parameter">50~95</th>
                    <th class="parameter-setting">Cm</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_name = "ht_expantion_tank_lvl_$range";
                        echo '<td colspan="4" style="text-align: center;">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">LT Expantion Tank lvl</th>
                    <th class="parameter">50~95</th>
                    <th class="parameter-setting">Cm</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_name = "lt_expantion_tank_lvl_$range";
                        echo '<td colspan="4" style="text-align: center;">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Warming Up</th>
                    <th class="parameter">2~3</th>
                    <th class="parameter-setting">Week</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_name = "warming_up_$range";
                        echo '<td colspan="4" style="text-align: center;">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Fuel Oil Inlet Temp</th>
                    <th class="parameter" style="text-align: center;">-</th>
                    <th class="parameter-setting">°C</th>
                    <?php
                    foreach ($time as $t) {
                        $field_name = "fuel_oil_inlet_temp_$t";
                        echo '<td>' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Fuel Oil Inlet Pressure</th>
                    <th class="parameter">4.0~7.0</th>
                    <th class="parameter-setting">Bar</th>
                    <?php
                    foreach ($time as $t) {
                        $field_name = "fuel_oil_inlet_pressure_$t";
                        echo '<td>' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Kebocoran Fuel</th>
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                    foreach ($time as $t) {
                        $field_name = "kebocoran_fuel_$t";
                        echo '<td style="text-align: center;">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
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
