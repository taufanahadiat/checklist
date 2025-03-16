<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
require 'database.php';
require 'request-konsumsi-air.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Report Konsumsi Air</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../../img/icon.ico">
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <style>
        td {
            text-align: center;
        }
        .enum, .input-field {
            width: 100%;
            max-width: 65px;
            height: 25px;
            text-align: center;
            font-weight: 700;
            cursor: pointer;
        }
        .input-field {
            cursor: text;
        }
    </style>
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h2>MONITORING KONSUMSI AIR</h2>
    <button class ="btn" style="float:left; margin:0;" id="exportButton">Export to Excel</button>
                
<table id="tableAir" style="overflow-x: auto; display: block; width: 100%; max-height: 800px; overflow-y: auto; table-layout: auto;">
    <form method="post">
        <thead>
            <tr>
                <th class="sticky-column-head" rowspan="4" style="min-width:30px;">No</th>
                <th class="sticky-column-head" rowspan="4" style="min-width:80px;">Tanggal</th>
                <th rowspan="4">Max Inlet/Day</th>
                <th rowspan="4">Max Inlet/Day</th>
                <th rowspan="4" style="border-right: 3px solid black;">Max Inlet/Day</th>
                <th rowspan="2" colspan="5" style="border-right: 3px solid black;">INLET 1 - Deep Well Pump 1 (AKPI 1)</th>
                <th rowspan="2" colspan="5" style="border-right: 3px solid black;">INLET 2 - Deep Well Pump 2 (AKPI 2)</th>
                <th rowspan="2" colspan="5" style="border-right: 3px solid black;">INLET 3 - Deep Well Pump 3 (AKPI 3)</th>
                <th rowspan="2" colspan="5" style="border-right: 3px solid black;">INLET 4 - Deep Well Pump 4 (AKPI 4)</th>
                <th rowspan="2" colspan="5" style="border-right: 3px solid black;">INLET 5 - Deep Well Pump 5 (AKPI 5)</th>
                <th rowspan="2" colspan="5" style="border-right: 3px solid black;">INLET 6 - Deep Well Pump 6 (AKPI 6)</th>
                <th rowspan="2" colspan="5" style="border-right: 3px solid black;">INLET 7 - Deep Well Pump 7 (AKPI 7)</th>
                <th rowspan="2" colspan="3" style="border-right: 3px solid black;">Sumur Resapan</th>
                <th rowspan="2" colspan="9" style="border-right: 3px solid black;">Outlet 1 - Fresh Water Tank 1</th>
                <th rowspan="2" colspan="12" style="border-right: 3px solid black;">Outlet 3 - Fresh Water Tank 3</th>
                <th rowspan="2" colspan="15" style="border-right: 3px solid black;">Outlet 4 - Fresh Water Tank 4</th>
                <th rowspan="2" colspan="6" style="border-right: 3px solid black;">Outlet 5 - Reverse Osmosis Water</th>
                <th rowspan="2" colspan="3" style="border-right: 3px solid black;">Outlet 6 - Reverse Osmosis Water</th>
                <th rowspan="2" colspan="9" style="border-right: 3px solid black;">Outlet 7 - Cooling Tower Water Makeup</th>
                <th rowspan="2" colspan="3" style="border-right: 3px solid black;">Outlet 8 - Hydrant Water Discharge 1</th>
                <th rowspan="2" colspan="3" style="border-right: 3px solid black;">Outlet 9 - Hydrant Water Discharge 2</th>
                <th rowspan="2" colspan="3" style="border-right: 3px solid black;">Outlet 10 - Fresh Water Supply</th>
                <th colspan="2" style="border-right: 3px solid black;">Deep Well Tank</th>
                <th rowspan="2" style="border-right: 3px solid black;">Clean Water Tank</th>
                <th rowspan="3" style="border-right: 3px solid black;">Water Make UP</th>
                <th rowspan="4">Entry By</th>
            </tr>
            <tr>
                <th>Tank 1 (DWT)</th>
                <th style="border-right: 3px solid black;">Tank 2 (RWT)</th>
            </tr>
            <tr>
                <th colspan="5" style="border-right: 3px solid black;">Workshop MET (DWP 1)</th>
                <th colspan="5" style="border-right: 3px solid black;">Boiler Batu Bara 1 (DWP 2)</th>
                <th colspan="5" style="border-right: 3px solid black;">Slitter PET (DWP 3)</th>
                <th colspan="5" style="border-right: 3px solid black;">Rest Area Line 7 (DWP 4)</th>
                <th colspan="5" style="border-right: 3px solid black;">Chiller PET (DWP 5)</th>
                <th colspan="5" style="border-right: 3px solid black;">Fuel Storage Tank (DWP 6)</th>
                <th colspan="5" style="border-right: 3px solid black;">Boiler Batu Bara (DWP 7)</th>
                <th colspan="3" style="border-right: 3px solid black;">Gudang Line 7</th>
                <th colspan="3" style="border-right: 3px solid black;">Bopet</th>
                <th colspan="3" style="border-right: 3px solid black;">Chiller Bopet</th>
                <th colspan="3" style="border-right: 3px solid black;">Cooling Tower Bopet</th>
                <th colspan="3" style="border-right: 3px solid black;">OPP Line 4~8</th>
                <th colspan="3" style="border-right: 3px solid black;">Chiller OPP Line 4, 5 & 8</th>
                <th colspan="3" style="border-right: 3px solid black;">Cooling Tower OPP Line 4~5</th>
                <th colspan="3" style="border-right: 3px solid black;">Cooling Tower OPP Line 8</th>
                <th colspan="3" style="border-right: 3px solid black;">Kantin, HRD, New Office & Masjid</th>
                <th colspan="3" style="border-right: 3px solid black;">Argha Water</th>
                <th colspan="3" style="border-right: 3px solid black;">Cooling Tower MET 3~4</th>
                <th colspan="3" style="border-right: 3px solid black;">Cooling Tower MET 1~2</th>
                <th colspan="3" style="border-right: 3px solid black;">MET, Coat, BG 4~8</th>
                <th colspan="3" style="border-right: 3px solid black;">Water Bath Line 8</th>
                <th colspan="3" style="border-right: 3px solid black;">Water Bath Line 4~5</th>
                <th colspan="3" style="border-right: 3px solid black;">Water Bath Line 6~7</th>
                <th colspan="3" style="border-right: 3px solid black;">All Cooling Tower Line 6~7</th>
                <th colspan="3" style="border-right: 3px solid black;">Cooling Tower Line 6</th>
                <th colspan="3" style="border-right: 3px solid black;">Cooling Tower Line 7</th>
                <th colspan="3" style="border-right: 3px solid black;">Hydrant OPP 4~8</th>
                <th colspan="3" style="border-right: 3px solid black;">Hydrant OPP 6~7</th>
                <th colspan="3" style="border-right: 3px solid black;">OPP Line 6~7</th>
                <th style="white-space:nowrap;">Old Tank</th>
                <th style="white-space:nowrap; border-right: 3px solid black;">New Tank</th>
                <th style="border-right: 3px solid black;">CWT</th>
            </tr>
            <tr>
            <?php for ($i = 1; $i <= 7; $i++) : ?>
                <th style="min-width:70px;">Max.</th>
                <th style="min-width:70px;">Meter</th>
                <th style="min-width:100px;">Instruction</th>
                <th style="min-width:45px;">V/d</th>
                <th style="font-size:0.7em; border-right: 3px solid black; ">Kumulatif</th>
            <?php endfor;?>
                <th style="min-width:70px;">Meter</th>
                <th>V/d</th>
                <th style="font-size:0.7em; border-right: 3px solid black;">Kumulatif</th>
            <?php for ($i = 1; $i <= 21; $i++) : ?>
                <th style="min-width:70px;">Counter</th>
                <th>V/d</th>
                <th style="font-size:0.7em; border-right: 3px solid black;">Kumulatif</th>
            <?php endfor;?>
            <th>Level</th>
            <th style="border-right: 3px solid black;">Level</th>
            <th style="min-width:70px; border-right: 3px solid black;">Level</th>
            <th style="min-width:70px; border-right: 3px solid black;">Level</th>
            </tr>
        </thead>
            <tbody>
