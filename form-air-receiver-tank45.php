    <h2>AIR RECEIVER TANK LINE OPP <?php echo $line; ?></h2>
    <h4>SHIFT <?php echo $shift;?></h4>
                    
<table>
        <?php include 'pilih-unit-compressor.php'; ?>
            <thead>
            <tr>
            <th>PARAMETER</th>
            <th>Uom</th>
            <th>STANDARD</th>
            <th>TANK 1</th>
            <th>TANK 2</th>
            <th>TANK 3</th>
            <th>TANK 5</th>
            <th>TANK 6</th>
            <th>TANK 7</th>
            </tr>
            </thead>
            <form method="post">
            <tbody>
            <?php
                require 'database.php';
                include 'request-view-compressor.php';
                $models = array("tank1", "tank2", "tank3", "tank5", "tank6", "tank7");
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
                        include 'indicator-air-receiver-tank.php';
                        // Generate input row
                        if ($existing_record && isset($existing_record[$fieldName])) {
                            echo "<td $style>";
                            echo htmlspecialchars(formatValue($existing_record[$fieldName]));
                            echo "<button type='button' class='clear-btn' data-field='$fieldName'>X</button>";
                            echo "</td>";
                        } else {
                        $inputrow = "<$dataType $dataClass name='$fieldName'>$enum</$dataType>";
                        echo "<td>$inputrow</td>";
                        }
                    }
                    echo "</tr>";
                }
            ?>
            <tr>
                <th class="measure2" colspan="3">Entry By</th>
               <?php 
                if ($existing_record && isset($existing_record['pic'])){
                    echo "<td colspan='10'style='text-align:left; color:grey; padding: 5px 10px'>";
                    echo htmlspecialchars(formatValue($existing_record['pic']));
                    echo "&nbsp&nbsp";
                    echo htmlspecialchars(formatValue($existing_record['time']));
                    echo "</td>";
                }
                else{
                    echo "<td colspan='10'></td>";
                }
                echo "<input type='hidden' name='pic' value='" . htmlspecialchars($baris[0]) . "'>";
                echo '<input type="hidden" name="time" value="' . date('d/m/Y H:i') . '">';
                ?>
            </tr>  

            <tr>
            <th class="measure2" colspan="3">Notes
            </th>

            <?php 
            $current_note = '';
            if ($existing_record && isset($existing_record['note'])) {
                $current_note = $existing_record['note']; // Set current_note to the existing note
                echo "<td colspan='10' id='note-container' style='text-align:left; padding: 5px 10px'>";
                echo htmlspecialchars(formatValue($existing_record['note']));
                echo "<button type='button' class='clear-btn' data-field='note'>X</button>";
                echo "<button type='button' class='edit-btn' data-current-note='" . htmlspecialchars($current_note, ENT_QUOTES) . "'>EDIT</button>";
                echo "</td>";
            } else {
                echo "<td colspan='10' style='text-align:left; padding: 4px 0.8%;'><textarea name='note' id='note-textarea' style='height:30px;width:90%;padding:4px;'></textarea></td>";
            }
            ?>
            </tr>

            </tbody>
        </table>
        <span class="legalDoc" style="margin-top: -25px;">H1-CRT-23-24R0</span><br><br>
        <button type="submit" class="btn" id="save-button">SAVE</button>
    </form>