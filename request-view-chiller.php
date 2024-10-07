<?php
//Viewing existing data at Form Entry
 date_default_timezone_set('Asia/Jakarta'); // Replace 'YOUR_TIMEZONE' with the appropriate timez
 // Determine if the current time is between 00:00-08:00
 $currentHour = (int) date('H');

$shift = isset($shift) ? $shift : NULL;
$unit = isset($unit) ? $unit : '';
$tanggal = isset($tanggal) ? $tanggal : '';

if ($shift !== NULL) {
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
} else {
//Viewing all data at View Menu

// Fetch data for Trane unit
$sql_trane_1 = "SELECT * FROM $unit_trane WHERE tanggal LIKE '%{$tanggal}%' AND shift LIKE 1";
$results_trane_1 = mysqli_query($conn, $sql_trane_1);

if ($results_trane_1 === false) {
    echo mysqli_error($conn);
} else {
    $article_trane_1 = mysqli_fetch_assoc($results_trane_1);
}

$sql_trane_2 = "SELECT * FROM $unit_trane WHERE tanggal LIKE '%{$tanggal}%' AND shift LIKE 2";
$results_trane_2 = mysqli_query($conn, $sql_trane_2);

if ($results_trane_2 === false) {
    echo mysqli_error($conn);
} else {
    $article_trane_2 = mysqli_fetch_assoc($results_trane_2);
}

$sql_trane_3 = "SELECT * FROM $unit_trane WHERE tanggal LIKE '%{$tanggal}%' AND shift LIKE 3";
$results_trane_3 = mysqli_query($conn, $sql_trane_3);

if ($results_trane_3 === false) {
    echo mysqli_error($conn);
} else {
    $article_trane_3 = mysqli_fetch_assoc($results_trane_3);
}

// Fetch data for Hitachi unit
$sql_hitachi_1 = "SELECT * FROM $unit_hitachi WHERE tanggal LIKE '%{$tanggal}%' AND shift LIKE 1";
$results_hitachi_1 = mysqli_query($conn, $sql_hitachi_1);

if ($results_hitachi_1 === false) {
    echo mysqli_error($conn);
} else {
    $article_hitachi_1 = mysqli_fetch_assoc($results_hitachi_1);
}

$sql_hitachi_2 = "SELECT * FROM $unit_hitachi WHERE tanggal LIKE '%{$tanggal}%' AND shift LIKE 2";
$results_hitachi_2 = mysqli_query($conn, $sql_hitachi_2);

if ($results_hitachi_2 === false) {
    echo mysqli_error($conn);
} else {
    $article_hitachi_2 = mysqli_fetch_assoc($results_hitachi_2);
}

$sql_hitachi_3 = "SELECT * FROM $unit_hitachi WHERE tanggal LIKE '%{$tanggal}%' AND shift LIKE 3";
$results_hitachi_3 = mysqli_query($conn, $sql_hitachi_3);

if ($results_hitachi_3 === false) {
    echo mysqli_error($conn);
} else {
    $article_hitachi_3 = mysqli_fetch_assoc($results_hitachi_3);
}
}

if(isset($unit_trane)){
$query = "SELECT verifikasi FROM `$unit_trane` WHERE tanggal = '$tanggal' LIMIT 1";
$result = mysqli_query($conn, $query);

$isVerified = false;
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $isVerified = $row['verifikasi'];
}
}
if(isset($unit_trane)){
$query2 = "SELECT verifikasi FROM `$unit_hitachi` WHERE tanggal = '$tanggal' LIMIT 1";
$result2 = mysqli_query($conn, $query);

$isVerified2 = false;
if ($result2 && mysqli_num_rows($result2) > 0) {
    $row2 = mysqli_fetch_assoc($result2);
    $isVerified2 = $row2['verifikasi'];
}
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
                        unit: '<?php echo $unit; ?>', // Pass the unit parameter
                        shift: '<?php echo $shift; ?>' // Pass the unit parameter
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

    $(document).ready(function() {
    $('.edit-btn').click(function() {
        var currentNote = $(this).data('current-note');
        if (!currentNote) {
            currentNote = "<?php echo htmlspecialchars($existing_record['note'], ENT_QUOTES); ?>";
        }
        
        // Create or show the textarea with the current note value
        var $textarea = $('<textarea>', {
            name: 'note',
            id: 'note-textarea',
            style: 'height:60px;width:90%;padding:4px;',
            text: currentNote
        });

        // Insert the textarea into the desired location, replace existing textarea if needed
        $('#note-container').html($textarea);
        
        // Optionally, you can also focus on the textarea
        $textarea.focus();
    });
});

$(document).ready(function() {
    $('#save-button').click(function() {
        event.preventDefault();

        var noteValue = $('#note-textarea').val();
        if (!noteValue) {
            noteValue = "<?php echo htmlspecialchars($existing_record['note'], ENT_QUOTES); ?>";
        }
        var selectedUnit = "<?php echo $unit; ?>";
        var selectedShift = "<?php echo isset($selectedShift) ? $selectedShift : ''; ?>"; // Ensure this is available in PHP
        var selectedLine = "<?php echo isset($selectedLine) ? $selectedLine : ''; ?>"; // Ensure this is available in PHP

        // Prepare the data object for AJAX request
        var data = {
            note: noteValue,
            unit: selectedUnit
        };

        // Conditionally add selectedShift if it's set
        if (selectedShift) {
            data.shift = selectedShift;
        }

        // Conditionally add selectedLine if it's set
        if (selectedLine) {
            data.line = selectedLine;
        }

        $.ajax({
            url: 'edit_field.php',
            type: 'POST',
            data: data,
            success: function(response) {
                document.forms[1].submit();
            },
            error: function(xhr, status, error) {
                console.error('AJAX error:', status, error);
                alert('Error updating note. Please try again.');
            }
        });
    });
});



</script>