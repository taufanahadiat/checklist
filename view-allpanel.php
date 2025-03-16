<?php
$bulan = $_GET['selectedMonth']; 
$convert = DateTime::createFromFormat('Y-m', $bulan);
$nama_bulan = $convert->format('F Y'); // Output: 'September-2024'
$area = 'panel_lvdp';
require 'database.php';

// Function to format the value
function formatValue($value) {
    if (is_numeric($value)) {
        // If the value is a float and has .00 as decimals, return it as an integer
        if (floor($value) == $value) {
            return number_format(intval($value));
        } else {
            // Return the value formatted with commas but preserving its decimal part
            return number_format($value, 2);
        }
    } else {
        // Otherwise, return the original value
        return $value;
    }
}

?>


<!DOCTYPE html>
<html>
<head>
    <title>View Checklist</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../../img/icon.ico">
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="fontawesome/css/all.css">
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
<?php include 'header.php'; ?>
<main>
    <h2 style="margin-bottom: 5px">
        <span style="font-weight:200;">CHECK SHEET</span>
        <br>
        <span style="text-decoration: underline;">PANEL LOW VOLTAGE</span>
    </h2>
    <?php 
        include 'pilih-tanggal.php';
        include 'view-panel-lvdp3.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-panel-lvdp4.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-panel-lvdp5.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-panel-lvdp12l6.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-panel-lvdp3l6.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-panel-lvdp12l7.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-panel-lvdp3l7.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-panel-lvdp1l8.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-panel-lvdp2l8.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-panel-lvdp3l8.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-panel-lvdppet.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-panel-lvdpmet1.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-panel-lvdpmet2.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-panel-lvdpmet3.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-panel-lvdpcpp.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-panel-lvdpoffice.php'; 
    ?>
    
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
