          <div class="unitfield" id="shift-container">
            <label for="shift">Shift:</label>
            <select class="selection-shift" name="shift" id="option-shift-chiller">
              <option value="" disabled selected hidden>Pilih Shift</option>
              <option value="1">Shift 1</option>
              <option value="2">Shift 2</option>
              <option value="3">Shift 3</option>
            </select>
          </div>
          <div class="unitfield" id="line-container">
            <label for="line">Line:</label>
            <select class="selection-chiller" name="line" id="option-form-chiller">
              <option value="" disabled selected hidden>Pilih Line</option>
              <option value="chiller_trane_67bopet">OPP 6-7 & BOPET</option>
              <option value="chiller_trane_45met34">OPP 4,5,8 & Met 3-4</option>
              <option value="chiller_trane_coat14met12">Coat 1-4 & Met 1-2</option>
            </select>
          </div>
          <div class="unitfield">
            <label for="konsumsi_air" style="font-size: 0.9em">Report Daily:</label>
            <span style="font-size: 0.7em">Konsumsi Air&nbsp;
            <input type="checkbox" class="medium-checkbox selection-report" id="option-report-air" name="konsumsi_air" value="konsumsi_air" onclick="toggleSelections()">
            </span>
          </div>