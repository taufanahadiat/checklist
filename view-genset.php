<?php

$unit_pass = $gensetWartsila;
    $article = null;

if ($unit_pass == 'genset_wartsila_01' && isset($article_gensetWartsila01)) {
    $article = $article_gensetWartsila01;
}

if ($unit_pass == 'genset_wartsila_02' && isset($article_gensetWartsila02)) {
    $article = $article_gensetWartsila02;
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
                $time = array(8, 10, 12, 14, 16, 18, 20, 22, 0, 2, 4, 6);
                ?>
                <tr>  
                    <th class="measure">Running Hours</th>
                    <th class="parameter" style="text-align: center">-</th>
                    <th class="parameter-setting">Hour</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_key = "running_hrs_$range";
                        echo '<td colspan="4" style="text-align:center">' . formatValue($article[$field_key]) . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Lube Oil Sump Level</th>
                    <th class="parameter">14~17</th>
                    <th class="parameter-setting">Cm</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_key = "lube_oil_sump_lvl_$range";
                        include 'indicator-genset.php';
                        echo "<td colspan='4' $style>" . formatValue($article[$field_key]) . "</td>";
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Air Condenstion Heater</th>
                    <th class="parameter" style="text-align: center">-</th>
                    <th class="parameter-setting">On</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_key = "anti_cond_heater_$range";
                        echo '<td colspan="4" style="text-align:center">' . formatValue($article[$field_key]) . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Pre lube Pump</th>
                    <th class="parameter" style="text-align: center">-</th>
                    <th class="parameter-setting">On</th>
                    <?php
                    foreach ($time as $t) {
                        $field_key = "prelube_pump_$t";
                        echo '<td style="text-align: center;">' . formatValue($article[$field_key]) . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Pre lube Pump Press</th>
                    <th class="parameter">>0.5</th>
                    <th class="parameter-setting">Bar</th>
                    <?php
                    foreach ($time as $t) {
                        $field_key = "prelube_pump_press_$t";
                        echo '<td>' . formatValue($article[$field_key]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Kebocoran Oil</th>
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                    foreach ($time as $t) {
                        $field_key = "kebocoran_oil_$t";
                        echo '<td style="text-align: center;">' . formatValue($article[$field_key]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Preheating Unit</th>
                    <th class="parameter" style="text-align: center">-</th>
                    <th class="parameter-setting">On</th>
                    <?php
                    foreach ($time as $t) {
                        $field_key = "preheat_unit_$t";
                        echo '<td style="text-align: center;">' . formatValue($article[$field_key]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">HT Water Outlet Temp</th>
                    <th class="parameter">>50</th>
                    <th class="parameter-setting">°C</th>
                    <?php
                    foreach ($time as $t) {
                        $field_key = "ht_water_outlet_temp_$t";
                        echo '<td>' . formatValue($article[$field_key]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">HT Expantion Tank lvl</th>
                    <th class="parameter">50~95</th>
                    <th class="parameter-setting">Cm</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_key = "ht_expantion_tank_lvl_$range";
                        echo '<td colspan="4" style="text-align: center;">' . formatValue($article[$field_key]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">LT Expantion Tank lvl</th>
                    <th class="parameter">50~95</th>
                    <th class="parameter-setting">Cm</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_key = "lt_expantion_tank_lvl_$range";
                        echo '<td colspan="4" style="text-align: center;">' . formatValue($article[$field_key]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Warming Up</th>
                    <th class="parameter">2~3</th>
                    <th class="parameter-setting">Week</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_key = "warming_up_$range";
                        echo '<td colspan="4" style="text-align: center;">' . formatValue($article[$field_key]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Fuel Oil Inlet Temp</th>
                    <th class="parameter" style="text-align: center;">-</th>
                    <th class="parameter-setting">°C</th>
                    <?php
                    foreach ($time as $t) {
                        $field_key = "fuel_oil_inlet_temp_$t";
                        echo '<td>' . formatValue($article[$field_key]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Fuel Oil Inlet Pressure</th>
                    <th class="parameter">4.0~7.0</th>
                    <th class="parameter-setting">Bar</th>
                    <?php
                    foreach ($time as $t) {
                        $field_key = "fuel_oil_inlet_pressure_$t";
                        echo '<td>' . formatValue($article[$field_key]) . '</td>';
                    }
                    ?>
                </tr>
                
                <tr>
                    <th class="measure">Kebocoran Fuel</th>
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                    foreach ($time as $t) {
                        $field_key = "kebocoran_fuel_$t";
                        echo '<td style="text-align: center;">' . formatValue($article[$field_key]) . '</td>';
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
        <span class="legalDoc" style="margin-top: -25px;">
            <?php if ($unit_pass == 'genset_wartsila_01'){
                echo 'H1-GGW1-29-24R0';
            } elseif ($unit_pass == 'genset_wartsila_02'){
                echo 'H1-GGW2-30-24R0';
            } 
        ?></span>

        <?php endif; ?>

