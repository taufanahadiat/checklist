<?php

include 'database.php';
$tanggal = "" . $_GET['selectedDate'];
$unit_trane = "" . $_GET['selectedUnit'];
$unit_hitachi = "" . $_GET['selectedUnit2']; // Assuming you get the selected Hitachi unit from somewhere

// Fetch data for Trane unit
$sql_trane = "SELECT * FROM $unit_trane WHERE tanggal LIKE '%{$tanggal}%'";
$results_trane = mysqli_query($conn, $sql_trane);

if ($results_trane === false) {
    echo mysqli_error($conn);
} else {
    $article_trane = mysqli_fetch_assoc($results_trane);
}

// Fetch data for Hitachi unit
$sql_hitachi = "SELECT * FROM $unit_hitachi WHERE tanggal LIKE '%{$tanggal}%'";
$results_hitachi = mysqli_query($conn, $sql_hitachi);

if ($results_hitachi === false) {
    echo mysqli_error($conn);
} else {
    $article_hitachi = mysqli_fetch_assoc($results_hitachi);
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

    <h2>CHILLER OPP 4~5 & MET 3~4</h2>
    <h3>Chiller Trane & Clivet</h3>
    <?php if ($article_trane === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>

    
    <table>
        <thead>
            <tr>
                <th rowspan="2">DESCRIPTION</th>
                <th colspan="2">EVAPORATOR TEMP.</th>
                <th colspan="2">CONDENSER TEMP.</th>
                <th colspan="2">EVAPORATOR PRESS.</th>
                <th colspan="2">CONDENSER PRESS.</th>
                <th>TEMP.</th>
                <th rowspan="2">%RLA</th>
                <th>APPROACH</th>
            </tr>
            <tr class="head">
                <td>CEL</td>
                <td>COL</td>
                <td>IN</td>
                <td>OUT</td>
                <td>IN</td>
                <td>OUT</td>
                <td>IN</td>
                <td>OUT</td>
                <td>SETTING</td>
                <td>TEMP</td>
            </tr>

        </thead>
        <thead class="head">
            <tr>
                <td>Uom</td>
                <td>°C</td>
                <td>°C</td>
                <td>°C</td>
                <td>°C</td>
                <td>Bar</td>
                <td>Bar</td>
                <td>Bar</td>
                <td>Bar</td>
                <td>°C</td>
                <td>%</td>
                <td>°C</td>
            </tr>
                </thead>
                <article>
                <tbody>
                <?php
                    $trane_units = array(
                        "Trane 40", "Trane 41", "Clivet 47", "Clivet 49", "Clivet 50"
                    );
                
                    $field_names = array(
                        "evap_tempcel", "evap_tempcol", "cond_tempin", "cond_tempout",
                        "evap_pressin", "evap_pressout", "cond_pressin", "cond_pressout",
                        "temp_set", "rla", "approach_temp"
                    );
                ?>

                <?php foreach ($trane_units as $unit) : ?>
                    <tr>
                        <th class="measure2"><?php echo $unit; ?></th>
                        <?php foreach ($field_names as $field) : ?>
                            <?php $formatted_value = formatValue($article_trane[strtolower(str_replace(' ', '', $unit)) . '_' . $field]); ?>
                            <td><?php echo $formatted_value; ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>



                </tbody>
                </article>
        </table>
        <?php endif; ?>
        <h3> Chiller Hitachi</h3>
        <?php if ($article_hitachi === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>

    
    <table>
    <thead>
            <tr>
            <th rowspan="2" colspan="2">DESCRIPTION</th>
            <th>DISCHARGE</th>
            <th colspan="2">EVAPORATOR TEMP.</th>
            <th colspan="2">CONDENSER TEMP.</th>
            <th>TEMP.</th>
            <th>ON/OFF</th>
            <th colspan="2">EVAPORATOR PRESS.</th>
            <th colspan="2">CONDENSER PRESS.</th>
            </tr>

            <tr class="head">
                <td>PRESS</td>
                <td>CEL</td>
                <td>COL</td>
                <td>IN</td>
                <td>OUT</td>
                <td>SETTING</td>
                <td>DIFF.</td>
                <td>IN</td>
                <td>OUT</td>
                <td>IN</td>
                <td>OUT</td>
            </tr>

        </thead>
        <thead class="head">
            <tr>
                <td colspan="2">Uom</td>
                <td>Mpa</td>
                <td>°C</td>
                <td>°C</td>
                <td>°C</td>
                <td>°C</td>
                <td>°C</td>
                <td>°C</td>
                <td>Bar</td>
                <td>Bar</td>
                <td>Bar</td>
                <td>Bar</td>
            </tr>
        </thead>
                <article>
                <tbody>
            <?php
            $models = array("hitachi37", "hitachi38");
            $categories = array("c1", "c2");
            $modelNames = array("Hitachi 37", "Hitachi 38");
            $categoryNames = array("C#1", "C#2");

            $fields = array(
                "disc_press",
                "evap_tempcel",
                "evap_tempcol",
                "cond_tempin",
                "cond_tempout",
                "temp_set",
                "onoff_diff",
                "evap_pressin",
                "evap_pressout",
                "cond_pressin",
                "cond_pressout"
            );
            ?>
            <?php foreach ($models as $key => $model) : ?>
                <tr>
                    <th rowspan='2' class='measure2'><?php echo ucfirst($modelNames[$key]); ?></th>
            
                    <?php foreach ($categories as $index => $category) : ?>
                        <th class='parameter-setting'><?php echo ucfirst($categoryNames[$index]); ?></th>
                        <?php foreach ($fields as $index => $field) : ?>
                            <?php
                            $fieldName = $model . $category . "_" . $field;
                            $rowSpan = ($index !== 0) ? "rowspan='2'" : "";
                            $inputName = ($index !== 0) ? $model . "_" . $field : $fieldName;                
                            if ($category === "c2" && $field !== "disc_press") {
                                continue;
                            }                
                            ?>
                            <?php $formatted_value = formatValue($article_hitachi[$inputName]); ?>
                            <td <?php echo $rowSpan; ?>><?php echo $formatted_value; ?></td>
                        <?php endforeach; ?>
                        </tr>
                        <tr>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
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
