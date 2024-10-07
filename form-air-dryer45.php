    <h2>AIR DRYER LINE OPP <?php echo $line; ?></h2>
    <h4>SHIFT <?php echo $shift;?></h4>

        <table>
        <?php include 'pilih-unit-compressor.php'; ?>
            <thead>
            <tr>
            <th>PARAMETER</th>
            <th>Uom</th>
            <th>STANDARD</th>
            <th style="font-size:13px">AD. SULLAIR 23</th>
            <th style="font-size:13px">AD. SULLAIR 24</th>
            <th style="font-size:13px">AD. SULLAIR 27</th>
            <th style="font-size:13px">AD. SULLAIR 33</th>
            <th style="font-size:13px">AD. SULLAIR 34</th>
            <th style="font-size:13px">AD. AUGUST 28</th>
            <th style="font-size:13px">AD. AUGUST 29</th>
            <th style="font-size:13px">AD. AUGUST 30</th>
            <th style="font-size:13px">AD. AUGUST 31</th>
            <th style="font-size:13px">AD. AUGUST 32</th>
            </tr>
            </thead>
            <form method="post">
            <tbody>
            <?php
                require 'database.php';
                include 'request-view-compressor.php';
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
                        // Skip condition                    
                        $fieldName = strtolower(str_replace(" ", "_", $model)) . "_" . $fields[$index];
                        $dataType = ($index === 1 || $index === 2) ? "input" : "select";
                        $dataClass = ($index === 1 || $index === 2) ? "type='number' step='0.01' class='input-field'" : "class='enum'";
                        include 'indicator-air-dryer.php';
                        // Enum options
                        $enum = "";
                        if ($index === 3 || $index === 4) {
                            $enum = "<option value='HJ'>HJ</option><option value='M'>M</option>";
                        } elseif ($index === 5) {
                            $enum = "<option value='B'>B</option><option value='R'>R</option>";
                        } elseif ($index === 6) {
                            $enum = "<option value='H'>H</option><option value='S'>S</option><option value='T'>T</option>";
                        }
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
        <button type="submit" class="btn" id="save-button">SAVE</button>
    </form>