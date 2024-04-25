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
// Define an associative array mapping $unit values to headings
$unit_headings = [
    "hfo_unloading_pump_unit" => "HFO Unloading Pump Unit",
    "fuel_transfer_pump_unit" => "Fuel Transfer Pump Unit",
    "hfo_separator_pump_unit"=> "HFO Separator Pump Unit",
    "lfo_unloading_pump_unit"=> "LFO Unloading Pump Unit"
];

// Check if the $unit exists in the array keys
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
                    <th class="measure">Operating Pump#1</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <td colspan="4"><select class="enum" name="operating_pump1_8_14"><?= require 'enum-on-off.php'?></td>
                    <td colspan="4"><select class="enum" name="operating_pump1_16_22"><?= require 'enum-on-off.php'?></td>
                    <td colspan="4"><select class="enum" name="operating_pump1_0_6"><?= require 'enum-on-off.php'?></td>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <td><select class="enum" name="kebocoran_fuel1_8" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel1_10"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel1_12"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel1_14"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel1_16"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel1_18"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel1_20"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel1_22"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel1_0" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel1_2" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel1_4" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel1_6" ><?= require 'enum-kebocoran.php'?></td>
                </tr>
                <tr>  
                    <th class="measure">Operating Pump#2</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <td colspan="4"><select class="enum" name="operating_pump2_8_14"><?= require 'enum-on-off.php'?></td>
                    <td colspan="4"><select class="enum" name="operating_pump2_16_22"><?= require 'enum-on-off.php'?></td>
                    <td colspan="4"><select class="enum" name="operating_pump2_0_6"><?= require 'enum-on-off.php'?></td>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <td><select class="enum" name="kebocoran_fuel2_8" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel2_10"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel2_12"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel2_14"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel2_16"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel2_18"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel2_20"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel2_22"><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel2_0" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel2_2" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel2_4" ><?= require 'enum-kebocoran.php'?></td>
                    <td><select class="enum" name="kebocoran_fuel2_6" ><?= require 'enum-kebocoran.php'?></td>
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
