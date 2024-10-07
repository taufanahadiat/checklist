<figure class="img-container" id="imageContainer" style="align-self:flex-start; margin-left: 130px; margin-top: 20px;">
        <img class="img-small" src="css/review.png" alt="View Checklist">
        <figcaption>Konsumsi Gas</figcaption>
    </figure>

<script>
// Get the selected month from PHP
var selectedMonth = '<?php echo substr($tanggal, 0, 7); ?>';

// Get today's month in YYYY-MM format
var today = new Date();
var currentMonth = today.getFullYear() + '-' + ('0' + (today.getMonth() + 1)).slice(-2);

// Event listener for image container click
document.getElementById('imageContainer').addEventListener('click', function () {
    // Check if today's month is the same as the month in $tanggal
    if (currentMonth === selectedMonth) {
        // Redirect to form-konsumsi-gas.php if the months match
        location.href = 'form-konsumsi-gas.php?selectedUnit=konsumsi_gas';
    } else {
        // Otherwise, redirect to view-konsumsi-gas.php
        location.href = 'view-konsumsi-gas.php?selectedUnit=konsumsi_gas&selectedMonth=' + encodeURIComponent(selectedMonth);
    }
});
</script>