<?php 
require 'database.php';
include 'request-view-konsumsi-air.php';

$outlet_fields = array(
    'bopet',
    'chbopet',
    'cooltow_bopet',
    'line48',
    'ch458',
    'cooltow45',
    'cooltow8',
    'office',
    'argha_water',
    'cooltow_met34',
    'cooltow_met12',
    'bg48',
    'waterbath8',
    'waterbath45',
    'waterbath67',
    'cooltow67',
    'cooltow6',
    'cooltow7',
    'hydrant48',
    'hydrant67',
    'line67'
);
$parameter = array(
    'count',
    'volume',
    'kumulatif'
);


// Initialize arrays to store values for max_dwp, meter_dwp, and volume_dwp
$max_dwp_values = array(); // For max_dwp values
$meter_dwp_values = array(); // For meter_dwp values
$volume_dwp_values = array(); // For volume_dwp values
$meter_gudang_values = array(); 
$volume_gudang_values = array(); 
$counter_outlet_values = array(); 
$volume_outlet_values = array(); 

// Initialize each sub-array for max_dwp, meter_dwp, and volume_dwp
for ($i = 1; $i <= 7; $i++) {
    $max_dwp_values[$i] = array();
    $meter_dwp_values[$i] = array();
    $volume_dwp_values[$i] = array();
}

