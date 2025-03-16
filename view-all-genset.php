<?php

include 'database.php';
$tanggal = "" . $_GET['selectedDate'];
include 'request-view-all-genset.php';
$area = 'genset';
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Checklist Genset</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../../img/icon.ico">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <style>
        .measure2{
            width: 80px;
        }
        .parameter-setting{
            width: 30px;
        }
    </style>
</head>

<body>
<?php include 'header.php'?>
    <main>
        <br><br>
        <?php 
            if (isset($_GET['selectedUnit'])) {
                if ($_GET['selectedUnit'] === 'hfo_unloading_pump_unit') {
                    echo "<h2 style='margin-top: -10px; text-decoration: underline;'>HFO Unloading Pump Unit</h2>";
                    include 'pilih-tanggal.php';
                    $hfo_lfo_fuel = 'hfo_unloading_pump_unit';
                    include 'view-hfo-lfo-fuel.php';
                }else if ($_GET['selectedUnit'] === 'fuel_transfer_pump_unit'){
                    echo "<h2 style='margin-top: -10px; text-decoration: underline;'>Fuel Transfer Pump Unit</h2>";
                    include 'pilih-tanggal.php';
                    $hfo_lfo_fuel = 'fuel_transfer_pump_unit';
                    include 'view-hfo-lfo-fuel.php';
                }else if ($_GET['selectedUnit'] === 'genset_wartsila_01'){
                    echo "<h2 style='margin-top: -10px; text-decoration: underline;'>Genset Wartsila 01</h2>";
                    include 'pilih-tanggal.php';
                    $gensetWartsila = 'genset_wartsila_01';
                    include 'view-genset.php';    
                }else if ($_GET['selectedUnit'] === 'genset_wartsila_02'){
                    echo "<h2 style='margin-top: -10px; text-decoration: underline;'>Genset Wartsila 02</h2>";
                    include 'pilih-tanggal.php';
                    $gensetWartsila = 'genset_wartsila_02';
                    include 'view-genset.php';    
                }else if ($_GET['selectedUnit'] === 'genset_man'){
                    echo "<h2 style='margin-top: -10px; text-decoration: underline;'>Genset Man</h2>";
                    include 'pilih-tanggal.php';
                    include 'view-genset-man.php';
                }else if ($_GET['selectedUnit'] === 'common_unit'){
                    echo "<h2 style='margin-top: -10px; text-decoration: underline;'>Common Unit</h2>";
                    include 'pilih-tanggal.php';
                    include 'view-common-unit.php';
                }else if ($_GET['selectedUnit'] === 'fuel_booster'){
                    echo "<h2 style='margin-top: -10px; text-decoration: underline;'>Fuel Booster Unit</h2>";
                    include 'pilih-tanggal.php';
                    include 'view-fuel-booster.php';
                }else if ($_GET['selectedUnit'] === 'heater_oil'){
                    echo "<h2 style='margin-top: -10px; text-decoration: underline;'>Heater Oil Unit</h2>";
                    include 'pilih-tanggal.php';
                    include 'view-heater-oil.php';
                }else if ($_GET['selectedUnit'] === 'fuel_oil_feeder'){
                    echo "<h2 style='margin-top: -10px; text-decoration: underline;'>Fuel Oil Feeder Unit</h2>";
                    include 'pilih-tanggal.php';
                    include 'view-fuel-oil-feeder.php';
                }else if ($_GET['selectedUnit'] === 'kebocoran_fuel_tank'){
                    echo "<h2 style='margin-top: -10px; text-decoration: underline;'>Kebocoran Fuel Tank</h2>";
                    include 'pilih-tanggal.php';
                    include 'view-kebocoran-fuel-tank.php';
                }else if ($_GET['selectedUnit'] === 'hfo_separator_pump_unit'){
                    echo "<h2 style='margin-top: -10px; text-decoration: underline;'>HFO Separator Pump Unit</h2>";
                    include 'pilih-tanggal.php';
                    $hfo_lfo_fuel = 'hfo_separator_pump_unit';
                    include 'view-hfo-lfo-fuel.php';
                }else if ($_GET['selectedUnit'] === 'lfo_unloading_pump_unit'){
                    echo "<h2 style='margin-top: -10px; text-decoration: underline;'>LFO Unloading Pump Unit</h2>";
                    include 'pilih-tanggal.php';
                    $hfo_lfo_fuel = 'lfo_unloading_pump_unit';
                    include 'view-hfo-lfo-fuel.php';    
                }

            }else{
                echo "<h2 style='margin-top: -30px; text-decoration: underline;'>VIEW ALL GENSET</h2>";
                echo "<h2 style='margin-top: -10px;'>HFO Unloading Pump Unit</h2>";
                include 'pilih-tanggal.php';
                $hfo_lfo_fuel = 'hfo_unloading_pump_unit';
                $unit = 'genset_man';
                include 'verification-form.php';
                include 'view-hfo-lfo-fuel.php';
                echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
                echo "<h2>Fuel Transfer Pump Unit</h2>";
                $hfo_lfo_fuel = 'fuel_transfer_pump_unit';
                include 'view-hfo-lfo-fuel.php';
                echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
                echo "<h2>Genset Wartsila 01</h2>";
                $gensetWartsila = 'genset_wartsila_01';
                include 'view-genset.php';
                echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
                echo "<h2>Genset Wartsila 02</h2>";
                $gensetWartsila = 'genset_wartsila_02';
                include 'view-genset.php';
                echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
                echo "<h2>Genset Man</h2>";
                include 'view-genset-man.php';
                echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
                echo "<h2>Common Unit</h2>";
                include 'view-common-unit.php';
                echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
                echo "<h2>Fuel Booster Unit</h2>";
                include 'view-fuel-booster.php';
                echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
                echo "<h2>Heater Oil Unit</h2>";
                include 'view-heater-oil.php';
                echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
                echo "<h2>Fuel Oil Feeder Unit</h2>";
                include 'view-fuel-oil-feeder.php';
                echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
                echo "<h2>Kebocoran Fuel Tank</h2>";
                include 'view-kebocoran-fuel-tank.php';
                echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
                echo "<h2>HFO Separator Pump Unit</h2>";
                $hfo_lfo_fuel = 'hfo_separator_pump_unit';
                include 'view-hfo-lfo-fuel.php';
                echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
                echo "<h2>LFO Unloading Pump Unit</h2>";
                $hfo_lfo_fuel = 'lfo_unloading_pump_unit';
                include 'view-hfo-lfo-fuel.php';    
            }

        ?>
    </main>
    <script>
        document.getElementById("exit").onclick=function (){
            location.href = 'selection.php'
        }
    </script>

</body>
</html>
