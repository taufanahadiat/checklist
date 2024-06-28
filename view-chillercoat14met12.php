<?php

include 'database.php';
$tanggal = "" . $_GET['selectedDate'];
$unit_trane = "" . $_GET['selectedUnit'];
$unit_hitachi = "" . $_GET['selectedUnit2']; // Assuming you get the selected Hitachi unit from somewhere

include 'request-view-chiller.php';
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

    <h2>CHILLER COAT1~4 & MET 1~2</h2>
    <h3>Chiller Hitachi</h3>
    <?php if ($article_hitachi_1 === null && $article_hitachi_2 === null && $article_hitachi_3 === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>

    
    <table>
    <thead>
            <tr>
            <th rowspan="6" colspan="2">DESCRIPTION</th>
            <th rowspan="6" colspan="3">MACHINE STATUS</th>
            <th colspan="3">DISCHARGE</th>
            <th colspan="6">EVAPORATOR TEMP.</th>
            <th colspan="6">CONDENSER TEMP.</th>
            <th colspan="3">TEMP.</th>
            <th colspan="3">ON/OFF</th>
            <th colspan="6">EVAPORATOR PRESS.</th>
            <th colspan="6">CONDENSER PRESS.</th>
            </tr>

            <tr class="head">
                <td colspan="3">PRESS</td>
                <td colspan="3">CEL</td>
                <td colspan="3">COL</td>
                <td colspan="3">IN</td>
                <td colspan="3">OUT</td>
                <td colspan="3">SETTING</td>
                <td colspan="3">DIFF.</td>
                <td colspan="3">IN</td>
                <td colspan="3">OUT</td>
                <td colspan="3">IN</td>
                <td colspan="3">OUT</td>
            </tr>

        </thead>
        <thead class="head">
            <tr>
                <td colspan="2">Uom</td>
                <td colspan="3">-</td>
                <td colspan="3">Mpa</td>
                <td colspan="3">°C</td>
                <td colspan="3">°C</td>
                <td colspan="3">°C</td>
                <td colspan="3">°C</td>
                <td colspan="3">°C</td>
                <td colspan="3">°C</td>
                <td colspan="3">Bar</td>
                <td colspan="3">Bar</td>
                <td colspan="3">Bar</td>
                <td colspan="3">Bar</td>
            </tr>
            <tr>
                <td colspan="2">Shift</td>
                <?php
                $sets = 12;

                for ($i = 0; $i < $sets; $i++) {
                    for ($j = 1; $j <= 3; $j++) {
                        echo "<td>" . $j . "</td>";
                    }
                }
            ?>
            </tr>
        </thead>
                <article>
                <tbody>
                <?php
    $models = array("bitzer31", "clima48", "hitachi30", "hitachi36");
    $categories = array("c1", "c2");
    $modelNames = array("Bitzer", "Clima 48", "Hitachi 30", "Hitachi 36");
    $categoryNames = array("C#1", "C#2");
    
    $fields = array(
        "machine_status",
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

    foreach ($models as $key => $model) {
        echo "<tr>";
        if ($model === "clima48") {
            echo "<th colspan='2' class='measure2'>" . ucfirst($modelNames[$key]) . "</th>";
        } else {
            echo "<th rowspan='2' class='measure2'>" . ucfirst($modelNames[$key]) . "</th>";
        }    
        foreach ($categories as $index => $category) {
            if ($model === "clima48" && $category === "c2") {
                continue; // Skip this category for clima48 model
            }

            if ($model !== "clima48") {
                echo "<th class='parameter-setting'>" . ucfirst($categoryNames[$index]) . "</th>";
            }            
            foreach ($fields as $index => $field) {
                if ($model === "clima48") {
                    $inputName = $model . "_" . $field;                
                    $formatted_value_hitachi_1 = formatValue($article_hitachi_1[$inputName]);
                    echo "<td $rowSpan>$formatted_value_hitachi_1</td>";
    
                    $formatted_value_hitachi_2 = formatValue($article_hitachi_2[$inputName]);
                    echo "<td $rowSpan>$formatted_value_hitachi_2</td>";
    
                    $formatted_value_hitachi_3 = formatValue($article_hitachi_3[$inputName]);
                    echo "<td $rowSpan>$formatted_value_hitachi_3</td>";
                    continue; // Skip the rest of the loop iteration
                }
                $fieldName = $model . $category . "_" . $field;
                $rowSpan = ($index !== 0 && $index !== 1 && $model !== "bitzer31") ? "rowspan='2'" : "";
                $inputName = ($index !== 0 && $index !== 1 && $model !== "bitzer31") ? $model . "_" . $field : $fieldName;                
                if ($model !== "bitzer31" && $category === "c2" && $field !== "disc_press" && $field !== "machine_status") {
                    continue;
                }
                $formatted_value_hitachi_1 = formatValue($article_hitachi_1[$inputName]);
                echo "<td $rowSpan>$formatted_value_hitachi_1</td>";

                $formatted_value_hitachi_2 = formatValue($article_hitachi_2[$inputName]);
                echo "<td $rowSpan>$formatted_value_hitachi_2</td>";

                $formatted_value_hitachi_3 = formatValue($article_hitachi_3[$inputName]);
                echo "<td $rowSpan>$formatted_value_hitachi_3</td>";
            }
            echo "</tr><tr>";
        }
        echo "</tr>";
    }
    ?>


                </tbody>
                </article>
        </table>
        <?php endif; ?>
        <h3> Chiller Trane</h3>
        <?php if ($article_trane_1 === null && $article_trane_2 === null && $article_trane_3 === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>

    
    <table>
    <thead>
            <tr>
                <th rowspan="2">DESCRIPTION</th>
                <th rowspan="2" colspan="3">MACHINE STATUS</th>
                <th colspan="6">EVAPORATOR TEMP.</th>
                <th colspan="6">CONDENSER TEMP.</th>
                <th colspan="6">EVAPORATOR PRESS.</th>
                <th colspan="6">CONDENSER PRESS.</th>
                <th colspan="3">TEMP.</th>
                <th colspan="3" rowspan="2">%RLA</th>
                <th colspan="3">APPROACH</th>
            </tr>
            <tr class="head">
                <td colspan="3">CEL</td>
                <td colspan="3">COL</td>
                <td colspan="3">IN</td>
                <td colspan="3">OUT</td>
                <td colspan="3">IN</td>
                <td colspan="3">OUT</td>
                <td colspan="3">IN</td>
                <td colspan="3">OUT</td>
                <td colspan="3">SETTING</td>
                <td colspan="3">TEMP</td>
            </tr>
            <tr>
                <td>Shift</td>
                <?php
                $sets = 12;

                for ($i = 0; $i < $sets; $i++) {
                    for ($j = 1; $j <= 3; $j++) {
                        echo "<td>" . $j . "</td>";
                    }
                }
            ?>
            </tr>
        </thead>

                <article>
                <tbody>
                <?php
                    $trane_units = array(
                        "Trane 46"
                    );
                
                    $field_names = array(
                        "machine_status", "evap_tempcel", "evap_tempcol", "cond_tempin", "cond_tempout",
                        "evap_pressin", "evap_pressout", "cond_pressin", "cond_pressout",
                        "temp_set", "rla", "approach_temp"
                    );
                ?>

                <?php foreach ($trane_units as $unit) : ?>
                    <tr>
                        <th class="measure2"><?php echo $unit; ?></th>
                        <?php foreach ($field_names as $field) : ?>
                            <?php
                                $fieldName = strtolower(str_replace(' ', '', $unit)) . '_' . $field; 
                                $formatted_value_trane_1 = formatValue($article_trane_1[$fieldName]);
                                echo "<td>$formatted_value_trane_1</td>";

                                $formatted_value_trane_2 = formatValue($article_trane_2[$fieldName]);
                                echo "<td>$formatted_value_trane_2</td>";

                                $formatted_value_trane_3 = formatValue($article_trane_3[$fieldName]);
                                echo "<td>$formatted_value_trane_3</td>";
                            ?>
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
