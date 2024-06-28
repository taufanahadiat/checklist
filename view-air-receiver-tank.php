<?php

include 'database.php';
$tanggal = "" . $_GET['selectedDate'];
$line = $_GET['selectedLine'];
$unit = "" . $_GET['selectedUnit'];

include 'request-view-compressor.php';
?>


<!DOCTYPE html>
<html>
<head>
    <title>Checklist</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">


</head>

<body>
<?php include 'header.php'?>
<main>
<?php
    if($line === '4&5'){
        include 'view-air-receiver-tank45.php';
    }else if($line === '6&7'){
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
