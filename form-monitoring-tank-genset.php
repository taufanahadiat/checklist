<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string
require 'database.php';
require 'request-monitor-tank-genset.php';

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
    <title>Form Checklist</title>
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
    <h2>MONITORING FUEL DAY TANK GENSET WARTSILA</h2>
    <table>
        <thead>
            <tr>
                <th rowspan="3">No</th>
                <th rowspan="3">Tanggal</th>
                <th colspan="8">SOLAR / LFO</th>
                <th colspan="3">MINYAK BAKAR / HFO</th>
                <th style="font-size:0.8em; width:3%;">Estimasi Pemakaian<br></th>
                <th rowspan="3">Entry By</th>
            </tr>
            <tr>
                <th>Level Tanki</th>
                <th colspan="2">Persentase</th>
                <th>Stock</th>
                <th rowspan="2" style="width: 7%;">Status</th>
                <th colspan="3">Flowrate</th>
                <th>Level Tank</th>
                <th>Storage Tank</th>
                <th>Day Tank</th>
                <th rowspan="2" style="font-size:0.8em;">1 Engine-Full Load (Hours)</th>
            </tr>
            <tr>
                <th>(Cm)</th>
                <th>Tank (%)</th>
                <th>Computer (%)</th>
                <th>Liter</th>
                <th>Awal (m³)</th>
                <th>Akhir (m³)</th>
                <th>Liter</th>
                <th>(Cm)</th>
                <th>Liter</th>
                <th>Liter</th>
            </tr>
        </thead>
        <form method="post">
            <tbody>
                <?php 
                require 'database.php';
                include 'request-view-monitor-tank-genset.php';
            
?>

<?php if (mysqli_num_rows($result_previous) > 0) : ?>
    <?php while ($previous_record = mysqli_fetch_assoc($result_previous)) : ?>
    <tr>
        <td><?php echo htmlspecialchars(formatValue($previous_record['id'])); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_record['tanggal'])); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_record['lfo_lvl_tank'])); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_record['lfo_percent_tank'])); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_record['lfo_percent_comp'])); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_record['stock_liter'])); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_record['status'])); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_record['flow_awal'])); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_record['flow_akhir'])); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_record['flow_liter'])); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_record['hfo_lvl_tank'])); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_record['hfo_st_tank'])); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_record['hfo_day_tank'])); ?></td>
        <td><?php echo htmlspecialchars(formatValue($previous_record['estimasi_pakai'])); ?></td>
        <td>
            <?php echo htmlspecialchars(formatValue($previous_record['pic'])); ?>
            <br>
            <?php echo htmlspecialchars(formatValue($previous_record['time'])); ?>
        </td>
    </tr>
    <?php endwhile; ?>
<?php endif; ?>

