<?php
    $unit = 'panel_lvdp_metalize1'; 
    require 'database.php';
    include 'request-view-capbank.php';
?>
    <br>

    <h3>
        <span style="font-weight:200;">Nama Panel: <span style="font-weight:550;">LVDP Metallize 1</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <span style="font-weight:550;">Metallize 1</span></span>
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
                    'breaker1' => 'Breaker',
                    'breaker2' => 'Breaker',
                    'breaker3' => 'Breaker',
                    'breaker4' => 'Breaker',
                    'incoming' => 'Incoming',
                    'pct' => 'PCT',
                    'vaccum' => 'Vaccum',
                    'spare1' => 'Spare',
                    'crane' => 'Crane',
                    'lp1' => 'LP 1',
                    'p_compressor' => 'P Compressor',
                    'slitter' => 'Slitter',
                    'spare2' => 'Spare',
                    'lp2' => 'LP 2',
                    'met1' => 'MET 1',
                    'cap_bank1' => 'Cap Bank',
                    'cap_bank2' => 'Cap Bank'
                );
                

                $capacity = array(
                    'breaker1' => '100',
                    'breaker2' => '250',
                    'breaker3' => '250',
                    'breaker4' => '800',
                    'incoming' => '1250',
                    'pct' => '100',
                    'vaccum' => '25',
                    'spare1' => '25',
                    'crane' => '25',
                    'lp1' => '25',
                    'p_compressor' => '40',
                    'slitter' => '250',
                    'spare2' => '25',
                    'lp2' => '40',
                    'met1' => '1000',
                    'cap_bank1' => '',
                    'cap_bank2' => ''
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
                    if($index == 'breaker1'){
                        echo '<th rowspan="4">1</th>';
                    }
                    if($index == 'incoming'){
                        echo '<th>2</th>';
                    }
                    if($index == 'pct'){
                        echo '<th rowspan="10">3</th>';
                    }
                    if($index == 'cap_bank1'){
                        echo '<th>4</th>';
                    }
                    if($index == 'cap_bank2'){
                        echo '<th>5</th>';
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
<span class="legalDoc" style="margin-top: -15px;">H1-LVM1-60-24R0</span><br><br>