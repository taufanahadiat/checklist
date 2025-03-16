<?php 

    $article = null;

if (isset($article_fuelBooster)) {
    $article = $article_fuelBooster;
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
                </thead>
                <article>
                <tbody>
               <?php 
                $time_ranges = array('8_14', '16_22', '0_6');
                $times = array(8, 10, 12, 14, 16, 18, 20, 22, 0, 2, 4, 6);
                ?>
                <tr>
                    <th class="measure">Operating Pump#1</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "operating_pump1_$time";
                        echo '<td style="text-align:center">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "kebocoran_fuel1_$time";
                        echo '<td style="text-align:center">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Operating Pump#2</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "operating_pump2_$time";
                        echo '<td style="text-align:center">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "kebocoran_fuel2_$time";
                        echo '<td style="text-align: center;">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                <th class="measure">Flowrate (Booster Unit)</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Liter</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "flowrate_booster_$range";
                        echo '<td colspan="4">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                <th class="measure">Flowrate (Monitor)</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Liter</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "flowrate_monitor_$range";
                        echo '<td colspan="4" style="text-align: center;">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                <th class="measure">HFO/LFO</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">-</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "hfo_lfo_$range";
                        echo '<td colspan="4" style="text-align: center;">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                <th class="measure">Feed Pressure</th>
                    <th class="parameter">3.5~5.0</th>
                    <th class="parameter-setting">Bar</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "feed_pressure_$time";
                        echo '<td>' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                <th class="measure">Outlet Pressure</th>
                    <th class="parameter">4.0~5.0</th>
                    <th class="parameter-setting">Bar</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "outlet_pressure_$time";
                        echo '<td style="text-align: center;">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                <th class="measure">Fuel Temperature</th>
                    <th class="parameter">80~110</th>
                    <th class="parameter-setting">°C</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "fuel_temp_$time";
                        echo '<td style="text-align: center;">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                <th class="measure">Fuel Viscosity</th>
                    <th class="parameter">0~16</th>
                    <th class="parameter-setting">cSt</th>
                    <?php
                        foreach ($times as $time) {
                            $field_name = "fuel_visc_$time";
                        echo '<td style="text-align: center;">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                <th class="measure">Flushing Counter</th>
                    <th class="parameter">-</th>
                    <th class="parameter-setting">Cycl</th>
                    <?php
                        foreach ($time_ranges as $range) {
                            $field_name = "flushing_count_$range";
                        echo '<td colspan="4">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
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
        <span class="legalDoc" style="margin-top: -25px;">H1-GFBU-33-24R0</span><br>

        <?php endif; ?>
