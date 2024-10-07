<?php
// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Database connection
$conn = mysqli_connect('localhost', 'root', 'akpidev3', 'checklistnew_24'); // Update with your credentials
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $column = $_POST['column'];
    $value = $_POST['value'];

    error_log("Date: $date, Column: $column, Value: $value"); // Log to check values

    // Check if the value is empty, set to NULL if it is
    if (empty($value)) {
        // Prepare the SQL query to set the column to NULL
        $sql = "UPDATE konsumsi_gas SET $column = NULL WHERE tanggal = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 's', $date);
    } else {
        // Prepare the SQL query to update the database with the provided value
        $sql = "UPDATE konsumsi_gas SET $column = ? WHERE tanggal = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, 'ss', $value, $date);
    }

    if (mysqli_stmt_execute($stmt)) {
        echo 'Success'; // Return success response
    } else {
        echo 'Error'; // Return error response
    }

    mysqli_stmt_close($stmt);
}
mysqli_close($conn);
?>
