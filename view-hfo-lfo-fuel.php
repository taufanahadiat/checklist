<?php

require 'database.php';

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


</head>

<body>
<?php include 'header.php'; ?>    
<?php
$unit_headings = array(
    "hfo_unloading_pump_unit" => "HFO Unloading Pump Unit",
    "fuel_transfer_pump_unit" => "Fuel Transfer Pump Unit",
    "hfo_separator_pump_unit"=> "HFO Separator Pump Unit",
    "lfo_unloading_pump_unit"=> "LFO Unloading Pump Unit"
);

if (array_key_exists($unit, $unit_headings)):
    ?>
    <h2><?php echo $unit_headings[$unit]; ?></h2>
<?php endif; ?>

<?php require 'pilih-tanggal.php'; ?>

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
                    <th class="measure">Operating Pump#1</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_name = "operating_pump1_$range";
                        echo '<td colspan="4">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                    foreach ($time as $t) {
                        $field_name = "kebocoran_fuel1_$t";
                        echo '<td>' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                <tr>  
                    <th class="measure">Operating Pump#2</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_name = "operating_pump2_$range";
                        echo '<td colspan="4">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                    foreach ($time as $t) {
                        $field_name = "kebocoran_fuel2_$t";
                        echo '<td>' . formatValue($article[$field_name]) . '</td>';
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
