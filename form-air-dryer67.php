    <h2>AIR DRYER LINE OPP <?php echo $line; ?></h2>
    <h4>SHIFT <?php echo $shift;?></h4>

        <table>
        <?php include 'pilih-unit-compressor.php'; ?>
            <thead>
            <tr>
            <th>PARAMETER</th>
            <th>Uom</th>
            <th>STANDARD</th>
            <th>SULLAIR 22</th>
            <th>BOGE 01</th>
            <th>BOGE 02</th>
            </tr>
            </thead>
            <form method="post">
            <tbody>
            <?php
                require 'database.php';
                include 'request-view-compressor.php';
                $models = array("sullair22", "boge01", "boge02");
                $parameters = array("Dew Point Temp.", "Ref. Low Press", "Pre Filter", "After Filter", "Auto Drain Solenoid", "Vibration");
                $uom = array("°C", "Bar", "-", "-", "-", "-");
                $standard = array("2 ~ 10", "4 ~ 10", "HJ", "HJ", "B", "H ~ S");
                $fields = array("dewpoint_temp", "reflow_press", "pre_filter", "after_filter", "autodrain_solenoid", "vibration");

                foreach ($parameters as $index => $parameter) {
                    echo "<tr>";
                    echo "<th style='width: 40px' class='measure2'>" . htmlspecialchars($parameter) . "</th>";
                    echo "<th style='width:25px' class='parameter'>" . htmlspecialchars($uom[$index]) . "</th>";
                    echo "<th class='parameter-setting'>" . htmlspecialchars($standard[$index]) . "</th>";
                
                    foreach ($models as $key => $model) {
                        // Skip condition                    
                        $fieldName = strtolower(str_replace(" ", "_", $model)) . "_" . $fields[$index];
                        $dataType = ($index === 0 || $index === 1) ? "input" : "select";
                        $dataClass = ($index === 0 || $index === 1) ? "type='number' step='0.01' class='input-field'" : "class='enum'";
                        // Enum options
                        $enum = "";
                        if ($index === 2 || $index === 3) {
                            $enum = "<option value='HJ'>HJ</option><option value='M'>M</option>";
                        } elseif ($index === 4) {
                            $enum = "<option value='B'>B</option><option value='R'>R</option>";
                        } elseif ($index === 5) {
                            $enum = "<option value='H'>H</option><option value='S'>S</option><option value='T'>T</option>";
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
        <br>
        <button type="submit" class="btn">SAVE</button>
    </form>