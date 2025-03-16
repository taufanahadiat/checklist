<form name="select-form-boiler" onsubmit="handleFormSubmit(event, 'option-form-boiler')">
        <div class="custom-label-form"> 
        <label for="unit-boiler">Change Unit:</label>
          <div class="unitfield-form">
            <select class="selection-boiler" name="unit-boiler" id="option-form-boiler" onchange="handleFormSubmit(event, 'option-form-boiler')">
              <?php include 'list-boiler.php' ?>
            </select>
          </div>
          </div>
      </form>
