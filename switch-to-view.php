<figure class="img-container" id="imageContainer">
        <img class="img-small" src="css/review.png" alt="View Checklist">
        <figcaption>View Data</figcaption>
    </figure>

<script>
        var selectedUnit = '<?php echo $unit; ?>';
        var selectedDate = '<?php echo $tanggal; ?>'; 
        var selectedShift = '<?php echo $shift; ?>';
        var selectedLine = '<?php echo $line; ?>';
    // Extract the current PHP file name from the URL
    const currentFileName = window.location.pathname.split('/').pop();

    // Replace "view" with "form" in the file name
    const newFileName = currentFileName.replace('form', 'view-all');

    // Construct the new URL
    const newUrl = `${newFileName}?&selectedDate=${encodeURIComponent(selectedDate)}`;

    // Event listener for image container click
    document.getElementById('imageContainer').addEventListener('click', function () {
        // Redirect to the new URL
        location.href = newUrl;
    });
</script>
