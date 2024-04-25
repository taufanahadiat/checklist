<?php

require 'database.php';

$tanggal = "" . $_GET['selectedDate'];
$unit = "" . $_GET['selectedUnit'];
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

<body>
    <div class="header-img">
      <img id="logo" src="css/logo.png" alt="Logo Argha"><br>
      <img id="exit" src="css/exit.png" alt="Exit"><br>
    </div>
<header>
      <h1>ONLINE CHECKLIST</h1>
</header>
<?php
$unit_headings = [
    "hfo_unloading_pump_unit" => "HFO Unloading Pump Unit",
    "fuel_transfer_pump_unit" => "Fuel Transfer Pump Unit",
    "hfo_separator_pump_unit"=> "HFO Separator Pump Unit",
    "lfo_unloading_pump_unit"=> "LFO Unloading Pump Unit"
];

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
                <tr>  
                    <th class="measure">Operating Pump#1</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <td colspan="4"><?= $article['operating_pump1_8_14']; ?></td>
                    <td colspan="4"><?= $article['operating_pump1_16_22']; ?></td>
                    <td colspan="4"><?= $article['operating_pump1_0_6']; ?></td>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <td><?= $article['kebocoran_fuel1_8']; ?></td>
                    <td><?= $article['kebocoran_fuel1_10']; ?></td>
                    <td><?= $article['kebocoran_fuel1_12']; ?></td>
                    <td><?= $article['kebocoran_fuel1_14']; ?></td>
                    <td><?= $article['kebocoran_fuel1_16']; ?></td>
                    <td><?= $article['kebocoran_fuel1_18']; ?></td>
                    <td><?= $article['kebocoran_fuel1_20']; ?></td>
                    <td><?= $article['kebocoran_fuel1_22']; ?></td>
                    <td><?= $article['kebocoran_fuel1_0']; ?></td>
                    <td><?= $article['kebocoran_fuel1_2']; ?></td>
                    <td><?= $article['kebocoran_fuel1_4']; ?></td>
                    <td><?= $article['kebocoran_fuel1_6']; ?></td>
                </tr>
                <tr>  
                    <th class="measure">Operating Pump#2</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <td colspan="4"><?= $article['operating_pump2_8_14']; ?></td>
                    <td colspan="4"><?= $article['operating_pump2_16_22']; ?></td>
                    <td colspan="4"><?= $article['operating_pump2_0_6']; ?></td>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <td><?= $article['kebocoran_fuel2_8']; ?></td>
                    <td><?= $article['kebocoran_fuel2_10']; ?></td>
                    <td><?= $article['kebocoran_fuel2_12']; ?></td>
                    <td><?= $article['kebocoran_fuel2_14']; ?></td>
                    <td><?= $article['kebocoran_fuel2_16']; ?></td>
                    <td><?= $article['kebocoran_fuel2_18']; ?></td>
                    <td><?= $article['kebocoran_fuel2_20']; ?></td>
                    <td><?= $article['kebocoran_fuel2_22']; ?></td>
                    <td><?= $article['kebocoran_fuel2_0']; ?></td>
                    <td><?= $article['kebocoran_fuel2_2']; ?></td>
                    <td><?= $article['kebocoran_fuel2_4']; ?></td>
                    <td><?= $article['kebocoran_fuel2_6']; ?></td>
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
