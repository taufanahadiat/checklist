<?php
// Database connection
include('database.php');
$bulan = date("Y-m");

// Get the column and filename from the POST request
$column = isset($_POST['column']) ? $_POST['column'] : '';
$filename = isset($_POST['filename']) ? $_POST['filename'] : '';
$primaryKeyValue = isset($_POST['primaryKeyValue']) ? $_POST['primaryKeyValue'] : ''; // Primary key value to target the correct row

if ($column && $filename && $primaryKeyValue) {
    // Define the file paths for JPG and PNG files
    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/checklist/uploadTrafo/';
    $imagePathJpg = $uploadDir . $filename . '.jpg';
    $imagePathPng = $uploadDir . $filename . '.png';

    // Delete the image file if it exists
    if (file_exists($imagePathJpg)) {
        unlink($imagePathJpg);
    } elseif (file_exists($imagePathPng)) {
        unlink($imagePathPng);
    }

    // Update the database: set the corresponding column to NULL
    $sql = "UPDATE trafo_monthly SET $column = NULL WHERE bulan ='$bulan' AND trafo = '$primaryKeyValue'";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        // Respond back to the client
        echo "Image and database entry deleted successfully.";
    } else {
        echo "Error updating the database: " . mysqli_error($conn);
    }
} else {
    echo "Invalid request parameters.";
}

mysqli_close($conn);
?>
