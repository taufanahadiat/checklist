<?php
date_default_timezone_set('Asia/Jakarta');
// Fetch all records before today's date
$day = date('j'); // 'j' gives the day of the month without leading zeros

//Viewing existing data at Form Entry

     $sql_select = "SELECT * FROM $unit WHERE tanggal = CURDATE()";
     $result_select = mysqli_query($conn, $sql_select);

 if (!$result_select) {
     die("Query failed: " . mysqli_error($conn));
 }      
$existing_record = mysqli_fetch_assoc($result_select);

if (isset($bulan)){
//Viewing all data at View Menu
$sql = "SELECT * FROM $unit WHERE bulan = '{$bulan}' ORDER BY id ASC";
$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} 
}
// Function to format the value
function formatValue($value) {
    if (is_numeric($value)) {
            return number_format(round($value));
    } else {
        // Otherwise, return the original value
        return $value;
    }
}

// Example usage:
//$value = 10.00;
//echo formatValue($value); // Output: 10

//$value = 10.50;
//echo formatValue($value); // Output: 10.5

//$value = 10000.00;
//echo formatValue($value); // Output: 10,000
//
//$value = 10500.75;
//echo formatValue($value); // Output: 10,500.75
//
//$value = 1000000;
//echo formatValue($value); // Output: 1,000,000
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