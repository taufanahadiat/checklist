<?php

include 'database.php';
$line = '4&5';
$line67 = '6&7';
$unit = 'compressor';
$airDryer = 'air_dryer';
$airReceiver = 'air_receiver_tank';

$tanggal = $_GET['selectedDate'];

include 'request-view-all-compressor.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Checklist</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../../img/icon.ico">
    <link rel="stylesheet" href="fontawesome/css/all.css">

</head>

<body>
<?php include 'header.php'?>
<main>
<?php include 'legend-compressor.php'?>
<?php include 'switch-to-form.php'?>
<?php
        $article_1 = null;
        $article_2 = null;
        $article_3 = null;

    if($_GET['selectedLine'] === '45_compressor'){
        echo "<h2>COMPRESSOR LINE 4,5,8 & BOPET</h2>";
        include 'pilih-tanggal.php';
        include 'view-compressor45.php';
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        echo "<h2>AIR DRYER LINE 4,5,8 & BOPET</h2>";
        include 'view-air-dryer45.php';
    }else if($_GET['selectedLine'] === '67_compressor'){
        echo "<h2>COMPRESSOR LINE 6&7</h2>";
        include 'pilih-tanggal.php';
        include 'view-compressor67.php';
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