foreach ($outlet_fields as $field) {
    $counter_outlet_values[$field] = array(); 
    $volume_outlet_values[$field] = array();
}


?>
<?php if (mysqli_num_rows($result_previous) > 0) : ?>
    <?php while ($previous_existing_record = mysqli_fetch_assoc($result_previous)) : ?>
    <tr>
        <td class="sticky-column"><?php echo htmlspecialchars(formatValue($previous_existing_record['id'])); ?></td>
        <td class="sticky-column"><?php echo htmlspecialchars(date("d M 'y", strtotime($previous_existing_record['tanggal']))); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_existing_record['max_inlet_1'])); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_existing_record['max_inlet_2'])); ?></td>
        <td style="border-right: 3px solid black;"><?php echo htmlspecialchars(formatValue($previous_existing_record['max_inlet_3'])); ?></td>

        <?php for ($i = 1; $i <= 7; $i++) : ?>
            <td><?php 
                // Store max_dwp value in the corresponding $i sub-array
                $max_dwp_value = $previous_existing_record["max_dwp$i"];
                $max_dwp_values[$i][] = (int) $max_dwp_value;
                echo htmlspecialchars(formatValue($max_dwp_value)); 
            ?></td>
            <td><?php 
                // Store meter_dwp value in the corresponding $i sub-array
                $meter_dwp_value = $previous_existing_record["meter_dwp$i"];
                $meter_dwp_values[$i][] = (int)$meter_dwp_value; // Append meter_dwp value to the specific $i sub-array
                echo htmlspecialchars(formatValue($meter_dwp_value)); 
            ?></td>
            <td style="font-size:13.5px; white-space: nowrap; font-weight:550; font-style:italic;">
                <?php echo htmlspecialchars($previous_existing_record["instruction_dwp$i"]); ?>
            </td>
            <td><?php 
                // Store volume_dwp value in the corresponding $i sub-array
                $volume_dwp_value = $previous_existing_record["volume_dwp$i"];
                $volume_dwp_values[$i][] = (int)$volume_dwp_value; // Append volume_dwp value to the specific $i sub-array
                echo htmlspecialchars(formatValue($volume_dwp_value)); 
            ?></td>
            <td style="border-right: 3px solid black;"><?php echo htmlspecialchars(formatValue($previous_existing_record["kumulatif_dwp$i"])); ?></td>
        <?php endfor; ?>

        <td><?php 
            $meter_gudang_value = $previous_existing_record["meter_gudang7"];
            $meter_gudang_values[] = (int)$meter_gudang_value; 
            echo htmlspecialchars(formatValue($previous_existing_record["meter_gudang7"])); 
        ?></td>
        <td><?php 
            $volume_gudang_value = $previous_existing_record["volume_gudang7"];
            $volume_gudang_values[] = (int)$volume_gudang_value; 
            echo htmlspecialchars(formatValue($previous_existing_record["volume_gudang7"])); 
        ?></td>
        <td style="border-right: 3px solid black;"><?php echo htmlspecialchars(formatValue($previous_existing_record["kumulatif_gudang7"])); ?></td>
        <?php foreach ($outlet_fields as $field) : ?>
            <?php foreach ($parameter as $param) : ?>
                <td <?php echo $param === 'kumulatif' ? 'style="border-right: 3px solid black;"' : ''; ?>>
                    <?php if ($param === 'count'){
                        $counter_outlet_value = $previous_existing_record["{$param}_{$field}"];
                        $counter_outlet_values[$field][] = (int)$counter_outlet_value; 
                    } else if ($param === "volume"){
                        $volume_outlet_value = $previous_existing_record["{$param}_{$field}"];
                        $volume_outlet_values[$field][] = (int)$volume_outlet_value; 
                    }
                    ?>
                    <?php echo htmlspecialchars(formatValue($previous_existing_record["{$param}_{$field}"])); ?>
                </td>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <td><?php echo htmlspecialchars(formatValue($previous_existing_record['level_old_dwt'])); ?></td>
        <td style="border-right: 3px solid black;"><?php echo htmlspecialchars(formatValue($previous_existing_record['level_new_dwt'])); ?></td>
        <td style="border-right: 3px solid black;"><?php echo htmlspecialchars(formatValue($previous_existing_record['level_cwt'])); ?></td>
        <td style="border-right: 3px solid black;"><?php echo htmlspecialchars($previous_existing_record['level_makeup']); ?></td>
        <td style="white-space: nowrap; text-align:left; padding: 5px 2px; padding-right: 15px; color:grey;">
            <?php echo htmlspecialchars(formatValue($previous_existing_record['pic'])); ?>
            <br>
            <?php echo htmlspecialchars(formatValue($previous_existing_record['time'])); ?>
        </td>
    </tr>
    <?php endwhile; ?>
