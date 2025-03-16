<?php
//Viewing existing data at Form Entry
 date_default_timezone_set('Asia/Jakarta'); 
 // Determine if the current time is between 00:00-08:00
     $sql_select = "SELECT * FROM $unit WHERE tahun = '$tahun'";
 $result_select = mysqli_query($conn, $sql_select);
 if (!$result_select) {
     die("Query failed: " . mysqli_error($conn));
 }      
$existing_record = mysqli_fetch_assoc($result_select);

//Viewing all data at View Menu

$sql_1 = "SELECT * FROM $unit WHERE tahun LIKE '%{$tahun}%_1'";
$results_1 = mysqli_query($conn, $sql_1);

$sql_2 = "SELECT * FROM $unit WHERE tahun LIKE '%{$tahun}%_2'";
$results_2 = mysqli_query($conn, $sql_2);

if ($results_1 === false) {
    echo mysqli_error($conn);
} else {
    $article_1 = mysqli_fetch_assoc($results_1);
}
if ($results_2 === false) {
    echo mysqli_error($conn);
} else {
    $article_2 = mysqli_fetch_assoc($results_2);
}

$query = "SELECT verifikasi FROM `$unit` WHERE tahun = '$tahun' LIMIT 1";
$result = mysqli_query($conn, $query);

$isVerified = false;
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $isVerified = $row['verifikasi'];
}

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