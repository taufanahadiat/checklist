<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field_to_clear = $_POST['field_to_clear'];
    $unit = $_POST['unit'];
    $shift = isset($_POST['shift']) ? $_POST['shift'] : '';
    $line = isset($_POST['line']) ? $_POST['line'] : '';
    $date = isset($_POST['date']) ? $_POST['date'] : '';

    // Sanitize input
    $field_to_clear = mysqli_real_escape_string($conn, $field_to_clear);
    $unit = mysqli_real_escape_string($conn, $unit);

    if (!empty($date)) {
        $date = mysqli_real_escape_string($conn, $line); 
        $sql_update = "UPDATE $unit SET $fieldToClear = NULL WHERE tanggal = '$date'";
    }else{
    // Start constructing the SQL query
    $sql_update = "UPDATE $unit SET $field_to_clear = NULL WHERE tanggal = CURDATE()";
    }
    
    // Append conditions based on presence of shift and line
    if (!empty($shift)) {
        $shift = mysqli_real_escape_string($conn, $shift); 
        $sql_update .= " AND shift LIKE '%$shift%'";
    }
    
    if (!empty($line)) {
        $line = mysqli_real_escape_string($conn, $line); 
        $sql_update .= " AND line LIKE '%$line%'";
    }

    // Execute the query
    if (mysqli_query($conn, $sql_update)) {
        echo '<script>alert("Field cleared successfully"); window.location.href = window.location.href;</script>';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>
