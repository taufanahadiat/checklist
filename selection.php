<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli('localhost', 'root','akpidev3','checklistnew_24');

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <meta charset="utf-8">
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="icon" type="image/x-icon" href="../../img/icon.ico">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <script src="js/libs/xlsx.full.min.js"></script>
    <style>
    /* Styling for the alert message */
    .alert {
      display: none; /* Hidden by default */
      padding: 10px;
      border: 1px solid #666262;
      background-color: #6b6969;
      color: #ffffff;
      border-radius: 5px;
      font-weight: bold;
      text-align: center;
      max-width: 500px;
      height: 30px;
      font-size: 18px;
      /* Positioning to prevent layout shift */
      position: absolute;
      bottom: 80px; /* Adjusted position near the bottom */
      left: 50%;
      transform: translateX(-50%);
      z-index: 1000; /* Ensures it stays on top */
    }

    /* Fade-out effect for 5 seconds */
    .fade-out {
      animation: fadeOut 1s forwards;
    }

    /* Keyframes for fade-out effect */
    @keyframes fadeOut {
      0% { opacity: 1; }
      100% { opacity: 0; display: none; }
    }

    .custom-label{
        display: flex;
        max-width: 100%;
    }
    </style>
  </head>
  <body>
    <?php include 'header.php'; ?>
    <div id="overlay"></div>
    <div id="custom-confirm">
        <h2>LOG-OUT</h2>
        <p>Apakah anda yakin ingin keluar Arghapedia Checklist?</p>
        <div id="custom-confirm-buttons">
            <button id="confirm-yes">Yes</button>
            <button id="confirm-no">No</button>
        </div>
    </div>
    <main>
        <div id="mainMenu">
    <?php include 'weeklyReport.php'?>
    <form>
    <div class="custom-label" style="margin-top: 20px;"> 
        <label for="menu-area">Area:&nbsp;</label>
        <select class="selection-area" name="menu-area" id="menu-area">
            <option value="" disabled selected hidden>Pilih Area</option>
            <option value="chiller">Chiller</option>
            <option value="compressor">Compressor</option>
            <option value="genset">Genset</option>
            <option value="boiler">Boiler</option>
            <option value="electric">Electric Utility</option>
            <option value="crane">Crane</option>
        </select>
    </div>

    <div class="radio">
        <label id="menu-form" class="menu-option">
            <img class="img" src="css/centang.png" alt="Form Checklist">
            <div class="selection-indicator">Entry Form</div>
            <input type="radio" id="form-btn" name="mode" value="form" 
            <?php if (isset($_SESSION['sesi_user']) && $_SESSION['sesi_user'] === 'guest') echo 'disabled'; ?>>
        </label>
        
        <label id="menu-view" class="menu-option">
            <img class="img" src="css/review.png" alt="View Checklist">
            <div class="selection-indicator">View Data</div>
            <input type="radio" id="view-btn" name="mode" value="view"
            <?php if (isset($_SESSION['type_user']) && ($_SESSION['type_user'] == 36 || $_SESSION['type_user'] == 2 || $_SESSION['type_user'] == 1)) echo 'onclick="showTemporaryAlert()"'; ?>>
        </label>
    </div>
</form>
<div id="alertMessage" class="alert"><span style="color:red;">!!!</span> Fitur 'Check' oleh atasan hanya terdapat di pilihan "All" <span style="color:red;">!!!</span></div>
    
    <script>
    // Function to display alert for 5 seconds, then fade out over 3 seconds
    function showTemporaryAlert() {
      const alertBox = document.getElementById('alertMessage');
      alertBox.style.display = 'block'; 

      setTimeout(() => {
        alertBox.classList.add('fade-out'); 
        setTimeout(() => {
          alertBox.style.display = 'none'; 
          alertBox.classList.remove('fade-out'); // Reset for next use
        }, 1000); // fade-out duration
      }, 1500); // initial delay
    }
  </script>

    <div id="select-form-chiller" style="display: none;">
        <form name="select-form-chiller" id="selectForm" onsubmit="setFormSubmitHandler(event)">
        <div class="custom-label"> 
        <div class="form-row">
          <?php include 'pilih-form-chiller.php' ?>
        </div>
        </div>
        <input class="btn" type="submit" value="SUBMIT">
      </form>
    </div>

    <div id="select-view-chiller" style="display: none;">
      <form name="select-view-chiller"  onsubmit="setFormSubmitHandler(event)">
        <div class="custom-label">
        <div class="form-row">
        <div class="unitfield" id="line-chiller-view">
            <label for="from">Line:</label>
            <select class="selection-genset" name="form" id="option-view-chiller">
              <option value="" disabled selected hidden>Pilih Line</option>
              <option value="all_chiller">All Line</option>
              <option value="chiller_trane_67bopet">OPP 6-7 & BOPET</option>
              <option value="chiller_trane_45met34">OPP 4,5,8 & Met 3-4</option>
              <option value="chiller_trane_coat14met12">Coat 1-4 & Met 1-2</option>
            </select>
          </div>
          <div class="tanggalfield" id="tanggal-chiller-day">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="input-container dateInput" name="tanggal" max="<?php echo $today->format('Y-m-d'); ?>">
        </div>
          <div class="unitfield">
            <label for="konsumsi_air" style="font-size: 0.9em">Report Daily:</label>
            <span style="font-size: 0.7em">Konsumsi Air&nbsp;
            <input type="checkbox" class="medium-checkbox selection-report" id="view-report-air" name="konsumsi_air" value="konsumsi_air" onclick="toggleSelections()">
            </span>
        </div>
        <div class="tanggalfield" id="tanggal-chiller-month" style="display:none;">
            <label for="tanggal">Tanggal:</label>
            <input type="month" class="input-container monthInput" name="tanggal" max="<?php echo $today->format('Y-m-d'); ?>">
          </div>
        </div>
        </div>
        <input class="btn" type="submit" value="SUBMIT">
      </form>
    </div>

    <div id="select-form-compressor" style="display: none;">
      <form name="select-form-compressor" onsubmit="handleFormSubmit(event, 'option-form-compressor')">
        <div class="custom-label"> 
        <div class="form-row">
          <?php include 'pilih-form-compressor.php' ?>
        </div>
        </div>
        <input class="btn" type="submit" value="SUBMIT">
      </form>
    </div>

    <div id="select-view-compressor" style="display: none;">
      <form name="select-view-compressor" onsubmit="handleFormSubmit(event, 'option-view-compressor')">
        <div class="custom-label"> 
        <div class="form-row">
          <?php include 'pilih-view-compressor.php' ?>
          <div class="tanggalfield">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="input-container dateInput" name="tanggal" max="<?php echo $today->format('Y-m-d'); ?>">
        </div>
        </div>
        </div>
        <input class="btn" type="submit" value="SUBMIT">
      </form>
    </div>

    <div id="select-form-genset" style="display: none;">
      <form name="select-form-genset" onsubmit="setFormSubmitHandler(event)">
        <div class="custom-label"> 
        <div class="form-row">
          <div class="unitfield" id="unit-container">
          <label for="unit-genset">Unit:</label>
            <select class="selection-genset" name="unit-genset" id="option-form-genset">
            <option value="" disabled selected hidden>Pilih Genset</option>
              <?php include 'list-genset.php' ?>
            </select>
          </div>
          <div class="unitfield">
            <label for="tank_genset" style="font-size: 0.9em">Report Monthly:</label>
            <span style="font-size: 0.7em">BBM Genset&nbsp;
            <input type="checkbox" class="medium-checkbox selection-report" id="option-report-genset" name="tank_genset" value="tank_genset" onclick="toggleSelections()">
            </span>
          </div>
          </div>
          </div>
          <input class="btn" type="submit" value="SUBMIT">
      </form>
    </div>
    
    <div id="select-view-genset" style="display: none;">
    <form name="select-view-genset" onsubmit="setFormSubmitHandler(event)">
    <div class="custom-label">
    <div class="form-row">
        <div class="unitfield" id="unit-genset-container">
        <label for="unit-genset">Unit:</label>
            <select class="selection-genset" name="unit-genset" id="option-view-genset">
            <option value="" disabled selected hidden>Pilih Genset</option>
            <option value="all_genset" class="placeholder-option">All Genset</option>
              <?php include 'list-genset.php' ?>
        </select>
        </div>
        <div class="tanggalfield" id="tanggal-genset-day">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="input-container dateInput" name="tanggal" max="<?php echo $today->format('Y-m-d'); ?>">
        </div>
        <div class="unitfield">
            <label for="tank_genset" style="font-size: 0.9em">Report Monthly:</label>
            <span style="font-size: 0.7em">BBM Genset&nbsp;
            <input type="checkbox" class="medium-checkbox selection-report" id="view-report-genset" name="tank_genset" value="tank_genset" onclick="toggleSelections()">
            </span>
          </div>
    </div>
    </div>
    <input class="btn" type="submit" value="SUBMIT">
