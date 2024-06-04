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
    
    <h2>Fuel Booster Unit</h2>

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
                <th class="measure">Operating Pump#1</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "operating_pump1_$time";
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-on-off.php';
                                echo "</select></td>";
                            }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Oil</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "kebocoran_oil1_$time";
                            echo "<select class='enum' name='$field_name'>";
                            include 'enum-kebocoran.php';
                            echo "</select></td>";
                        }
                    ?>
                </tr>
                <tr>  
                    <th class="measure">Operating Pump#2</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "operating_pump2_$time";
                                echo "<select class='enum' name='$field_name'>";
                                include 'enum-on-off.php';
                                echo "</select></td>";
                            }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Oil</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "kebocoran_oil2_$time";
                            echo "<select class='enum' name='$field_name'>";
                            include 'enum-kebocoran.php';
                            echo "</select></td>";
                        }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Inlet Pressure</th> 
                    <th class="parameter">1.5~3.0</th>
                    <th class="parameter-setting">Bar</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "inlet_pressure_$time";
                            echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                            echo "</td>";
                        }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Heater Temp. Tank #1</th> 
                    <th class="parameter">70~90</th>
                    <th class="parameter-setting">°C</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "heater_temp_tank1_$time";
                            echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                            echo "</td>";
                        }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Oil</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "kebocoran_oil_tank1_$time";
                            echo "<select class='enum' name='$field_name'>";
                            include 'enum-kebocoran.php';
                            echo "</select></td>";
                        }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Heater Temp. Tank #2</th> 
                    <th class="parameter">70~90</th>
                    <th class="parameter-setting">°C</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "heater_temp_tank2_$time";
                            echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                            echo "</td>";
                        }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Oil</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "kebocoran_oil_tank2_$time";
                            echo "<select class='enum' name='$field_name'>";
                            include 'enum-kebocoran.php';
                            echo "</select></td>";
                        }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Oil Temperature Supply</th> 
                    <th class="parameter">60~90</th>
                    <th class="parameter-setting">°C</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "oil_temp_supply_$time";
                            echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                            echo "</td>";
                        }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Oil Temperature Return</th> 
                    <th class="parameter">50~80</th>
                    <th class="parameter-setting">°C</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "oil_temp_return_$time";
                            echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                            echo "</td>";
                        }
                    ?>
                </tr>
                <tr>
                    <th class="measure">HFO Outlet Temp</th> 
                    <th class="parameter">60~90</th>
                    <th class="parameter-setting">°C</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "hfo_outlet_temp_$time";
                            echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                            echo "</td>";
                        }
                    ?>
                </tr>
                <tr>
                    <th class="measure">HFO Day Tank Temp</th> 
                    <th class="parameter">60~90</th>
                    <th class="parameter-setting">°C</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "hfo_tank_temp_$time";
                            echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                            echo "</td>";
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
    </script>
</body>
</html>
