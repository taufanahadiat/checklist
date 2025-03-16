<form name="select-form-trafo" onsubmit="handleFormSubmit(event, 'option-form-trafo')">
        <div class="custom-label-form"> 
        <label for="unit-trafo">Change Line:</label>
          <div class="unitfield-form">
            <select class="selection-genset" name="unit-trafo" id="option-form-trafo" onchange="handleFormSubmit(event, 'option-form-trafo')">              
                <?php include 'list-trafo.php' ?>
                </select>
          </div>
          </div>
      </form> 

              <script>
                    function handleFormSubmit(event, selectId) {
    event.preventDefault();

    var selectElement = document.getElementById(selectId);
    var selectedUnit = selectElement.value;    
              
            console.log('Selected <select> ID:', selectId);
            console.log('Selected Value:', selectedUnit);

            switch (selectedUnit) {
                case 'trafo_daily_office':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-office.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
                case 'trafo_daily_coating':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-coating.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;
                case 'trafo_daily_bopet':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-bopet.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;    
                case 'trafo_daily_met2':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-met2.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;    
                case 'trafo_daily_met34':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-met34.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;    
                case 'trafo_daily_line4':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-line4.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;    
                case 'trafo_daily_line5':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-line5.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;    
                case 'trafo_daily_line6':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-line6.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;    
                case 'trafo_daily_line7':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-line7.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;    
                case 'trafo_daily_line8':
                    if (selectId === 'option-form-trafo' && selectedUnit) {
                        location.href = 'form-trafo-daily-line8.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;    
                default:
                    break;
            }
        }

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
