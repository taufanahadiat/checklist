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
    <style>
        #custom-confirm {
            display: none;
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #314765;
            padding: 20px;
            border: 1px solid black;
            z-index: 1000;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.5);
            color:beige;
            border-radius: 10px;
        }
        #custom-confirm h2 {
            margin-top: 0;
            color: red;
        }
        #custom-confirm-buttons {
            text-align: right;
        }
        #custom-confirm-buttons button {
            margin-left: 10px;
        }
        #overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 500;
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

    <form>
    <div class="custom-label"> 
        <label for="menu-area">Area: </label>
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
            <div class="selection-indicator">Form Checklist</div>
            <input type="radio" id="form-btn" name="mode" value="form" 
            <?php if (isset($_SESSION['sesi_user']) && $_SESSION['sesi_user'] === 'guest') echo 'disabled'; ?>>
        </label>
        
        <label id="menu-view" class="menu-option">
            <img class="img" src="css/review.png" alt="View Checklist">
            <div class="selection-indicator">View Data</div>
            <input type="radio" id="view-btn" name="mode" value="view">
        </label>
    </div>
</form>
    
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
      <form name="select-view-chiller"  onsubmit="handleFormSubmit(event, 'option-view-chiller')">
        <div class="custom-label">
        <div class="form-row">
        <?php include 'pilih-view-chiller.php' ?>
          <div class="tanggalfield" id="tanggal-chiller-day" style="display:none;">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="input-container dateInput" name="tanggal">
        </div>
          <div class="tanggalfield" id="tanggal-chiller-month" style="display:none;">
            <label for="tanggal">Tanggal:</label>
            <input type="month" class="input-container monthInput" name="tanggal">
          </div>
        </div>
        <input class="btn" type="submit" value="SUBMIT">
        </div>
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
            <input type="date" class="input-container dateInput" name="tanggal">
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
          <input class="btn" type="submit" value="SUBMIT">
        </div>
      </form>
    </div>
    
    <div id="select-view-genset" style="display: none;">
    <form name="select-view-genset" onsubmit="setFormSubmitHandler(event)">
    <div class="custom-label">
    <div class="form-row">
        <div class="unitfield" id="unit-genset-container">
        <label for="unit-genset">Unit:</label>
            <select class="selection-genset" name="unit-genset" id="option-view-genset">
              <?php include 'list-genset.php' ?>
        </select>
        </div>
        <div class="tanggalfield" id="tanggal-genset-day">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="input-container dateInput" name="tanggal">
        </div>
        <div class="unitfield">
            <label for="tank_genset" style="font-size: 0.9em">Report Monthly:</label>
            <span style="font-size: 0.7em">BBM Genset&nbsp;
            <input type="checkbox" class="medium-checkbox selection-report" id="view-report-genset" name="tank_genset" value="tank_genset" onclick="toggleSelections()">
            </span>
          </div>
    </div>
    <input class="btn" type="submit" value="SUBMIT">
    </div>
</form>
</div>

<div id="select-form-boiler" style="display: none;">
      <form name="select-form-boiler" onsubmit="setFormSubmitHandler(event)">
        <div class="custom-label"> 
        <div class="form-row">
          <div class="unitfield" id="line-boiler-container">
          <label for="unit-boiler">Line:</label>
            <select class="selection-genset" name="unit-boiler" id="option-form-boiler">
              <?php include 'pilih-unit-boiler.php' ?>
            </select>
          </div>
          <div class="unitfield">
            <label for="konsumsi_gas" style="font-size: 0.9em">Report Daily:</label>
            <span style="font-size: 0.7em">Konsumsi Gas&nbsp;
            <input type="checkbox" class="medium-checkbox selection-report" id="option-report-gas" name="konsumsi_gas" value="konsumsi_gas" onclick="toggleSelections()">
            </span>
          </div>
          </div>
          <input class="btn" type="submit" value="SUBMIT">
        </div>
      </form>
    </div>