</form>
</div>

<div id="select-form-boiler" style="display: none;">
      <form name="select-form-boiler" onsubmit="setFormSubmitHandler(event)">
        <div class="custom-label"> 
        <div class="form-row">
          <div class="unitfield" id="line-boiler-container">
          <label for="unit-boiler">Line:</label>
            <select class="selection-genset" name="unit-boiler" id="option-form-boiler">
              <?php include 'list-boiler.php' ?>
            </select>
          </div>
          <div class="unitfield">
            <label for="konsumsi_gas" style="font-size: 0.9em">Report Daily:</label>
            <span style="font-size: 0.7em">Konsumsi Gas&nbsp;
            <input type="checkbox" class="medium-checkbox selection-report" id="option-report-gas" name="konsumsi_gas" value="konsumsi_gas" onclick="toggleSelections()">
            </span>
          </div>
          </div>
        </div>
        <input class="btn" type="submit" value="SUBMIT">
      </form>
    </div>

<div id="select-view-boiler" style="display: none;">
    <form name="select-view-boiler" onsubmit="setFormSubmitHandler(event)">
    <div class="custom-label">
    <div class="form-row">
        <div class="unitfield" id="line-boiler-view">
        <label for="unit-boiler">Line:</label>
            <select class="selection-boiler" name="unit-boiler" id="option-view-boiler">
              <?php include 'list-view-boiler.php' ?>
        </select>
        </div>
        <div class="tanggalfield" id="tanggal-boiler-day">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="input-container dateInput" name="tanggal" max="<?php echo $today->format('Y-m-d'); ?>">
        </div>
        <div class="unitfield">
            <label for="konsumsi_gas" style="font-size: 0.9em">Report Daily:</label>
            <span style="font-size: 0.7em">Konsumsi Gas&nbsp;
            <input type="checkbox" class="medium-checkbox selection-report" id="view-report-gas" name="konsumsi_gas" value="konsumsi_gas" onclick="toggleSelections()">
            </span>
    </div>
    <div class="tanggalfield" id="tanggal-boiler-month" style="display:none;">
            <label for="tanggal">Bulan:</label>
            <input type="month" class="input-container monthInput" name="tanggal" max="<?php echo $today->format('Y-m-d'); ?>">
     </div>
     </div>
        </div>
        <input class="btn" type="submit" value="SUBMIT">
</form>
</div>


<div id="select-form-electric" style="display: none;">
      <form name="select-form-electric" onsubmit="setFormSubmitHandler(event)">
        <div class="custom-label"> 
        <div class="form-row">
          <div class="unitfield">
          <label for="form-electric">Check Sheet:</label>
            <select class="selection-genset" name="form-electric" id="option-form-electric" onchange="toggleSelections()">
            <option value="" disabled selected hidden>Pilih Sheet</option>
            <option value="trafo">Pengamanan Area</option>
            <option value="trafo_monthly">Transformator</option>
            <option value="panel">Panel Low Voltage</option>
            <option value="capbank">Capacitor Bank</option>
            <option value="grounding">Box Grounding</option>
            </select>
          </div>
        <!--Form Trafo-->  
          <div class="unitfield" id="line-trafo-form" style="display:none;">
          <label for="unit-trafo">Line:</label>
            <select class="selection-genset" name="unit-trafo" id="option-form-trafo">
              <?php include 'list-trafo.php' ?>
            </select>
          </div>
        <!--Form Panel LV-->  
        <div class="unitfield" id="line-panel-form" style="display:none;">
          <label for="unit-panel">Line:</label>
            <select class="selection-genset" name="unit-panel" id="option-form-panel">
              <?php include 'list-panel.php' ?>
            </select>
          </div>
        <!--Form Capbank-->  
          <div class="unitfield" id="line-capbank-form" style="display:none;">
          <label for="unit-capbank">Line:</label>
            <select class="selection-genset" name="unit-capbank" id="option-form-capbank">
              <?php include 'list-capbank.php' ?>
            </select>
          </div>
        <!--Form Grounding-->  
          <div class="unitfield" id="period-grounding-form" style="display:none;">
            <?php
                $current_year = date("Y");
            ?>
          <label for="period-grounding">Period:</label>
            <select class="selection-genset" name="period-grounding" id="option-form-grounding">
                <option value="" disabled selected hidden>Pilih Periode</option>
                <option value="grounding_1" class="placeholder-option"><?php echo $current_year;?>.1</option>
                <option value="grounding_2" class="placeholder-option"><?php echo $current_year;?>.2</option>
            </select>
          </div>
          </div>
        </div>
        <input class="btn" type="submit" value="SUBMIT">
      </form>
    </div>