<?php endif; ?>

<tr>  
    <td class="sticky-column">
    <?php echo htmlspecialchars(formatValue($existing_record['id'])); ?>
    </td>              
    <td class="sticky-column" style="white-space: nowrap; padding: 5px;">
        <?php if ($existing_record && isset($existing_record['tanggal'])) :?>
            <?php echo htmlspecialchars(date("d M 'y", strtotime($existing_record['tanggal']))); ?>
        <?php endif;?>
    </td>
    <td>
        <?php if ($existing_record && isset($existing_record['max_inlet_1'])) :?>
            <?php echo htmlspecialchars(formatValue($existing_record['max_inlet_1'])); ?>
        <?php endif;?>
    </td>
    <td>
        <?php if ($existing_record && isset($existing_record['max_inlet_2'])) :?>
            <?php echo htmlspecialchars(formatValue($existing_record['max_inlet_2'])); ?>
        <?php endif;?>
    </td>
    <td style="border-right: 3px solid black;">
        <?php if ($existing_record && isset($existing_record['max_inlet_3'])) :?>
            <?php echo htmlspecialchars(formatValue($existing_record['max_inlet_3'])); ?>
        <?php endif;?>
    </td>

    <?php for ($i = 1; $i <= 7; $i++) : ?>
        <td>
            <?php if ($existing_record && isset($existing_record["max_dwp$i"])) : ?>
                <?php 
                // Store the value in the array
                $max_dwp_value = $existing_record["max_dwp$i"];
                $max_dwp_values[$i][] = (int) $max_dwp_value; // Append value to the specific $i sub-array
                echo htmlspecialchars(formatValue($max_dwp_value)); 
                ?>
            <?php endif; ?>
        </td>
        <td style="min-width:100px; white-space: nowrap;">
            <?php if ($existing_record && isset($existing_record["meter_dwp$i"])) : ?>
                <?php 
                // Store the meter_dwp value in the array
                $meter_dwp_value = $existing_record["meter_dwp$i"];
                $meter_dwp_values[$i][] = (int)$meter_dwp_value; // Append to the specific $i sub-array
                echo htmlspecialchars(formatValue($meter_dwp_value)); 
                ?>
                <button type="button" class="clear-btn" data-field="meter_dwp<?php echo $i; ?>">X</button>
            <?php else : ?>
                <input class="input-field" type="number" step="0.01" name="meter_dwp<?php echo $i; ?>" id="meter_dwp<?php echo $i; ?>">
            <?php endif; ?>
        </td>
        <td style="font-size:13.5px; white-space: nowrap; font-weight:550; font-style:italic;">
            <?php if ($existing_record && isset($existing_record["instruction_dwp$i"])) : ?>
                <?php echo htmlspecialchars(formatValue($existing_record["instruction_dwp$i"])); ?>
            <?php endif; ?>
        </td>
        <td>
            <?php if ($existing_record && isset($existing_record["volume_dwp$i"])) : ?>
                <?php 
                // Store the volume_dwp value in the array
                $volume_dwp_value = $existing_record["volume_dwp$i"];
                $volume_dwp_values[$i][] = (int)$volume_dwp_value; // Append to the specific $i sub-array
                echo htmlspecialchars(formatValue($volume_dwp_value)); 
                ?>
            <?php endif; ?>
        </td>
        <td style="border-right: 3px solid black;">
            <?php if ($existing_record && isset($existing_record["kumulatif_dwp$i"])) : ?>
                <?php echo htmlspecialchars(formatValue($existing_record["kumulatif_dwp$i"])); ?>
            <?php endif; ?>
        </td>
