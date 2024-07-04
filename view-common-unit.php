<?php

include 'database.php';
$tanggal = "" . $_GET['selectedDate'];
$unit = "" . $_GET['selectedUnit'];

include 'request-view.php';

?>


<!DOCTYPE html>
<html>
<head>
    <title>Checklist</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <style>
        td {
            text-align: center;
            width: 300px;
        }
    </style>
</head>

<body>
<?php include 'header.php'?>
<main>

    <h2>Common Unit</h2>
    <?php include 'pilih-tanggal.php'; ?>
    <?php if ($article === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>

    
        <table>
            <thead>
            <tr>
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

            </tr>
            </thead>
                <article>
                <tbody>
                <?php
                $times = array('8', '10', '12', '14', '16', '18', '20', '22', '0', '2', '4', '6');
                $measurements = array(
                    array("DC System Voltage", "110~125", "Volt", "dc_system_volt_"),
                    array("LV Switchgear Voltage", "380~410", "Volt", "lv_switchgear_"),
                    array("Starting Air Pressure #1", "20~29", "Bar", "start_air_press1_"),
                    array("Starting Air Pressure #2", "20~29", "Bar", "start_air_press2_"),
                    array("Drain Starting Air Bottle", "-", "-", "drain_start_"),
                    array("Compressor #1", "-", "Hour", "compressor1_"),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil1_"),
                    array("Compressor #2", "-", "Hour", "compressor2_"),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil2_"),
                    array("Compressor #3", "-", "Hour", "compressor3_"),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil3_"),
                    array("Outdoor Temperature", "-", "°C", "outdoor_temp_")
                );


                foreach ($measurements as $measurement) {
                    echo "<tr>";
                    echo "<th class='measure'>{$measurement[0]}</th>";
                    echo "<th class='parameter'>{$measurement[1]}</th>";
                    echo "<th class='parameter-setting'>{$measurement[2]}</th>";

                    foreach ($times as $time) {
                        $field_name = $measurement[3] . $time;
                        echo "<td>";
                        echo htmlspecialchars(formatValue($article[$field_name]));
                        echo "</td>";
                    }
                    echo "</tr>";
                } ?>

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
