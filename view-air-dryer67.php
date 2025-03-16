<?php

$article_1 = null;
$article_2 = null;
$article_3 = null;

if (isset($article_comp67_1)) {
    $article_1 = $article_airDryer67_1;
}

if (isset($article_airDryer67_2)) {
    $article_2 = $article_airDryer67_2;
}

if (isset($article_airDryer67_3)) {
    $article_3 = $article_airDryer67_3;
}
?>

<?php if ($article_1 === null && $article_2 === null && $article_3 === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>
        <table style="display:inline-table;">
            <thead>
            <tr>
            <th>PARAMETER</th>
            <th>Uom</th>
            <th>STANDARD</th>
            <th colspan="3">AD. SULLAIR 22</th>
            <th colspan="3">AD. SULLAIR 35</th>
            <th colspan="3">BOGE 01</th>
            <th colspan="3">BOGE 02</th>
            </tr>
            <tr>
                <th colspan="3">Shift</th>
                <?php
                $sets = 4;

                for ($i = 0; $i < $sets; $i++) {
                    for ($j = 1; $j <= 3; $j++) {
                        echo "<th>" . $j . "</th>";
                    }
                }
            ?>
            </tr>
            </thead>
                <article>
                <tbody>
                <?php
                $models = array("sullair22", "adsullair35", "boge01", "boge02");
                $parameters = array("Machine Status", "Dew Point Temp.", "Ref. Low Press", "Pre Filter", "After Filter", "Auto Drain Solenoid", "Vibration");
                $uom = array("-", "°C", "Bar", "-", "-", "-", "-");
                $standard = array("-", "2 ~ 10", "4 ~ 20", "HJ", "HJ", "B", "H ~ S");
                $fields = array("machine_status", "dewpoint_temp", "reflow_press", "pre_filter", "after_filter", "autodrain_solenoid", "vibration");
                

                    foreach ($parameters as $index => $parameter) {
                    echo "<tr>";
                    echo "<th style='width: 40px' class='measure2'>" . htmlspecialchars($parameter) . "</th>";
                    echo "<th style='width:25px' class='parameter'>" . htmlspecialchars($uom[$index]) . "</th>";
                    echo "<th class='parameter-setting'>" . htmlspecialchars($standard[$index]) . "</th>";

                    foreach ($models as $key => $model) {
                        $fieldName = strtolower(str_replace(" ", "_", $model)) . "_" . $fields[$index];
                        include 'indicator-air-dryer.php';
                        $formatted_value_1 = isset($article_1[$fieldName]) && $article_1[$fieldName] !== null ? formatValue($article_1[$fieldName]) : '';                    
                        echo "<td $style>$formatted_value_1</td>";
                        $article_1[$fieldName] = null;
                        include 'indicator-air-dryer.php';
                        $formatted_value_2 = isset($article_2[$fieldName]) && $article_2[$fieldName] !== null ? formatValue($article_2[$fieldName]) : '';                    
                        echo "<td $style>$formatted_value_2</td>";
                        $article_2[$fieldName] = null;
                        include 'indicator-air-dryer.php';
                        $formatted_value_3 = isset($article_3[$fieldName]) && $article_3[$fieldName] !== null ? formatValue($article_3[$fieldName]) : '';                    
                        echo "<td $style>$formatted_value_3</td>";
                        }
                            echo "</tr>";

                        } ?>
            <tr style="border-top: 3px solid black;">
                    <th class="measure2" rowSpan="2" style="border-right:none" colspan="3">Entry By</th>
                    <th colspan="3" class="shift">Shift 1</th>
                    <th colspan="3" class="shift">Shift 2</th>
                    <th colspan="3" class="shift">Shift 3</th>
                    <td colspan="21" class="blank"></td>  
                </tr>
                <tr>
                <td colspan="3" style="height:32px;" class="pic">
                    <?php echo isset($article_1['pic']) && $article_1['pic'] !== null ? $article_1['pic'] : ''; ?>
                    <br>
                    <?php echo isset($article_1['time']) && $article_1['time'] !== null ? $article_1['time'] : ''; ?>
                </td>
                <td colspan="3" style="height:32px;" class="pic">
                    <?php echo isset($article_2['pic']) && $article_2['pic'] !== null ? $article_2['pic'] : ''; ?>
                    <br>
                    <?php echo isset($article_2['time']) && $article_2['time'] !== null ? $article_2['time'] : ''; ?>
                </td>
                <td colspan="3" style="height:32px;" class="pic">
                    <?php echo isset($article_3['pic']) && $article_3['pic'] !== null ? $article_3['pic'] : ''; ?>
                    <br>
                    <?php echo isset($article_3['time']) && $article_3['time'] !== null ? $article_3['time'] : ''; ?>
                </td>
                <td colspan="21" class="blank"></td>
                    
                </tr>
                <tr>
                <th class="measure2" colspan="3">Notes</th>
                <td colspan="3">
                    <?php echo isset($article_1['note']) && $article_1['note'] !== null ? $article_1['note'] : ''; ?>
                </td>
                <td colspan="3">
                    <?php echo isset($article_2['note']) && $article_2['note'] !== null ? $article_2['note'] : ''; ?>
                </td>
                <td colspan="3">
                    <?php echo isset($article_3['note']) && $article_3['note'] !== null ? $article_3['note'] : ''; ?>
                </td>

                <td colspan="21" class="blank"></td>  
                </tr>

                </tbody>
                </article>
        </table>
        <span class="legalDoc" style="margin-top: -25px;">H1-OCAD-25-24R0</span><br><br>
        <?php endif; ?>