    <h2>AIR DRYER LINE <?php echo $line; ?></h2>
    <?php include 'pilih-tanggal.php'; ?>
    <?php if ($article_1 === null && $article_2 === null && $article_3 === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>
        <?php include 'legend-air-dryer.php'?>
        <?php include 'verification-form.php'?>
        <table style="width:70%">
            <thead>
            <tr>
            <th>PARAMETER</th>
            <th>Uom</th>
            <th>STANDARD</th>
            <th colspan="3">SULLAIR 22</th>
            <th colspan="3">BOGE 01</th>
            <th colspan="3">BOGE 02</th>
            </tr>
            <tr>
                <th colspan="3">Shift</th>
                <?php
                $sets = 3;

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
                $models = array("sullair22", "boge01", "boge02");
                $parameters = array("Machine Status", "Dew Point Temp.", "Ref. Low Press", "Pre Filter", "After Filter", "Auto Drain Solenoid", "Vibration");
                $uom = array("-", "°C", "Bar", "-", "-", "-", "-");
                $standard = array("-", "2 ~ 10", "4 ~ 10", "HJ", "HJ", "B", "H ~ S");
                $fields = array("machine_status", "dewpoint_temp", "reflow_press", "pre_filter", "after_filter", "autodrain_solenoid", "vibration");
                

                    foreach ($parameters as $index => $parameter) {
                    echo "<tr>";
                    echo "<th style='width: 40px' class='measure2'>" . htmlspecialchars($parameter) . "</th>";
                    echo "<th style='width:25px' class='parameter'>" . htmlspecialchars($uom[$index]) . "</th>";
                    echo "<th class='parameter-setting'>" . htmlspecialchars($standard[$index]) . "</th>";

                    foreach ($models as $key => $model) {

                        $fieldName = strtolower(str_replace(" ", "_", $model)) . "_" . $fields[$index];
                        include 'indicator-air-dryer.php';
                        $formatted_value_1 = formatValue($article_1[$fieldName]);
                        echo "<td $style>$formatted_value_1</td>";

                        $formatted_value_2 = formatValue($article_2[$fieldName]);
                        echo "<td $style>$formatted_value_2</td>";

                        $formatted_value_3 = formatValue($article_3[$fieldName]);
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
                    <td colspan="3" style="height:32px;" class="pic"><?php echo $article_1['pic']?>&nbsp;&nbsp;<?php echo $article_1['time']?></td>
                    <td colspan="3" style="height:32px;" class="pic"><?php echo $article_2['pic']?>&nbsp;&nbsp;<?php echo $article_2['time']?></td>
                    <td colspan="3" style="height:32px;" class="pic"><?php echo $article_3['pic']?>&nbsp;&nbsp;<?php echo $article_3['time']?></td>
                </tr>
                <tr>
                <th class="measure2" colspan="3">Notes</th>
                            <td colspan="3"><?php echo $article_1['note']?></td>
                            <td colspan="3"><?php echo $article_2['note']?></td>
                            <td colspan="3"><?php echo $article_3['note']?></td>
                </tr>

                </tbody>
                </article>
        </table>
        <?php endif; ?>