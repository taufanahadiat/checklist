<?php
$unit = 'capbank_trafo7'; 
require 'database.php';
include 'request-view-capbank.php';
?>
   <br>
    <h3 style="margin-bottom: -10px;">
    <span style="font-weight:200;">Nama Panel: <span style="font-weight:550;">Cap. Bank Line 7</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Lokasi: <span style="font-weight:550;">R. Trafo L7</span></span>
    </h3>
    <?php if ($article === null): ?>
        <br>
            <p style="font-weight:550">----- Form ini belum terisi -----</p>
        <?php else: ?>
                
<table style="width:80%; margin-left:0; margin-right:0; float:left;"> 
        <thead>
        <tr>
            <th style="width:2%;">Nomor Unit</th>
            <th style="width:5%;">Arus (A)</th>
            <th style="width:2%;">Capacitor</th>
            <th style="width:2%;">Reaktor</th>
            <th style="width:2%;">Fuse/Breaker</th>
            <th style="width:2%;">Contactor</th>
            <th style="width:2%;">Kabel & Koneksi</th>
            <th style="width:5%;">Temp (°C)</th>
            <th style="width:12%;">Keterangan</th>
        </tr>
        </thead>
        <tbody>
        <?php                
                $noUnit = array(
                    '1,1' => '1a',
                    '2,1' => '2a',
                    '3,1' => '3a',
                    '3,2' => '3b',
                    '4,1' => '4a',
                    '4,2' => '4b',
                    '5,1' => '5a',
                    '5,2' => '5b',
                    '5,3' => '5c',
                    '6,1' => '6a',
                    '6,2' => '6b',
                    '6,3' => '6c',
                    '7,1' => '7a',
                    '7,2' => '7b',
                    '7,3' => '7c',
                    '8,1' => '8a',
                    '8,2' => '8b',
                    '8,3' => '8c',
                    '9,1' => '9a',
                    '9,2' => '9b',
                    '9,3' => '9c',
                    '10,1' => '10a',
                    '10,2' => '10b',
                    '10,3' => '10c',
                    '11,1' => '11a',
                    '11,2' => '11b',
                    '11,3' => '11c',
                    '12,1' => '12a',
                    '12,2' => '12b',
                    '12,3' => '12c'
                );                
                                
                $fields = array(
                    'arus' => 'num', 
                    'capacitor' => 'check', 
                    'reaktor' => 'check', 
                    'fuse' => 'check', 
                    'contactor' => 'check', 
                    'kabel' => 'check', 
                    'temp' => 'num', 
                    'note' => 'text'
                );
                
                foreach ($noUnit as $index => $no) {
                    echo '<tr>';
                    echo '<th class="measure2">' . $index . '</th>';
                    
                    foreach ($fields as $field => $type) {
                        $fieldName = "{$field}_{$no}";
                        $fieldValue = isset($article[$fieldName]) ? htmlspecialchars(formatValue($article[$fieldName])) : '';
                        
                        if ($article && isset($article[$fieldName])) {
                            $noteStyle = ($type === 'text') ? "style='text-align: left; padding: 5px 10px'" : '';
                            echo "<td $noteStyle>";

                            if ($type === 'check' && ($article[$fieldName] == 1 || $article[$fieldName] == 0)) {
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
                }

                ?>
                <tr>
                    <td style="border:none; background-color: white; text-align:left;"></td>

                    <td style="border:none; background-color: white; text-align:left;" colspan="2">
                    <?php if ($article && isset($article['kebersihan_dalam']) && $article['kebersihan_dalam'] == 1) : ?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                        <?php else: ?>
                        <i class="fa-regular fa-square fa-lg"></i>
                    <?php endif;?>
                        <span style="vertical-align: top;">Kebersihan Dalam Panel</span>
                    </td>

                    <td style="border:none; background-color: white; text-align:left;" colspan="2">
                    <?php if ($article && isset($article['lampu']) && $article['lampu'] == 1) :?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                    <?php else: ?>
                        <i class="fa-regular fa-square fa-lg"></i>
                    <?php endif;?>
                        <span style="vertical-align: top;">Lampu Indikator</span>
                    </td>
                    
                    <td style="border:none; background-color: white; text-align:left;" colspan="3">
                    <?php if ($article && isset($article['tombol']) && $article['tombol'] == 1) :?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                    <?php else: ?>
                        <i class="fa-regular fa-square fa-lg"></i>
                    <?php endif;?>
                        <span style="vertical-align: top;">Tombol & Selector Switch</span>
                    </td>

                    <td style="border:none; background-color: white; text-align: center; position: relative; vertical-align: middle;" rowspan="2">cos φ<br>
                    <div class="rectangle-box">
                    <?php if ($article && isset($article['cos'])) :?>
                            <span class="rectangle-value"><?php echo htmlspecialchars(formatValue($article['cos'])); ?></span>
                            &nbsp;
                    <?php endif;?> 
                    </div>                              
                    </td>
                </tr>
                <tr>
                    <td style="border:none; background-color: white; text-align:left;"></td>

                    <td style="border:none; background-color: white; text-align:left;" colspan="2">
                    <?php if ($article && isset($article['kebersihan_luar']) && $article['kebersihan_luar'] == 1) : ?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                    <?php else: ?>
                        <i class="fa-regular fa-square fa-lg"></i>
                    <?php endif;?>
                        <span style="vertical-align: top;">Kebersihan Luar Panel</span>
                    </td>

                    <td style="border:none; background-color: white; text-align:left;" colspan="2">
                    <?php if ($article && isset($article['exhaust']) && $article['exhaust'] == 1) : ?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                    <?php else: ?>
                        <i class="fa-regular fa-square fa-lg"></i>
                    <?php endif;?>
                        <span style="vertical-align: top;">Exhaust Fan</span>
                    </td>
                    
                    <td style="border:none; background-color: white; text-align:left;" colspan="3">
                    <?php if ($article && isset($article['pintu']) && $article['pintu'] == 1) : ?>
                        <i class="fa-regular fa-square-check fa-lg"></i>
                    <?php else: ?>
                        <i class="fa-regular fa-square fa-lg"></i>
                    <?php endif;?>
                        <span style="vertical-align: top;">Engsel, Handle & Kunci Pintu</span>
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
                    ?>
                </tr>
        </tbody>
        <?php endif;?>
        </table>