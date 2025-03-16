    <h2>COMPRESSOR LINE OPP <?php echo $line; ?></h2>
    <h4>SHIFT <?php echo $shift;?></h4>

                    
<table>
        <?php include 'pilih-unit-compressor.php'; ?>
            <thead>
            <tr>
            <th>PARAMETER</th>
            <th>Uom</th>
            <th>STANDARD</th>
            <th>COMP. SULLAIR 18</th>
            <th>COMP. SULLAIR 24</th>
            <th>COMP. SULLAIR 25</th>
            </tr>
            </thead>
            <form method="post">
            <tbody>
            <?php
                require 'database.php';
                include 'request-view-compressor.php';

                $models = array("compsullair18", "compsullair24", "compsullair25");
                $parameters = array("Machine Status", "Air Dischrg. Press", "Air Dishrg. Temp", "Separator Δ Press.", "Oil Level (%Botm SG)", "Vibration", "Noise", "Running Hours", "Load Hours", "Δ Voltage", "Current", "Alarm");
                $uom = array("-", "Bar", "°C", "Bar", "-", "-", "-", "H", "H", "%", "A", "-");
                $standard = array("-", "6.4 ~ 8.0", "80 ~ 110", "0 ~ 0.8", "1/2 ~ 3/4", "H", "H", "-", "-", "5 ~ 15", "80 ~ 150", "TA");
                $fields = array("machine_status", "disc_press", "disc_temp", "separator_press", "oil_level", "vibration", "noise", "run_hours", "load_hours", "voltage", "current", "alarm");

                foreach ($parameters as $index => $parameter) {
                    echo "<tr>";
                    echo "<th style='width: 20%' class='measure2'>" . htmlspecialchars($parameter) . "</th>";
                    echo "<th style='width: 5%' class='parameter'>" . htmlspecialchars($uom[$index]) . "</th>";
                    echo "<th class='parameter-setting'>" . htmlspecialchars($standard[$index]) . "</th>";
                
                    foreach ($models as $key => $model) {
                        // Skip condition
                    
                        $fieldName = strtolower(str_replace(" ", "_", $model)) . "_" . $fields[$index];
                        $dataType =  ($index === 4 || $index === 5 || $index === 6 || $index === 11) ? "select" : "input";
                        $dataClass = ($index === 4 || $index === 5 || $index === 6 || $index === 11) ? "class='enum'" : "type='number' step='0.01' class='input-field'";
                        // Enum options
                        $enum = "";
                        if ($index === 4){
                            $enum = "<option value='1/4'>1/4</option><option value='1/2'>1/2</option><option value='3/4'>3/4</option>";
                        } else if ($index === 5 || $index === 6) {
                            $enum = "<option value='H'>H</option><option value='S'>S</option><option value='T'>T</option>";
                        } elseif ($index === 11) {
                            $enum = "<option value='A'>A</option><option value='TA'>TA</option>";
                        }
                        include 'indicator-compressor.php';
                        if ($existing_record && isset($existing_record[$fieldName])) {
                            echo "<td $style>";
                            echo htmlspecialchars(formatValue($existing_record[$fieldName]));
                            echo "<button type='button' class='clear-btn' data-field='$fieldName'>X</button>";
                            echo "</td>";
                        } else if ($index === 0){
                            echo "<td>";
                            echo "<select class='enum_long' name='{$fieldName}'>"; 
                            include 'enum-running-standby.php';
                            echo "</select>";
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
        <span class="legalDoc" style="margin-top: -25px;">H1-OCMC-24-24R0</span><br><br>
        <button type="submit" class="btn" id="save-button">SAVE</button>
    </form>