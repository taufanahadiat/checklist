<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$mysqli = new mysqli('localhost', 'root','','checklistnew_24');

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Home</title>
    <meta charset="utf-8">
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="style.css">
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
          <option value="chiller">Chiller</option>
          <option value="compressor">Compressor & Air Dryer</option>
          <option value="genset">Genset</option>
        </select>
    </div>
      <div class="radio">
        <label id="menu-form">
          <img class="img" src="css/centang.png" alt="Form Checklist">
          <div class="selection-indicator">Form Checklist</div>
          <input type="radio" id="form-btn" name="mode" value="form">
        </label>
        <label id="menu-view">
          <img class="img" src="css/review.png" alt="View Checklist">
          <div class="selection-indicator">View Data</div>
          <input type="radio" id="view-btn" name="mode" value="view">
        </label>
      </div>
    </form>
    
    <div id="select-form-chiller" style="display: none;">
      <form name="select-form-chiller" onsubmit="handleFormSubmit(event, 'option-form-chiller')">
        <div class="custom-label"> 
        <div class="form-row">
          <?php include 'pilih-form-chiller.php' ?>
        </div>
        </div>
        <input class="btn" type="submit" value="SUBMIT">
      </form>
    </div>

    <div id="select-view-chiller" style="display: none;">
      <form name="select-view-chiller" onsubmit="handleFormSubmit(event, 'option-view-chiller')">
        <div class="custom-label"> 
        <div class="form-row">
          <?php include 'pilih-view-chiller.php' ?>
          <div class="tanggalfield">
            <label for="tanggal">Tanggal:</label>
            <input type="date" class="input-container dateInput" name="tanggal">
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
            <input type="date" class="input-container dateInput" name="tanggal">
        </div>
        </div>
        </div>
        <input class="btn" type="submit" value="SUBMIT">
      </form>
    </div>

    <div id="select-form-genset" style="display: none;">
      <form name="select-form-genset" onsubmit="handleFormSubmit(event, 'option-form-genset')">
        <div class="custom-label"> 
        <div class="form-row">
          <div class="unitfield">
          <label for="unit-genset">Unit:</label>
            <select class="selection-genset" name="unit-genset" id="option-form-genset">
              <?php include 'pilih-unit-genset.php' ?>
            </select>
          </div>
          </div>
          <input class="btn" type="submit" value="SUBMIT">
        </div>
      </form>
    </div>
    
    <div id="select-view-genset" style="display: none;">
    <form name="select-view-genset" onsubmit="handleFormSubmit(event, 'option-view-genset')">
    <div class="custom-label">
    <div class="form-row">
        <div class="unitfield">
        <label for="unit-genset">Unit:</label>
            <select class="selection-genset" name="unit-genset" id="option-view-genset">
              <?php include 'pilih-unit-genset.php' ?>
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

    <script>
        $(document).ready(function() {
            $("#exit").click(function() {
                $("#overlay, #custom-confirm").show();
            });

            $("#confirm-yes").click(function() {
                window.location.href = '../index.php';
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

    function handleVisibility() {
        selectFormGenset.toggle(menuArea.val() === 'genset' && formBtn.is(':checked'));
        selectViewGenset.toggle(menuArea.val() === 'genset' && viewBtn.is(':checked'));
        selectFormChiller.toggle(menuArea.val() === 'chiller' && formBtn.is(':checked'));
        selectViewChiller.toggle(menuArea.val() === 'chiller' && viewBtn.is(':checked'));
        selectFormCompressor.toggle(menuArea.val() === 'compressor' && formBtn.is(':checked'));
        selectViewCompressor.toggle(menuArea.val() === 'compressor' && viewBtn.is(':checked'));
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

$(".selection-genset").prepend("<option value='' disabled selected class='placeholder-option' hidden>Pilih Genset</option>");
$(".selection-area").prepend("<option value='' disabled selected class='placeholder-option' hidden>Pilih Area</option>");
        //$(".selection").prop("selectedIndex", -1);

      function handleFormSubmit(event, selectId) {
        event.preventDefault();

        var selectElement = document.getElementById(selectId);
        var selectedUnit = selectElement.value;
        // Find the closest form element that contains the select element
        var formElement = selectElement.closest('form');

        // Find the date input within the same form
        var dateInput = formElement.querySelector('.dateInput');
        var selectedDate = dateInput ? dateInput.value : null;
              
            console.log('Selected <select> ID:', selectId);
            console.log('Selected Value:', selectedUnit);
            console.log('Selected Date:', selectedDate);

            switch (selectedUnit) {
                case 'fuel_transfer_pump_unit':
                case 'hfo_separator_pump_unit':
                case 'hfo_unloading_pump_unit':
                case 'lfo_unloading_pump_unit':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-hfo-lfo-fuel.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset') {
                        location.href = 'view-hfo-lfo-fuel.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case 'common_unit':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-common-unit.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset') {
                        location.href = 'view-hfo-lfo-fuel.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case 'fuel_booster':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-fuel-booster.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset') {
                        location.href = 'view-hfo-lfo-fuel.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;     
                  case 'fuel_oil_feeder':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-fuel-oil-feeder.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset') {
                        location.href = 'view-hfo-lfo-fuel.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                                   
                case 'heater_oil':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-heater-oil.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset') {
                        location.href = 'view-hfo-lfo-fuel.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                    
                case 'genset_wartsila_01':
                case 'genset_wartsila_02':
                    if (selectId === 'option-form-genset') {
                        location.href = 'form-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-genset') {
                        location.href = 'view-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case 'chiller_trane_67bopet':
                    if (selectId === 'option-form-chiller') {
                        location.href = 'form-chiller67bopet-trane.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-chiller') {
                        location.href = 'view-chiller67bopet.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate) + '&selectedUnit2=chiller_hitachi_67bopet';
                    }
                    break;
                case 'chiller_trane_45met34':
                    if (selectId === 'option-form-chiller') {
                        location.href = 'form-chiller45met34-trane.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-chiller') {
                        location.href = 'view-chiller45met34.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate) + '&selectedUnit2=chiller_hitachi_45met34';
                    }
                    break;                    
                case 'chiller_trane_coat14met12':
                    if (selectId === 'option-form-chiller') {
                        location.href = 'form-chillercoat14met12-trane.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-chiller') {
                        location.href = 'view-chillercoat14met12.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate) + '&selectedUnit2=chiller_hitachi_coat14met12';
                    }
                    break;                    
                case 'compressor':
                    if (selectId === 'option-form-compressor') {
                        location.href = 'form-compressor.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-compressor') {
                        location.href = 'view-compressor.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                    
                case 'air_dryer':
                    if (selectId === 'option-form-compressor') {
                        location.href = 'form-air-dryer.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-compressor') {
                        location.href = 'view-air-dryer.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                case 'air_receiver_tank':
                    if (selectId === 'option-form-compressor') {
                        location.href = 'form-air-receiver-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-compressor') {
                        location.href = 'view-air-receiver-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                    
                case 'received_tank':
                    if (selectId === 'option-form-compressor') {
                        location.href = 'form-received-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view-compressor') {
                        location.href = 'view-received-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;                    
                    
                default:
                    break;
            }
        }
    
      </script>
  </body>
</html>