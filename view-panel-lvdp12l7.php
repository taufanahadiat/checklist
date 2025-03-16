<?php
    $unit = 'panel_lvdp1_2_l7'; 
    require 'database.php';
    include 'request-view-capbank.php';
?>
    <br>

    <h3>
        <span style="font-weight:200;">Nama Panel: <span style="font-weight:550;">LVDP 1-2 L7</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <span style="font-weight:550;">R. Trafo L7</span></span>
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
                    'se_11' => 'SE 11',
                    'se_21' => 'SE 21',
                    'sh_41' => 'SH 41',
                    'sg_31' => 'SG 31',
                    'sg_51' => 'SG 51',
                    'sm_11' => 'SM 11',
                    'sn_4'  => 'SN 4',
                    'spare1' => 'Spare',
                    'sn_2'  => 'SN 2',
                    'sn_3'  => 'SN 3',
                    'sn_1'  => 'SN 1',
                    'utility_erema' => 'Utility Erema',
                    'se_31' => 'SE 31',
                    'se_41' => 'SE 41',
                    'se_51' => 'SE 51',
                    'sd_31' => 'SD 31',
                    'sh_31' => 'SH 31',
                    'sh_11' => 'SH 11',
                    'big_grinder' => 'Big Grinder',
                    'spq_11' => 'SPQ 11',
                    'ups_20_kva' => 'UPS 20 KVA',
                    'sn_5' => 'SN 5',
                    'smu_mdo' => 'SMU MDO',
                    'shredder' => 'Shredder',
                    'sc_1' => 'SC 1',
                    'spare2' => 'Spare',
                    'pluff_sylo_erema' => 'Pluff Sylo Erema',
                    'spare3' => 'Spare',
                    'spare4' => 'Spare',
                    'spare5' => 'Spare',
                    'inc_produksi' => 'Inc Produksi',
                );
                
                $capacity = array(
                    'se_11' => '',
                    'se_21' => '',
                    'sh_41' => '250/630',
                    'sg_31' => '250/630',
                    'sg_51' => '250/630',
                    'sm_11' => '250/630',
                    'sn_4'  => '250/630',
                    'spare1' => '250/630',
                    'sn_2'  => '160/400',
                    'sn_3'  => '160/400',
                    'sn_1'  => '250/630',
                    'utility_erema' => '800',
                    'se_31' => '800',
                    'se_41' => '800',
                    'se_51' => '800',
                    'sd_31' => '800',
                    'sh_31' => '800',
                    'sh_11' => '1000',
                    'big_grinder' => '1000',
                    'spq_11' => '1250',
                    'ups_20_kva' => '44/63',
                    'sn_5' => '175/250',
                    'smu_mdo' => '140/200',
                    'shredder' => '175/250',
                    'sc_1' => '175/250',
                    'spare2' => '175/250',
                    'pluff_sylo_erema' => '112/160',
                    'spare3' => '56/80',
                    'spare4' => '20',
                    'spare5' => '16',
                    'inc_produksi' => '5000',
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
                    if($index == 'se_11'){
                        echo '<th colspan="8" style="background-color: grey;">LVDP 1/L7</th></tr>';
                        echo '<tr><th>1</th>';
                    }
                    if($index == 'se_21'){
                        echo '<th>2</th>';
                    }
                    if($index == 'sh_41'){
                        echo '<th colspan="8" style="background-color: grey;">LVDP 2/L7</th></tr>';
                        echo '<tr><th rowspan="9">1</th>';
                    }
                    if($index == 'utility_erema'){
                        echo '<th rowspan="6">2</th>';
                    }
                    if($index == 'sh_11'){
                        echo '<th rowspan="11">3</th>';
                    }
                    if($index == 'spare4' || $index == 'spare5' || $index == 'inc_produksi'){
                        echo '<th></th>';
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