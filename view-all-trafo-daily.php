<?php

include 'database.php';
$tanggal = "" . $_GET['selectedDate'];
$area = 'trafo';

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
    <title>View Checklist Trafo</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../../img/icon.ico">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <style>
        td {
            text-align: center;
            width: 300px;
        }
    </style>
</head>

<body>
<?php include 'header.php'?>
    <main>
        <br><br>
        <?php 
        echo "<h2 style='margin-top: -30px; text-decoration: underline;'>VIEW ALL TRAFO DAILY CHECK</h2>";
        include 'pilih-tanggal.php';
        include 'view-trafo-daily-office.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-trafo-daily-bopet.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-trafo-daily-coating.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-trafo-daily-line4.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-trafo-daily-line5.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-trafo-daily-line6.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-trafo-daily-line7.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-trafo-daily-line8.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-trafo-daily-met2.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';
        include 'view-trafo-daily-met34.php'; 
        echo '<hr style="border: 1px solid #000; width: 100%; margin: 20px 0;">';

        ?>
    </main>
    <script>
        document.getElementById("exit").onclick=function (){
            location.href = 'selection.php'
        }
    </script>

</body>
</html>
