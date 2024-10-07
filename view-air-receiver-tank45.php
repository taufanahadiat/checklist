    <h2>AIR RECEIVER TANK <?php echo $line; ?></h2>
    <?php include 'pilih-tanggal.php'; ?>
    <?php if ($article_1 === null && $article_2 === null && $article_3 === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>
        <?php include 'legend-air-receiver-tank.php';?>
        <?php include 'verification-form.php';?>
    
        <table>
            <thead>
            <tr>
            <th>PARAMETER</th>
            <th>Uom</th>
            <th>STANDARD</th>
            <th colspan="3">TANK 1</th>
            <th colspan="3">TANK 2</th>
            <th colspan="3">TANK 3</th>
            <th colspan="3">TANK 5</th>
            <th colspan="3">TANK 6</th>
            <th colspan="3">TANK 7</th>
            </tr>
            <tr>
                <th colspan="3">Shift</th>
                <?php
                $sets = 6;

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
                $models = array("tank1", "tank2", "tank3", "tank5", "tank6", "tank7");
                $parameters = array("Air Pressure", "Auto Drain", "Kondensat", "Kandungan Oli");
                $uom = array("Bar", "-", "-", "-");
                $standard = array("6.0 ~ 7.5", "B", "TA", "TA");
                $fields = array("air_pressure", "auto_drain", "kondensat", "kandungan_oli");


                    foreach ($parameters as $index => $parameter) {
                    echo "<tr>";
                    echo "<th style='width: 40px' class='measure2'>" . htmlspecialchars($parameter) . "</th>";
                    echo "<th style='width:25px' class='parameter'>" . htmlspecialchars($uom[$index]) . "</th>";
                    echo "<th class='parameter-setting'>" . htmlspecialchars($standard[$index]) . "</th>";

                    foreach ($models as $key => $model) {
                        $fieldName = strtolower(str_replace(" ", "_", $model)) . "_" . $fields[$index];
                        include 'indicator-air-receiver-tank.php';
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
                    <th colspan="5" class="shift">Shift 1</th>
                    <th colspan="5" class="shift">Shift 2</th>
                    <th colspan="5" class="shift">Shift 3</th>
                    <td colspan="21" class="blank"></td>
                            
                </tr>
                <tr>
                    <td colspan="5" style="height:32px;" class="pic"><?php echo $article_1['pic']?>&nbsp;&nbsp;<?php echo $article_1['time']?></td>
                    <td colspan="5" style="height:32px;" class="pic"><?php echo $article_2['pic']?>&nbsp;&nbsp;<?php echo $article_2['time']?></td>
                    <td colspan="5" style="height:32px;" class="pic"><?php echo $article_3['pic']?>&nbsp;&nbsp;<?php echo $article_3['time']?></td>
                    <td colspan="21" class="blank"></td>
                </tr>
                <tr>
                <th class="measure2" colspan="3">Note</th>
                            <td colspan="5"><?php echo $article_1['note']?></td>
                            <td colspan="5"><?php echo $article_2['note']?></td>
                            <td colspan="5"><?php echo $article_3['note']?></td>
                            <td colspan="21" class="blank"></td>
                </tr>

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