<div id="select-view-electric" style="display: none;">
    <form name="select-view-electric" onsubmit="setFormSubmitHandler(event)">
    <div class="custom-label">
    <div class="form-row">
    <div class="unitfield">
          <label for="view-electric">Check Sheet:</label>
            <select class="selection-genset" name="view-electric" id="option-view-electric" onchange="toggleSelections()">
            <option value="" disabled selected hidden>Pilih Sheet</option>
            <option value="trafo">Pengamanan Area</option>
            <option value="trafo_monthly">Transformator</option>
            <option value="panel">Panel Low Voltage</option>
            <option value="capbank">Capacitor Bank</option>
            <option value="grounding">Box Grounding</option>
            </select>
          </div>
        <!--View Trafo-->  
        <div class="unitfield" id="line-trafo-view" style="display:none;">
        <label for="unit-trafo">Line:</label>
            <select class="selection-genset" name="unit-trafo" id="option-view-trafo">
              <?php include 'list-view-trafo.php' ?>
        </select>
        </div>
        <div class="tanggalfield" id="tanggal-electric-day" style="display:none;">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="input-container dateInput" name="tanggal" max="<?php echo $today->format('Y-m-d'); ?>">
        </div>

        <div class="tanggalfield" id="tanggal-trafo-month" style="display:none;">
            <label for="tanggal">Bulan:</label>
            <input type="month" class="input-container monthInput" name="bulan">
            <input type="hidden" name="trafo_monthly" value="trafo_monthly" id="option-view-trafoMonth">
        </div>
        <!--View Panel Low Voltage-->  
        <div class="tanggalfield" id="tanggal-panel-month" style="display:none;">
            <label for="tanggal">Bulan:</label>
            <input type="month" class="monthInput2 input-container" name="bulan">
            <input type="hidden" name="all_panel" value="all_panel" id="option-view-lvdp">
        </div>
        <!--View Capbank-->  
        <div class="tanggalfield" id="tanggal-capbank-month" style="display:none;">
            <label for="bulan">Bulan:</label>
            <input type="month" class="monthInput3 input-container" name="bulan">
            <input type="hidden" name="all_capbank" value="all_capbank" id="option-view-capbank">
        </div>
        <!--View Box Grounding-->  
        <div class="tanggalfield" id="tahun-grounding-year" style="display:none;">
            <label for="tahun">Tahun:</label>
            <select class="input-container yearInput" name="tahun">
                <?php
                $currentYear = date("Y");
                for ($year = $currentYear; $year >= 2020; $year--) {
                    echo "<option value=\"$year\">$year</option>";
                }
                ?>
            </select>
            <input type="hidden" name="all_grounding" value="all_grounding" id="option-view-grounding">
        </div>
    </div>
        </div>
        <input class="btn" type="submit" value="SUBMIT">
</form>
</div>

<div id="select-form-crane" style="display: none;">
        <form name="select-form-crane" onsubmit="handleSubmitCrane(event, 'option-form-crane')">
            <div class="custom-label">
                <div class="form-row">
                    <div class="unitfield">
                        <label for="line_crane">Line:</label>
                        <select class="selection-compressor" name="line_crane" id="line-craneForm">
                        <option value="" disabled selected hidden>Pilih Line</option>
                            <option value="line4">Line 4</option>
                            <option value="line5">Line 5</option>
                            <option value="line6">Line 6</option>
                            <option value="line7">Line 7</option>
                            <option value="line8">Line 8</option>
                            <option value="bopet">Line BOPET</option>
                            <option value="metalize">Metalize 1~4</option>
                            <option value="coating">Coating 1, 3, 4</option>
                            <option value="small_slitter">Small Slitter</option>
                        </select>
                    </div>
                    <div class="unitfield" id="unitForm-crane-container" style="display: none;">
                        <label for="unit_crane">Unit Crane:</label>
                        <select class="selection-genset" style="width: 400px" name="unit_crane" id="option-form-crane">
                            <?php include 'list-crane.php'?>
                        </select>
                    </div>
                </div>
        </div>
        <input class="btn" type="submit" value="SUBMIT">
        </form>
    </div>

<div id="select-view-crane" style="display: none;">
    <form name="select-view-crane" onsubmit="handleSubmitCrane(event, 'option-view-crane')">
        <div class="custom-label">
        <div class="form-row">
                    <div class="unitfield">
                        <label for="line_crane">Line:</label>
                        <select class="selection-compressor" name="line_crane" id="line-craneView">
                            <option value="" disabled selected hidden>Pilih Line</option>
                            <option value="line4">Line 4</option>
                            <option value="line5">Line 5</option>
                            <option value="line6">Line 6</option>
                            <option value="line7">Line 7</option>
                            <option value="line8">Line 8</option>
                            <option value="bopet">Line BOPET</option>
                            <option value="metalize">Metalize 1~4</option>
                            <option value="coating">Coating 1, 3, 4</option>
                            <option value="small_slitter">Small Slitter</option>
                        </select>
                    </div>
                    <div class="unitfield" id="unitView-crane-container" style="display: none;">
                        <label for="unit_crane">Unit Crane:</label>
                        <select class="selection-genset" style="width: 400px" name="unit_crane" id="option-view-crane">
                        <?php include 'list-crane-view.php'?>
                        </select>
                    </div>
                    <div class="tanggalfield">
                    <label for="tanggal">Bulan:</label>
                    <input type="month" class="input-container" id="monthCrane" name="tanggal">
                    </div>
                </div>
        </div>
        <input class="btn" type="submit" value="SUBMIT">
    </form>
