<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require 'database.php';

    $sql = "INSERT INTO genset_wartsila_01 (tanggal, running_hrs_8_14, running_hrs_16_22, running_hrs_0_6, lube_oil_sump_lvl_8_14, lube_oil_sump_lvl_16_22, lube_oil_sump_lvl_0_6, anti_cond_heater_8_14, anti_cond_heater_16_22, anti_cond_heater_0_6)
            VALUES (curdate(), '" 
                    . $_POST['running_hrs_8_14'] . "','"
                    . $_POST['running_hrs_16_22'] . "','"
                    . $_POST['running_hrs_0_6'] . "','"
                    . $_POST["lube_oil_sump_lvl_8_14"] . "','"
                    . $_POST["lube_oil_sump_lvl_16_22"] . "','"
                    . $_POST["lube_oil_sump_lvl_0_6"] . "','"
                    . $_POST["anti_cond_heater_8_14"] . "','"  
                    . $_POST["anti_cond_heater_16_22"] . "','"
                    . $_POST["anti_cond_heater_0_6"] . "')
                    ";


    $results = mysqli_query($conn, $sql);
    $date= date("Y-m-d");
    if ($results === false) {

        echo mysqli_error($conn);

    } else {
        echo "data submitted to date:$date";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Form Checklist</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">


</head>

<body>
<header>
    <h1>Genset Wartsila 01</h1>
</header>
<main>
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
                    <th class="measure">Running Hours</th>
                    <th class="parameter" style="text-align: center">-</th>
                    <th>Hour</th>
                    <td colspan="4"><input name="running_hrs_8_14" id="running_hrs_8_14" /></td>
                    <td colspan="4"><input name="running_hrs_16_22" id="running_hrs_16_22" /></td>
                    <td colspan="4"><input name="running_hrs_0_6" id="running_hrs_0_6" /></td>
                </tr>
                <tr>
                    <th class="measure">Lube Oil Sump Level</th>
                    <th class="parameter">14~17</th>
                    <th>Cm</th>
                    <td colspan="4"><input name="lube_oil_sump_lvl_8_14" id="lube_oil_sump_lvl_8_14" /></td>
                    <td colspan="4"><input name="lube_oil_sump_lvl_16_22" id="lube_oil_sump_lvl_16_22" /></td>
                    <td colspan="4"><input name="lube_oil_sump_lvl_0_6" id="lube_oil_sump_lvl_0_6" /></td>
                </tr>
                <tr>
                    <th class="measure">Air Condenstion Heater</th>
                    <th class="parameter" style="text-align: center">-</th>
                    <th>On</th>
                    <td colspan="4"><select name="anti_cond_heater_8_14"><?= require 'enum-on-off.php'?></td>
                    <td colspan="4"><select name="anti_cond_heater_16_22"><?= require 'enum-on-off.php'?></td>
                    <td colspan="4"><select name="anti_cond_heater_0_6"><?= require 'enum-on-off.php'?></td>
                </tr>

            </tbody>
    </table>
    <br>
    <button class="btn">SAVE</button>
    </form>
</main>
</body>
</html>
