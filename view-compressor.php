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

    <h2>COMPRESSOR LINE</h2>
    <?php if ($article === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>

    
        <table>
            <thead>
            <tr>
            <th>PARAMETER</th>
            <th>Uom</th>
            <th>STANDARD</th>
            <th>COMP. KAESER 19</th>
            <th>COMP.  BOGE 01 (26)</th>
            <th>COMP.  BOGE 02 (27)</th>
            <th>COMP. KAESER 22</th>
            <th>COMP. SULLAIR 18</th>
            <th>COMP. SULLAIR 20</th>
            <th>COMP. SULLAIR 21</th>
            <th>COMP. SULLAIR 23</th>
            <th>COMP. SULLAIR 24</th>
            <th>COMP. SULLAIR 25</th>
            <th>COMP. AUGUST 28</th>
            <th>COMP. AUGUST 29</th>
            <th>COMP. AUGUST 30</th>
            <th>AD. SULLAIR 34</th>
            </tr>
            </thead>
                <article>
                <tbody>
                <?php
                $models = array("compkaeser19", "compboge01", "boge02", "kaeser22", "compsullair18", "compsullair20", "compsullair21", "compsullair23", "compsullair24", "compsullair25", "compaugust28", "compaugust29", "compaugust30", "adsullair34");
                $parameters = array("Air Dischrg. Press", "Air Dishrg. Temp", "Separator Δ Press.", "Oil Level (%Botm SG)", "Vibration", "Noise", "Running Hours", "Load Hours", "Δ Voltage", "Current", "Alarm");
                $uom = array("Bar", "Bar", "Bar", "-", "-", "-", "H", "H", "%", "A", "-");
                $standard = array("6.4 ~ 8.0", "80 ~ 110", "0 ~ 0.8", "1/2 ~ 3/4", "H", "H", "-", "-", "5 ~ 15", "80 ~ 150", "TA");
                $fields = array("disc_press", "disc_temp", "separator_press", "oil_level", "vibration", "noise", "run_hours", "load_hours", "voltage", "current", "alarm");
                

                    foreach ($parameters as $index => $parameter) {
                    echo "<tr>";
                    echo "<th style='width: 40px' class='measure2'>" . htmlspecialchars($parameter) . "</th>";
                    echo "<th style='width:25px' class='parameter'>" . htmlspecialchars($uom[$index]) . "</th>";
                    echo "<th class='parameter-setting'>" . htmlspecialchars($standard[$index]) . "</th>";

                    foreach ($models as $key => $model) {
                        // Skip condition
                        if ((($key === 0 || $key === 1 || $key === 2 || $key === 3 || $key === 13) && ($index === 8 || $index === 9)) || 
                            (($key !== 4 && $key !== 8 && $key !== 9) && ($index === 10)) || (($key === 13) && ($index === 6 || $index === 7))){
                            echo "<td></td>";
                            continue;
                        }

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
