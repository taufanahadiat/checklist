<?php 
    $article = null;

if (isset($article_heaterOil)) {
    $article = $article_heaterOil;
}

?>
<?php if ($article === null): ?>
            <p>Form ini belum terisi</p>
        <?php else: ?>
            <?php 
                if (isset($_GET['selectedUnit'])){
                    $unit = 'genset_man';
                    echo '<br><br>';
                    echo '<div class="verif">';
                     include 'verification-show.php';
                     echo '</div>';
                }
            ?>
                    
<table>
            <thead>
            <tr>
                    <th colspan="3">Time</th>
                    <th>08.00</th>
                    <th>10.00</th>
                    <th>12.00</th>
                    <th>14.00</th>
                    <th>16.00</th>
                    <th>18.00</th>
                    <th>20.00</th>
                    <th>22.00</th>
                    <th>0.00</th>
                    <th>2.00</th>
                    <th>4.00</th>
                    <th>6.00</th>

            </tr>
            </thead>
                <article>
                <tbody>
                <?php
                $times = array('8', '10', '12', '14', '16', '18', '20', '22', '0', '2', '4', '6');
                $measurements = array(
                    array("Operating Pump#1", "ON/OFF", "-", "operating_pump1_", "enum-on-off.php"),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil1_", "enum-kebocoran.php"),
                    array("Operating Pump#2", "ON/OFF", "-", "operating_pump2_", "enum-on-off.php"),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil2_", "enum-kebocoran.php"),
                    array("Inlet Pressure", "1.5~3.0", "Bar", "inlet_pressure_", null),
                    array("Heater Temp. Tank #1", "70~90", "°C", "heater_temp_tank1_", null),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil_tank1_", "enum-kebocoran.php"),
                    array("Heater Temp. Tank #2", "70~90", "°C", "heater_temp_tank2_", null),
                    array("Kebocoran Oil", "A/TA/RS", "-", "kebocoran_oil_tank2_", "enum-kebocoran.php"),
                    array("Oil Temperature Supply", "60~90", "°C", "oil_temp_supply_", null),
                    array("Oil Temperature Return", "50~80", "°C", "oil_temp_return_", null),
                    array("HFO Outlet Temp", "60~90", "°C", "hfo_outlet_temp_", null),
                    array("HFO Day Tank Temp", "60~90", "°C", "hfo_tank_temp_", null)
                );


                foreach ($measurements as $measurement) {
                    echo "<tr>";
                    echo "<th class='measure'>{$measurement[0]}</th>";
                    echo "<th class='parameter'>{$measurement[1]}</th>";
                    echo "<th class='parameter-setting'>{$measurement[2]}</th>";

                    foreach ($times as $time) {
                        $field_name = $measurement[3] . $time;
                        echo "<td>";
                        echo htmlspecialchars(formatValue($article[$field_name]));
                        echo "</td>";
                    }
                    echo "</tr>";
                } ?>
                <tr>
                <th class="measure2" colspan="3">Entry By</th>
                            <td class='pic'><?php echo $article['pic_8']?><br><?php echo $article['time_8']?></td>    
                            <td class='pic'><?php echo $article['pic_10']?><br><?php echo $article['time_10']?></td>    
                            <td class='pic'><?php echo $article['pic_12']?><br><?php echo $article['time_12']?></td>    
                            <td class='pic'><?php echo $article['pic_14']?><br><?php echo $article['time_14']?></td>    
                            <td class='pic'><?php echo $article['pic_16']?><br><?php echo $article['time_16']?></td>    
                            <td class='pic'><?php echo $article['pic_18']?><br><?php echo $article['time_18']?></td>    
                            <td class='pic'><?php echo $article['pic_20']?><br><?php echo $article['time_20']?></td>    
                            <td class='pic'><?php echo $article['pic_22']?><br><?php echo $article['time_22']?></td>    
                            <td class='pic'><?php echo $article['pic_0']?><br><?php echo $article['time_0']?></td>    
                            <td class='pic'><?php echo $article['pic_2']?><br><?php echo $article['time_2']?></td>    
                            <td class='pic'><?php echo $article['pic_4']?><br><?php echo $article['time_4']?></td>    
                            <td class='pic'><?php echo $article['pic_6']?><br><?php echo $article['time_6']?></td>    
                </tr>

                <tr>
                    <th class="measure2" style="border-right:none" colspan="3">Notes</th>                            
                    <td colspan="12" class="note" style="height:32px;"><?php echo $article['note']?></td>
                </tr>

                </tbody>
                </article>
        </table>
        <span class="legalDoc" style="margin-top: -25px;">H1-GHOU-34-24R0</span><br>

        <?php endif; ?>

