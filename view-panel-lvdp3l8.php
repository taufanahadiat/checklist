<?php
    $unit = 'panel_lvdp3_l8'; 
    require 'database.php';
    include 'request-view-capbank.php';
?>
    <br>

    <h3>
        <span style="font-weight:200;">Nama Panel: <span style="font-weight:550;">LVDP-3 L8</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <span style="font-weight:550;">R. Trafo L8</span></span>
    </h3>
    <?php if ($article === null): ?>
        <br>
            <p style="font-weight:550">----- Form ini belum terisi -----</p>
        <?php else: ?>
                
<table style="width:80%; margin-left:0; margin-right:0; float:left;">    
    <thead>
        <tr>
            <th style="width:2%;" rowspan="2">CUB</th>
            <th style="width:5%;" rowspan="2">Nama Breaker/MCB</th>
            <th style="width:2%;" rowspan="2">Capacity (A)</th>
            <th style="width:5%;" rowspan="2">Aktual Amp (A)</th>
            <th style="width:5%;" rowspan="2">Temp (°C)</th>
            <th colspan="2">Kondisi</th>
            <th style="width:12%;" rowspan="2">Keterangan</th>
        </tr>
        <tr>
            <th style="width:2%;">MCB</th>
            <th style="width:2%;">Kabel & Koneksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
                $breaker = array(
                    'spare1' => 'Spare',
                    'spare2' => 'Spare',
                    'spare3' => 'Spare',
                    'main_uty2' => 'Main Uty 2',
                    'sdp_fan_equipment' => 'SDP Fan Equipment',
                    'sdp_roof_fan1' => 'SDP Roof Fan #1',
                    'sdp_roof_fan2' => 'SDP Roof Fan #2',
                    'spare4' => 'Spare',
                    'main_uty1' => 'Main Uty 1',
                    'dp_chiller_pump' => 'DP Chiller Pump',
                    'dp_ngr' => 'DP NGR',
                    'dp_compressor' => 'DP Compressor',
                    'dp_lp' => 'DP LP',
                    'sdp_supplyfan' => 'SDP Supply Fan',
                    'dp_pump' => 'DP Pump',
                    'dp_slitter' => 'DP Slitter',
                    'capacitor_bank1' => 'Capacitor Bank 1',
                    'capacitor_bank2' => 'Capacitor Bank 2',
                    'spare5' => 'Spare',
                    'spare6' => 'Spare',
                    'lp_utility' => 'LP Utility',
                    'sdp_fcu1' => 'SDP FCU #1'
                );                
                

                $capacity = array(
                    'spare1' => '125',
                    'spare2' => '63',
                    'spare3' => '400',
                    'main_uty2' => '2500',
                    'sdp_fan_equipment' => '160',
                    'sdp_roof_fan1' => '160',
                    'sdp_roof_fan2' => '125',
                    'spare4' => '100',
                    'main_uty1' => '4000',
                    'dp_chiller_pump' => '1000',
                    'dp_ngr' => '2000',
                    'dp_compressor' => '400',
                    'dp_lp' => '400',
                    'sdp_supplyfan' => '400',
                    'dp_pump' => '400',
                    'dp_slitter' => '630',
                    'capacitor_bank1' => '630',
                    'capacitor_bank2' => '630',
                    'spare5' => '630',
                    'spare6' => '160',
                    'lp_utility' => '125',
                    'sdp_fcu1' => '25'
                );
                
                $fields = array(
                    'amp' => 'input', 
                    'temp' => 'input', 
                    'mcb' => 'select', 
                    'kabel' => 'select', 
                    'note' => 'input'
                );
                
                foreach ($breaker as $index => $nama) {
                    echo '<tr>';
                    if($index == 'spare1'){
                        echo '<th rowspan="3">1</th>';
                    }
                    if($index == 'main_uty2'){
                        echo '<th rowspan="5">2</th>';
                    }
                    if($index == 'main_uty1'){
                        echo '<th>3</th>';
                    }
                    if($index == 'dp_chiller_pump'){
                        echo '<th rowspan="2">4</th>';
                    }
                    if($index == 'dp_compressor'){
                        echo '<th rowspan="8">5</th>';
                    }
                    if($index == 'spare6'){
                        echo '<th rowspan="3">6</th>';
                    }

                    echo '<th class="measure2" style="text-align: left;">' . $nama . '</th>';
                    echo '<th class="parameter">' . $capacity[$index] . '</th>';
                    
                    foreach ($fields as $field => $type) {
                        $fieldName = "{$index}_{$field}";
                        $fieldValue = isset($article[$fieldName]) ? htmlspecialchars(formatValue($article[$fieldName])) : '';

                        if ($article && isset($article[$fieldName])) {
                            $noteStyle = ($field === 'note') ? "style='text-align: left; padding: 5px 10px'" : '';
                            echo "<td $noteStyle>";

                            if ($type === 'select' && ($article[$fieldName] == 1 || $article[$fieldName] == 0)) {
                                if ($article[$fieldName] == 1) {
                                    echo "<i class='fa fa-check'></i>";
                                } else {
                                    echo "<i class='fa fa-times'></i>";
                                }
                            } else {
                                echo $fieldValue;
                            }
                            echo "</td>";
                        } else {  
                            echo "<td></td>";  
                        }
                    }
                    echo '</tr>';
                }

                ?>
                <tr>
                    <td style="border:none; background-color: white; text-align:left;"></td>

                    <td style="border:none; background-color: white; text-align:left;" colspan="2">
                    <?php if ($article && isset($article['kebersihandalampanel']) && $article['kebersihandalampanel'] == 1) : ?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                    <?php else :?>
                        <i class="fa-regular fa-square fa-lg"></i>
                    <?php endif;?>
                        <span style="vertical-align: top;">Kebersihan Dalam Panel</span>
                    </td>

                    <td style="border:none; background-color: white; text-align:left;" colspan="3">
                    <?php if ($article && isset($article['lampuindikator']) && $article['lampuindikator'] == 1) :?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                    <?php else :?>
                        <i class="fa-regular fa-square fa-lg"></i>
                    <?php endif;?>
                        <span style="vertical-align: top;">Lampu Indikator</span>      
                    </td>
                    
                    <td style="border:none; background-color: white; text-align:left;" colspan="2"></td>
                </tr>
                <tr>
                    <td style="border:none; background-color: white; text-align:left;"></td>

                    <td style="border:none; background-color: white; text-align:left;" colspan="2">
                    <?php if ($article && isset($article['kebersihanluarpanel']) && $article['kebersihanluarpanel'] == 1) : ?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                        <?php else :?>           
                            <i class="fa-regular fa-square fa-lg"></i>
                    <?php endif;?> 
                    <span style="vertical-align: top;">Kebersihan Luar Panel</span>
                    </td>                    
                    <td style="border:none; background-color: white; text-align:left;" colspan="3">
                    <?php if ($article && isset($article['engselhandledankuncipintu']) && $article['engselhandledankuncipintu'] == 1) : ?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                        <?php else :?>           
                            <i class="fa-regular fa-square fa-lg"></i>
                    <?php endif;?> 
                    <span style="vertical-align: top;">Engsel, Handle & Kunci Pintu</span>

                    <td style="border:none; background-color: white; text-align:left;" colspan="2"></td>
                </tr>
                <tr>
                    <td colspan="5" style="height:50px; text-align:left; vertical-align:top;">Catatan:<br>
                        <?php if ($article && isset($article['catatan'])) :?>
                            <span style="font-weight: 550;"><?php echo htmlspecialchars($article['catatan']); ?></span>
                        <?php endif;?> 
                    </td>
                    <th class="parameter" colspan="2">Entry By</th>
                    <?php 
                    if ($article && isset($article['pic'])){
                        echo "<td colspan='12'style='text-align:left; color:grey; padding: 5px 10px'>";
                        echo htmlspecialchars(formatValue($article['pic']));
                        echo "&nbsp&nbsp";
                        echo htmlspecialchars(formatValue($article['time']));
                        echo "</td>";
                    }
                    else{
                        echo "<td colspan='12'></td>";
                    }
                    echo "<input type='hidden' name='pic' value='" . htmlspecialchars($baris[0]) . "'>";
                    echo '<input type="hidden" name="time" value="' . date('d/m/Y H:i') . '">';
                    ?>
                </tr>
        </tbody>
        </table>
<?php endif;?>
<span class="legalDoc" style="margin-top: -15px;">H1-LV83-58-24R0</span><br><br>