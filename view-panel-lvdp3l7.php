<?php
    $unit = 'panel_lvdp3_l7'; 
    require 'database.php';
    include 'request-view-capbank.php';
?>
    <br>

    <h3>
        <span style="font-weight:200;">Nama Panel: <span style="font-weight:550;">LVDP-3 L7</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <span style="font-weight:550;">R. Trafo L7</span></span>
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
                    'sdp_fan_eq' => 'SDP Fan EQ',
                    'spare2' => 'Spare',
                    'spare3' => 'Spare',
                    'spare4' => 'Spare',
                    'spare5' => 'Spare',
                    'sdp_roof_fan_1'=> 'SDP-Roof Fan-1',
                    'spare6' => 'Spare',
                    'main_uty_ll' => 'Main UTY II',
                    'incoming' => 'Incoming',
                    'compressor' => 'Compressor',
                    'sdp_fan_uty' => 'SDP Fan UTY',
                    'spare7' => 'Spare',
                    'ups1' => 'UPS 1',
                    'ups2' => 'UPS 2',
                    'dp_chiller' => 'DP Chiller',
                    'sdp_sup_fan3' => 'SDP Sup Fan 3',
                    'lp_coal_boiler' => 'LP Coal Boiler',
                    'spare8' => 'Spare',
                    'spare9' => 'Spare',
                    'dp_slitters' => 'DP Slitters',
                    'dp_cooling_twr' => 'DP Cooling TWR',
                    'sdp_sup_fan1' => 'SDP Sup Fan 1',
                    'sdp_sup_fan2' => 'SDP Sup Fan 2',
                    'sdp_roof_fan' => 'SDP Roof Fan',
                    'sdp_fan_gudang' => 'SDP Fan Gudang',
                    'dp_hvac_fcu' => 'DP HVAC FCU',
                    'spare10' => 'Spare',
                    'spare11' => 'Spare',
                    'dp_lp_6000' => 'DP LP -6000',
                    'dp_lp_0000' => 'DP LP -0000',
                    'sdp_boiler_gas' => 'SDP Boiler Gas',
                    'main_cap_bank' => 'Main Cap. Bank',
                    'cap_bank1' => 'Cap. Bank',
                    'cap_bank2' => 'Cap. Bank'
                );                                

                $capacity = array(
                        'spare1' => '63',
                        'sdp_fan_eq' => '160',
                        'spare2' => '160',
                        'spare3' => '160',
                        'spare4' => '250',
                        'spare5' => '630',
                        'sdp_roof_fan_1'=> '400',
                        'spare6' => '400',
                        'main_uty_ll' => '2500',
                        'incoming' => '5000',
                        'compressor' => '1000',
                        'sdp_fan_uty' => '80',
                        'spare7' => '63',
                        'ups1' => '63',
                        'ups2' => '25',
                        'dp_chiller' => '2000',
                        'sdp_sup_fan3' => '400',
                        'lp_coal_boiler' => '400',
                        'spare8' => '400',
                        'spare9' => '400',
                        'dp_slitters' => '630',
                        'dp_cooling_twr' => '400',
                        'sdp_sup_fan1' => '400',
                        'sdp_sup_fan2' => '400',
                        'sdp_roof_fan' => '160',
                        'sdp_fan_gudang' => '125',
                        'dp_hvac_fcu' => '100',
                        'spare10' => '250',
                        'spare11' => '250',
                        'dp_lp_6000' => '250',
                        'dp_lp_0000' => '160',
                        'sdp_boiler_gas' => '160',
                        'main_cap_bank' => '2500',
                        'cap_bank1' => '18 x 160',
                        'cap_bank2' => '12 x 160'
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
                        echo '<th rowspan="8">1</th>';
                    }
                    if($index == 'main_uty_ll'){
                        echo '<th>2</th>';
                    }
                    if($index == 'incoming'){
                        echo '<th>3</th>';
                    }
                    if($index == 'compressor'){
                        echo '<th rowspan="6">4</th>';
                    }
                    if($index == 'sdp_sup_fan3'){
                        echo '<th rowspan="8">5</th>';
                    }
                    if($index == 'sdp_roof_fan'){
                        echo '<th rowspan="9">6</th>';
                    }
                    if($index == 'cap_bank1'){
                        echo '<th>7</th>';
                    }
                    if($index == 'cap_bank2'){
                        echo '<th>8</th>';
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
<span class="legalDoc" style="margin-top: -15px;">H1-LV71-54-24R0</span><br><br>