    <?php 
    $currentHour = (int) date('H');
    if ($currentHour >= 0 && $currentHour < 8) {
        $todayDate = date("Y-m-d", strtotime("-1 day")); // Yesterday's date
    } else {
        $todayDate = date("Y-m-d"); // Today's date
    }
    ?>
    <?php if ($tanggal === $todayDate): ?>
    <figure class="img-container" id="imageContainer" style="align-self:flex-start; margin-left: 130px; margin-top: 20px;">
        <img class="img-small" src="css/review.png" alt="View Checklist">
        <figcaption>Form Data</figcaption>
    </figure>
    <?php endif; ?>

    <script>
        var selectedUnit = '<?php echo $unit; ?>';
        var selectedLine = '<?php echo $line; ?>';
        // Retrieve the `selectedShift` parameter from the URL
        const urlParams = new URLSearchParams(window.location.search);
        let selectedShift = urlParams.get('selectedShift');

        // Check if `selectedShift` is not set or is null
        if (!selectedShift) {
            selectedShift = '1'; // Default value if `selectedShift` is not present
        }
    // Extract the current PHP file name from the URL
    const currentFileName = window.location.pathname.split('/').pop();

    // Replace "view" with "form" in the file name
    const newFileName = currentFileName.replace('view', 'form');

    // Construct the new URL
    const newUrl = `${newFileName}?selectedUnit=${encodeURIComponent('<?php echo $unit; ?>')}&selectedShift=${encodeURIComponent(selectedShift)}&selectedLine=${encodeURIComponent('<?php echo $line; ?>')}`;

    // Event listener for image container click
    document.getElementById('imageContainer').addEventListener('click', function () {
        // Redirect to the new URL
        location.href = newUrl;
    });

    </script>