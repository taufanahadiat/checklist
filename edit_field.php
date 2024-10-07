<?php
// FOR NOTE FIELD ONLY
require 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $note = mysqli_real_escape_string($conn, $_POST['note']);
    $unit = mysqli_real_escape_string($conn, $_POST['unit']);
    $shift = isset($_POST['shift']) ? mysqli_real_escape_string($conn, $_POST['shift']) : '';
    $line = isset($_POST['line']) ? mysqli_real_escape_string($conn, $_POST['line']) : '';

    // Start constructing the SQL query
    $sql_update_note = "UPDATE $unit SET note = '$note' WHERE tanggal = CURDATE()";

    // Append conditions based on presence of shift and line
    if (!empty($shift)) {
        $sql_update_note .= " AND shift LIKE '%$shift%'";
    }
    
    if (!empty($line)) {
        $sql_update_note .= " AND line LIKE '%$line%'";
    }

    // Execute the query
    $result_update_note = mysqli_query($conn, $sql_update_note);

    if ($result_update_note === false) {
        echo "Error: " . mysqli_error($conn);
    } else {
        echo "Note updated successfully.";
    }

    mysqli_close($conn);
}
?>
