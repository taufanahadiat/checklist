<?php

include 'database.php';
$tanggal = "" . $_GET['selectedDate'];
$t67bopet = 'chiller_trane_67bopet';
$h67bopet = 'chiller_hitachi_67bopet';
$t45met34 = 'chiller_trane_45met34';
$h45met34 = 'chiller_hitachi_45met34';
$tcoat14met12 = 'chiller_trane_coat14met12';
$hcoat14met12 = 'chiller_hitachi_coat14met12';
include 'request-view-all-chiller.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Checklist Chiller</title>
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
            echo "<h2 style='margin-top: -30px; text-decoration: underline;'>VIEW ALL CHILLER</h2>";
            echo "<h2 style='margin-top: -10px;'>CHILLER OPP 6~7 & BOPET</h2>";
            include 'pilih-tanggal.php';
            include 'view-chiller67bopet.php';
            echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
            echo "<h2>CHILLER OPP 4~5 & MET 3~4</h2>";
            include 'view-chiller45met34.php';
            echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
            echo "<h2>CHILLER COAT1~4 & MET 1~2</h2>";
            include 'view-chillercoat14met12.php';
        ?>
    </main>
    <script>
        document.getElementById("exit").onclick=function (){
            location.href = 'selection.php'
        }
    </script>

</body>
</html>