<tr>  
    <td>
        <?php echo htmlspecialchars(formatValue($existing_record['id'])); ?>
    </td>              
    <td>
        <?php if ($existing_record && isset($existing_record['tanggal'])) :?>
            <?php echo htmlspecialchars(formatValue($existing_record['tanggal'])); ?>
        <?php endif;?>
    </td>
    <td>
        <?php if ($existing_record && isset($existing_record['lfo_lvl_tank'])) :?>
            <?php echo htmlspecialchars(formatValue($existing_record['lfo_lvl_tank'])); ?>
            <button type='button' class='clear-btn' data-field='lfo_lvl_tank'>X</button>
        <?php else: ?>
            <input class="input-field" type="number" step="0.01" name="lfo_lvl_tank" id="lfo_lvl_tank">
        <?php endif;?>
    </td>
    <td>
        <?php if (!isset($existing_record['lfo_lvl_tank'])) :?>
            <input type="hidden" name="lfo_percent_tank" id="lfo_percent_tank" value="">
        <?php elseif ($existing_record && isset($existing_record['lfo_percent_tank'])) :?>
            <?php echo htmlspecialchars(formatValue($existing_record['lfo_percent_tank'])); ?>
        <?php else: ?>
            <input type="hidden" id="lfo_percent_tank" name="lfo_percent_tank">
        <?php endif;?>
    </td>
    <td>
        <?php if (!isset($existing_record['lfo_lvl_tank'])) :?>
            <input type="hidden" name="lfo_percent_comp" id="lfo_percent_comp" value="">
        <?php elseif ($existing_record && isset($existing_record['lfo_percent_comp'])) :?>
            <?php echo htmlspecialchars(formatValue($existing_record['lfo_percent_comp'])); ?>
        <?php else: ?>
            <input type="hidden" id="lfo_percent_comp" name="lfo_percent_comp">
        <?php endif;?>
    </td>
    <td>
        <?php if (!isset($existing_record['lfo_lvl_tank'])) :?>
            <input type="hidden" name="stock_liter" id="stock_liter" value="">
        <?php elseif ($existing_record && isset($existing_record['stock_liter'])) :?>
            <?php echo htmlspecialchars(formatValue($existing_record['stock_liter'])); ?>
        <?php else: ?>
            <input type="hidden" id="stock_liter" name="stock_liter">
        <?php endif;?>
    </td>
    <td>
    <?php
    $today = date('Y-m-d');

    // Query to get the latest stock_liter entry before today
    $query = "SELECT stock_liter FROM $unit WHERE tanggal < '$today' ORDER BY tanggal DESC LIMIT 1";
    $result = mysqli_query($conn, $query);
    
    $previous_stock_liter = 0;
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $previous_stock_liter = $row['stock_liter'];
    }
    ?>
    <script>
    var previousStockLiter = <?php echo json_encode($previous_stock_liter); ?>;
    </script>

    <?php if (!isset($existing_record['lfo_lvl_tank'])) :?>
        <input type="hidden" name="status" id="status" value="">
    <?php elseif ($existing_record && isset($existing_record['status'])) :?>
        <?php 
    $status = htmlspecialchars(formatValue($existing_record['status']));

    // Determine the color based on the status
    $color = '';
    if (strpos($status, 'Filling') !== false) {
        $color = 'blue';
    } elseif (strpos($status, 'Usage') !== false) {
        $color = 'red';
    }
    ?>
    <span style="color: <?php echo $color; ?>; font-style: italic; font-weight: bold;">
        <?php echo $status; ?>
    </span>
    <?php else: ?>
        <input type="hidden" id="status" name="status">
    <?php endif; ?>
    </td>
    <td>
        <?php if ($existing_record && isset($existing_record['flow_awal'])) :?>
            <?php echo htmlspecialchars(formatValue($existing_record['flow_awal'])); ?>
            <button type='button' class='clear-btn' data-field='flow_awal'>X</button>
        <?php else: ?>
            <input class="input-field" type="number" step="0.01" name="flow_awal" id="flow_awal">
        <?php endif;?>
    </td>
    <td>
        <?php if ($existing_record && isset($existing_record['flow_akhir'])) :?>
            <?php echo htmlspecialchars(formatValue($existing_record['flow_akhir'])); ?>
            <button type='button' class='clear-btn' data-field='flow_akhir'>X</button>
        <?php else: ?>
            <input class="input-field" type="number" step="0.01" name="flow_akhir" id="flow_akhir">
        <?php endif;?>
    </td>
    <td>
        <?php if (!isset($existing_record['flow_awal']) || !isset($existing_record['flow_akhir'])) :?>
            <input type="hidden" name="flow_liter" id="flow_liter" value="">
        <?php elseif ($existing_record && isset($existing_record['flow_liter'])) :?>
            <?php echo htmlspecialchars(formatValue($existing_record['flow_liter'])); ?>
        <?php else: ?>
            <input type="hidden" id="flow_liter" name="flow_liter">
        <?php endif;?>
    </td>
    <td>
        <?php if ($existing_record && isset($existing_record['hfo_lvl_tank'])) :?>
            <?php echo htmlspecialchars(formatValue($existing_record['hfo_lvl_tank'])); ?>
            <button type='button' class='clear-btn' data-field='hfo_lvl_tank'>X</button>
        <?php else: ?>
            <input class="input-field" type="number" step="0.01" name="hfo_lvl_tank" id="hfo_lvl_tank">
        <?php endif;?>
    </td>
    <td>
        <?php if (!isset($existing_record['hfo_lvl_tank'])) :?>
            <input type="hidden" name="hfo_st_tank" id="hfo_st_tank" value="">
        <?php elseif ($existing_record && isset($existing_record['hfo_st_tank'])) :?>
            <?php echo htmlspecialchars(formatValue($existing_record['hfo_st_tank'])); ?>
        <?php else: ?>
            <input type="hidden" id="hfo_st_tank" name="hfo_st_tank">
        <?php endif;?>
    </td>
    <td>
        <?php if ($existing_record && isset($existing_record['hfo_day_tank'])) :?>
            <?php echo htmlspecialchars(formatValue($existing_record['hfo_day_tank'])); ?>
            <button type='button' class='clear-btn' data-field='hfo_day_tank'>X</button>
        <?php else: ?>
            <input class="input-field" type="number" step="0.01" name="hfo_day_tank" id="hfo_day_tank">
        <?php endif;?>
    </td>
    <td>
        <?php if (!isset($existing_record['stock_liter']) || !isset($existing_record['hfo_day_tank'])) :?>
            <input type="hidden" name="estimasi_pakai" id="estimasi_pakai" value="">
        <?php elseif ($existing_record && isset($existing_record['estimasi_pakai'])) :?>
            <?php echo htmlspecialchars(formatValue($existing_record['estimasi_pakai'])); ?>
        <?php else: ?>
            <input type="hidden" id="estimasi_pakai" name="estimasi_pakai">
        <?php endif;?>
    </td>
    <?php 
                if ($existing_record && isset($existing_record['pic'])){
                    echo "<td style='text-align:left; color:grey; padding: 5px 10px'>";
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
            </tbody>
    </table>
    <button type="button" id="addRowBtn">Add Row</button>
    <br>
    <button class="btn">SAVE</button>
    </form>
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

document.addEventListener('DOMContentLoaded', function() {
    var lfoLvlTankInput = document.getElementById('lfo_lvl_tank');
    var flowAwalInput = document.getElementById('flow_awal');
    var flowAkhirInput = document.getElementById('flow_akhir');
    var hfoLvlTankInput = document.getElementById('hfo_lvl_tank');
    var hfoDayTankInput = document.getElementById('hfo_day_tank');

    // Trigger calculations on input change
    if (lfoLvlTankInput) {
        lfoLvlTankInput.addEventListener('input', calculateValues);
    }
    if (flowAwalInput) {
        flowAwalInput.addEventListener('input', calculateFlowLiter);
    }
    if (flowAkhirInput) {
        flowAkhirInput.addEventListener('input', calculateFlowLiter);
    }
    if (hfoLvlTankInput) {
        hfoLvlTankInput.addEventListener('input', calculateHFOValues);
    }
    if (hfoDayTankInput) {
        hfoDayTankInput.addEventListener('input', calculateEstimasiPakai);
    }
});

function calculateValues() {
    var lfoLvlTankInput = document.getElementById('lfo_lvl_tank');
    var stockLiterInput = document.getElementById('stock_liter');
    var lfoPercentTankInput = document.getElementById('lfo_percent_tank');
    var lfoPercentCompInput = document.getElementById('lfo_percent_comp');
    var statusInput = document.getElementById('status');

    if (lfoLvlTankInput && stockLiterInput && lfoPercentTankInput && lfoPercentCompInput) {
        var lfoLvlTank = parseFloat(lfoLvlTankInput.value) || 0;

        var stockLiter = (lfoLvlTank * 16000) / 280 - 1500;

        if (!isNaN(stockLiter)) {
            var lfoPercentTank = (stockLiter / 16000) * 100;
            var lfoPercentComp = (lfoLvlTank / 300) * 43;
            var status = stockLiter - previousStockLiter;

            stockLiterInput.value = stockLiter.toFixed(2);
            lfoPercentTankInput.value = lfoPercentTank.toFixed(2);
            lfoPercentCompInput.value = lfoPercentComp.toFixed(2);

            if (!isNaN(status)) {
            var statusMessage;
            if (status < 0) {
                statusMessage = "Usage " + Math.abs(Math.round(status));
            } else {
                statusMessage = "Filling " + Math.round(status);
            }

            statusInput.value = statusMessage;
        }

            // Recalculate Estimasi Pakai if necessary
            calculateEstimasiPakai();
        } else {
            stockLiterInput.value = '';
            lfoPercentTankInput.value = '';
            lfoPercentCompInput.value = '';
            statusInput.value = '';
        }
    } else {
        console.error("One or more fields are missing from the DOM.");
    }
}

function calculateFlowLiter() {
    var flowAwalInput = document.getElementById('flow_awal');
    var flowAkhirInput = document.getElementById('flow_akhir');
    var flowLiterInput = document.getElementById('flow_liter');

    if (flowAwalInput && flowAkhirInput && flowLiterInput) {
        var flowAwal = parseFloat(flowAwalInput.value) || 0;
        var flowAkhir = parseFloat(flowAkhirInput.value) || 0;

        var flowLiter = (flowAkhir - flowAwal) * 1000;

        if (!isNaN(flowLiter)) {
            flowLiterInput.value = flowLiter.toFixed(2);
        } else {
            flowLiterInput.value = '';
        }
    } else {
        console.error("One or more fields (flow_awal, flow_akhir, flow_liter) are missing from the DOM.");
    }
}

function calculateHFOValues() {
    var hfoLvlTankInput = document.getElementById('hfo_lvl_tank');
    var hfoStTankInput = document.getElementById('hfo_st_tank');

    if (hfoLvlTankInput && hfoStTankInput) {
        var hfoLvlTank = parseFloat(hfoLvlTankInput.value) || 0;

        // Formula for HFO storage tank calculation: hfo_st_tank = hfo_lvl_tank * 3.143 * 777 * 777 / 4 / 1000
        var hfoStTank = (hfoLvlTank * 3.143 * 777 * 777) / 4 / 1000;

        if (!isNaN(hfoStTank)) {
            hfoStTankInput.value = hfoStTank.toFixed(2);
        } else {
            hfoStTankInput.value = '';
        }
    } else {
        console.error("One or more fields (hfo_lvl_tank, hfo_st_tank) are missing from the DOM.");
    }
}

function calculateEstimasiPakai() {
    var stockLiterInput = document.getElementById('stock_liter');
    var hfoDayTankInput = document.getElementById('hfo_day_tank');
    var estimasiPakaiInput = document.getElementById('estimasi_pakai');

    if (stockLiterInput && hfoDayTankInput && estimasiPakaiInput) {
        var stockLiter = parseFloat(stockLiterInput.value) || 0;
        var hfoDayTank = parseFloat(hfoDayTankInput.value) || 0;

        // Formula for estimasi_pakai: ((stock_liter - 1500 + hfo_day_tank - 3000) / 500)
        var estimasiPakai = ((stockLiter - 1500 + hfoDayTank - 3000) / 500);

        if (!isNaN(estimasiPakai)) {
            estimasiPakaiInput.value = estimasiPakai.toFixed(2);
        } else {
            estimasiPakaiInput.value = '';
        }
    } else {
        console.error("One or more fields (stock_liter, hfo_day_tank, estimasi_pakai) are missing from the DOM.");
    }
}

document.getElementById('addRowBtn').addEventListener('click', function() {
    // Get the last row of the tbody
    var tableBody = document.querySelector('tbody');
    var lastRow = tableBody.querySelector('tr:last-child');
    var newRow = lastRow.cloneNode(true);  // Clone the last row

    // Increment the id for each input field in the new row
    newRow.querySelectorAll('input').forEach(function(input) {
        var currentId = input.id;
        if (currentId) {
            // Extract the numeric part of the id and increment it
            var idNumber = parseInt(currentId.replace(/\D/g, ''), 10) + 1;
            var newId = currentId.replace(/\d+/, idNumber);

            // Update the id and name attribute
            input.id = newId;
            input.name = newId;

            // Clear the value of the new input field for user input
            input.value = '';
        }
    });

    // Append the new row to the tbody
    tableBody.appendChild(newRow);
});

</script>
</body>
</html>