<?php endfor; ?>

        <td style="min-width:100px; white-space: nowrap;">
        <?php if ($existing_record && isset($existing_record["meter_gudang7"])) : ?>
                <?php 
                // Store the meter_dwp value in the array
                $meter_gudang_value = $existing_record["meter_gudang7"];
                $meter_gudang_values[] = (int)$meter_gudang_value; // Append to the specific $i sub-array
                echo htmlspecialchars(formatValue($meter_gudang_value)); 
                ?>
                <button type="button" class="clear-btn" data-field="meter_gudang7">X</button>
            <?php else : ?>
                <input class="input-field" type="number" step="0.01" name="meter_gudang7" id="meter_gudang7">
            <?php endif; ?>
        </td>
        <td>
            <?php if ($existing_record && isset($existing_record["volume_gudang7"])) : ?>
                <?php 
                // Store the volume_dwp value in the array
                $volume_gudang_value = $existing_record["volume_gudang7"];
                $volume_gudang_values[] = (int)$volume_gudang_value; // Append to the specific $i sub-array
                echo htmlspecialchars(formatValue($volume_gudang_value)); 
                ?>
            <?php endif; ?>
        </td>
        <td style="border-right: 3px solid black;">
            <?php if ($existing_record && isset($existing_record["kumulatif_gudang7$i"])) : ?>
                <?php echo htmlspecialchars(formatValue($existing_record["kumulatif_gudang7$i"])); ?>
            <?php endif; ?>
        </td>

        <?php foreach ($outlet_fields as $field) : ?>
        <td style="min-width:100px; white-space: nowrap;">
            <?php if ($existing_record && isset($existing_record["count_$field"])) : ?>
                <?php 
                $count_field = $existing_record["count_$field"];
                $counter_outlet_values[$field][] = (int)$count_field;  
                echo htmlspecialchars(formatValue($count_field)); 
                ?>
                <button type="button" class="clear-btn" data-field="count_<?php echo $field; ?>">X</button>
            <?php else : ?>
                <input class="input-field" type="number" step="0.01" name="count_<?php echo $field; ?>" id="count_<?php echo $field; ?>">
            <?php endif; ?>
        </td>
        <td>
            <?php if ($existing_record && isset($existing_record["volume_$field"])) : ?>
                <?php 
                $volume_field = $existing_record["volume_$field"];
                $volume_outlet_values[$field][] = (int)$volume_field; 
                echo htmlspecialchars(formatValue($volume_field)); 
                ?>
            <?php endif; ?>
        </td>
        <td style="border-right: 3px solid black;">
            <?php if ($existing_record && isset($existing_record["kumulatif_$field"])) : ?>
                <?php echo htmlspecialchars(formatValue($existing_record["kumulatif_$field"])); ?>
            <?php endif; ?>
        </td>
        <?php endforeach;?>
        <td style="min-width:100px; white-space: nowrap;">
        <?php if ($existing_record && isset($existing_record["level_old_dwt"])) : ?>
                <?php echo htmlspecialchars(formatValue($existing_record["level_old_dwt"])); ?>
                <button type="button" class="clear-btn" data-field="level_old_dwt">X</button>
            <?php else : ?>
                <input class="input-field" type="number" step="0.01" name="level_old_dwt" id="level_old_dwt">
            <?php endif; ?>
        </td>
        <td style="min-width:100px; white-space: nowrap; border-right: 3px solid black;">
        <?php if ($existing_record && isset($existing_record["level_new_dwt"])) : ?>
                <?php echo htmlspecialchars(formatValue($existing_record["level_new_dwt"])); ?>
                <button type="button" class="clear-btn" data-field="level_new_dwt">X</button>
            <?php else : ?>
                <input class="input-field" type="number" step="0.01" name="level_new_dwt" id="level_new_dwt">
            <?php endif; ?>
        </td>
        <td style="min-width:100px; white-space: nowrap; border-right: 3px solid black;">
        <?php if ($existing_record && isset($existing_record["level_cwt"])) : ?>
                <?php echo htmlspecialchars(formatValue($existing_record["level_cwt"])); ?>
                <button type="button" class="clear-btn" data-field="level_cwt">X</button>
            <?php else : ?>
                <input class="input-field" type="number" step="0.01" name="level_cwt" id="level_cwt">
            <?php endif; ?>
        </td>
        <td style="min-width:100px; white-space: nowrap; border-right: 3px solid black;">
        <?php if ($existing_record && isset($existing_record["level_makeup"])) : ?>
                <?php echo htmlspecialchars($existing_record["level_makeup"]); ?>
                <button type="button" class="clear-btn" data-field="level_makeup">X</button>
            <?php else : ?>
                <input class="input-field" type="number" step="0.01" name="level_makeup" id="level_makeup">
            <?php endif; ?>
        </td>

    <?php 
                if ($existing_record && isset($existing_record['pic'])){
                    echo "<td style='color:grey; text-align:left; padding: 5px 2px; padding-right: 15px; white-space: nowrap;'>";
                    echo htmlspecialchars(formatValue($existing_record['pic']));
                    echo "<br>";
                    echo htmlspecialchars(formatValue($existing_record['time']));
                    echo "</td>";
                }
                else{
                    echo "<td></td>";
                }
                echo "<input type='hidden' name='pic' value='" . htmlspecialchars($baris[0]) . "'>";
                echo '<input type="hidden" name="time" value="' . date('d/m/Y H:i') . '">';
                ?>
