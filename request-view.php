<?php
//Viewing existing data at Form Entry
 date_default_timezone_set('Asia/Jakarta'); 
 // Determine if the current time is between 00:00-08:00
 $currentHour = (int) date('H');
 if ($currentHour >= 0 && $currentHour < 8) {
     $sql_select = "SELECT * FROM $unit WHERE tanggal = DATE_SUB(CURDATE(), INTERVAL 1 DAY)";
 } else {
     $sql_select = "SELECT * FROM $unit WHERE tanggal = CURDATE()";
 }
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