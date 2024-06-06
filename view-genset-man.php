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
    <h2>Genset Man</h2>

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
                    <th class="measure">Running Hours</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Hour</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_name = "running_hours_$range";
                        echo '<td colspan="4" style="text-align:center">' . $article[$field_name] . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Breaker Position</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">On</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_name = "breaker_position_$range";
                        echo '<td colspan="4" style="text-align:center">' . $article[$field_name] . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Energy Switch Position</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Off</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_name = "energy_switch_$range";
                        echo '<td colspan="4" style="text-align:center">' . $article[$field_name] . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Switch Mode</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Auto</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_name = "switch_mode_$range";
                        echo '<td colspan="4" style="text-align:center">' . $article[$field_name] . '</td>';
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
                        echo '<td colspan="4" style="text-align:center">' . $article[$field_name] . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Voltage Battery</th>
                    <th class="parameter">>24</th>
                    <th class="parameter-setting">Volt</th>
                    <?php
                    foreach ($times as $time) {
                        $field_name = "voltage_battery_$time";
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
                        $field_name = "kebocoran_fuel_$time";
                        echo '<td style="text-align:center">' . $article[$field_name] . '</td>';
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