</tr>
<?php
// After processing all the records, calculate quota_dwp, qty_dwp, avg_dwp, and dev_dwp
$quota_dwp = array(); // Array to store quota_dwp values for each $i
$qty_dwp = array();   // Array to store qty_dwp (Max - Min for meter_dwp)
$avg_dwp = array();   // Array to store avg_dwp (average of volume_dwp values)
$dev_dwp = array();   // Array to store dev_dwp (qty_dwp - quota_dwp)
$qty_gudang = array();
$avg_gudang = array();
$qty_outlet = array();
$avg_outlet = array();

// Loop through the 7 DWPs
for ($i = 1; $i <= 7; $i++) {
    // Calculate quota_dwp (Max - Min for max_dwp values)
    if (!empty($max_dwp_values[$i])) {
        $max_value = max($max_dwp_values[$i]);
        $min_value = min($max_dwp_values[$i]);
        $quota_dwp[$i] = $max_value - $min_value; // Store the result in quota_dwp
    } else {
        $quota_dwp[$i] = 0; // If no values exist, set to 0
    }

    // Calculate qty_dwp (Max - Min for meter_dwp values)
    if (!empty($meter_dwp_values[$i])) {
        $max_meter_value = max($meter_dwp_values[$i]);
        $min_meter_value = min($meter_dwp_values[$i]);
        $qty_dwp[$i] = $max_meter_value - $min_meter_value; // Store the result in qty_dwp
    } else {
        $qty_dwp[$i] = 0; // If no values exist, set to 0
    }

    // Calculate avg_dwp (average of volume_dwp values)
    if (!empty($volume_dwp_values[$i])) {
        $avg_dwp[$i] = array_sum($volume_dwp_values[$i]) / count($volume_dwp_values[$i]); // Calculate and store average
    } else {
        $avg_dwp[$i] = 0; // If no values exist, set to 0
    }

    // Calculate dev_dwp (qty_dwp - quota_dwp)
    $dev_dwp[$i] = $qty_dwp[$i] - $quota_dwp[$i]; // Calculate and store dev_dwp
}

    if (!empty($meter_gudang_values)) {
        $max_meter_value = max($meter_gudang_values);
        $min_meter_value = min($meter_gudang_values);
        $qty_gudang[0] = $max_meter_value - $min_meter_value; // Store the result in qty_gudang[0]
    } else {
        $qty_gudang[0] = 0; // If no values exist, set to 0
    }

    // Calculate avg_gudang (average of volume_gudang values)
    if (!empty($volume_gudang_values)) {
        $avg_gudang[0] = array_sum($volume_gudang_values) / count($volume_gudang_values); // Calculate and store average
    } else {
        $avg_gudang[0] = 0; // If no values exist, set to 0
    }

    foreach ($outlet_fields as $field) {
        if (!empty($counter_outlet_values[$field])) {
            // Get the max and min values for the current field
            $max_counter_value = max($counter_outlet_values[$field]);
            $min_counter_value = min($counter_outlet_values[$field]);
            
            // Store the result in qty_outlet[$field]
            $qty_outlet[$field] = $max_counter_value - $min_counter_value; 
        } else {
            $qty_outlet[$field] = 0;
        }

    if (!empty($volume_outlet_values[$field])) {
        $avg_outlet[$field] = array_sum($volume_outlet_values[$field]) / count($volume_outlet_values[$field]); // Calculate and store average
    } else {
        $avg_outlet[$field] = 0; // If no values exist, set to 0
    }

}
?>
<tr>
    <th colspan="5" style="border-right: 3px solid black;">Volume</th>
    <?php for ($i = 1; $i <= 7; $i++) : ?>
    <th>
    <?php echo formatValue((int)$quota_dwp[$i]); ?>
    </th>
    <th>
    <?php echo formatValue((int)$qty_dwp[$i]); ?>
    </th>
    <th></th>
    <th>
    <?php echo formatValue((int)$avg_dwp[$i]); ?>
    </th>
    <th style="border-right: 3px solid black;">
    <?php echo formatValue((int)$dev_dwp[$i]); ?>
    </th>
    <?php endfor;?>
    <th>
    <?php echo formatValue((int)$qty_gudang[0]); ?>
    </th>
    <th>
    <?php echo formatValue((int)$avg_gudang[0]); ?>
    </th>
    <th></th>
    <?php foreach ($outlet_fields as $field) : ?>
    <th>
    <?php echo formatValue((int)$qty_outlet[$field]); ?>
    </th>
    <th>
    <?php echo formatValue((int)$avg_outlet[$field]); ?>
    </th>
    <th></th>
    <?php endforeach; ?>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
    <th></th>
