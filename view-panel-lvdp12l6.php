<?php
    $unit = 'panel_lvdp1_2_l6'; 
    require 'database.php';
    include 'request-view-capbank.php';
?>
    <br>

    <h3>
        <span style="font-weight:200;">Nama Panel: <span style="font-weight:550;">LVDP 1-2 L6</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <span style="font-weight:550;">R. Trafo L6</span></span>
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
                    'ups_15_kva' => 'UPS 15 KVA',
                    'ups_2_kva' => 'UPS 2 KVA',
                    'sb_light_room1' => 'SB Light Room 1',
                    'spare1' => 'Spare',
                    'sb_light_room2' => 'SB Light Room 2',
                    'activefil_master' => 'Active Fil. (Master)',
                    'se_31' => 'SE 31',
                    'control' => 'Control', 
                    'activefil_new' => 'Active Fil. (New)',
                    'spare2' => 'Spare',
                    'spare3' => 'Spare',
                    'sg_11' => 'SG 11',
                    'heating_melt_ex' => 'Heating Melt Ex',
                    'film_recycling' => 'Film Recycling',
                    'sd_31' => 'SD 31',
                    'sg_71' => 'SG 71',
                    'sd_11' => 'SD 11',
                    'utility_erema' => 'Utility Erema',
                    'sh_31' => 'SH 31',
                    'sg_31' => 'SG 31',
                    'sg_51' => 'SG 51',
                    'main_breaker' => 'Main Breaker'
                );
                
                
                $capacity = array(
                    'se_11' => '1000',
                    'se_21' => '1000',
                    'ups_15_kva' => '50/63',
                    'ups_2_kva' => '20/25',
                    'sb_light_room1' => '20/25',
                    'spare1' => '20/25',
                    'sb_light_room2' => '12.5/16',
                    'activefil_master' => '800',
                    'se_31' => '800',
                    'control' => '250/630',
                    'activefil_new' => '175/250',
                    'spare2' => '160/400',
                    'spare3' => '160/400',
                    'sg_11' => '160/400',
                    'heating_melt_ex' => '1250',
                    'film_recycling' => '1000',
                    'sd_31' => '800',
                    'sg_71' => '250/630',
                    'sd_11' => '800',
                    'utility_erema' => '250/630',
                    'sh_31' => '250/630',
                    'sg_31' => '250/630',
                    'sg_51' => '250/630',
                    'main_breaker' => '5000'
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
                        echo '<th colspan="8" style="background-color: grey;">LVDP 1/L6</th></tr>';
                        echo '<tr><th>1</th>';
                    }
                    if($index == 'se_21'){
                        echo '<th>2</th>';
                    }
                    if($index == 'ups_15_kva'){
                        echo '<th colspan="8" style="background-color: grey;">LVDP 2/L6</th></tr>';
                        echo '<tr><th rowspan="12">1</th>';
                    }
                    if($index == 'heating_melt_ex'){
                        echo '<th rowspan="9">2</th>';
                    }
                    if($index == 'main_breaker'){
                        echo '<th>3</th>';
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
<span class="legalDoc" style="margin-top: -15px;">H1-LV61-52-24R0</span><br><br>
