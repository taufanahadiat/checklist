<h2>AIR RECEIVER TANK LINE OPP <?php echo $line; ?></h2>
    <h4>SHIFT <?php echo $shift;?></h4>
        <table style="width: 70%;">
        <?php include 'pilih-unit-compressor.php'; ?>
            <thead>
            <tr>
            <th>PARAMETER</th>
            <th>Uom</th>
            <th>STANDARD</th>
            <th>TANK 1</th>
            <th>TANK 2</th>
            <th>TANK 3</th>
            </tr>
            </thead>
            <form method="post">
            <tbody>
            <?php
                require 'database.php';
                include 'request-view-compressor.php';
                $models = array("tank1", "tank2", "tank3");
                $parameters = array("Air Pressure", "Auto Drain", "Kondensat", "Kandungan Oli");
                $uom = array("Bar", "-", "-", "-");
                $standard = array("6.0 ~ 7.5", "B", "TA", "TA");
                $fields = array("air_pressure", "auto_drain", "kondensat", "kandungan_oli");

                foreach ($parameters as $index => $parameter) {
                    echo "<tr>";
                    echo "<th class='measure2'>" . htmlspecialchars($parameter) . "</th>";
                    echo "<th class='parameter'>" . htmlspecialchars($uom[$index]) . "</th>";
                    echo "<th class='parameter-setting'>" . htmlspecialchars($standard[$index]) . "</th>";
                
                    foreach ($models as $key => $model) {
                        // Skip condition                    
                        $fieldName = strtolower(str_replace(" ", "_", $model)) . "_" . $fields[$index];
                        $dataType = ($index === 0) ? "input" : "select";
                        $dataClass = ($index === 0) ? "type='number' step='0.01' class='input-field'" : "class='enum'";
                        // Enum options
                        $enum = "";
                        if ($index === 1) {
                            $enum = "<option value='B'>B</option><option value='R'>R</option>";
                        } elseif ($index === 2 || $index === 3) {
                            $enum = "<option value='A'>A</option><option value='TA'>TA</option>";
                        }
                        if ($existing_record && isset($existing_record[$fieldName])) {
                            echo "<td>";
                            echo htmlspecialchars(formatValue($existing_record[$fieldName]));
                            echo "<button type='button' class='clear-btn' data-field='$fieldName'>X</button>";
                            echo "</td>";
                        } else {
                        // Generate input row
                        $inputrow = "<$dataType $dataClass name='$fieldName'>$enum</$dataType>";
                        echo "<td>$inputrow</td>";
                        }
                    }
                    echo "</tr>";
                }
            ?>

            </tbody>
        </table>
        <button type="submit" class="btn">SAVE</button>
    </form>
