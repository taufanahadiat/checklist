        <form name="select-form-genset" onsubmit="handleFormSubmit(event, 'option-form-compressor')">
        <div class="custom-label-form"> 
        <label for="unit-compressor">Change Unit: </label>
          <div class="unitfield-form">
            <select class="selection-compressor" name="unit-compressor" id="option-form-compressor">
            <option value="" disabled selected hidden>Pilih Unit</option>
              <option value="compressor">Compressor</option>
              <option value="air_dryer">Air Dryer</option>
              <option value="air_receiver_tank">Air Receiver Tank</option>
              <option value="received_tank">Received Tank</option>            
            </select>
          </div>
          <input style="margin-top: 20px" class="btn-form" type="submit" value="SUBMIT">
          </div>
      </form>

      <script>
    function handleFormSubmit(event, selectId) {
    event.preventDefault();

    var selectElement = document.getElementById(selectId);
    var selectedUnit = selectElement.value;
    var selectedShift = '<?php echo $shift; ?>';
    var selectedLine = '<?php echo $line; ?>';    
              
            console.log('Selected <select> ID:', selectId);
            console.log('Selected Value:', selectedUnit);
            console.log('Selected Shift:', selectedShift);

            switch (selectedUnit) {
                case 'compressor':
                    if (selectId === 'option-form-compressor') {
                        location.href = 'form-compressor.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    } 
                    break;                    
                case 'air_dryer':
                    if (selectId === 'option-form-compressor') {
                        location.href = 'form-air-dryer.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    } 
                    break;
                case 'air_receiver_tank':
                    if (selectId === 'option-form-compressor') {
                        location.href = 'form-air-receiver-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    } 
                    break;                    
                case 'received_tank':
                    if (selectId === 'option-form-compressor') {
                        location.href = 'form-received-tank.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedShift=' + encodeURIComponent(selectedShift) + '&selectedLine=' + encodeURIComponent(selectedLine);
                    }
                    break;                    
                    
                default:
                    break;
            }
        }
      </script>