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

    <h2>Kebocoran Fuel Tank</h2>
    <?php if ($article === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>

    
        <table>
            <thead>
            <tr>
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

            </tr>
            </thead>
                <article>
                <tbody>
                <?php
                $times = array('8', '10', '12', '14', '16', '18', '20', '22', '0', '2', '4', '6');
                $tanks = array(
                    "HFO Day Tank" => "hfo_day_tank",
                    "LFO Day Tank" => "lfo_day_tank",
                    "HFO Storage Tank" => "hfo_storage_tank",
                    "LFO Storage Tank" => "lfo_storage_tank"
                );


                foreach ($tanks as $tank_name => $field_prefix) {
                    echo "<tr>";
                    echo "<th class='measure'>{$tank_name}</th>";
                    echo "<th class='parameter'>A/TA/RS</th>";
                    echo "<th class='parameter-setting'>-</th>";

                    foreach ($times as $time) {
                        $field_name = "{$field_prefix}_{$time}";
                        echo "<td>";
                        echo htmlspecialchars(formatValue($article[$field_name]));
                        echo "</td>";
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