</tr>
<tr>
    <td style="border: none; background-color: #c1d6f3;"></td>
    <td style="border: none; background-color: #c1d6f3;"></td>
    <td style="border: none; background-color: #c1d6f3;"></td>
    <td style="border: none; background-color: #c1d6f3;"></td>
    <td style="border: none; background-color: #c1d6f3;"></td>
<?php for ($i = 1; $i <= 7; $i++) : ?>
    <td style="border: none; background-color: #c1d6f3; font-size:11px; vertical-align: top; font-weight:550;">Quota</td>
    <td style="border: none; background-color: #c1d6f3; font-size:11px; vertical-align: top; font-weight:550;">Qty</td>
    <td style="border: none; background-color: #c1d6f3;"></td>
    <td style="border: none; background-color: #c1d6f3; font-size:11px; vertical-align: top; font-weight:550;">Average</td>
    <td style="border: none; background-color: #c1d6f3; font-size:11px; vertical-align: top; font-weight:550;">Deviation</td>
<?php endfor; ?>
</tr>
    </tbody>
    </table>
    <button class="btn">SAVE</button>
    </form>

                
<table id="tableSummary" style="width:500px; align-self:flex-start; margin-left: 40px; margin-top: -70px;">
        <thead>
            <tr>
                <th>DWP</th>
                <th>Stand Meter</th>
                <th>Vol</th>
                <th>Avg/d</th>
                <th>Sisa Quota</th>
                <th>Quota</th>
            </tr>
        </thead>
        <tbody>
        <?php for ($i = 1; $i <= 7; $i++) : ?>
            <tr>
                <td>No. <?php echo $i ?></td>
                <td><?php if (!empty($meter_dwp_values[$i])) {
                    echo formatValue(max($meter_dwp_values[$i]));} else echo "0"; ?></td>
                <td><?php echo formatValue((int)$qty_dwp[$i]); ?></td>
                <td><?php echo formatValue((int)$avg_dwp[$i]); ?></td>
                <td><?php echo formatValue((int)$dev_dwp[$i]); ?></td>
                <td><?php echo formatValue((int)$quota_dwp[$i]); ?></td>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
</main>
<script src="js/exceljs.min.js"></script>
<script>
document.getElementById("exit").onclick = function() {
    location.href = 'selection.php';
}
$(".enum").prop("selectedIndex", -1);
$(".input-field").val('');

