<?php
    $unit = 'panel_lvdp_pet'; 
    require 'database.php';
    include 'request-view-capbank.php';
?>
    <br>

    <h3>
        <span style="font-weight:200;">Nama Panel: <span style="font-weight:550;">LVDP PET</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <span style="font-weight:550;">R. Trafo PET</span></span>
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
                    'outgoing' => 'Outgoing',
                    'coupler' => 'Coupler',
                    'from_trafo_gen' => 'From Trafo Gen',
                    'coupler2' => 'Coupler',
                    'outgoing2' => 'Outgoing',
                    'ppg1' => 'PPG-1',
                    'ppg1_copy' => '',
                    'pp1_2' => 'PP1-2',
                    'pp1_1' => 'PP1-1',
                    'mini_coex' => 'Mini Coex',
                    'ppg2' => 'PPG-2',
                    'pp1_4' => 'PP1-4',
                    'pp1_3' => 'PP1-3',
                    'dc1' => 'DC-1',
                    'ac1' => 'AC-1',
                    'dc2' => 'DC-2',
                    'ac2' => 'AC-2',
                    'dc3' => 'DC-3',
                    'cap_bank1' => 'Cap Bank',
                    'from_tr10_prod' => 'From TR10 (Prod)',
                    'coupler3' => 'Coupler',
                    'from_tr9_uty' => 'From TR9 (Uty)',
                    'p_fc' => 'P-FC',
                    'cap_bank2' => 'Cap Bank',
                    'p_sl' => 'P-SL',
                    'p_chiller' => 'P Chiller',
                    'plb' => 'PLB',
                    'spare' => 'Spare',
                    'plg1' => 'PLG-1',
                    'charger' => 'Charger',
                    'clips' => 'Clips',
                    'plg2' => 'PLG-2',
                    'pl1_1' => 'PL1-1',
                    'pl1_2' => 'PL1-2',
                    'p_hb' => 'P-HB',
                    'chiller_hitachi' => 'Chiller Hitachi',
                    'p_gs' => 'P-GS',
                    'p_gr' => 'P-GR',
                );
                
                

                $capacity = array(
                    'outgoing' => '3900',
                    'coupler' => '',
                    'from_trafo_gen' => '3900',
                    'coupler2' => '',
                    'outgoing2' => '3900',
                    'ppg1' => '250',
                    'ppg1_copy' => '160',
                    'pp1_2' => '400',
                    'pp1_1' => '400',
                    'mini_coex' => '250',
                    'ppg2' => '160',
                    'pp1_4' => '1250',
                    'pp1_3' => '400',
                    'dc1' => '1250',
                    'ac1' => '1600',
                    'dc2' => '1250',
                    'ac2' => '1600',
                    'dc3' => '800',
                    'cap_bank1' => '2000',
                    'from_tr10_prod' => '3900',
                    'coupler3' => '',
                    'from_tr9_uty' => '3900',
                    'p_fc' => '800',
                    'cap_bank2' => '2000',
                    'p_sl' => '1000',
                    'p_chiller' => '1600',
                    'plb' => '160',
                    'spare' => '160',
                    'plg1' => '160',
                    'charger' => '160',
                    'clips' => '160',
                    'plg2' => '160',
                    'pl1_1' => '160',
                    'pl1_2' => '160',
                    'p_hb' => '400',
                    'chiller_hitachi' => '630',
                    'p_gs' => '400',
                    'p_gr' => '630',
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
                    if($index == 'ppg1_copy' || $index == 'pp1_2' || $index == 'pp1_1' || $index == 'ppg2' || $index == 'pp1_4' || $index == 'pp1_3' || $index == 'ac1' || $index == 'ac2' || $index == 'cap_bank1' || $index == 'cap_bank2' || $index == 'p_chiller') {
                        echo '<th style="border-top:none; border-bottom:none;"></th>';
                    }else if($cubindex == 16 && $index  == 'plb'){
                        echo '<th rowspan="8">' . $cubindex . '</th>';
                    }else if ($cubindex < 16){
                        echo '<th style="border-bottom:none;">' . $cubindex . '</th>';
                            $cubindex++;
                    } 

                    if ($index == 'p_hb' || $index == 'p_gs') {
                        $cubindex++;
                        echo '<th style="border-bottom:none;">' . $cubindex . '</th>';
                    } else if ($index == 'chiller_hitachi' || $index == 'p_gr') {
                        echo '<th style="border-top:none;"></th>';
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
<span class="legalDoc" style="margin-top: -15px;">H1-LVP-59-24R0</span><br><br>