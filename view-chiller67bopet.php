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

    <h2>CHILLER OPP 6~7 & BOPET</h2>
    <h3>Chiller Trane</h3>
    <?php if ($article_trane_1 === null && $article_trane_2 === null && $article_trane_3 === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>

    
    <table>
        <thead>
            <tr>
                <th rowspan="2">DESCRIPTION</th>
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

        </thead>
        <thead class="head">
            <tr>
                <td>Uom</td>
                <td colspan="3">°C</td>
                <td colspan="3">°C</td>
                <td colspan="3">°C</td>
                <td colspan="3">°C</td>
                <td colspan="3">Bar</td>
                <td colspan="3">Bar</td>
                <td colspan="3">Bar</td>
                <td colspan="3">Bar</td>
                <td colspan="3">°C</td>
                <td colspan="3">%</td>
                <td colspan="3">°C</td>
            </tr>
            <tr>
                <td>Shift</td>
                <?php
                $sets = 11;

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
                        "Trane 31", "Trane 32", "Trane 39", "Trane 42", "Trane 43", "Trane 44", "Trane 45"
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
        <h3> Chiller Hitachi</h3>
        <?php if ($article_hitachi_1 === null && $article_hitachi_2 === null && $article_hitachi_3 === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>

    
    <table>
    <thead>
            <tr>
            <th rowspan="2" colspan="2">DESCRIPTION</th>
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
                $sets = 11;

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
            $models = array("hitachi27", "hitachi34", "hitachi35");
            $categories = array("c1", "c2");
            $modelNames = array("Hitachi 27", "Hitachi 34", "Hitachi 35");
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
                            $fieldName = $model  . $category . "_" . $field;
                            $rowSpan = ($index === 5 || $index === 6) ? "rowspan='2'" : "";
                            $inputName = ($index === 5 || $index === 6) ? $model . "_" . $field : $fieldName;
                            if ($category === "c2" && ($field === "temp_set" || $field === "onoff_diff")) {
                                continue;
                            }
                            ?>
                            <?php
                                $formatted_value_hitachi_1 = formatValue($article_hitachi_1[$inputName]);
                                echo "<td $rowSpan>$formatted_value_hitachi_1</td>";

                                $formatted_value_hitachi_2 = formatValue($article_hitachi_2[$inputName]);
                                echo "<td $rowSpan>$formatted_value_hitachi_2</td>";

                                $formatted_value_hitachi_3 = formatValue($article_hitachi_3[$inputName]);
                                echo "<td $rowSpan>$formatted_value_hitachi_3</td>";
                            ?>
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
