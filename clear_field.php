<?php
require 'database.php';

date_default_timezone_set('Asia/Jakarta'); // Set timezone to Asia/Jakarta

// Determine if the current time is between 00:00-06:00
$currentHour = (int) date('H');
if ($currentHour >= 0 && $currentHour < 8) {
    $tanggal = date("Y-m-d", strtotime("-1 day")); // Yesterday's date
} else {
    $tanggal = date("Y-m-d"); // Today's date
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $field_to_clear = mysqli_real_escape_string($conn, $_POST['field_to_clear']);
    $unit = mysqli_real_escape_string($conn, $_POST['unit']);
    $shift = isset($_POST['shift']) ? mysqli_real_escape_string($conn, $_POST['shift']) : '';
    $line = isset($_POST['line']) ? mysqli_real_escape_string($conn, $_POST['line']) : '';
    $date = isset($_POST['date']) ? mysqli_real_escape_string($conn, $_POST['date']) : '';
    $bulan = isset($_POST['bulan']) ? mysqli_real_escape_string($conn, $_POST['bulan']) : '';
    $trafo = isset($_POST['trafo']) ? mysqli_real_escape_string($conn, $_POST['trafo']) : '';

    // Build base SQL query based on presence of date or bulan
    if (!empty($bulan)) {
        $sql_update = "UPDATE $unit SET $field_to_clear = NULL WHERE bulan = '$bulan'";
    } elseif (!empty($date)) {
        $sql_update = "UPDATE $unit SET $field_to_clear = NULL WHERE tanggal = '$date'";
    } else {
        $sql_update = "UPDATE $unit SET $field_to_clear = NULL WHERE tanggal = '$tanggal'";
    }

    // Add optional conditions
    if (!empty($shift)) $sql_update .= " AND shift LIKE '%$shift%'";
    if (!empty($line)) $sql_update .= " AND line LIKE '%$line%'";
    if (!empty($trafo)) $sql_update .= " AND trafo LIKE '%$trafo%'";

    // Execute the query and handle response
    if (mysqli_query($conn, $sql_update)) {
        echo 'Field cleared successfully';
    } else {
        echo 'Error: ' . mysqli_error($conn);
    }
}
?>
