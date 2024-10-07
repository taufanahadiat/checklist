<form name="select-form-genset" onsubmit="handleFormSubmit(event, 'option-form-genset')">
      <div class="custom-label-form"> 
        <label for="unit-genset">Change Unit: </label>
        <div class="unitfield-form">
          <select class="selection-genset" name="unit-genset" id="option-form-genset" onchange="handleFormSubmit(event, 'option-form-genset')">
            <?php include 'list-genset.php' ?>
          </select>
        </div>

        <!-- Add hidden inputs dynamically -->
        <?php
          if (isset($_GET['selectedDate'])) {
            echo '<input type="hidden" name="selectedDate" value="' . htmlspecialchars($_GET['selectedDate']) . '">';
          }
          if (isset($_GET['selectedMonth'])) {
            echo '<input type="hidden" name="selectedMonth" value="' . htmlspecialchars($_GET['selectedMonth']) . '">';
          }
        ?>
      </div>
    </form>

<script>
function handleFormSubmit(event, selectId) {
    event.preventDefault();

    var selectElement = document.getElementById(selectId);
    var selectedUnit = selectElement.value;

    console.log('Selected <select> ID:', selectId);
    console.log('Selected Value:', selectedUnit);

    // Function to replace 'form-' with 'view-' in the URL
    function getViewUrl(formUrl) {
      return formUrl.replace('form-', 'view-');
    }

    // Base URLs with 'form-' prefix
    var baseUrls = {
      'fuel_transfer_pump_unit': 'form-hfo-lfo-fuel.php',
      'hfo_separator_pump_unit': 'form-hfo-lfo-fuel.php',
      'hfo_unloading_pump_unit': 'form-hfo-lfo-fuel.php',
      'lfo_unloading_pump_unit': 'form-hfo-lfo-fuel.php',
      'common_unit': 'form-common-unit.php',
      'fuel_booster': 'form-fuel-booster.php',
      'fuel_oil_feeder': 'form-fuel-oil-feeder.php',
      'heater_oil': 'form-heater-oil.php',
      'genset_man': 'form-genset-man.php',
      'genset_wartsila_01': 'form-genset.php',
      'genset_wartsila_02': 'form-genset.php',
      'kebocoran_fuel_tank': 'form-kebocoran-fuel-tank.php',
      'tank_genset': 'form-monitoring-tank-genset.php'
    };

    // Append selectedUnit to the correct URL
    if (selectedUnit in baseUrls && selectId === 'option-form-genset') {
      var formUrl = baseUrls[selectedUnit] + '?selectedUnit=' + encodeURIComponent(selectedUnit);

      // Change 'form-' to 'view-' in the URL
      var viewUrl = getViewUrl(formUrl);

      // If selectedDate or selectedMonth is in the query string, append them
      var params = new URLSearchParams(window.location.search);
      if (params.has('selectedDate')) {
        viewUrl += '&selectedDate=' + encodeURIComponent(params.get('selectedDate'));
        location.href = viewUrl;
      } else if (params.has('selectedMonth')) {
        viewUrl += '&selectedMonth=' + encodeURIComponent(params.get('selectedMonth'));
        location.href = viewUrl;
      } else{
        location.href = formUrl;
      }
    }
}
</script>
