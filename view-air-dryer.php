<?php

include 'database.php';
$tanggal = "" . $_GET['selectedDate'];
$unit = "" . $_GET['selectedUnit'];

$sql = "SELECT * FROM $unit WHERE tanggal LIKE '%{$tanggal}%'";
$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $article = mysqli_fetch_assoc($results);
}

?>
<?php

// Function to format the value
function formatValue($value) {
    // Check if the value is a float and has .00 as decimals
    if (is_numeric($value) && floor($value) == $value) {
        return intval($value); // Return integer value
    } else {
        return $value; // Otherwise, return the original value
    }
}

// Example usage:
$value = 10.00;
//echo formatValue($value); // Output: 10

$value = 10.50;
//echo formatValue($value); // Output: 10.5
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

    <h2>AIR DRYER LINE</h2>
    <?php if ($article === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>

    
        <table>
            <thead>
            <tr>
            <th>PARAMETER</th>
            <th>Uom</th>
            <th>STANDARD</th>
            <th>SULLAIR 22</th>
            <th>BOGE 01</th>
            <th>BOGE 02</th>
            <th>AD. SULLAIR 23</th>
            <th>AD. SULLAIR 24</th>
            <th>AD. SULLAIR 27</th>
            <th>AD. SULLAIR 33</th>
            <th>AD. AUGUST 28</th>
            <th>AD. AUGUST 29</th>
            <th>AD. AUGUST 30</th>
            <th>AD. AUGUST 31</th>
            <th>AD. AUGUST 32</th>
            </tr>
            </thead>
                <article>
                <tbody>
                <?php
                $models = array("sullair22", "boge01", "boge02", "adsullair23", "adsullair24", "adsullair27", "adsullair33", "adaugust28", "adaugust29", "adaugust30", "adaugust31", "adaugust32");
                $parameters = array("Dew Point Temp.", "Ref. Low Press", "Pre Filter", "After Filter", "Auto Drain Solenoid", "Vibration");
                $uom = array("°C", "Bar", "-", "-", "-", "-");
                $standard = array("2 ~ 10", "4 ~ 10", "HJ", "HJ", "B", "H ~ S");
                $fields = array("dewpoint_temp", "reflow_press", "pre_filter", "after_filter", "autodrain_solenoid", "vibration");
                

                    foreach ($parameters as $index => $parameter) {
                    echo "<tr>";
                    echo "<th style='width: 40px' class='measure2'>" . htmlspecialchars($parameter) . "</th>";
                    echo "<th style='width:25px' class='parameter'>" . htmlspecialchars($uom[$index]) . "</th>";
                    echo "<th class='parameter-setting'>" . htmlspecialchars($standard[$index]) . "</th>";

                    foreach ($models as $key => $model) {

                            $fieldName = strtolower(str_replace(" ", "_", $model)) . "_" . $fields[$index];
                            $formatted_value = formatValue($article[$fieldName]); 
                            echo "<td>$formatted_value</td>";
                        }
                            echo "</tr>";

                        } ?>

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
