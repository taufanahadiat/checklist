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
        table {
          width: 100%;
          height: 600px; /* Set the height of the scrollable area */
          overflow-y:auto; /* Enable vertical scrolling */
        }

        .input-field {
            cursor: text;
            min-width: 70px;
            max-width: 85px;
        }

        thead{
          position: sticky; /* Make the header sticky */
          top: 0; /* Stick to the top of the container */
          z-index: 3; /* Ensure the header is above the body content */
        }

    </style>
</head>
<body>
<?php include 'header.php'; ?>
<main>
    <h2>MONITORING KONSUMSI AIR</h2>
    <button class ="btn" style="float:left; margin:0;" id="exportButton">Export to Excel</button>
                
<table id="tableAir" style="overflow-x: auto; display: block; width: 100%; table-layout: auto;">
        <thead>
            <tr>
                <th class="sticky-column-head" rowspan="4" style="min-width:30px; border-left: 3px solid black;">No</th>
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
                <th rowspan="4" style="white-space:nowrap; border-right: 3px solid black; padding: 2px 30px">Entry By</th>
                <th rowspan="4" style="white-space:nowrap; border-right: 3px solid black;"></th>
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
                <th style="min-width:45px;">V/d</th>
                <th style="font-size:0.7em; border-right: 3px solid black;">Kumulatif</th>
            <?php for ($i = 1; $i <= 21; $i++) : ?>
                <th style="min-width:70px;">Counter</th>
                <th style="min-width:45px;">V/d</th>
                <th style="font-size:0.7em; border-right: 3px solid black;">Kumulatif</th>
            <?php endfor;?>
            <th>Level</th>
            <th style="border-right: 3px solid black;">Level</th>
            <th style="min-width:70px; border-right: 3px solid black;">Level</th>
            <th style="min-width:70px; border-right: 3px solid black;">Level</th>
            </tr>
        </thead>
        <tbody>
    <?php for ($i = 0; $i < $id_num; $i++): ?>
    <?php
        // Calculate the current date dynamically
        $date = date("Y-m-d", strtotime("+$i day", $startTimestamp));


        // Calculate the values for the formulas, starting from the second row (index 1)
        if ($i > 0 && $i < $id_num) {
            $maxInlet1 += 1400 / $total_day;
            $maxInlet2 += 1500 / $total_day;
            $maxInlet3 += 1900 / $total_day;
        }
        ?>

        <tr>
        <th class="sticky-column parameter" id="id" style="border-left: 3px solid black;"><?php echo $i + 1; ?></th> 
        <th class="sticky-column parameter"><?php echo $date; ?></th> 
        <form method="post">
        <input type="hidden" name="tanggal" value="<?php echo $date; ?>">
        <th><?php echo $i > 0 ? round($maxInlet1) : '0'; ?></th>
        <th><?php echo $i > 0 ? round($maxInlet2) : '0'; ?></th>
        <th style="border-right: 3px solid black;"><?php echo $i > 0 ? round($maxInlet3) : '0'; ?></th>
        <?php for ($j = 1; $j <= 7; $j++): ?>
            <td id="<?php echo $i ?>_max_dwp<?php echo $j ?>"></td>
            <td id="<?php echo $i ?>_meter_dwp<?php echo $j ?>"
                data-value="<?php echo isset(${"record_$date"}["meter_dwp$j"]) ? htmlspecialchars(formatValue(${"record_$date"}["meter_dwp$j"])) : 0; ?>">
                <?php
                    echo htmlspecialchars(formatValue(${"record_$date"}["meter_dwp$j"]));
                ?>
            </td>
            <td id="<?php echo $i ?>_instruction_dwp<?php echo $j ?>" style="white-space: nowrap;"></td>
            <td id="<?php echo $i ?>_volume_dwp<?php echo $j ?>"></td>
            <td id="<?php echo $i ?>_kumulatif_dwp<?php echo $j ?>" style="border-right: 3px solid black;"></td>
        <?php endfor; ?>
            <td id="<?php echo $i ?>_meter_gudang7"
                data-value="<?php echo isset(${"record_$date"}["meter_gudang7"]) ? htmlspecialchars(formatValue(${"record_$date"}["meter_gudang7"])) : 0; ?>">
                <?php 
                    echo htmlspecialchars(formatValue(${"record_$date"}["meter_gudang7"]));
                ?>
            </td>
            <td id="<?php echo $i ?>_volume_gudang7"></td>
            <td id="<?php echo $i ?>_kumulatif_gudang7" style="border-right: 3px solid black;"></td>
        <?php 
        $outlet_fields = array(
            'bopet', 'chbopet', 'cooltow_bopet', 'line48', 'ch458',
            'cooltow45', 'cooltow8', 'office', 'argha_water', 
            'cooltow_met34', 'cooltow_met12', 'bg48', 'waterbath8', 
            'waterbath45', 'waterbath67', 'cooltow67', 'cooltow6', 
            'cooltow7', 'hydrant48', 'hydrant67', 'line67'
        );
        $parameter = array(
            'count',
            'volume',
            'kumulatif'
        );
        ?>
        <?php foreach ($outlet_fields as $outlet): ?>
            <td id="<?php echo $i ?>_count_<?php echo $outlet ?>" 
                data-value="<?php echo isset(${"record_$date"}["count_$outlet"]) ? htmlspecialchars(formatValue(${"record_$date"}["count_$outlet"])) : 0; ?>">
                <?php 
                    echo htmlspecialchars(formatValue(${"record_$date"}["count_$outlet"]));
                ?>
            </td>
            <td id="<?php echo $i ?>_volume_<?php echo $outlet ?>"></td>
            <td id="<?php echo $i ?>_kumulatif_<?php echo $outlet ?>" style="border-right: 3px solid black;"></td>
        <?php endforeach; ?>
        <td style="min-width:100px; white-space: nowrap;">
                <?php echo htmlspecialchars(formatValue(${"record_$date"}["level_old_dwt"])); ?>
        </td>
        <td style="min-width:100px; white-space: nowrap; border-right: 3px solid black;">
        <?php if (${"record_$date"} && isset(${"record_$date"}["level_new_dwt"])) : ?>
                <?php echo htmlspecialchars(formatValue(${"record_$date"}["level_new_dwt"])); ?>
                <button type="button" class="clear-btn" data-field="level_new_dwt">X</button>
            <?php else : ?>
                <input class="input-field" type="number" step="0.01" name="level_new_dwt" id="level_new_dwt">
            <?php endif; ?>
        </td>
        <td style="min-width:100px; white-space: nowrap; border-right: 3px solid black;">
        <?php if (${"record_$date"} && isset(${"record_$date"}["level_cwt"])) : ?>
                <?php echo htmlspecialchars(formatValue(${"record_$date"}["level_cwt"])); ?>
                <button type="button" class="clear-btn" data-field="level_cwt">X</button>
            <?php else : ?>
                <input class="input-field" type="number" step="0.01" name="level_cwt" id="level_cwt">
            <?php endif; ?>
        </td>
        <td style="min-width:100px; white-space: nowrap; border-right: 3px solid black;">
        <?php if (${"record_$date"} && isset(${"record_$date"}["level_makeup"])) : ?>
                <?php echo htmlspecialchars(${"record_$date"}["level_makeup"]); ?>
                <button type="button" class="clear-btn" data-field="level_makeup">X</button>
            <?php else : ?>
                <input class="input-field" type="number" step="0.01" name="level_makeup" id="level_makeup">
            <?php endif; ?>
        </td>

    <?php 
                if (${"record_$date"} && isset(${"record_$date"}['pic'])){
                    echo "<td style='color:grey; text-align:left; padding: 5px; padding-right: 15px; white-space: nowrap; border-right: 3px solid black;'>";
                    echo htmlspecialchars(formatValue(${"record_$date"}['pic']));
                    echo "<br>";
                    echo htmlspecialchars(formatValue(${"record_$date"}['time']));
                    echo "</td>";
                }
                else{
                    echo "<td style='border-right: 3px solid black;'></td>";
                }
                echo "<input type='hidden' name='pic' value='" . htmlspecialchars($baris[0]) . "'>";
                echo '<input type="hidden" name="time" value="' . date('d/m/Y H:i') . '">';
                ?>
        <td><button class='btn' style='white-space:nowrap; padding:5px; margin-bottom: 0px;' type='submit'>Submit for <?php echo $date; ?></button></td>
        </form>    
    </tr>
        <?php endfor; ?>
        <tr>
    <th colspan="5" style="border-right: 3px solid black;">Volume</th>
    <?php for ($i = 1; $i <= 7; $i++) : ?>
    <th id="quota_dwp<?php echo $i;?>"></th>
    <th id="qty_dwp<?php echo $i;?>"></th>
    <th></th>
    <th id="avg_dwp<?php echo $i;?>"></th>
    <th style="border-right: 3px solid black;" id="dev_dwp<?php echo $i;?>"></th>
    <?php endfor;?>
    <th id="qty_gudang7"></th>
    <th id="avg_gudang7"></th>
    <th></th>
    <?php foreach ($outlet_fields as $field) : ?>
    <th id="qty_<?php echo $field;?>"></th>
    <th id="avg_<?php echo $field;?>"></th>
    <th></th>
    <?php endforeach; ?>
    <th></th>
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
    <td style="border: none; background-color: #c1d6f3; font-size:11px; vertical-align: top; font-weight:550;">Qty</td>
    <td style="border: none; background-color: #c1d6f3; font-size:11px; vertical-align: top; font-weight:550;">Average</td>
    <td style="border: none; background-color: #c1d6f3;"></td>
