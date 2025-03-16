<?php
    $unit = 'panel_lvdp5'; 
    require 'database.php';
    include 'request-view-capbank.php';
?>
    <br>

    <h3>
        <span style="font-weight:200;">Nama Panel: <span style="font-weight:550;">LVDP 5</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <span style="font-weight:550;">Line 5</span></span>
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
                    'dc_4' => 'DC 4',
                    'ac_3' => 'AC 3',
                    'dc_3' => 'DC 3',
                    'ac_1' => 'AC 1',
                    'ac_2' => 'AC 2',
                    'dc_2' => 'DC 2',
                    'dc_1' => 'DC 1',
                    'cap_bank' => 'CAP BANK',
                    'incoming' => 'INCOMING',
                    'pp_1_2' => 'PP 1-2',
                    'ups_25' => 'UPS 25',
                    'spare1' => 'SPARE',
                    'chiller_25' => 'CHILLER 25',
                    'pp_1_4' => 'PP 1-4',
                    'trane_40' => 'TRANE 40',
                    'ea_line_l5' => 'EA LINE L5',
                    'spare2' => 'SPARE',
                    'mixing' => 'MIXING',
                    'spare3' => 'SPARE',
                    'pl_g_1' => 'PL G-1',
                    'pl_1_1' => 'PL 1-1',
                    '3p' => '3P',
                    'phb' => 'PHB',
                    'ppg_1' => 'PPG-1',
                    'spare4' => 'SPARE',
                    'spare5' => 'SPARE',
                    'spare6' => 'SPARE',
                    'pp_1_1' => 'PP 1-1',
                    'pp_g_2' => 'PP G-2',
                    'p_bsl' => 'P BSL'
                );
                

                $capacity = array(
                    'dc_4' => '2500',
                    'ac_3' => '630',
                    'dc_3' => '630',
                    'ac_1' => '1000',
                    'ac_2' => '1000',
                    'dc_2' => '800',
                    'dc_1' => '1200',
                    'cap_bank' => '2500',
                    'incoming' => '5000',
                    'pp_1_2' => '160',
                    'ups_25' => '160',
                    'spare1' => '160',
                    'chiller_25' => '400',
                    'pp_1_4' => '250',
                    'trane_40' => '450',
                    'ea_line_l5' => '1600',
                    'spare2' => '',
                    'mixing' => '160',
                    'spare3' => '160',
                    'pl_g_1' => '160',
                    'pl_1_1' => '160',
                    '3p' => '160',
                    'phb' => '250',
                    'ppg_1' => '250',
                    'spare4' => '250',
                    'spare5' => '250',
                    'spare6' => '250',
                    'pp_1_1' => '630',
                    'pp_g_2' => '630',
                    'p_bsl' => '630'
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
                    if($index == 'dc_4'){
                        echo '<th rowspan="6">1</th>';
                    }
                    if($index == 'dc_1'){
                        echo '<th rowspan="2">2</th>';
                    }
                    if($index == 'incoming'){
                        echo '<th>3</th>';
                    }
                    if($index == 'pp_1_2'){
                        echo '<th rowspan="7">4</th>';
                    }
                    if($index == 'spare2'){
                        echo '<th rowspan="14">5</th>';
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
<span class="legalDoc" style="margin-top: -15px;">H1-ELV5-51-24R0</span><br><br>