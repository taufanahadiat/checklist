<?php 
// PHP for handling the formatted date logic
if (isset($_GET['selectedDate'])) {
    $tanggal = "" . $_GET['selectedDate']; 
    $date = DateTime::createFromFormat('Y-m-d', $tanggal);
} elseif (isset($_GET['selectedMonth'])) {
    $tanggal = "" . $_GET['selectedMonth']; 
    $date = DateTime::createFromFormat('Y-m', $tanggal);
}

$formattedDate = $date ? $date->format(isset($_GET['selectedDate']) ? 'd F Y' : 'F Y') : '';

if ($date) {
    $formattedDate = str_replace($date->format('F'), strtoupper($date->format('F')), $formattedDate);
}

if(!isset($unit)){
    $unit = '';
}
?>

<?php if (isset($_GET['selectedMonth'])): ?>
    <h2 style="margin-top: 5px; margin-bottom: 5px; font-size: 18px; font-weight:550;">── <?php echo $formattedDate ?> ──</h2>
<?php else: ?>
    <h2 style="margin-top: -20px; margin-bottom: 5px; font-size: 18px; font-weight:550;">── <?php echo $formattedDate ?> ──</h2>
<?php endif; ?>

<div class="custom-label-sub">
    <div class="form-row">
        
        <?php
        $genset = array(
            'common_unit','fuel_booster','fuel_oil_feeder','fuel_transfer_pump_unit','genset_man','genset_wartsila_01',
            'genset_wartsila_02','heater_oil','hfo_separator_pump_unit','hfo_unloading_pump_unit','kebocoran_fuel_tank','lfo_unloading_pump_unit'
        );
        $compressor = array(
            'compressor','air_dryer','air_receiver_tank'
        );

        if (in_array($unit, $genset)) {
            include 'pilih-unit-genset.php';
        }
        ?>

    <form method="GET" action="" onsubmit="return validateForm()">
        <div class="custom-label-form">
            <label for="selectedDate" style="font-size:18px">Tanggal:</label>
            <div class="unitfield-form">
                <!-- Show the appropriate input (date or month) based on the current selection -->
                <?php if (isset($_GET['selectedMonth'])): ?>
                    <input type="month" id="selectedMonth" class="input-container" name="selectedMonth" style="margin-top:2px; height:25px">
                <?php else: ?>
                    <input type="date" id="selectedDate" class="input-container" name="selectedDate" style="margin-top:2px; height:25px">
                <?php endif; ?>
            </div>

            <!-- Pass hidden fields -->
            <?php
            if (isset($_GET['selectedUnit'])) {
                echo '<input type="hidden" name="selectedUnit" value="' . htmlspecialchars($_GET['selectedUnit']) . '">';
            }
            if (isset($_GET['selectedUnit2'])) {
                echo '<input type="hidden" name="selectedUnit2" value="' . htmlspecialchars($_GET['selectedUnit2']) . '">';
            }
            if (isset($_GET['selectedLine'])) {
                echo '<input type="hidden" name="selectedLine" value="' . htmlspecialchars($_GET['selectedLine']) . '">';
            }
            ?>
        </div>
    </form>
    </div>
</div>


<script>
function validateForm() {
    var selectedDate = document.getElementById("selectedDate");
    var selectedMonth = document.getElementById("selectedMonth");
    
    // Ensure at least one of the fields has a value
    if ((selectedDate && selectedDate.value == "") || (selectedMonth && selectedMonth.value == "")) {
        alert("Please select a date or month!");
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}

// Automatically submit the form when the date or month input changes
var dateInput = document.getElementById("selectedDate");
var monthInput = document.getElementById("selectedMonth");

if (dateInput) {
    dateInput.addEventListener("change", function() {
        document.querySelector("form[method='GET']").submit();
    });
}

if (monthInput) {
    monthInput.addEventListener("change", function() {
        document.querySelector("form[method='GET']").submit();
    });
}

</script>
