<?php
//Viewing existing data at Form Entry
 date_default_timezone_set('Asia/Jakarta'); 
 // Determine if the current time is between 00:00-08:00
     $sql_select = "SELECT * FROM $unit WHERE tanggal = CURDATE()";
 $result_select = mysqli_query($conn, $sql_select);
 if (!$result_select) {
     die("Query failed: " . mysqli_error($conn));
 }      
$existing_record = mysqli_fetch_assoc($result_select);

//Viewing all data at View Menu

$sql = "SELECT * FROM $unit WHERE tanggal LIKE '%{$tanggal}%'";
$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $article = mysqli_fetch_assoc($results);
}

$query = "SELECT verifikasi FROM `$unit` WHERE tanggal = '$tanggal' LIMIT 1";
$result = mysqli_query($conn, $query);

$isVerified = false;
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $isVerified = $row['verifikasi'];
}

if (isset($_GET['selectedUnit'])){
// Function to format the value
function formatValue($value) {
    if (is_numeric($value)) {
        // If the value is a float and has .00 as decimals, return it as an integer
        if (floor($value) == $value) {
            return number_format(intval($value));
        } else {
            // Return the value formatted with commas but preserving its decimal part
            return number_format($value, 2);
        }
    } else {
        // Otherwise, return the original value
        return $value;
    }
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