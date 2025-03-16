<?php
        $article_1 = null;
        $article_2 = null;
        $article_3 = null;

if (isset($article_comp67_1)) {
    $article_1 = $article_comp67_1;
}

if (isset($article_comp67_2)) {
    $article_2 = $article_comp67_2;
}

if (isset($article_comp67_3)) {
    $article_3 = $article_comp67_3;
}
?>

<?php if ($article_1 === null && $article_2 === null && $article_3 === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>
            <br><br>
            <?php 
                if (isset($_GET['selectedLine'])){
                    $unit = 'compressor';
                    $line = '4&5';
                    echo '<div class="verif">';
                     include 'verification-show.php';
                     echo '</div>';
                }
            ?>
                    
<table style="margin-left:0; margin-right:0; float:left;">
            <thead>
            <tr>
            <th>PARAMETER</th>
            <th>Uom</th>
            <th>STANDARD</th>
            <th colspan="3">COMP. SULLAIR 18</th>
            <th colspan="3">COMP. SULLAIR 24</th>
            <th colspan="3">COMP. SULLAIR 25</th>
            </tr>
            <tr>
                <th colspan="3">Shift</th>
                <?php
                $sets = 3;

                for ($i = 0; $i < $sets; $i++) {
                    for ($j = 1; $j <= 3; $j++) {
                        echo "<th style='width:8%;'>" . $j . "</th>";
                    }
                }
            ?>
            </tr>
            </thead>
                <article>
                <tbody>
                <?php
                $models = array("compsullair18", "compsullair24", "compsullair25");
                $parameters = array("Machine Status", "Air Dischrg. Press", "Air Dishrg. Temp", "Separator Δ Press.", "Oil Level (%Botm SG)", "Vibration", "Noise", "Running Hours", "Load Hours", "Δ Voltage", "Current", "Alarm");
                $uom = array("-", "Bar", "°C", "Bar", "-", "-", "-", "H", "H", "%", "A", "-");
                $standard = array("-", "6.4 ~ 8.0", "80 ~ 110", "0 ~ 0.8", "1/2 ~ 3/4", "H", "H", "-", "-", "5 ~ 15", "80 ~ 150", "TA");
                $fields = array("machine_status", "disc_press", "disc_temp", "separator_press", "oil_level", "vibration", "noise", "run_hours", "load_hours", "voltage", "current", "alarm");
                

                    foreach ($parameters as $index => $parameter) {
                    echo "<tr>";
                    echo "<th style='width: 40px' class='measure2'>" . htmlspecialchars($parameter) . "</th>";
                    echo "<th style='width:25px' class='parameter'>" . htmlspecialchars($uom[$index]) . "</th>";
                    echo "<th class='parameter-setting'>" . htmlspecialchars($standard[$index]) . "</th>";

                    foreach ($models as $key => $model) {
                            $fieldName = strtolower(str_replace(" ", "_", $model)) . "_" . $fields[$index];
                            include 'indicator-compressor.php';
                            $formatted_value_1 = isset($article_1[$fieldName]) && $article_1[$fieldName] !== null ? formatValue($article_1[$fieldName]) : '';                    
                            echo "<td $style>$formatted_value_1</td>";
                            $article_1[$fieldName] = null;
                            include 'indicator-compressor.php';
                            $formatted_value_2 = isset($article_2[$fieldName]) && $article_2[$fieldName] !== null ? formatValue($article_2[$fieldName]) : '';                    
                            echo "<td $style>$formatted_value_2</td>";
                            $article_2[$fieldName] = null;
                            include 'indicator-compressor.php';
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

                </tr>
                </tbody>
                </article>
        </table>
        <span class="legalDoc" style="margin-top: -25px;">H1-OCMC-24-24R0</span><br><br>
        <?php endif; ?>


