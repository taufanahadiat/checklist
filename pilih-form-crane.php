<form name="select-unit-crane" onsubmit="handleFormSubmit(event, 'option-unit-crane')">
    <div class="custom-label-form">
        <label for="option-unit-crane">Form:</label>
        <div class="unitfield-form">
        <select style="margin-left: 10px" class="selection-line" name="unit-crane" id="option-unit-crane" onchange="handleFormSubmit(event, 'option-unit-crane')">
        <option value="" disabled selected hidden>Pilih Form</option>
        <option value="data_sheet">Data Sheet</option>
        <option value="cek_kondisi">Pengecekan Kondisi</option>
        </select>
        </div>
    </div>
</form>


<script>
function handleFormSubmit(event, selectId) {
    event.preventDefault();

    var selectElement = document.getElementById(selectId);
    var elementValue = selectElement.value;
    var selectedLine = '<?php echo $line; ?>';
    var selectedUnit = '<?php echo $unit; ?>';
    var changeForm = '';

    // Determine the form based on selectedUnit
    switch (selectedUnit) {
        case 'crane_single_girder':
            changeForm = 'form-crane-singlegirder';
            break;
        case 'crane_double_girder':
            changeForm = 'form-crane-doublegirder';
            break;
        case 'crane_monorail':
            changeForm = 'form-crane-monorail';
            break;
        case 'crane_cargo_lift':
            changeForm = 'form-crane-cargolift';
            break;
        default:
            console.error('Unrecognized selectedUnit: ' + selectedUnit);
            return; // Exit if selectedUnit is not recognized
    }

    switch (elementValue) {
        case 'data_sheet':
            location.href = changeForm + '-datasheet.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedLine=' + encodeURIComponent(selectedLine);
            break;
        case 'cek_kondisi':
            location.href = changeForm + '-kondisi.php?selectedUnit=' + encodeURIComponent(selectedUnit) + '&selectedLine=' + encodeURIComponent(selectedLine);
            break;
        default:
            console.error('Unrecognized selectedUnit: ' + selectedUnit);
            break;
    }
}
</script>