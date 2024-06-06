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
        td {
            text-align: center;
        }
        .enum, .input-field {
            width: 100%;
            max-width: 65px;
            height: 25px;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
        }
        .input-field {
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
    <h2>Fuel Oil Feeder Unit</h2>
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
        <form method="post">
            <tbody>
            <?php
            $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");

            $measures = array(
                array("Operating Pump#1", "ON/OFF", "-", "operating_pump1", 'enum-on-off.php'),
                array("Kebocoran Fuel", "A/TA/RS", "-", "kebocoran_fuel1", 'enum-kebocoran.php'),
                array("Operating Pump#2", "ON/OFF", "-", "operating_pump2", 'enum-on-off.php'),
                array("Kebocoran Fuel", "A/TA/RS", "-", "kebocoran_fuel2", 'enum-kebocoran.php'),
                array("Outlet Pressure", "3.0~5.0", "Bar", "outlet_pressure", null),
                array("Outlet Temperature", "50~80", "°C", "outlet_temp", null),
            );

            foreach ($measures as $measure) {
                echo "<tr>";
                echo "<th class='measure'>{$measure[0]}</th>";
                echo "<th class='parameter'>{$measure[1]}</th>";
                echo "<th class='parameter-setting'>{$measure[2]}</th>";

                foreach ($times as $time) {
                    echo "<td>";
                    $field_name = "{$measure[3]}_$time";

                    if ($measure[4]) {
                        echo "<select class='enum' name='$field_name'>";
                        include $measure[4];
                        echo "</select>";
                    } else {
                        echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                    }

                    echo "</td>";
                }
                echo "</tr>";
            }
            ?>
            </tbody>
    </table>
    <br>
    <button class="btn">SAVE</button>
    </form>
</main>
<script>
    document.getElementById("exit").onclick = function () {
        location.href = 'selection.php'
    }
    $(".enum").prop("selectedIndex", -1);
    $(".input-field").val('');
</script>
</body>
</html>
