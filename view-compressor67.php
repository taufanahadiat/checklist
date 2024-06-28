    <h2>COMPRESSOR LINE <?php echo $line; ?></h2>
    <?php if ($article_1 === null && $article_2 === null && $article_3 === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>

    
        <table>
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
                        echo "<th>" . $j . "</th>";
                    }
                }
            ?>
            </tr>
            </thead>
                <article>
                <tbody>
                <?php
                $models = array("compkaeser19", "compboge01", "boge02", "kaeser22",  "compsullair20", "compsullair21", "compsullair23", "compaugust28", "compaugust29", "compaugust30");
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
                        // Skip condition
                        if ((($key === 0 || $key === 1 || $key === 2 || $key === 3 || $key === 13) && ($index === 8 || $index === 9)) || 
                            (($key !== 4 && $key !== 8 && $key !== 9) && ($index === 10)) || (($key === 13) && ($index === 6 || $index === 7))){
                            echo "<td class='blank'></td>";
                            echo "<td class='blank'></td>";
                            echo "<td class='blank'></td>";
                            continue;
                        }

                            $fieldName = strtolower(str_replace(" ", "_", $model)) . "_" . $fields[$index];
                                $formatted_value_1 = formatValue($article_1[$fieldName]);
                                echo "<td>$formatted_value_1</td>";

                                $formatted_value_2 = formatValue($article_2[$fieldName]);
                                echo "<td>$formatted_value_2</td>";

                                $formatted_value_3 = formatValue($article_3[$fieldName]);
                                echo "<td>$formatted_value_3</td>";
                        
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
