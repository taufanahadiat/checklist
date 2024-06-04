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

    <h2>Kebocoran Fuel Tank</h2>

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
                    <th class="measure">HFO Day Tank</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "hfo_day_tank_$time";
                            echo "<select class='enum' name='$field_name'>";
                            include 'enum-kebocoran.php';
                            echo "</select></td>";
                        }
                    ?>
                </tr>
                <tr>
                    <th class="measure">LFO Day Tank</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "lfo_day_$time";
                            echo "<select class='enum' name='$field_name'>";
                            include 'enum-kebocoran.php';
                            echo "</select></td>";
                        }
                    ?>
                </tr>
                <tr>
                <th class="measure">HFO Storage Tank</th>
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "hfo_storage_tank_$time";
                            echo "<input type='number' step='0.01' class='input-field' name='$field_name'>";
                            echo "</td>";
                        }
                    ?>
                </tr>                                                                                               
                <tr>
                <th class="measure">LFO Storage Tank</th>
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        $times = array("8", "10", "12", "14", "16", "18", "20", "22", "0", "2", "4", "6");
                        foreach ($times as $time) {
                            echo "<td>";
                            $field_name = "lfo_storage_tank_$time";
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