$(document).ready(function() {
    $('.clear-btn').click(function() {
        var fieldToClear = $(this).data('field');
        var confirmed = confirm('Are you sure you want to clear this field?');

        if (confirmed) {
            // Send an AJAX request to update the field to NULL
            $.ajax({
                url: 'clear_field.php',
                method: 'POST',
                data: {
                    field_to_clear: fieldToClear,
                    unit: '<?php echo $unit; ?>' // Pass the unit parameter
                },
                success: function(response) {
                    // Reload the page after clearing the field
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        }
    });
});

document.getElementById('exportButton').addEventListener('click', async () => {
        const workbook = new ExcelJS.Workbook();
        const worksheet = workbook.addWorksheet('Konsumsi Air');

        // Add the headers
        worksheet.addRow(['No', 'Tanggal', 'Max Inlet/Day', 'Max Inlet/Day', 'Max Inlet/Day', 
            'INLET 1 - Deep Well Pump 1 (AKPI 1)', '', '', '', '', 
            'INLET 2 - Deep Well Pump 2 (AKPI 2)', '', '', '', '', 
            'INLET 3 - Deep Well Pump 3 (AKPI 3)', '', '', '', '', 
            'INLET 4 - Deep Well Pump 4 (AKPI 4)', '', '', '', '', 
            'INLET 5 - Deep Well Pump 5 (AKPI 5)', '', '', '', '', 
            'INLET 6 - Deep Well Pump 6 (AKPI 6)', '', '', '', '', 
            'INLET 7 - Deep Well Pump 7 (AKPI 7)', '', '', '', '', 
            'Sumur Resapan', '', '', 
            'Outlet 1 - Fresh Water Tank 1', '', '', '', '', '',
            'Outlet 3 - Fresh Water Tank 3', '', '', '', '', '', 
            'Outlet 4 - Fresh Water Tank 4', '', '', '', '', '', '', '', '', '', '', '',
            'Outlet 5 - Reverse Osmosis Water', '', '', '', '', '', 
            'Outlet 6 - Reverse Osmosis Water', '', '', 
            'Outlet 7 - Cooling Tower Water Makeup', '', '', '', '', '', '', '', '',
            'Outlet 8 - Hydrant Water Discharge 1', '', '', 
            'Outlet 9 - Hydrant Water Discharge 2', '', '', 
            'Outlet 10 - Fresh Water Supply', '', '', 
            'Deep Well Tank', '', 
            'Clean Water Tank',
            'Water Make UP', 
            'Entry By']);

    // Merge headers for complex structure and set alignment
    const mergeCells = [
        { range: 'F1:J1' },
        { range: 'K1:O1' },
        { range: 'P1:T1' },
        { range: 'U1:Y1' },
        { range: 'Z1:AD1' },
        { range: 'AE1:AI1' },
        { range: 'AJ1:AN1' },
        { range: 'AO1:AQ1' },
        { range: 'AR1:AW1' },
        { range: 'AX1:BC1' },
        { range: 'BD1:BO1' },
        { range: 'BP1:BU1' },
        { range: 'BV1:BX1' },
        { range: 'BY1:CG1' },
        { range: 'CH1:CJ1' },
        { range: 'CK1:CM1' },
        { range: 'CN1:CP1' },
        { range: 'CQ1:CR1' }
    ];

    mergeCells.forEach(cell => {
        worksheet.mergeCells(cell.range);
        const mergedCell = worksheet.getCell(cell.range.split(':')[0]);
        mergedCell.alignment = { horizontal: 'center', vertical: 'middle' }; // Center align text
    });

    // Add data rows from the table
    const rows = document.querySelectorAll('#tableAir tbody tr');
    rows.forEach(row => {
        const rowData = [];
        row.querySelectorAll('td').forEach(cell => {
            rowData.push(cell.innerText);
        });
        worksheet.addRow(rowData);
    });

    // Save the workbook
    const buffer = await workbook.xlsx.writeBuffer();
    const blob = new Blob([buffer], { type: 'application/octet-stream' });
    const url = window.URL.createObjectURL(blob);
    const a = document.createElement('a');
    a.href = url;
    a.download = 'konsumsi_air.xlsx';
    a.click();
    window.URL.revokeObjectURL(url);
});
</script>
</body>
</html>