</div>
</div>
</main>
<script>
document.addEventListener("DOMContentLoaded", function() {
    // Function to hide all unit_crane options initially
    function hideAllCraneOptions() {
        const craneOptionsForm = document.querySelectorAll("#option-form-crane option[line-value]");
        const craneOptionsView = document.querySelectorAll("#option-view-crane option[line-value]");
        craneOptionsForm.forEach(option => option.style.display = "none");
        craneOptionsView.forEach(option => option.style.display = "none");
    }

    // Function to show only options matching selected line_crane value
    function filterCraneOptions(selectedLine) {
        hideAllCraneOptions();  // Hide all options first
        const matchingOptionsForm = document.querySelectorAll(`#option-form-crane option[line-value='${selectedLine}']`);
        const matchingOptionsView = document.querySelectorAll(`#option-view-crane option[line-value='${selectedLine}']`);
        matchingOptionsForm.forEach(option => option.style.display = "block");
        matchingOptionsView.forEach(option => option.style.display = "block");
    }

    // Set up event listeners if elements exist
    const lineCraneForm = document.getElementById("line-craneForm");
    const lineCraneView = document.getElementById("line-craneView");
    const unitFormCraneContainer = document.getElementById("unitForm-crane-container");
    const unitViewCraneContainer = document.getElementById("unitView-crane-container");

    if (lineCraneForm) {
        lineCraneForm.addEventListener("change", function() {
            const selectedLine = this.value;
            if (unitFormCraneContainer) unitFormCraneContainer.style.display = "block";
            filterCraneOptions(selectedLine);
        });
    }

    if (lineCraneView) {
        lineCraneView.addEventListener("change", function() {
            const selectedLine = this.value;
            if (unitViewCraneContainer) unitViewCraneContainer.style.display = "block";
            filterCraneOptions(selectedLine);
        });
    }

    // Initial setup: hide all options
    hideAllCraneOptions();
});
    </script>

    <script>

    // Detect Firefox
    if (navigator.userAgent.includes("Firefox")) {
        // Select all <input type="month"> elements (both .monthInput class and #monthCrane)
        document.querySelectorAll("input[type='month']").forEach(function (inputElement) {
            // Create a wrapper div
            var wrapper = document.createElement("div");

            // Create month select
            var monthSelect = document.createElement("select");
            monthSelect.name = inputElement.name + "_month";
            monthSelect.className = "month-dropdown";

            // Add month options with 01, 02, ..., 12 values
            var months = [
                { value: "01", text: "January" },
                { value: "02", text: "February" },
                { value: "03", text: "March" },
                { value: "04", text: "April" },
                { value: "05", text: "May" },
                { value: "06", text: "June" },
                { value: "07", text: "July" },
                { value: "08", text: "August" },
                { value: "09", text: "September" },
                { value: "10", text: "October" },
                { value: "11", text: "November" },
                { value: "12", text: "December" }
            ];
            months.forEach(month => {
                var option = document.createElement("option");
                option.value = month.value;
                option.textContent = month.text;
                monthSelect.appendChild(option);
            });

            // Create year select
            var yearSelect = document.createElement("select");
            yearSelect.name = inputElement.name + "_year";
            yearSelect.className = "year-dropdown";

            // Get current year and set minYear to 2024
            var currentYear = new Date().getFullYear();
            var minYear = 2024;

            for (var i = currentYear; i >= minYear; i--) {
                var option = document.createElement("option");
                option.value = i;
                option.textContent = i;
                yearSelect.appendChild(option);
            }

            // Replace the input field with the dropdowns
            inputElement.parentNode.replaceChild(wrapper, inputElement);
            wrapper.appendChild(monthSelect);
            wrapper.appendChild(yearSelect);
        });
    }

        $(document).ready(function() {
            $("#exit").click(function() {
                $("#overlay, #custom-confirm").show();
            });

            $("#confirm-yes").click(function() {
                $.ajax({
                    url: '../logout.php',  
                    method: 'POST',
                    success: function() {
                        window.location.href = './index.php';
                    },
                    error: function() {
                        alert('Failed to destroy session. Please try again.');
                    }
                });
            });

            $("#confirm-no, #overlay").click(function() {
                $("#overlay, #custom-confirm").hide();
            });
        });

      $(document).ready(function() {
    const menuArea = $('#menu-area');
    const formBtn = $('#form-btn');
    const viewBtn = $('#view-btn');
    const selectFormGenset = $('#select-form-genset');
    const selectViewGenset = $('#select-view-genset');
    const selectFormChiller = $('#select-form-chiller');
    const selectViewChiller = $('#select-view-chiller');
    const selectFormCompressor = $('#select-form-compressor');
    const selectViewCompressor = $('#select-view-compressor');
    const selectFormBoiler = $('#select-form-boiler');
    const selectViewBoiler = $('#select-view-boiler');
    const selectFormElectric = $('#select-form-electric');
    const selectViewElectric = $('#select-view-electric');
    const selectFormCrane = $('#select-form-crane');
    const selectViewCrane = $('#select-view-crane');

    function handleVisibility() {
        selectFormGenset.toggle(menuArea.val() === 'genset' && formBtn.is(':checked'));
        selectViewGenset.toggle(menuArea.val() === 'genset' && viewBtn.is(':checked'));
        selectFormChiller.toggle(menuArea.val() === 'chiller' && formBtn.is(':checked'));
        selectViewChiller.toggle(menuArea.val() === 'chiller' && viewBtn.is(':checked'));
        selectFormCompressor.toggle(menuArea.val() === 'compressor' && formBtn.is(':checked'));
        selectViewCompressor.toggle(menuArea.val() === 'compressor' && viewBtn.is(':checked'));
        selectFormBoiler.toggle(menuArea.val() === 'boiler' && formBtn.is(':checked'));
        selectViewBoiler.toggle(menuArea.val() === 'boiler' && viewBtn.is(':checked'));
        selectFormElectric.toggle(menuArea.val() === 'electric' && formBtn.is(':checked'));
        selectViewElectric.toggle(menuArea.val() === 'electric' && viewBtn.is(':checked'));
        selectFormCrane.toggle(menuArea.val() === 'crane' && formBtn.is(':checked'));
        selectViewCrane.toggle(menuArea.val() === 'crane' && viewBtn.is(':checked'));
    }

    function handleModeChange() {
        handleVisibility();
    }

    menuArea.on('change', function() {
        handleVisibility();
    });

    formBtn.on('change', function() {
        handleModeChange();
    });

    viewBtn.on('change', function() {
        handleModeChange();
    });
});

  // Check if the user is a guest
  <?php if (isset($_SESSION['sesi_user']) && $_SESSION['sesi_user'] === 'guest'): ?>
    // Add an event listener for the click event on the disabled radio button
    document.getElementById('menu-form').addEventListener('click', function(event) {
      alert("You cannot select 'Form Checklist' in guest mode.");
    });
  <?php endif; ?>

  function toggleSelections() {
    const monitorBBMGensetCheckbox = document.getElementById('option-report-genset');
    const konsumsiAirCheckbox = document.getElementById('option-report-air');
    const konsumsiGasCheckbox = document.getElementById('option-report-gas');

    const monitorBBMGensetView = document.getElementById('view-report-genset');
    const konsumsiGasView = document.getElementById('view-report-gas');
    const konsumsiAirView = document.getElementById('view-report-air');

    const unitContainer = document.getElementById('unit-container');
    const unitGensetView = document.getElementById('unit-genset-container');
    const shiftContainer = document.getElementById('shift-container');
    const lineContainer = document.getElementById('line-container');
    const lineChillerView = document.getElementById('line-chiller-view');
    const lineBoilerContainer = document.getElementById('line-boiler-container');
    const lineBoilerView = document.getElementById('line-boiler-view');
    const lineTrafoForm = document.getElementById('line-trafo-form');
    const lineCapbankForm = document.getElementById('line-capbank-form');
    const linePanelForm = document.getElementById('line-panel-form');
    const lineTrafoView = document.getElementById('line-trafo-view');
    const periodGroundingForm = document.getElementById('period-grounding-form');

    const tanggalGensetDay = document.getElementById('tanggal-genset-day');
    const tanggalBoilerDay = document.getElementById('tanggal-boiler-day');
    const tanggalBoilerMonth = document.getElementById('tanggal-boiler-month');
    const tanggalChillerDay = document.getElementById('tanggal-chiller-day');
    const tanggalChillerMonth = document.getElementById('tanggal-chiller-month');
    const tanggalElectricDay = document.getElementById('tanggal-electric-day');
    const tanggalCapbankMonth = document.getElementById('tanggal-capbank-month');
    const tanggalPanelMonth = document.getElementById('tanggal-panel-month');
    const tanggalTrafoMonth = document.getElementById('tanggal-trafo-month');
    const tahunGroundingYear = document.getElementById('tahun-grounding-year');

    const viewSelectChiller = document.getElementById('option-view-chiller');
    const formSelectElectric = document.getElementById('option-form-electric');
    const viewSelectElectric = document.getElementById('option-view-electric');

    
    if (monitorBBMGensetCheckbox.checked) {
      unitContainer.style.display = 'none';
    } else {
      unitContainer.style.display = 'block';
    }

    if (monitorBBMGensetView.checked) {
      unitGensetView.style.display = 'none';
      tanggalGensetDay.style.display = 'none';
    } else {
      unitGensetView.style.display = 'block';
      tanggalGensetDay.style.display = 'block';
    }

    if (konsumsiAirCheckbox.checked) {
      shiftContainer.style.display = 'none';
      lineContainer.style.display = 'none';
    } else {
      shiftContainer.style.display = 'block';
      lineContainer.style.display = 'block';
    }

    if (konsumsiGasCheckbox.checked) {
      lineBoilerContainer.style.display = 'none';
    } else {
      lineBoilerContainer.style.display = 'block';
    }

    if (konsumsiGasView.checked) {
        lineBoilerView.style.display = 'none';
        tanggalBoilerDay.style.display = 'none';
        tanggalBoilerMonth.style.display = 'block';
    } else {
        lineBoilerView.style.display = 'block';
        tanggalBoilerDay.style.display = 'block';
        tanggalBoilerMonth.style.display = 'none';
    }

    if (konsumsiAirView.checked) {
        lineChillerView.style.display = 'none';
        tanggalChillerDay.style.display = 'none';
        tanggalChillerMonth.style.display = 'block';
    } else{
        lineChillerView.style.display = 'block';
        tanggalChillerDay.style.display = 'block';
        tanggalChillerMonth.style.display = 'none';
    }

    if (formSelectElectric.value === 'trafo') {
        lineCapbankForm.style.display = 'none';
        linePanelForm.style.display = 'none';
        lineTrafoForm.style.display = 'block';
        periodGroundingForm.style.display = 'none';
    } else if (formSelectElectric.value === 'capbank') {
        lineCapbankForm.style.display = 'block';
        linePanelForm.style.display = 'none';
        lineTrafoForm.style.display = 'none';
        periodGroundingForm.style.display = 'none';
    } else if (formSelectElectric.value === 'panel'){
        lineCapbankForm.style.display = 'none';
        linePanelForm.style.display = 'block';
        lineTrafoForm.style.display = 'none';
        periodGroundingForm.style.display = 'none';
    } else if(formSelectElectric.value === 'grounding'){
        lineCapbankForm.style.display = 'none';
        linePanelForm.style.display = 'none';
        lineTrafoForm.style.display = 'none';
        periodGroundingForm.style.display = 'block';
    } else if(formSelectElectric.value === 'trafo_monthly'){
        lineCapbankForm.style.display = 'none';
        linePanelForm.style.display = 'none';
        lineTrafoForm.style.display = 'none';
        periodGroundingForm.style.display = 'none';
    }

    if (viewSelectElectric.value === 'trafo') {
        tanggalTrafoMonth.style.display = 'none';
        tanggalCapbankMonth.style.display = 'none';
        tanggalPanelMonth.style.display = 'none';
        lineTrafoView.style.display = 'block';
        tanggalElectricDay.style.display = 'block';
        tahunGroundingYear.style.display = 'none';
    } else if (viewSelectElectric.value === 'capbank') {
        tanggalTrafoMonth.style.display = 'none';
        tanggalCapbankMonth.style.display = 'block';
        tanggalPanelMonth.style.display = 'none';
        lineTrafoView.style.display = 'none';
        tanggalElectricDay.style.display = 'none';
        tahunGroundingYear.style.display = 'none';
    } else if (viewSelectElectric.value === 'panel') {
        tanggalTrafoMonth.style.display = 'none';
        tanggalCapbankMonth.style.display = 'none';
        tanggalPanelMonth.style.display = 'block';
        lineTrafoView.style.display = 'none';
        tanggalElectricDay.style.display = 'none';
        tahunGroundingYear.style.display = 'none';
    } else if(viewSelectElectric.value === 'grounding'){
        tanggalTrafoMonth.style.display = 'none';
        tanggalCapbankMonth.style.display = 'none';
        tanggalPanelMonth.style.display = 'none';
        lineTrafoView.style.display = 'none';
        tanggalElectricDay.style.display = 'none';
        tahunGroundingYear.style.display = 'block';
    } else if (viewSelectElectric.value === 'trafo_monthly') {
        tanggalTrafoMonth.style.display = 'block';
        tanggalCapbankMonth.style.display = 'none';
        tanggalPanelMonth.style.display = 'none';
        lineTrafoView.style.display = 'none';
        tanggalElectricDay.style.display = 'none';
        tahunGroundingYear.style.display = 'none';
    }
  }

  function setFormSubmitHandler(event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    const monitorBBMGensetCheckbox = document.getElementById('option-report-genset');
    const monitorBBMGensetView = document.getElementById('view-report-genset');
    const reportCheckboxAir = document.getElementById('option-report-air');
    const reportCheckboxGas = document.getElementById('option-report-gas');
    const ViewCheckboxGas = document.getElementById('view-report-gas');
    const ViewCheckboxAir = document.getElementById('view-report-air');
    const formElectricSelect = document.getElementById('option-form-electric');
    const viewElectricSelect = document.getElementById('option-view-electric');
        
    if (monitorBBMGensetCheckbox.checked) {
        handleFormSubmit(event, 'option-report-genset');
    } else {
        handleFormSubmit(event, 'option-form-genset');
    }

    if (monitorBBMGensetView.checked) {
        handleFormSubmit(event, 'view-report-genset');
    } else {
        handleFormSubmit(event, 'option-view-genset');
    }

    if (reportCheckboxAir.checked) {
        handleFormSubmit(event, 'option-report-air');
    } else {
        handleFormSubmit(event, 'option-form-chiller');
    }

    if (reportCheckboxGas.checked) {
        handleFormSubmit(event, 'option-report-gas');
    } else {
        handleFormSubmit(event, 'option-form-boiler');
    }

    if (ViewCheckboxGas.checked) {
        handleFormSubmit(event, 'view-report-gas');
    } else {
        handleFormSubmit(event, 'option-view-boiler');
    }

    if (ViewCheckboxAir.checked) {
        handleFormSubmit(event, 'view-report-air');
    } else {
        handleFormSubmit(event, 'option-view-chiller');
    }

    if (formElectricSelect.value === 'trafo') {
        handleFormSubmit(event, 'option-form-trafo');
    } else if (formElectricSelect.value === 'capbank'){
        handleFormSubmit(event, 'option-form-capbank');
    } else if (formElectricSelect.value === 'panel'){
        handleFormSubmit(event, 'option-form-panel');
    } else if (formElectricSelect.value === 'grounding'){
        handleFormSubmit(event, 'option-form-grounding');
    } else if (formElectricSelect.value === 'trafo_monthly'){
        handleFormSubmit(event, 'option-form-electric');
    }

    if (viewElectricSelect.value === 'trafo') {
        handleFormSubmit(event, 'option-view-trafo');
    } else if (viewElectricSelect.value === 'capbank'){
        handleFormSubmit(event, 'option-view-capbank');
    } else if (viewElectricSelect.value === 'panel'){
        handleFormSubmit(event, 'option-view-lvdp');
    } else if (viewElectricSelect.value === 'grounding'){
        handleFormSubmit(event, 'option-view-grounding');
    } else if (viewElectricSelect.value === 'trafo_monthly'){
        handleFormSubmit(event, 'option-view-electric');
    }
  }