<div id="select-view-boiler" style="display: none;">
    <form name="select-view-boiler" onsubmit="setFormSubmitHandler(event)">
    <div class="custom-label">
    <div class="form-row">
        <div class="unitfield" id="line-boiler-view">
        <label for="unit-boiler">Line:</label>
            <select class="selection-boiler" name="unit-boiler" id="option-view-boiler">
              <?php include 'pilih-unit-boiler.php' ?>
        </select>
        </div>
        <div class="tanggalfield" id="tanggal-boiler-day">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="input-container dateInput" name="tanggal">
        </div>
        <div class="unitfield">
            <label for="konsumsi_gas" style="font-size: 0.9em">Report Daily:</label>
            <span style="font-size: 0.7em">Konsumsi Gas&nbsp;
            <input type="checkbox" class="medium-checkbox selection-report" id="view-report-gas" name="konsumsi_gas" value="konsumsi_gas" onclick="toggleSelections()">
            </span>
    </div>
    <div class="tanggalfield" id="tanggal-boiler-month" style="display:none;">
            <label for="tanggal">Tanggal:</label>
            <input type="month" class="input-container monthInput" name="tanggal">
     </div>
     </div>
    <input class="btn" type="submit" value="SUBMIT">
    </div>
</form>
</div>


<div id="select-form-electric" style="display: none;">
      <form name="select-form-electric" onsubmit="setFormSubmitHandler(event)">
        <div class="custom-label"> 
        <div class="form-row">
          <div class="unitfield">
          <label for="check-electric">Check Sheet:</label>
            <select class="selection-genset" name="unit-trafo" id="option-form-electric" onchange="toggleSelections()">
            <option value="" disabled selected hidden>Pilih Sheet</option>
            <option value="trafo">Trafo</option>
            <option value="panel">Panel Low Voltage</option>
            <option value="capbank">Capacitor Bank</option>
            </select>
          </div>
          <div class="unitfield" id="line-trafo-form" style="display:none;">
          <label for="unit-trafo">Line:</label>
            <select class="selection-genset" name="unit-trafo" id="option-form-trafo">
              <?php include 'pilih-unit-trafo.php' ?>
            </select>
          </div>
          <div class="unitfield" id="line-capbank-form" style="display:none;">
          <label for="unit-trafo">Line:</label>
            <select class="selection-genset" name="unit-trafo" id="option-form-capbank">
              <?php include 'pilih-unit-capbank.php' ?>
            </select>
          </div>
          </div>
          <input class="btn" type="submit" value="SUBMIT">
        </div>
      </form>
    </div>

<div id="select-view-electric" style="display: none;">
    <form name="select-view-electric" onsubmit="handleFormSubmit(event, 'option-view-trafo')">
    <div class="custom-label">
    <div class="form-row">
        <div class="unitfield">
        <label for="unit-trafo">Line:</label>
            <select class="selection-genset" name="unit-trafo" id="option-view-trafo">
              <?php include 'pilih-unit-trafo.php' ?>
        </select>
        </div>
        <div class="tanggalfield">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="input-container dateInput" name="tanggal">
        </div>
    </div>
    <input class="btn" type="submit" value="SUBMIT">
    </div>
</form>
</div>

<div id="select-form-crane" style="display: none;">
    <form name="select-form-crane" onsubmit="handleSubmitCrane(event, 'option-form-crane')">
        <div class="custom-label">
            <div class="form-row">
                <div class="unitfield">
                    <label for="unit-crane">Unit:</label>
                    <input type="text" class="selection-crane" id="unit-form-crane" name="unit-crane-display" list="crane-list" placeholder="Ketik unit crane...">
                    <input type="hidden" id="unit-crane-form" name="unit-crane">
                    <?php include 'pilih-unit-crane.php' ?>
                </div>
                <div class="unitfield">
                    <label for="Type">Type Crane:</label>
                    <select class="selection-compressor" name="Type" id="option-form-crane">
                        <option value="" disabled selected hidden>Pilih Type</option>
                        <option value="crane_monorail">Monorail</option>
                        <option value="crane_cargo_lift">Cargo Lift</option>
                        <option value="crane_single_girder">Single Girder</option>
                        <option value="crane_double_girder">Double Girder</option>
                    </select>
                </div>
            </div>
            <input class="btn" type="submit" value="SUBMIT">
        </div>
    </form>
</div>