<?php foreach ($outlet_fields as $field) : ?>
    <td style="border: none; background-color: #c1d6f3; font-size:11px; vertical-align: top; font-weight:550;">Qty</td>
    <td style="border: none; background-color: #c1d6f3; font-size:11px; vertical-align: top; font-weight:550;">Average</td>
    <td style="border: none; background-color: #c1d6f3;"></td>
    <?php endforeach; ?>
</tr>
</tbody>
    </table>

 <!--               
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
        <?php //for ($i = 1; $i <= 7; $i++) : ?>
            <tr>
                <td>No. <?php //echo $i ?></td>
                <td><?php //if (!empty($meter_dwp_values[$i])) {
                    //echo formatValue(max($meter_dwp_values[$i]));} else //echo "0"; ?></td>
                <td><?php //echo formatValue((int)$qty_dwp[$i]); ?></td>
                <td><?php //echo formatValue((int)$avg_dwp[$i]); ?></td>
                <td><?php //echo formatValue((int)$dev_dwp[$i]); ?></td>
                <td><?php //echo formatValue((int)$quota_dwp[$i]); ?></td>
            </tr>
        <?php // endfor; ?>
        </tbody>
    </table>
                -->
</main>
<script src="js/exceljs.min.js"></script>
<script>
function clearField(button) {
    var fieldToClear = button.getAttribute('data-field');
    var dateToClear = button.getAttribute('data-tanggal');
    var confirmed = confirm('Are you sure you want to clear this field?');

    if (confirmed) {
        // Send an AJAX request to update the field to NULL
        var unit = '<?php echo $unit; ?>'; // Pass the unit parameter
        $.ajax({
            url: 'clear_field.php',
            method: 'POST',
            data: {
                field_to_clear: fieldToClear,
                unit: unit,
                date: dateToClear
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
}

document.addEventListener("DOMContentLoaded", function () {
    const totalDays = <?php echo $total_day; ?>; // Get total days from PHP

    for (let i = 0; i < <?php echo $id_num; ?>; i++) {
        for (let j = 1; j <= 7; j++) {
            const meterId = `${i}_meter_dwp${j}`;
            const maxId = `${i}_max_dwp${j}`;
            const instructionId = `${i}_instruction_dwp${j}`;
            const volumeId = `${i}_volume_dwp${j}`;
            const nextMeterId = `${i + 1}_meter_dwp${j}`; // Reference to the next meter reading
            const KumulatifId = `${i}_kumulatif_dwp${j}`; // Reference to the next meter reading
            const prevKumulatifId = `${i - 1}_kumulatif_dwp${j}`; // Reference to the next meter reading

            const meterElement = document.getElementById(meterId);
            const maxElement = document.getElementById(maxId);
            const instructionElement = document.getElementById(instructionId);
            const volumeElement = document.getElementById(volumeId);
            const nextMeterElement = document.getElementById(nextMeterId);
            const kumulatiElement = document.getElementById(KumulatifId);
            const prevKumulatiElement = document.getElementById(prevKumulatifId);

            if (meterElement) {
                const meterValue = parseFloat(meterElement.getAttribute("data-value")?.replace(/,/g, '') || '0');

                // Set max values and instructions
                if (i === 0) {
                    maxElement.textContent = meterValue.toLocaleString();
                    if (meterElement && !meterElement.querySelector('input')) {
                    instructionElement.textContent = "Pantau terus";
                    }
                } else {
                    let inlet;
                    if ([1, 2, 4].includes(j)) inlet = 1560;
                    else if (j === 3) inlet = 1410;
                    else if ([5, 6, 7].includes(j)) inlet = 1920;

                    const prevMaxElement = document.getElementById(`${i - 1}_max_dwp${j}`);
                    const prevMaxValue = parseFloat((prevMaxElement?.textContent || '1').replace(/,/g, '')) || 1;

                    // Calculate max value
                    const maxValue = (inlet / totalDays) + prevMaxValue;
                    if (document.getElementById(`0_max_dwp${j}`).textContent != 0) {
                        const roundedMaxValue = Math.round(maxValue);
                        maxElement.textContent = roundedMaxValue.toLocaleString();
                    }

                    // Update instructions
                    if (meterElement && !meterElement.querySelector('input')) {
                        if (meterValue > maxValue) {
                            instructionElement.textContent = "Change over pompa";
                        } else {
                            instructionElement.textContent = "Pantau terus";
                        }
                    }
                }

                // Calculate volume difference
                if (nextMeterElement && !nextMeterElement.querySelector('input')) {
                    const nextMeterValue = parseFloat(nextMeterElement.getAttribute("data-value")?.replace(/,/g, '') || '0');
                    const prevKumulatifValue = parseFloat((prevKumulatiElement?.textContent || '0').replace(/,/g, '')) || 0;
                    if (!isNaN(nextMeterValue)) {
                        const volumeValue = nextMeterValue - meterValue;
                        const kumulatifValue = nextMeterValue - meterValue + prevKumulatifValue;
                        if (!isNaN(volumeValue)) {
                            volumeElement.textContent = volumeValue.toLocaleString();
                            kumulatiElement.textContent = kumulatifValue.toLocaleString();
                        }
                    }
                }
            }
        }
        const gudangId = `${i}_meter_gudang7`;
        const gudangVolId = `${i}_volume_gudang7`;
        const nextGudangId = `${i + 1}_meter_gudang7`; 
        const gudangKumulatifId = `${i}_kumulatif_gudang7`; 
        const prevGudangKumulatifId = `${i - 1}_kumulatif_gudang7`; 

        const gudangElement = document.getElementById(gudangId);
        const gudangVolElement = document.getElementById(gudangVolId);
        const nextGudangElement = document.getElementById(nextGudangId);
        const gudangKumulatiElement = document.getElementById(gudangKumulatifId);
        const prevGudangKumulatiElement = document.getElementById(prevGudangKumulatifId);

        if (gudangElement) {
            const gudangValue = parseFloat(gudangElement.getAttribute("data-value")?.replace(/,/g, '') || '0');

            if (nextGudangElement && !nextGudangElement.querySelector('input')) {
                const nextGudangValue = parseFloat(nextGudangElement.getAttribute("data-value")?.replace(/,/g, '') || '0');
                const prevGudangKumulatifValue = parseFloat((prevGudangKumulatiElement?.textContent || '0').replace(/,/g, '')) || 0;
                if (!isNaN(nextGudangValue)) {
                    const gudangVolValue = nextGudangValue - gudangValue;
                    const gudangKumulatifValue = nextGudangValue - gudangValue + prevGudangKumulatifValue;
                    if (!isNaN(gudangVolValue)) {
                        gudangVolElement.textContent = gudangVolValue.toLocaleString();
                        gudangKumulatiElement.textContent = gudangKumulatifValue.toLocaleString();
                    }
                }
            }
        }

    <?php foreach ($outlet_fields as $outlet): ?>
        // Defining outlet-specific element IDs
        const outletId_<?php echo $outlet; ?> = `${i}_count_<?php echo $outlet; ?>`;
        const outletVolId_<?php echo $outlet; ?> = `${i}_volume_<?php echo $outlet; ?>`;
        const nextoutletId_<?php echo $outlet; ?> = `${i + 1}_count_<?php echo $outlet; ?>`;
        const outletKumulatifId_<?php echo $outlet; ?> = `${i}_kumulatif_<?php echo $outlet; ?>`;
        const prevOutletKumulatifId_<?php echo $outlet; ?> = `${i - 1}_kumulatif_<?php echo $outlet; ?>`;

        // Get the corresponding DOM elements
        const outletElement_<?php echo $outlet; ?> = document.getElementById(outletId_<?php echo $outlet; ?>);
        const outletVolElement_<?php echo $outlet; ?> = document.getElementById(outletVolId_<?php echo $outlet; ?>);
        const nextoutletElement_<?php echo $outlet; ?> = document.getElementById(nextoutletId_<?php echo $outlet; ?>);
        const outletKumulatifElement_<?php echo $outlet; ?> = document.getElementById(outletKumulatifId_<?php echo $outlet; ?>);
        const prevOutletKumulatifElement_<?php echo $outlet; ?> = document.getElementById(prevOutletKumulatifId_<?php echo $outlet; ?>);

        // Check if outlet element exists before proceeding
        if (outletElement_<?php echo $outlet; ?>) {
            const outletValue_<?php echo $outlet; ?> = parseFloat(outletElement_<?php echo $outlet; ?>.getAttribute("data-value")?.replace(/,/g, '') || '0');

            // Check if next outlet element exists and is not an input field
            if (nextoutletElement_<?php echo $outlet; ?> && !nextoutletElement_<?php echo $outlet; ?>.querySelector('input')) {
                const nextoutletValue_<?php echo $outlet; ?> = parseFloat(nextoutletElement_<?php echo $outlet; ?>.getAttribute("data-value")?.replace(/,/g, '') || '0');
                const prevOutletKumulatifValue_<?php echo $outlet; ?> = parseFloat((prevOutletKumulatifElement_<?php echo $outlet; ?>?.textContent || '0').replace(/,/g, '')) || 0;

                // Ensure next outlet value is a number before calculation
                if (!isNaN(nextoutletValue_<?php echo $outlet; ?>)) {
                    const outletVolValue_<?php echo $outlet; ?> = nextoutletValue_<?php echo $outlet; ?> - outletValue_<?php echo $outlet; ?>;
                    const outletKumulatifValue_<?php echo $outlet; ?> = outletVolValue_<?php echo $outlet; ?> + prevOutletKumulatifValue_<?php echo $outlet; ?>;

                    // Ensure outlet volume is a valid number before displaying
                    if (!isNaN(outletVolValue_<?php echo $outlet; ?>)) {
                        outletVolElement_<?php echo $outlet; ?>.textContent = outletVolValue_<?php echo $outlet; ?>.toLocaleString();
                        outletKumulatifElement_<?php echo $outlet; ?>.textContent = outletKumulatifValue_<?php echo $outlet; ?>.toLocaleString();
                    }
                }
            }
        }
    <?php endforeach; ?>
    }
    let maxValuesByColumn = [];
    let meterValuesByColumn = [];
    let volValuesByColumn = [];
    for (let j = 1; j <= 7; j++) {
    maxValuesByColumn[j] = [];  // Initialize an empty array for each column
    const quotaId = `quota_dwp${j}`;
    const quotaElement = document.getElementById(quotaId);

    meterValuesByColumn[j] = [];  // Initialize an empty array for each column
    const qtyId = `qty_dwp${j}`;
    const qtyElement = document.getElementById(qtyId);

    volValuesByColumn[j] = [];  // Initialize an empty array for each column
    const avgId = `avg_dwp${j}`;
    const avgElement = document.getElementById(avgId);

    const devId = `dev_dwp${j}`;
    const devElement = document.getElementById(devId);


    // Loop over rows (i = 0 to id_num)
    for (let i = 0; i < <?php echo $id_num; ?>; i++) {
        const maxId = `${i}_max_dwp${j}`;
        const maxElement = document.getElementById(maxId);

        const meterId = `${i}_meter_dwp${j}`;
        const meterElement = document.getElementById(meterId);

        const volumeId = `${i}_volume_dwp${j}`;
        const volumeElement = document.getElementById(volumeId);

        if (maxElement) {
            // Get the max value and parse it to float
            const maxValue = parseFloat(maxElement.textContent.replace(/,/g, '') || '0');
            maxValuesByColumn[j].push(maxValue);  // Store the value in the correct column index
        }

        if (meterElement && !meterElement.querySelector('input')) {
            // Get the max value and parse it to float
            const meterValue = parseFloat(meterElement.getAttribute("data-value")?.replace(/,/g, '') || '0');
            meterValuesByColumn[j].push(meterValue);  // Store the value in the correct column index
        }

        if (volumeElement && volumeElement.textContent !== "") {
            // Get the max value and parse it to float
            const volValue = parseFloat(volumeElement.textContent.replace(/,/g, '') || '0');
            volValuesByColumn[j].push(volValue);  // Store the value in the correct column index
        }
    }

// Calculate max and min for the current column (max_dwp)
const quotaColumnMax = maxValuesByColumn[j].length ? Math.max(...maxValuesByColumn[j]) : 0;
const quotaColumnMin = maxValuesByColumn[j].length ? Math.min(...maxValuesByColumn[j]) : 0;
const quotaColumnDiff = quotaColumnMax - quotaColumnMin;
const roundedQuotaColumnDiff = Math.round(quotaColumnDiff); // Round the difference
quotaElement.textContent = roundedQuotaColumnDiff.toLocaleString(); // Format and display

// Calculate max and min for the current column (meter_dwp)
const qtyColumnMax = meterValuesByColumn[j].length ? Math.max(...meterValuesByColumn[j]) : 0;
const qtyColumnMin = meterValuesByColumn[j].length ? Math.min(...meterValuesByColumn[j]) : 0;
const qtyColumnDiff = qtyColumnMax - qtyColumnMin;
const roundedQtyColumnDiff = Math.round(qtyColumnDiff); // Round the difference
qtyElement.textContent = roundedQtyColumnDiff.toLocaleString(); // Format and display

// Calculate the average for volume (volume_dwp)
const sumVolume = volValuesByColumn[j].reduce((acc, value) => acc + value, 0);
const avgColumn = volValuesByColumn[j].length ? sumVolume / volValuesByColumn[j].length : 0;
const roundedAvgColumn = Math.round(avgColumn); // Round the average
avgElement.textContent = roundedAvgColumn.toLocaleString(); // Format and display

// Calculate the deviation (difference between qty and quota)
const deviationColumn = roundedQtyColumnDiff - roundedQuotaColumnDiff; // Use rounded values for consistency
const roundedDeviationColumn = Math.round(deviationColumn); // Round the deviation
devElement.textContent = roundedDeviationColumn.toLocaleString(); // Format and display


}

let meterGudangByColumn = [];
let volGudangByColumn = [];

for (let i = 0; i < <?php echo $id_num; ?>; i++) {
const quotaGudang = document.getElementById(`${i}_meter_gudang7`);
const qtyGudangElement = document.getElementById('qty_gudang7');

const volGudangElement = document.getElementById(`${i}_volume_gudang7`);
const avgGudangElement = document.getElementById('avg_gudang7');


if (quotaGudang && !quotaGudang.querySelector('input')) {
            // Get the max value and parse it to float
            const meterGudangValue = parseFloat(quotaGudang.getAttribute("data-value")?.replace(/,/g, '') || '0');
            meterGudangByColumn.push(meterGudangValue);  // Store the value in the correct column index
        }

if (volGudangElement && volGudangElement.textContent !== "") {
            // Get the max value and parse it to float
            const volGudangValue = parseFloat(volGudangElement.textContent.replace(/,/g, '') || '0');
            volGudangByColumn.push(volGudangValue);  // Store the value in the correct column index
        }
    const qtyGudangMax = meterGudangByColumn.length ? Math.max(...meterGudangByColumn) : 0;
    const qtyGudangMin = meterGudangByColumn.length ? Math.min(...meterGudangByColumn) : 0;
    const qtyGudangDiff = qtyGudangMax - qtyGudangMin;
    qtyGudangElement.textContent = qtyGudangDiff.toLocaleString();

    const sumGudangVolume = volGudangByColumn.reduce((acc, value) => acc + value, 0);
    const avgGudangColumn = volGudangByColumn.length ? sumGudangVolume / volGudangByColumn.length : 0;
    avgGudangElement.textContent = Math.round(avgGudangColumn).toLocaleString(); // Round the value before displaying
}

});

</script>
</script>
<script>
document.getElementById("exit").onclick = function() {
    location.href = 'selection.php';
}
$(".enum").prop("selectedIndex", -1);
$(".input-field").val('');


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
<script>
<?php foreach ($outlet_fields as $field): ?>
    (function() {
        let meterOutletByColumn = []; // Initialize for each outlet field
        let volOutletByColumn = []; // Initialize for each outlet field

        const qtyOutletElement = document.getElementById('qty_<?php echo $field; ?>');
        const avgOutletElement = document.getElementById('avg_<?php echo $field; ?>');

        for (let i = 0; i < <?php echo $id_num; ?>; i++) {
            const quotaOutlet = document.getElementById(`${i}_count_<?php echo $field; ?>`);
            const volOutletElement = document.getElementById(`${i}_volume_<?php echo $field; ?>`);

            // Collect meter outlet values
            if (quotaOutlet && !quotaOutlet.querySelector('input')) {
                const meterOutletValue = parseFloat(
                    quotaOutlet.getAttribute("data-value")?.replace(/,/g, '') || '0'
                );
                meterOutletByColumn.push(meterOutletValue);
            }

            // Collect volume outlet values
            if (volOutletElement && volOutletElement.textContent.trim() !== "") {
                const volOutletValue = parseFloat(
                    volOutletElement.textContent.replace(/,/g, '') || '0'
                );
                volOutletByColumn.push(volOutletValue);
            }
        }

        // Calculate the max, min, and difference for meter outlets
        const qtyOutletMax = meterOutletByColumn.length ? Math.max(...meterOutletByColumn) : 0;
        const qtyOutletMin = meterOutletByColumn.length ? Math.min(...meterOutletByColumn) : 0;
        const qtyOutletDiff = qtyOutletMax - qtyOutletMin;
        qtyOutletElement.textContent = qtyOutletDiff.toLocaleString();

        // Calculate the average for volume outlets
        const sumOutletVolume = volOutletByColumn.reduce((acc, value) => acc + value, 0);
        const avgOutletColumn = volOutletByColumn.length ? sumOutletVolume / volOutletByColumn.length : 0;
        avgOutletElement.textContent = Math.round(avgOutletColumn).toLocaleString();
    })();
<?php endforeach; ?>
</script>

</body>
</html>
