<?php
$unit_pass = $hfo_lfo_fuel;

    $article = null;

if ($unit_pass == 'hfo_unloading_pump_unit' && isset($article_hfoUnload)) {
    $article = $article_hfoUnload;
}

if ($unit_pass == 'fuel_transfer_pump_unit' && isset($article_fuel)) {
    $article = $article_fuel;
}

if ($unit_pass == 'hfo_separator_pump_unit' && isset($article_hfoSeparator)) {
    $article = $article_hfoSeparator;
}

if ($unit_pass == 'lfo_unloading_pump_unit' && isset($article_lfoUnloading)) {
    $article = $article_lfoUnloading;
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
                    <th class="measure">Operating Pump#1</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_name = "operating_pump1_$range";
                        echo '<td colspan="4">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                    foreach ($time as $t) {
                        $field_name = "kebocoran_fuel1_$t";
                        echo '<td>' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                <tr>  
                    <th class="measure">Operating Pump#2</th>
                    <th class="parameter">ON/OFF</th>
                    <th class="parameter-setting">-</th>
                    <?php
                    foreach ($time_ranges as $range) {
                        $field_name = "operating_pump2_$range";
                        echo '<td colspan="4">' . formatValue($article[$field_name]) . '</td>';
                    }
                    ?>
                </tr>
                <tr>
                    <th class="measure">Kebocoran Fuel</th> 
                    <th class="parameter">A/TA/RS</th>
                    <th class="parameter-setting">-</th>
                    <?php
                    foreach ($time as $t) {
                        $field_name = "kebocoran_fuel2_$t";
                        echo '<td>' . formatValue($article[$field_name]) . '</td>';
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
            <?php if ($unit_pass == 'hfo_unloading_pump_unit'){
                echo 'H1-GHUP-27-24R0';
            } elseif ($unit_pass == 'fuel_transfer_pump_unit'){
                echo 'H1-GFTP-28-24R0';
            } elseif ($unit_pass == 'hfo_separator_pump_unit'){
                echo 'H1-HFSP-36-24R0';
            } elseif ($unit_pass == 'lfo_unloading_pump_unit'){
                echo 'H1-LUUP-37-24R0';
            } 
        ?></span>
        <br>
        <?php endif; ?>

