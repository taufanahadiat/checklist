<?php
include 'database.php';
$tanggal = "" . $_GET['selectedDate'];
$unit_trane = "" . $_GET['selectedUnit'];
$unit_hitachi = "" . $_GET['selectedUnit2']; 

include 'request-view-chiller.php';
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
<div class="legend-container">
    <!-- Legend Button -->
    <button class="legend-btn" id="legendBtn" onclick="toggleLegend()">Show Legend</button>

    <!-- Legend Table -->
    <div class="legend-table" id="legendTable">
        <table>
            <thead>
                <tr>
                    <th>Collumn</th>
                    <th>Parameter</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td rowspan="5" style="text-align:center;">Machine Status</td>
                    <td>RUN</td>
                    <td>RUNNING</td>
                </tr>
                <tr>
                    <td>SBY</td>
                    <td>STANDBY</td>
                </tr>
                <tr>
                    <td>U/L</td>
                    <td>UNLOAD</td>
                </tr>
                <tr>
                    <td>ST</td>
                    <td>STOP</td>
                </tr>
                <tr>
                    <td>B/D</td>
                    <td>BREAKDOWN</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
        <?php if ($unit_trane === "chiller_trane_67bopet"){
            echo "<h2>CHILLER OPP 6~7 & BOPET</h2>";
            include 'pilih-tanggal.php';
            include 'view-chiller67bopet.php';
        }else if ($unit_trane === "chiller_trane_45met34"){
            echo "<h2>CHILLER OPP 4,5,8 & MET 3~4</h2>";
            include 'pilih-tanggal.php';
            include 'view-chiller45met34.php';
        }else if($unit_trane === "chiller_trane_coat14met12"){
            echo "<h2>CHILLER COAT1~4 & MET 1~2</h2>";
            include 'pilih-tanggal.php';
            include 'view-chillercoat14met12.php';
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
