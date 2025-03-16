<?php
if (!isset($_GET['selectedUnit'])) {
    $article_trane_1 = null;
    $article_trane_2 = null;
    $article_trane_3 = null;
    $article_hitachi_1 = null;
    $article_hitachi_2 = null;
    $article_hitachi_3 = null;
    }

// For view-all-chiller.php
// For Trane articles
if (isset($article_67bopet_trane_1)) {
    $article_trane_1 = $article_67bopet_trane_1;
}

if (isset($article_67bopet_trane_2)) {
    $article_trane_2 = $article_67bopet_trane_2;
}

if (isset($article_67bopet_trane_3)) {
    $article_trane_3 = $article_67bopet_trane_3;
}

// For Hitachi articles
if (isset($article_67bopet_hitachi_1)) {
    $article_hitachi_1 = $article_67bopet_hitachi_1;
}

if (isset($article_67bopet_hitachi_2)) {
    $article_hitachi_2 = $article_67bopet_hitachi_2;
}

if (isset($article_67bopet_hitachi_3)) {
    $article_hitachi_3 = $article_67bopet_hitachi_3;
}


// For verifikasi query
if(!isset($unit_trane)){
    $area = 'chiller';
    include 'verification-form.php';
}

?>

<h3>Chiller Trane</h3>
    <?php if ($article_trane_1 === null && $article_trane_2 === null && $article_trane_3 === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>
        <?php 
                if (isset($_GET['selectedUnit'])){
                    $unit_trane = 'chiller_trane_67bopet';
                    echo '<div class="verif">';
                     include 'verification-show.php';
                     echo '</div>';
                }
            ?>
                
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

            <tr class="head">
                <td>Standard</td>
                <td colspan="3"></td>
                <td colspan="3">&lt;20</td>
                <td colspan="3">6~13</td>
                <td colspan="3">27~37</td>
                <td colspan="3">32~42</td>
                <td colspan="3">4~7</td>
                <td colspan="3">3.5~6</td>
                <td colspan="3">1~3</td>
                <td colspan="3">0.5~2.5</td>
                <td colspan="3">6~10</td>
                <td colspan="3">60~100</td>
                <td colspan="3">0~7</td>
            </tr>

        </thead>
        <thead class="head">
        <tr style="background-color:dimgray">
                <td>Uom</td>
                <td colspan="3">-</td>
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
                    "Trane 31", "Trane 32", "Trane 39", "Trane 42", "Trane 43", "Trane 44", "Trane 45"
                );

                $field_names = array(
                    "machine_status" => ["title" => "Machine Status", "param" => ""],
                    "evap_tempcel" => ["title" => "Evaporator Temp. (Cel)", "param" => "Temperature (°C)"],
                    "evap_tempcol" => ["title" => "Evaporator Temp. (Col)", "param" => "Temperature (°C)"],
                    "cond_tempin" => ["title" => "Condenser Temp. (In)", "param" => "Temperature (°C)"],
                    "cond_tempout" => ["title" => "Condenser Temp. (Out)", "param" => "Temperature (°C)"],
                    "evap_pressin" => ["title" => "Evaporator Press. (In)", "param" => "Pressure (Bar)"],
                    "evap_pressout" => ["title" => "Evaporator Press. (Out)", "param" => "Pressure (Bar)"],
                    "cond_pressin" => ["title" => "Condenser Press. (In)", "param" => "Pressure (Bar)"],
                    "cond_pressout" => ["title" => "Condenser Press. (Out)", "param" => "Pressure (Bar)"],
                    "temp_set" => ["title" => "Temperature Setting", "param" => "Temperature (°C)"],
                    "rla" => ["title" => "%RLA", "param" => "Percentage (%)"],
                    "approach_temp" => ["title" => "Approach Temp.", "param" => "Temperature (°C)"]
                );
                ?>

                <?php foreach ($trane_units as $unit) : ?>
                    <tr>
                        <th class="measure2"><?php echo htmlspecialchars($unit); ?></th>
                        <?php foreach ($field_names as $field => $metadata) : ?>
                            <?php
                            $inputName = strtolower(str_replace(' ', '', $unit)) . '_' . $field;
                            include 'indicator-chiller67trane.php';
                            $formatted_value_trane_1 = isset($article_trane_1[$inputName]) ? formatValue($article_trane_1[$inputName]) : '';
                            echo "<td $style";
                            if ($field !== 'machine_status') {
                                echo " class='clickToPlot' 
                                        data-unit='" . htmlspecialchars($unit) . "' 
                                        data-field='" . htmlspecialchars($inputName) . "' 
                                        data-title='" . htmlspecialchars($metadata['title']) . "' 
                                        data-param='" . htmlspecialchars($metadata['param']) . "' 
                                        data-table='chiller_trane_67bopet'
                                        data-shift='1' ";
                            }
                            echo ">$formatted_value_trane_1</td>";
                            $article_trane_1[$inputName] = null;
                        
                            include 'indicator-chiller67trane.php';
                            $formatted_value_trane_2 = isset($article_trane_2[$inputName]) ? formatValue($article_trane_2[$inputName]) : '';
                            echo "<td $style";
                            if ($field !== 'machine_status') {
                                echo " class='clickToPlot' 
                                        data-unit='" . htmlspecialchars($unit) . "' 
                                        data-field='" . htmlspecialchars($inputName) . "' 
                                        data-title='" . htmlspecialchars($metadata['title']) . "' 
                                        data-param='" . htmlspecialchars($metadata['param']) . "' 
                                        data-table='chiller_trane_67bopet'
                                        data-shift='2' ";
                            }
                            echo ">$formatted_value_trane_2</td>";
                            $article_trane_2[$inputName] = null;
                        
                            include 'indicator-chiller67trane.php';
                            $formatted_value_trane_3 = isset($article_trane_3[$inputName]) ? formatValue($article_trane_3[$inputName]) : '';
                            echo "<td $style";
                            if ($field !== 'machine_status') {
                                echo " class='clickToPlot' 
                                        data-unit='" . htmlspecialchars($unit) . "' 
                                        data-field='" . htmlspecialchars($inputName) . "' 
                                        data-title='" . htmlspecialchars($metadata['title']) . "' 
                                        data-param='" . htmlspecialchars($metadata['param']) . "' 
                                        data-table='chiller_trane_67bopet'
                                        data-shift='3' ";
                            }
                            echo ">$formatted_value_trane_3</td>";
                            ?>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>

                <tr style="border-top: 3px solid black;">
                    <th class="measure2" rowSpan="2" style="border-right:none">Entry By</th>
                    <th colspan="5" class="shift">Shift 1</th>
                    <th colspan="5" class="shift">Shift 2</th>
                    <th colspan="5" class="shift">Shift 3</th>
                    <td colspan="21" class="blank"></td>
                            
                </tr>
                <tr>
                    <td colspan="5" style="height:32px;" class="pic">
                        <?php echo isset($article_trane_1['pic']) ? $article_trane_1['pic'] : '' ?><br>
                        <?php echo isset($article_trane_1['time']) ? $article_trane_1['time'] : '' ?>
                    </td>
                    <td colspan="5" style="height:32px;" class="pic">
                        <?php echo isset($article_trane_2['pic']) ? $article_trane_2['pic'] : '' ?><br>
                        <?php echo isset($article_trane_2['time']) ? $article_trane_2['time'] : '' ?>
                    </td>
                    <td colspan="5" style="height:32px;" class="pic">
                        <?php echo isset($article_trane_3['pic']) ? $article_trane_3['pic'] : '' ?><br>
                        <?php echo isset($article_trane_3['time']) ? $article_trane_3['time'] : '' ?>
                    </td>
                    <td colspan="21" class="blank"></td>
                </tr>
                <tr>
                    <th class="measure2">Notes</th>
                    <td colspan="5" style="height:32px;" class="note">
                        <?php echo isset($article_trane_1['note']) ? $article_trane_1['note'] : '' ?>
                    </td>
                    <td colspan="5" style="height:32px;" class="note">
                        <?php echo isset($article_trane_2['note']) ? $article_trane_2['note'] : '' ?>
                    </td>
                    <td colspan="5" style="height:32px;" class="note">
                        <?php echo isset($article_trane_3['note']) ? $article_trane_3['note'] : '' ?>
                    </td>
                    <td colspan="21" class="blank"></td>
                </tr>


                </tbody>
                </article>
        </table>
        <span class="legalDoc" style="margin-top: -25px;">H1-OCCT-14-24R0</span><br><br>
        <?php endif; ?>
        <h3> Chiller Hitachi</h3>
        <?php if ($article_hitachi_1 === null && $article_hitachi_2 === null && $article_hitachi_3 === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>
                
<table>
    <thead>
            <tr>
            <th rowspan="2" colspan="2">DESCRIPTION</th>
            <th rowspan="2" colspan="3">MACHINE STATUS</th>
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

            <tr class="head">
                <td colspan="2">Standard</td>
                <td colspan="3"></td>
                <td colspan="3">&lt;2.45</td>
                <td colspan="3">&lt;20</td>
                <td colspan="3">5</td>
                <td colspan="3">27~37</td>
                <td colspan="3">32~42</td>
                <td colspan="3">5~10</td>
                <td colspan="3">1~2</td>
                <td colspan="3">4~7</td>
                <td colspan="3">3.5~6</td>
                <td colspan="3">1~3</td>
                <td colspan="3">0.5~2.5</td>
            </tr>

        </thead>
        <thead class="head">
        <tr style="background-color:dimgray">
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
            $models = array("hitachi27", "hitachi34", "hitachi35");
            $categories = array("c1", "c2");
            $modelNames = array("Hitachi 27", "Hitachi 34", "Hitachi 35");
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
            ?>
            <?php foreach ($models as $key => $model) : ?>
                <tr>
                    <th rowspan='2' class='measure2'><?php echo ucfirst($modelNames[$key]); ?></th>
            
                    <?php foreach ($categories as $index => $category) : ?>
                        <th class='parameter-setting'><?php echo ucfirst($categoryNames[$index]); ?></th>
                        <?php foreach ($fields as $index => $field) : ?>
                            <?php
                            $inputName = $model  . $category . "_" . $field;
                            $rowSpan = ($index === 6 || $index === 7) ? "rowspan='2'" : "";
                            $inputName = ($index === 6 || $index === 7) ? $model . "_" . $field : $inputName;
                            if ($category === "c2" && ($field === "temp_set" || $field === "onoff_diff")) {
                                continue;
                            }
                            ?>
                            <?php
                                include 'indicator-chiller67hitachi.php';
                                $formatted_value_hitachi_1 = isset($article_hitachi_1[$inputName]) ? formatValue($article_hitachi_1[$inputName]) : '';
                                echo "<td $rowSpan $style>$formatted_value_hitachi_1</td>";
                                $article_hitachi_1[$inputName] = null;
                                include 'indicator-chiller67hitachi.php';
                                $formatted_value_hitachi_2 = isset($article_hitachi_2[$inputName]) ? formatValue($article_hitachi_2[$inputName]) : '';
                                echo "<td $rowSpan $style>$formatted_value_hitachi_2</td>";
                                $article_hitachi_2[$inputName] = null;
                                include 'indicator-chiller67hitachi.php';
                                $formatted_value_hitachi_3 = isset($article_hitachi_3[$inputName]) ? formatValue($article_hitachi_3[$inputName]) : '';
                                echo "<td $rowSpan $style>$formatted_value_hitachi_3</td>";
                            ?>
                        <?php endforeach; ?>
                        </tr>
                        <tr>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
            <tr style="border-top: 3px solid black;">
                    <th class="measure2" rowSpan="2" style="border-right:none" colspan="2">Entry By</th>
                    <th colspan="5" class="shift">Shift 1</th>
                    <th colspan="5" class="shift">Shift 2</th>
                    <th colspan="5" class="shift">Shift 3</th>
                    <td colspan="21" class="blank"></td>
                            
                </tr>
                <tr>
                    <td colspan="5" style="height:32px;" class="pic">
                        <?php echo isset($article_hitachi_1['pic']) ? $article_hitachi_1['pic'] : '' ?><br>
                        <?php echo isset($article_hitachi_1['time']) ? $article_hitachi_1['time'] : '' ?>
                    </td>
                    <td colspan="5" style="height:32px;" class="pic">
                        <?php echo isset($article_hitachi_2['pic']) ? $article_hitachi_2['pic'] : '' ?><br>
                        <?php echo isset($article_hitachi_2['time']) ? $article_hitachi_2['time'] : '' ?>
                    </td>
                    <td colspan="5" style="height:32px;" class="pic">
                        <?php echo isset($article_hitachi_3['pic']) ? $article_hitachi_3['pic'] : '' ?><br>
                        <?php echo isset($article_hitachi_3['time']) ? $article_hitachi_3['time'] : '' ?>
                    </td>
                    <td colspan="21" class="blank"></td>
                </tr>
                <tr>
                    <th class="measure2" colspan="2">Notes</th>
                    <td colspan="5" style="height:32px;" class="note">
                        <?php echo isset($article_hitachi_1['note']) ? $article_hitachi_1['note'] : '' ?>
                    </td>
                    <td colspan="5" style="height:32px;" class="note">
                        <?php echo isset($article_hitachi_2['note']) ? $article_hitachi_2['note'] : '' ?>
                    </td>
                    <td colspan="5" style="height:32px;" class="note">
                        <?php echo isset($article_hitachi_3['note']) ? $article_hitachi_3['note'] : '' ?>
                    </td>
                    <td colspan="21" class="blank"></td>
                </tr>
                </tbody>
                </article>
        </table>
        <span class="legalDoc" style="margin-top: -25px;">H1-OCCH-17-24R0</span><br><br>
        <?php endif; ?>