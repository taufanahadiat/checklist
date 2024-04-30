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
  </head>
  <body>
  <div class="header-img">
      <img id="logo" src="css/logo.png" alt="Logo Argha"><br>
      <img id="exit" src="css/exit.png" alt="Exit"><br>
      </div>
    <header>
      <h1>ONLINE CHECKLIST</h1>
    </header>

    <form>
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

    <div id="select-form" style="display: none;">
      <form name="select-form" onsubmit="handleFormSubmit(event, 'option-form')">
        <div class="custom-label"> 
        <div class="form-row">
          <div class="unitfield">
            <label for="unit">Pilih Unit:</label>
            <select class="selection" name="unit" id="option-form">
              <?php
              $dbname = 'checklistnew_24';
              $sql = "SHOW TABLES FROM $dbname";
              $result_unit = $mysqli->query($sql);
              $i=0;
              while ($row_unit = mysqli_fetch_row($result_unit)) {
                $row_name= array (
                  0 => "Fuel Transfer Pump Unit",
                  1 => "Genset Wartsila 1",
                  2 => "Genset Wartsila 2",
                  3 => "HFO Separator Pump Unit",
                  4 => "HFO Unloading Pump Unit",
                  5 => "LFO Unloading Pump Unit",
                );
                if ($row_name[$i]==NULL) {
                  $row_name[$i]="$row_unit[0]";
                }   
                echo "<option value='{$row_unit[0]}'>{$row_name[$i]}</option>";
                $i++;
              }
              ?>
            </select>
            
          </div>
          </div>
          <input class="btn" type="submit" value="SUBMIT">
        
        </div>
      </form>
    </div>
    
    <div id="select-view" style="display: none;">
    <form name="select-view" onsubmit="handleFormSubmit(event, 'option-view')">
    <div class="custom-label">
    <div class="form-row">
        <div class="unitfield">
            <label for="unit">Pilih Unit:</label>
            <select class="selection" name="unit" id="option-view">
            <?php
              $dbname = 'checklistnew_24';
              $sql = "SHOW TABLES FROM $dbname";
              $result_unit = $mysqli->query($sql);
              $i=0;
              while ($row_unit = mysqli_fetch_row($result_unit)) {
                $row_name= array(
                  0 => "Fuel Transfer Pump Unit",
                  1 => "Genset Wartsila 1",
                  2 => "Genset Wartsila 2",
                  3 => "HFO Separator Pump Unit",
                  4 => "HFO Unloading Pump Unit",
                  5 => "LFO Unloading Pump Unit",
                );
                if ($row_name[$i]==NULL) {
                  $row_name[$i]="$row_unit[0]";
                }   
                echo "<option value='{$row_unit[0]}'>{$row_name[$i]}</option>";
                $i++;
              }
              ?>
            </select>
        </div>
        <div class="tanggalfield">
            <label for="tanggal">Pilih Tanggal:</label>
            <input type="date" class="input-container" id="dateInput" name="tanggal">
        </div>
    </div>
    <input class="btn" type="submit" value="SUBMIT">
    </div>
</form>

    </div>

    <script>
      document.getElementById("exit").onclick = function() {
        location.href = 'selection.php';
      }

      $(document).ready(function() {
        $('input[name="mode"]').click(function() {
          if ($(this).prop('id') == 'form-btn') {
            $('#select-form').show(); 
            $('#select-view').hide();          
          } else if ($(this).prop('id') == 'view-btn') {
            $('#select-view').show(); 
            $('#select-form').hide();  
          } else {
            $('#select-form').hide(); 
            $('#select-view').hide();  
          }
        });

        $(".selection").prop("selectedIndex", -1);
      });

      function handleFormSubmit(event, selectId) {
        event.preventDefault();

        var selectElement = document.getElementById(selectId);
        var selectedUnit = selectElement.value;
        var selectedDate = document.getElementById('dateInput').value;

            console.log('Selected <select> ID:', selectId);
            console.log('Selected Value:', selectedUnit);
            console.log('Selected Date:', selectedDate);

            switch (selectedUnit) {
                case 'fuel_transfer_pump_unit':
                case 'hfo_separator_pump_unit':
                case 'hfo_unloading_pump_unit':
                case 'lfo_unloading_pump_unit':
                    if (selectId === 'option-form') {
                        location.href = 'form-hfo-lfo-fuel.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view') {
                        location.href = 'view-hfo-lfo-fuel.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                case 'genset_wartsila_01':
                case 'genset_wartsila_02':
                    if (selectId === 'option-form') {
                        location.href = 'form-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } else if (selectId === 'option-view') {
                        location.href = 'view-genset.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedDate=' + encodeURIComponent(selectedDate);
                    }
                    break;
                default:
                    break;
            }
        }
    
      </script>
  </body>
</html>