function handleFormSubmit(event, selectId) {
    event.preventDefault();

    var selectElement = document.getElementById(selectId);
    var selectedUnit = selectElement.value;

    // Find the closest form element that contains the select element
    var formElement = selectElement.closest('form');

    // Find the date input within the same form
    var dateInput = formElement.querySelector('.dateInput');
    var selectedDate = dateInput ? dateInput.value : null;
    var monthInput = formElement.querySelector('.monthInput');
    var selectedMonth = monthInput ? monthInput.value : null;
    var monthInput2 = formElement.querySelector('.monthInput2');
    var selectedMonth2 = monthInput2 ? monthInput2.value : null;
    var monthInput3 = formElement.querySelector('.monthInput3');
    var selectedMonth3 = monthInput3 ? monthInput3.value : null;
    var yearInput = formElement.querySelector('.yearInput');
    var selectedYear = yearInput ? yearInput.value : null;
    var monthDropdown = formElement.querySelector('.month-dropdown');
    var selectedMonthDropdown = monthDropdown ? monthDropdown.value : null;
    var yearDropdown = formElement.querySelector('.year-dropdown');
    var selectedYearDropdown = yearDropdown ? yearDropdown.value : null;

    // Assuming there is another select element for shift within the same form
    var shiftSelect = formElement.querySelector('.selection-shift');
    var selectedShift = shiftSelect ? shiftSelect.value : null;

    var lineSelect = formElement.querySelector('.selection-line');
    var selectedLine = lineSelect ? lineSelect.value : null; 
                  
            console.log('Selected <select> ID:', selectId);
            console.log('Selected Value:', selectedUnit);
            console.log('Selected Date:', selectedDate);
            console.log('Selected Shift:', selectedShift);

            switch (selectedUnit) {
            //Genset
                case 'fuel_transfer_pump_unit':
                case 'hfo_separator_pump_unit':
                case 'hfo_unloading_pump_unit':
                case 'lfo_unloading_pump_unit':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-hfo-lfo-fuel.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-all-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case 'common_unit':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-common-unit.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-all-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case 'fuel_booster':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-fuel-booster.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-all-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;     
                case 'fuel_oil_feeder':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-fuel-oil-feeder.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-all-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                                   
                case 'heater_oil':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-heater-oil.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-all-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case 'genset_man':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-genset-man.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-all-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                  
                case 'genset_wartsila_01':
                case 'genset_wartsila_02':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-all-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case 'kebocoran_fuel_tank':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-kebocoran-fuel-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-all-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case 'tank_genset':
                    if (selectId === 'option-report-genset') {
                        location.href = 'form-monitoring-tank-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'view-report-genset') {
                        location.href = 'view-all-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    }
                    break;
                case 'all_genset':
                    if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-all-genset.php?selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
            //Chiller
                case 'chiller_trane_67bopet':
                    if (selectId === 'option-form-chiller' && selectedShift) {
                        location.href = 'form-chiller67bopet-trane.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift);
                    } else if (selectId === 'option-view-chiller' && selectedDate) {
                        location.href = 'view-chiller.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate) + '&selectedUnit2=chiller_hitachi_67bopet';
                    }
                    break;
                case 'chiller_trane_45met34':
                    if (selectId === 'option-form-chiller' && selectedShift) {
                        location.href = 'form-chiller45met34-trane.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift);
                    } else if (selectId === 'option-view-chiller' && selectedDate) {
                        location.href = 'view-chiller.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate) + '&selectedUnit2=chiller_hitachi_45met34';
                    }
                    break;                    
                case 'chiller_trane_coat14met12':
                    if (selectId === 'option-form-chiller' && selectedShift) {
                        location.href = 'form-chillercoat14met12-trane.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift);
                    } else if (selectId === 'option-view-chiller' && selectedDate) {
                        location.href = 'view-chiller.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate) + '&selectedUnit2=chiller_hitachi_coat14met12';
                    }
                    break;
                case 'konsumsi_air':
                    if (selectId === 'option-report-air') {
                        location.href = 'form-konsumsi-air.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                     } else if (selectId === 'view-report-air' && selectedMonth){
                        location.href = 'view-konsumsi-air.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedMonth=' + encodeURIComponent(selectedMonth);
                     }
                      break;
                case 'all_chiller':
                    if (selectId === 'option-view-chiller' && selectedDate) {
                        location.href = 'view-all-chiller.php?selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
            //Compressor                    
                case 'compressor':
                    if (selectId === 'option-form-compressor' && selectedShift && selectedLine) {
                        location.href = 'form-compressor.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    } 
                    //else if (selectId === 'option-view-compressor' && selectedLine && selectedDate) {
                    //    location.href = 'view-compressor.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    //}
                    break;                    
                case 'air_dryer':
                    if (selectId === 'option-form-compressor' && selectedShift && selectedLine) {
                        location.href = 'form-air-dryer.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    } 
                    //else if (selectId === 'option-view-compressor' && selectedLine && selectedDate) {
                    //    location.href = 'view-air-dryer.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    //}
                    break;
                case 'air_receiver_tank':
                    if (selectId === 'option-form-compressor' && selectedShift && selectedLine) {
                        location.href = 'form-air-receiver-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    } 
                    //else if (selectId === 'option-view-compressor' && selectedLine && selectedDate) {
                    //    location.href = 'view-air-receiver-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    //}
                    break;                    
                case 'received_tank':
                    if (selectId === 'option-form-compressor' && selectedShift && selectedLine) {
                        location.href = 'form-received-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    } 
                    //else if (selectId === 'option-view-compressor' && selectedLine && selectedDate) {
                    //    location.href = 'view-received-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    //}
                    break;                    
                case 'all_compressor':
                    if (selectId === 'option-view-compressor' && selectedDate) {
                        location.href = 'view-all-compressor.php?selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case '45_compressor':
                    if (selectId === 'option-view-compressor'){
                        location.href = 'view-all-compressor.php?selectedLine=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case '67_compressor':
                    if (selectId === 'option-view-compressor'){
                        location.href = 'view-all-compressor.php?selectedLine=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
            //Boiler                    
                case '4&5-a':
                case '4&5-b':
                case '6':
                case '7':
                case '6&7-central':
                case '8':
                case 'bopet-a':
                case 'bopet-b':
                case 'coating-a':
                case 'coating-b':
                case 'coating-c':
                case 'coating-d':
                    if (selectId === 'option-form-boiler') {
                        location.href = 'form-boiler.php?selectedUnit=boiler&selectedLine=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-boiler' && selectedDate) {
                        location.href = 'view-boiler.php?selectedUnit=boiler&selectedLine=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break; 
                case 'all_boiler':
                    if (selectId === 'option-view-boiler' && selectedDate) {
                        location.href = 'view-all-boiler.php?selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case 'konsumsi_gas':
                    if (selectId === 'option-report-gas') {
                        location.href = 'form-konsumsi-gas.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                     } else if (selectId === 'view-report-gas' && selectedMonth){
                        location.href = 'view-konsumsi-gas.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedMonth=' + encodeURIComponent(selectedMonth);
                     } else if (selectId === 'view-report-gas' && selectedMonthDropdown && selectedYearDropdown){
                        location.href = 'view-konsumsi-gas.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedMonth=' + encodeURIComponent(selectedYearDropdown) + '-' + encodeURIComponent(selectedMonthDropdown);
                     }
                      break;
              //Trafo
                case 'trafo_daily_office':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-office.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-trafo' && selectedUnit && selectedDate) {
                        location.href = 'view-trafo-daily-office.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                   
                case 'trafo_daily_coating':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-coating.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-trafo' && selectedUnit && selectedDate) {
                        location.href = 'view-trafo-daily-coating.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break; 
                case 'trafo_daily_bopet':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-bopet.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-trafo' && selectedUnit && selectedDate) {
                        location.href = 'view-trafo-daily-bopet.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;    
                case 'trafo_daily_met2':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-met2.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-trafo' && selectedUnit && selectedDate) {
                        location.href = 'view-trafo-daily-met2.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;    
                case 'trafo_daily_met34':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-met34.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-trafo' && selectedUnit && selectedDate) {
                        location.href = 'view-trafo-daily-met34.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;    
                case 'trafo_daily_line4':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-line4.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-trafo' && selectedUnit && selectedDate) {
                        location.href = 'view-trafo-daily-line4.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;    
                case 'trafo_daily_line5':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-line5.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-trafo' && selectedUnit && selectedDate) {
                        location.href = 'view-trafo-daily-line5.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;    
                case 'trafo_daily_line6':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-line6.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-trafo' && selectedUnit && selectedDate) {
                        location.href = 'view-trafo-daily-line6.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;    
                case 'trafo_daily_line7':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-line7.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-trafo' && selectedUnit && selectedDate) {
                        location.href = 'view-trafo-daily-line7.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break; 
                case 'trafo_daily_line8':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-line8.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-trafo' && selectedUnit && selectedDate) {
                        location.href = 'view-trafo-daily-line8.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break; 
                case 'all_trafo_daily':
                    if (selectId === 'option-view-trafo' && selectedUnit && selectedDate) {
                        location.href = 'view-all-trafo-daily.php?selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break; 
                case 'trafo_monthly':
                    if (selectId === 'option-form-electric') {
                        location.href = 'form-trafo-monthly.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-electric' && selectedMonth) {
                        location.href = 'view-trafo-monthly.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedMonth=' + encodeURIComponent(selectedMonth);
                    } else if (selectId === 'option-view-electric' && selectedMonthDropdown && selectedYearDropdown){
                        location.href = 'view-trafo-monthly.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedMonth=' + encodeURIComponent(selectedYearDropdown) + '-' + encodeURIComponent(selectedMonthDropdown);
                    }
                    break; 
              //Panel LV
              case 'panel_lvdp3':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdp3.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'panel_lvdp4':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdp4.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'panel_lvdp5':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdp5.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'panel_lvdp1_2_l6':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdp12l6.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'panel_lvdp3_l6':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdp3l6.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'panel_lvdp1_2_l7':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdp12l7.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'panel_lvdp3_l7':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdp3l7.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'panel_lvdp1_l8':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdp1l8.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'panel_lvdp2_l8':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdp2l8.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'panel_lvdp3_l8':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdp3l8.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break; 
              case 'panel_lvdp_pet':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdppet.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    }  
                    break;                 
              case 'panel_lvdp_metalize1':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdpmet1.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'panel_lvdp_metalize2':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdpmet2.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'panel_lvdp_metalize3':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdpmet3.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'panel_lvdp_cpp':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdpcpp.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'panel_lvdp_office_p_sdp':
                    if (selectId === 'option-form-panel' && selectedUnit) {
                        location.href = 'form-panel-lvdpoffice.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;    
              case 'all_panel': 
                    if (selectId === 'option-view-lvdp' && selectedMonth2) {
                        location.href = 'view-allpanel.php?selectedMonth=' + encodeURIComponent(selectedMonth2);
                    } else if (selectId === 'option-view-lvdp' && selectedMonthDropdown && selectedYearDropdown){
                        location.href = 'view-allpanel.php?selectedMonth=' + encodeURIComponent(selectedYearDropdown) + '-' + encodeURIComponent(selectedMonthDropdown);
                    }
                    break;                                 
              //Capacitor Bank
              case 'capbank_lvdp3':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp3.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdp4_prod':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp4prod.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdp4_uty':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp4uty.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_trafo5':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafo5.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_trafo6':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafo6.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    }
                    break;                   
              case 'capbank_trafo7':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafo7.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdp8':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp8.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_trafopet_prod':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafopetprod.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    }
                    break;                   
              case 'capbank_trafopet_uty':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafopetuty.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdpmet2':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdpmet2.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdpmet3':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdpmet3.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    }
                    break;                   
              case 'capbank_lvdpoffice':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdpoffice.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    }
                    break;                   
              case 'capbank_trafocpp':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafocpp.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    }
                    break;
              case 'all_capbank': 
                    if (selectId === 'option-view-capbank' && selectedMonth3) {
                        location.href = 'view-allcapbank.php?selectedMonth2=' + encodeURIComponent(selectedMonth3);
                    } else if (selectId === 'option-view-capbank' && selectedMonthDropdown && selectedYearDropdown){
                        location.href = 'view-allcapbank.php?selectedMonth2=' + encodeURIComponent(selectedYearDropdown) + '-' + encodeURIComponent(selectedMonthDropdown);
                    }
                    break; 
              //Box Grounding      
              case 'grounding_1':
                    if (selectId === 'option-form-grounding' && selectedUnit) {
                        location.href = 'form-box-grounding.php?selectedUnit=box_grounding&selectedPeriod=' + encodeURIComponent(selectedUnit);
                    }
                    break;                 
              case 'grounding_2':
                    if (selectId === 'option-form-grounding' && selectedUnit) {
                        location.href = 'form-box-grounding.php?selectedUnit=box_grounding&selectedPeriod=' + encodeURIComponent(selectedUnit);
                    }
                    break;                 
              case 'all_grounding':
                    if (selectId === 'option-view-grounding' && selectedYear) {
                        location.href = 'view-box-grounding.php?selectedUnit=box_grounding&selectedYear=' + encodeURIComponent(selectedYear);
                    }
                    break;                 
                default:
                    break;
            }

        }

    function handleSubmitCrane(event, selectId) {
    event.preventDefault();

    var selectElement = document.getElementById(selectId);
    var selectedOption = selectElement.options[selectElement.selectedIndex];
    var selectedUnit = selectedOption.value;
    var dataValue = selectedOption.getAttribute("data-value");
    var lineValue = selectedOption.getAttribute("line-value");
    var formElement = selectElement.closest('form');


    // Find the date input within the same form
    var monthInput = document.getElementById('monthCrane');
    var selectedMonthCrane = monthInput ? monthInput.value : null;
    var monthDropdown = formElement.querySelector('.month-dropdown');
    var selectedMonthDropdown = monthDropdown ? monthDropdown.value : null;
    var yearDropdown = formElement.querySelector('.year-dropdown');
    var selectedYearDropdown = yearDropdown ? yearDropdown.value : null;

    var baseUrl = '';
    var urlParams = `selectedUnit=${encodeURIComponent(selectedUnit)}&selectedLine=${encodeURIComponent(dataValue)}&selectedArea=${encodeURIComponent(lineValue)}`;
    var urlAll = `selectedUnit=${encodeURIComponent(selectedUnit)}&selectedLineAll=${encodeURIComponent(lineValue)}`;

    switch (selectedUnit) {
        case 'crane_monorail':
            baseUrl = selectId === 'option-form-crane' ? 'form-crane-monorail-datasheet.php' : 'view-crane-monorail.php';
            break;
        case 'crane_cargo_lift':
            baseUrl = selectId === 'option-form-crane' ? 'form-crane-cargolift-datasheet.php' : 'view-crane-cargolift.php';
            break;
        case 'crane_single_girder':
            baseUrl = selectId === 'option-form-crane' ? 'form-crane-singlegirder-datasheet.php' : 'view-crane-singlegirder.php';
            break;
        case 'crane_double_girder':
            baseUrl = selectId === 'option-form-crane' ? 'form-crane-doublegirder-datasheet.php' : 'view-crane-doublegirder.php';
            break;
        case 'all_crane':
            baseUrl = 'view-all-crane.php';
            break;
        default:
            return; // Exit function if type is not recognized
    }

    if (dataValue && selectedMonthCrane && selectedUnit !== 'all_crane') {
        location.href = `${baseUrl}?${urlParams}&selectedMonth=${encodeURIComponent(selectedMonthCrane)}`;
    } else if (dataValue && selectedMonthCrane && selectedUnit === 'all_crane') {
        location.href = `${baseUrl}?${urlAll}&selectedMonth=${encodeURIComponent(selectedMonthCrane)}`;
    } else if (selectedMonthDropdown && selectedYearDropdown && selectedUnit !== 'all_crane') {
        location.href = `${baseUrl}?${urlParams}&selectedMonth=${encodeURIComponent(selectedYearDropdown)}-${encodeURIComponent(selectedMonthDropdown)}`;
    } else if (selectedMonthDropdown && selectedYearDropdown && selectedUnit === 'all_crane') {
        location.href = `${baseUrl}?${urlAll}&selectedMonth=${encodeURIComponent(selectedYearDropdown)}-${encodeURIComponent(selectedMonthDropdown)}`;
    } else {
        location.href = `${baseUrl}?${urlParams}`;
    }
}    

document.addEventListener('DOMContentLoaded', function () {
    const formBtn = document.getElementById('form-btn');
    const viewBtn = document.getElementById('view-btn');
    const formLabel = document.getElementById('menu-form');
    const viewLabel = document.getElementById('menu-view');

    function updateSelection() {
        if (formBtn.checked) {
            formLabel.classList.add('active');
            viewLabel.classList.remove('active');
        } else if (viewBtn.checked) {
            viewLabel.classList.add('active');
            formLabel.classList.remove('active');
        }
    }

    formBtn.addEventListener('change', updateSelection);
    viewBtn.addEventListener('change', updateSelection);
});

            
      </script>
  </body>
</html>                                                                 