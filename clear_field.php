<?php
require 'database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field_to_clear = $_POST['field_to_clear'];
    $unit = $_POST['unit'];

    // Sanitize input
    $field_to_clear = mysqli_real_escape_string($conn, $field_to_clear);
    $unit = mysqli_real_escape_string($conn, $unit);

    // Construct the SQL query to update the field to NULL
    $sql_update = "UPDATE $unit SET $field_to_clear = NULL WHERE tanggal = CURDATE()";
    if (mysqli_query($conn, $sql_update)) {
        echo 'Field cleared successfully';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>
