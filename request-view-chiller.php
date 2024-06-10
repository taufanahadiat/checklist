<?php
//Viewing existing data at Form Entry
 date_default_timezone_set('Asia/Jakarta'); // Replace 'YOUR_TIMEZONE' with the appropriate timez
 // Determine if the current time is between 00:00-08:00
 $currentHour = (int) date('H');
 if ($currentHour >= 0 && $currentHour < 8) {
     $sql_select = "SELECT * FROM $unit WHERE tanggal = DATE_SUB(CURDATE(), INTERVAL 1 DAY) AND shift LIKE '%{$shift}%'";
 } else {
     $sql_select = "SELECT * FROM $unit WHERE tanggal = CURDATE() AND shift LIKE '%{$shift}%'";
 }
 $result_select = mysqli_query($conn, $sql_select);
 if (!$result_select) {
     die("Query failed: " . mysqli_error($conn));
 }      
$existing_record = mysqli_fetch_assoc($result_select);

//Viewing all data at View Menu

$sql = "SELECT * FROM $unit WHERE tanggal LIKE '%{$tanggal}%' AND shift LIKE '%{$shift}%'";
$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $article = mysqli_fetch_assoc($results);
}


// Function to format the value
function formatValue($value) {
    // Check if the value is a float and has .00 as decimals
    if (is_numeric($value) && floor($value) == $value) {
        return intval($value); // Return integer value
    } else {
        return $value; // Otherwise, return the original value
    }
}

// Example usage:
$value = 10.00;
//echo formatValue($value); // Output: 10

$value = 10.50;
//echo formatValue($value); // Output: 10.5
?>

<script>
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