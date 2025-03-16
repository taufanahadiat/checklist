<?php
    $unit = 'panel_lvdp4'; 
    require 'database.php';
    include 'request-view-capbank.php';
?>
    <br>

    <h3>
        <span style="font-weight:200;">Nama Panel: <span style="font-weight:550;">LVDP 4</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <span style="font-weight:550;">Line 4</span></span>
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
                    'dc_II' => 'DC II', 
                    'dc_I' => 'DC I', 
                    'ac_I' => 'AC I', 
                    'dc_III' => 'DC III', 
                    'ac_II' => 'AC II', 
                    'ac_III' => 'AC III', 
                    'produksi' => 'PRODUKSI', 
                    'cos' => 'COS', 
                    'inc_tr7' => 'INC TR7', 
                    'coupler_tr' => 'COUPLER TR', 
                    'inc_tr4' => 'INC TR4', 
                    'grinder_l4' => 'GRINDER L4', 
                    'pp_II' => 'PP II', 
                    'lp_coating_II' => 'LP COATING II', 
                    'p_pompa_chiller' => 'P POMPA CHILLER', 
                    'chiller_l4' => 'CHILLER L4', 
                    'pp_I_l4' => 'PP I/L4', 
                    'chiller_l5' => 'CHILLER L5', 
                    'lp_II_lp_f' => 'LP II/LP F', 
                    'p_lp_l4' => 'P LP/L4', 
                    'p_roop_fan' => 'P ROOP FAN', 
                    'breaker_3p' => 'BREAKER 3P', 
                    'mesin_v_pvdc' => 'MESIN V/PVDC'
                );

                $capacity = array(
                    'dc_II' => '800', 
                    'dc_I' => '1250', 
                    'ac_I' => '800', 
                    'dc_III' => '1600', 
                    'ac_II' => '800', 
                    'ac_III' => '1250', 
                    'produksi' => '3200', 
                    'cos' => '', 
                    'inc_tr7' => '3200', 
                    'coupler_tr' => '3150', 
                    'inc_tr4' => '2500', 
                    'grinder_l4' => '250', 
                    'pp_II' => '160', 
                    'lp_coating_II' => '250', 
                    'p_pompa_chiller' => '100', 
                    'chiller_l4' => '800', 
                    'pp_I_l4' => '630', 
                    'chiller_l5' => '1600', 
                    'lp_II_lp_f' => '100', 
                    'p_lp_l4' => '100', 
                    'p_roop_fan' => '250', 
                    'breaker_3p' => '70', 
                    'mesin_v_pvdc' => ''
                );
                
                $fields = array(
                    'amp' => 'input', 
                    'temp' => 'input', 
                    'mcb' => 'select', 
                    'kabel' => 'select', 
                    'note' => 'input'
                );
                $cubindex =1;
                foreach ($breaker as $index => $nama) {
                    echo '<tr>';
                    if($index == 'dc_I' || $index == 'dc_III' || $index == 'ac_III' || $index == 'pp_II' || $index == 'p_pompa_chiller' || $index == 'pp_I_l4'|| $index == 'breaker_3p') {
                        echo '<th style="border-top:none;"></th>';
                    }else{
                        echo '<th style="border-bottom:none;">' . $cubindex . '</th>';
                        $cubindex++;
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
<span class="legalDoc" style="margin-top: -15px;">H1-ELV4-50-24R0</span><br><br>