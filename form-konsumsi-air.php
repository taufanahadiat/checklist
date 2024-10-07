<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
require 'database.php';
require 'request-konsumsi-air.php';

// The allowed IP address
$allowed_ip = array('131.107.7.210', '131.107.109.42');
// Get the user's IP address
$user_ip = $_SERVER['REMOTE_ADDR'];

// Check if the user's IP matches the allowed IP
if ($_SESSION["type_user"] !== '2' && !in_array($user_ip, $allowed_ip)) {
    // If not, set an error message and redirect to selection.php
    echo "<script>alert('Anda sedang tidak terhubung dengan WiFi di area Genset. Pastikan koneksi WiFi anda tidak terputus'); window.location.href = './selection.php';</script>";
    exit();
}

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

    <table style="overflow-x: auto; display: block; width: 100%; max-height: 800px; overflow-y: auto; table-layout: auto;">
        <thead>
            <tr>
                <th rowspan="3" style="min-width:30px;">No</th>
                <th rowspan="3" style="min-width:80px;">Tanggal</th>
                <th rowspan="3">Max Inlet/Day</th>
                <th rowspan="3">Max Inlet/Day</th>
                <th rowspan="3" style="border-right: 3px solid black;">Max Inlet/Day</th>
                <th colspan="5" style="border-right: 3px solid black;">INLET 1 - Deep Well Pump 1 (AKPI 1)</th>
                <th colspan="5" style="border-right: 3px solid black;">INLET 2 - Deep Well Pump 2 (AKPI 2)</th>
                <th colspan="5" style="border-right: 3px solid black;">INLET 3 - Deep Well Pump 3 (AKPI 3)</th>
                <th colspan="5" style="border-right: 3px solid black;">INLET 4 - Deep Well Pump 4 (AKPI 4)</th>
                <th colspan="5" style="border-right: 3px solid black;">INLET 5 - Deep Well Pump 5 (AKPI 5)</th>
                <th colspan="5" style="border-right: 3px solid black;">INLET 6 - Deep Well Pump 6 (AKPI 6)</th>
                <th colspan="5" style="border-right: 3px solid black;">INLET 7 - Deep Well Pump 7 (AKPI 7)</th>
                <th colspan="3" style="border-right: 3px solid black;">Sumur Resapan</th>
                <th rowspan="3">Entry By</th>
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
            </tr>
        </thead>
        <form method="post">
            <tbody>
                <?php 
                require 'database.php';
                include 'request-view-konsumsi-air.php';
    // Initialize arrays to store values for max_dwp, meter_dwp, and volume_dwp
    $max_dwp_values = array(); // For max_dwp values
    $meter_dwp_values = array(); // For meter_dwp values
    $volume_dwp_values = array(); // For volume_dwp values
    
    // Initialize each sub-array for max_dwp, meter_dwp, and volume_dwp
    for ($i = 1; $i <= 7; $i++) {
        $max_dwp_values[$i] = array();
        $meter_dwp_values[$i] = array();
        $volume_dwp_values[$i] = array();
    }
    ?>
<?php if (mysqli_num_rows($result_previous) > 0) : ?>
    <?php while ($previous_existing_record = mysqli_fetch_assoc($result_previous)) : ?>
    <tr>
        <td><?php echo htmlspecialchars(formatValue($previous_existing_record['id'])); ?></td>
        <td><?php echo htmlspecialchars(date("d M 'y", strtotime($previous_existing_record['tanggal']))); ?></td>
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
            <td style="font-size:13.5px; white-space: nowrap; font-weight:550; font-style:italic; color: 
                <?php echo ($previous_existing_record["instruction_dwp$i"] === 'Pantau terus') ? 'blue' : 'red'; ?>;">
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

        <td><?php echo htmlspecialchars(formatValue($previous_existing_record["meter_gudang7"])); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_existing_record["volume_gudang7"])); ?></td>
        <td style="border-right: 3px solid black;"><?php echo htmlspecialchars(formatValue($previous_existing_record["kumulatif_gudang7"])); ?></td>
        <td style="white-space: nowrap; text-align:left; padding: 5px 2px; padding-right: 15px; color:grey;">
            <?php echo htmlspecialchars(formatValue($previous_existing_record['pic'])); ?>
            <br>
            <?php echo htmlspecialchars(formatValue($previous_existing_record['time'])); ?>
        </td>
    </tr>
    <?php endwhile; ?>
<?php endif; ?>

<tr>  
    <td>
    <?php echo htmlspecialchars(formatValue($existing_record['id'])); ?>
    </td>              
    <td style="white-space: nowrap; padding: 5px;">
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
        <td style="font-size:13.5px; white-space: nowrap; font-weight:550; font-style:italic; color: 
            <?php echo (isset($existing_record["instruction_dwp$i"]) && $existing_record["instruction_dwp$i"] === 'Pantau terus') ? 'blue' : 'red'; ?>;">
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
                $meter_gudang_values[$i][] = (int)$meter_gudang_value; // Append to the specific $i sub-array
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
                $volume_gudang_values[$i][] = (int)$volume_gudang_value; // Append to the specific $i sub-array
                echo htmlspecialchars(formatValue($volume_gudang_value)); 
                ?>
            <?php endif; ?>
        </td>
        <td style="border-right: 3px solid black;">
            <?php if ($existing_record && isset($existing_record["kumulatif_gudang7$i"])) : ?>
                <?php echo htmlspecialchars(formatValue($existing_record["kumulatif_gudang7$i"])); ?>
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
        <?php if ($existing_record && isset($existing_record["qty_gudang7"])) : ?>
        <?php echo htmlspecialchars(formatValue($existing_record["qty_gudang7"])); ?>
        <?php endif; ?>
    </th>
    <th>
        <?php if ($existing_record && isset($existing_record["avg_gudang7"])) : ?>
        <?php echo htmlspecialchars(formatValue($existing_record["avg_gudang7"])); ?>
        <?php endif; ?>
    </th>
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
    <table style="width:500px; align-self:flex-start; margin-left: 40px; margin-top: -70px;">
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
</script>
</body>
</html>
