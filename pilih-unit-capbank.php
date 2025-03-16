<form name="select-form-capbank" onsubmit="handleFormSubmit(event, 'option-form-capbank')">
    <div class="custom-label-form" style="margin-top:-20px;"> 
    <label for="unit-capbank">Change Line:</label>
      <div class="unitfield-form">
        <select class="selection-genset" name="unit-capbank" id="option-form-capbank" onchange="handleFormSubmit(event, 'option-form-capbank')">
          <?php include 'list-capbank.php' ?>
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
              case 'capbank_lvdp3':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp3.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdp4_prod':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp4prod.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdp4_uty':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp4uty.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_trafo5':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafo5.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_trafo6':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafo6.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_trafo7':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafo7.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdp8':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdp8.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_trafopet_prod':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafopetprod.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_trafopet_uty':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafopetuty.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdpmet2':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdpmet2.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdpmet3':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdpmet3.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_lvdpoffice':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-lvdpoffice.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
              case 'capbank_trafocpp':
                    if (selectId === 'option-form-capbank' && selectedUnit) {
                        location.href = 'form-capbank-trafocpp.php?selectedUnit=' + encodeURIComponent(selectedUnit);
                    } 
                    break;                   
                default:
                    break;
            }
        }
</script>