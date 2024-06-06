<?php

include 'database.php';

$tanggal = $_GET['selectedDate'];
$unit = $_GET['selectedUnit'];
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

<?php
include 'header.php'; ?>
    <h2>Fuel Booster Unit</h2>

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
                $times = array(8, 10, 12, 14, 16, 18, 20, 22, 0, 2, 4, 6);
                ?>
                <tr>
                    <th class="measure">Operating Pump#1</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "operating_pump1_$time";
                        echo '<td style="text-align:center">' . $article[$field_name] . '</td>';
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
                        echo '<td style="text-align:center">' . $article[$field_name] . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Operating Pump#2</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "operating_pump2_$time";
                        echo '<td style="text-align:center">' . $article[$field_name] . '</td>';
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
                        echo '<td style="text-align: center;">' . $article[$field_name] . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                <th class="measure">Flowrate (Booster Unit)</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Liter</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "flowrate_booster_$range";
                        echo '<td colspan="4">' . $article[$field_name] . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                <th class="measure">Flowrate (Monitor)</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Liter</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "flowrate_monitor_$range";
                        echo '<td colspan="4" style="text-align: center;">' . $article[$field_name] . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                <th class="measure">HFO/LFO</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "hfo_lfo_$range";
                        echo '<td colspan="4" style="text-align: center;">' . $article[$field_name] . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                <th class="measure">Feed Pressure</th>
                    <th class="parameter">3.5~5.0</th>
                    <th class="parameter-setting">Bar</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "feed_pressure_$time";
                        echo '<td>' . $article[$field_name] . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                <th class="measure">Outlet Pressure</th>
                    <th class="parameter">4.0~5.0</th>
                    <th class="parameter-setting">Bar</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "outlet_pressure_$time";
                        echo '<td style="text-align: center;">' . $article[$field_name] . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                <th class="measure">Fuel Temperature</th>
                    <th class="parameter">80~110</th>
                    <th class="parameter-setting">°C</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "fuel_temp_$time";
                        echo '<td style="text-align: center;">' . $article[$field_name] . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                <th class="measure">Fuel Viscosity</th>
                    <th class="parameter">0~16</th>
                    <th class="parameter-setting">cSt</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "fuel_visc_$time";
                        echo '<td style="text-align: center;">' . $article[$field_name] . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                <th class="measure">Flushing Counter</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Cycl</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "flushing_count_$range";
                        echo '<td colspan="4">' . $article[$field_name] . '</td>';
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
