<?php 
    $article = null;

if (isset($article_kebocoranFuel)) {
    $article = $article_kebocoranFuel;
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
                $tanks = array(
                    "HFO Day Tank" => "hfo_day_tank",
                    "LFO Day Tank" => "lfo_day_tank",
                    "HFO Storage Tank" => "hfo_storage_tank",
                    "LFO Storage Tank" => "lfo_storage_tank"
                );


                foreach ($tanks as $tank_name => $field_prefix) {
                    echo "<tr>";
                    echo "<th class='measure'>{$tank_name}</th>";
                    echo "<th class='parameter'>A/TA/RS</th>";
                    echo "<th class='parameter-setting'>-</th>";

                    foreach ($times as $time) {
                        $field_name = "{$field_prefix}_{$time}";
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
        <span class="legalDoc" style="margin-top: -25px;">H1-GKFT-35-24R0</span><br>
        
        <?php endif; ?>