<?php

include 'database.php';
$tanggal = "" . $_GET['selectedDate'];
include 'request-view-all-compressor.php';
$area = "compressor";

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Checklist Compressor</title>
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
    <?php include 'legend-compressor.php'?>
        <br><br>
        <?php 
        if (isset($_GET['selectedLine'])) {
            if ($_GET['selectedLine'] === '45_compressor') {
                echo "<h2 style='margin-top: -10px; text-decoration: underline;'>COMPRESSOR LINE 4,5,8 & BOPET</h2>";
                include 'pilih-tanggal.php';
                include 'view-compressor45.php';
                echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
                echo "<h2>AIR DRYER LINE 4,5,8 & BOPET</h2>";
                include 'view-air-dryer45.php';
                echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
                echo "<h2>AIR RECEIVER TANK LINE 4,5,8 & BOPET</h2>";
                include 'view-air-receiver-tank45.php';
            } elseif ($_GET['selectedLine'] === '67_compressor') {
                echo "<h2 style='margin-top: -10px; text-decoration: underline;'>COMPRESSOR LINE 6&7</h2>";
                include 'pilih-tanggal.php';
                include 'view-compressor67.php';
                echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
                echo "<h2>AIR DRYER LINE 6&7</h2>";
                include 'view-air-dryer67.php';
                echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
                echo "<h2>AIR RECEIVER TANK LINE 6&7</h2>";
                include 'view-air-receiver-tank67.php';
            }
        } else {
            echo "<h2 style='margin-top: -30px; text-decoration: underline;'>VIEW ALL COMPRESSOR</h2>";
            echo "<h2 style='margin-top: -10px;'>COMPRESSOR LINE 4,5,8 & BOPET</h2>";
            include 'pilih-tanggal.php';
            include 'view-compressor45.php';
            echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
            echo "<h2>AIR DRYER LINE 4,5,8 & BOPET</h2>";
            include 'view-air-dryer45.php';
            echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
            echo "<h2>AIR RECEIVER TANK LINE 4,5,8 & BOPET</h2>";
            include 'view-air-receiver-tank45.php';
            echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
            echo "<h2>COMPRESSOR LINE 6&7</h2>";
            include 'view-compressor67.php';
            echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
            echo "<h2>AIR DRYER LINE 6&7</h2>";
            include 'view-air-dryer67.php';
            echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
            echo "<h2>AIR RECEIVER TANK LINE 6&7</h2>";
            include 'view-air-receiver-tank67.php';
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