<div id="select-view-crane" style="display: none;">
    <form name="select-view-crane" onsubmit="handleSubmitCrane(event, 'option-view-crane')">
        <div class="custom-label">
            <div class="form-row">
                <div class="unitfield">
                    <label for="unit-crane">Unit:</label>
                    <input type="text" class="selection-crane" id="unit-view-crane" name="unit-crane-display" list="crane-list" placeholder="Ketik unit crane...">
                    <input type="hidden" id="unit-crane-view" name="unit-crane">
                    <?php include 'pilih-unit-crane.php' ?>
                </div>
                <div class="unitfield">
                    <label for="Type">Type Crane:</label>
                    <select class="selection-compressor" name="Type" id="option-view-crane">
                        <option value="" disabled selected hidden>Pilih Type</option>
                        <option value="crane_monorail">Monorail</option>
                        <option value="crane_cargo_lift">Cargo Lift</option>
                        <option value="crane_single_girder">Single Girder</option>
                        <option value="crane_double_girder">Double Girder</option>
                    </select>
                </div>
                <div class="tanggalfield">
                    <label for="tanggal">Tanggal:</label>
                    <input type="month" class="input-container monthInput" name="tanggal">
                </div>
            </div>
        </div>
        <input class="btn" type="submit" value="SUBMIT">
    </form>
