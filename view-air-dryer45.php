    <h2>AIR DRYER LINE <?php echo $line; ?></h2>
    <?php if ($article_1 === null && $article_2 === null && $article_3 === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>

    
        <table>
            <thead>
            <tr>
            <th>PARAMETER</th>
            <th>Uom</th>
            <th>STANDARD</th>
            <th colspan="3">AD. SULLAIR 23</th>
            <th colspan="3">AD. SULLAIR 24</th>
            <th colspan="3">AD. SULLAIR 27</th>
            <th colspan="3">AD. SULLAIR 33</th>
            <th colspan="3">AD. SULLAIR 34</th>
            <th colspan="3">AD. AUGUST 28</th>
            <th colspan="3">AD. AUGUST 29</th>
            <th colspan="3">AD. AUGUST 30</th>
            <th colspan="3">AD. AUGUST 31</th>
            <th colspan="3">AD. AUGUST 32</th>
            </tr>
            <tr>
                <th colspan="3">Shift</th>
                <?php
                $sets = 10;

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
                $models = array("adsullair23", "adsullair24", "adsullair27", "adsullair33", "adsullair34", "adaugust28", "adaugust29", "adaugust30", "adaugust31", "adaugust32");
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