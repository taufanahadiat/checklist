<form name="select-form-panel" onsubmit="handleFormSubmit(event, 'option-form-panel')">
    <div class="custom-label-form" style="margin-top:-20px;"> 
    <label for="unit-panel">Change Panel:</label>
      <div class="unitfield-form">
        <select class="selection-genset" name="unit-panel" id="option-form-panel" onchange="handleFormSubmit(event, 'option-form-panel')">
          <?php include 'list-panel.php' ?>
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
                default:
                    break;
            }
        }
</script>