</div>




    <script>
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

    const unitContainer = document.getElementById('unit-container');
    const unitGensetView = document.getElementById('unit-genset-container');
    const shiftContainer = document.getElementById('shift-container');
    const lineContainer = document.getElementById('line-container');
    const lineBoilerContainer = document.getElementById('line-boiler-container');
    const lineBoilerView = document.getElementById('line-boiler-view');
    const lineTrafoForm = document.getElementById('line-trafo-form');
    const lineCapbankForm = document.getElementById('line-capbank-form');

    const tanggalGensetDay = document.getElementById('tanggal-genset-day');
    const tanggalBoilerDay = document.getElementById('tanggal-boiler-day');
    const tanggalBoilerMonth = document.getElementById('tanggal-boiler-month');
    const tanggalChillerDay = document.getElementById('tanggal-chiller-day');
    const tanggalChillerMonth = document.getElementById('tanggal-chiller-month');

    const viewSelectChiller = document.getElementById('option-view-chiller');
    const formSelectElectric = document.getElementById('option-form-electric');

    
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

    if (viewSelectChiller.value === 'konsumsi_air') {
        tanggalChillerDay.style.display = 'none';
        tanggalChillerMonth.style.display = 'block';
    } else if (viewSelectChiller.value === 'all_chiller') {
        tanggalChillerDay.style.display = 'block';
        tanggalChillerMonth.style.display = 'none';
    }

    if (formSelectElectric.value === 'trafo') {
        lineCapbankForm.style.display = 'none';
        lineTrafoForm.style.display = 'block';
    } else if (formSelectElectric.value === 'capbank') {
        lineCapbankForm.style.display = 'block';
        lineTrafoForm.style.display = 'none';
    }
  }

  function setFormSubmitHandler(event) {
    event.preventDefault(); // Prevent the form from submitting immediately

    const monitorBBMGensetCheckbox = document.getElementById('option-report-genset');
    const monitorBBMGensetView = document.getElementById('view-report-genset');
    const reportCheckboxAir = document.getElementById('option-report-air');
    const reportCheckboxGas = document.getElementById('option-report-gas');
    const ViewCheckboxGas = document.getElementById('view-report-gas');
    const formElectricSelect = document.getElementById('option-form-electric');
        
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

    if (formElectricSelect.value === 'trafo') {
        handleFormSubmit(event, 'option-form-trafo');
    } else {
        handleFormSubmit(event, 'option-form-capbank');
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
                        location.href = 'view-hfo-lfo-fuel.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case 'common_unit':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-common-unit.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-common-unit.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case 'fuel_booster':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-fuel-booster.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-fuel-booster.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;     
                  case 'fuel_oil_feeder':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-fuel-oil-feeder.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-fuel-oil-feeder.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                                   
                case 'heater_oil':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-heater-oil.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-heater-oil.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case 'genset_man':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-genset-man.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-genset-man.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                  
                case 'genset_wartsila_01':
                case 'genset_wartsila_02':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case 'kebocoran_fuel_tank':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-kebocoran-fuel-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-kebocoran-fuel-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case 'tank_genset':
                    if (selectId === 'option-report-genset') {
                        location.href = 'form-monitoring-tank-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'view-report-genset') {
                        location.href = 'view-monitoring-tank-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    }
                    break;
                case 'all_genset':
                    if (selectId === 'option-view-genset' && selectedDate) {
                        location.href = 'view-all-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDat1e=' + encodeURIComponent(selectedDate);
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
                     } else if (selectId === 'option-view-chiller' && selectedMonth){
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
                    } else if (selectId === 'option-view-compressor' && selectedLine && selectedDate) {
                        location.href = 'view-compressor.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    }
                    break;                    
                case 'air_dryer':
                    if (selectId === 'option-form-compressor' && selectedShift && selectedLine) {
                        location.href = 'form-air-dryer.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    } else if (selectId === 'option-view-compressor' && selectedLine && selectedDate) {
                        location.href = 'view-air-dryer.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    }
                    break;
                case 'air_receiver_tank':
                    if (selectId === 'option-form-compressor' && selectedShift && selectedLine) {
                        location.href = 'form-air-receiver-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    } else if (selectId === 'option-view-compressor' && selectedLine && selectedDate) {
                        location.href = 'view-air-receiver-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    }
                    break;                    
                case 'received_tank':
                    if (selectId === 'option-form-compressor' && selectedShift && selectedLine) {
                        location.href = 'form-received-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    } else if (selectId === 'option-view-compressor' && selectedLine && selectedDate) {
                        location.href = 'view-received-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    }
                    break;                    
                case 'all_compressor':
                    if (selectId === 'option-view-compressor' && selectedLine && selectedDate) {
                        location.href = 'view-all-compressor.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate) + '&selectedLine=' + encodeURIComponent(selectedLine);
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
                case 'konsumsi_gas':
                    if (selectId === 'option-report-gas') {
                        location.href = 'form-konsumsi-gas.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                     } else if (selectId === 'view-report-gas' && selectedMonth){
                        location.href = 'view-konsumsi-gas.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedMonth=' + encodeURIComponent(selectedMonth);
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
              //Capacitor Bank
              case 'capbank_lvdp3':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp3.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-capbank' && selectedUnit && selectedDate) {
                        location.href = 'view-capbank-lvdp3.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                   
              case 'capbank_lvdp4_prod':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp4prod.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-capbank' && selectedUnit && selectedDate) {
                        location.href = 'view-capbank-lvdp4prod.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                   
              case 'capbank_lvdp4_uty':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp4uty.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-capbank' && selectedUnit && selectedDate) {
                        location.href = 'view-capbank-lvdp4uty.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                   
              case 'capbank_trafo5':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafo5.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-capbank' && selectedUnit && selectedDate) {
                        location.href = 'view-capbank-trafo5.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                   
              case 'capbank_trafo6':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafo6.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-capbank' && selectedUnit && selectedDate) {
                        location.href = 'view-capbank-trafo6.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                   
              case 'capbank_trafo7':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafo7.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-capbank' && selectedUnit && selectedDate) {
                        location.href = 'view-capbank-trafo7.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                   
              case 'capbank_lvdp8':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp8.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-capbank' && selectedUnit && selectedDate) {
                        location.href = 'view-capbank-lvdp8.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                   
              case 'capbank_trafopet_prod':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafopetprod.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-capbank' && selectedUnit && selectedDate) {
                        location.href = 'view-capbank-trafopetprod.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                   
              case 'capbank_trafopet_uty':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafopetuty.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-capbank' && selectedUnit && selectedDate) {
                        location.href = 'view-capbank-trafopetuty.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                   
              case 'capbank_lvdpmet2':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdpmet2.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-capbank' && selectedUnit && selectedDate) {
                        location.href = 'view-capbank-lvdpmet2.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                   
              case 'capbank_lvdpmet3':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdpmet3.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-capbank' && selectedUnit && selectedDate) {
                        location.href = 'view-capbank-lvdpmet3.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                   
              case 'capbank_lvdpoffice':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdpoffice.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-capbank' && selectedUnit && selectedDate) {
                        location.href = 'view-capbank-lvdpoffice.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                   
              case 'capbank_lvdpcpp':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdpcpp.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-capbank' && selectedUnit && selectedDate) {
                        location.href = 'view-capbank-lvdpcpp.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                   
                default:
                    break;
            }

        }

    function handleSubmitCrane(event, selectId) {
    event.preventDefault();

    var selectElement = document.getElementById(selectId);
    var selectedUnit = selectElement.value;

    var form = event.target;
    var selectedLine = form.querySelector('input[name="unit-crane"]').value;

    // Find the date input within the same form
    var monthInput = form.querySelector('.monthInput');
    var selectedMonth = monthInput ? monthInput.value : null;

    var baseUrl = '';
    var urlParams = `selectedUnit=${encodeURIComponent(selectedUnit)}&selectedLine=${encodeURIComponent(selectedLine)}`;

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
        default:
            return; // Exit function if type is not recognized
    }

    if (selectId === 'option-view-crane' && selectedMonth) {
        location.href = `${baseUrl}?${urlParams}&selectedMonth=${encodeURIComponent(selectedMonth)}`;
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