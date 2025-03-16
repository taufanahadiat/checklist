<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

include 'database.php';
error_reporting(E_ALL ^ E_DEPRECATED);

// Define the upload directory
$uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/checklist/uploadTrafo/';

// Get the parameters from the GET request
$unit = isset($_GET['unit']) ? $_GET['unit'] : null;
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : null;
$trafo = isset($_GET['trafo']) ? $_GET['trafo'] : null;
$fileType = isset($_GET['fileType']) ? $_GET['fileType'] : null;

// Check if the file is uploaded
if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
    // Get the file details
    $fileTmpPath = $_FILES['file']['tmp_name'];
    $fileName = $_FILES['file']['name'];
    $fileSize = $_FILES['file']['size'];
    $fileType = $_FILES['file']['type'];
    $fileNameCmps = pathinfo($fileName);
    $fileExtension = strtolower($fileNameCmps['extension']);

    // Sanitize the file name
    $newFileName = preg_replace('/[^a-zA-Z0-9_-]/', '_', $fileNameCmps['filename']) . '.' . $fileExtension;

    // Construct the target file path
    $targetFilePath = $uploadDir . $newFileName;

    // Move the file to the target directory
    if (move_uploaded_file($fileTmpPath, $targetFilePath)) {
        // File upload successful
        $response = array(
            'status' => 'success',
            'message' => 'File uploaded successfully.',
            'fileName' => $newFileName
        );

        // Update the database with the new file name
        $columnName = ($fileType === 'lv') ? 'temp_img_kabel_lv' : 'temp_img_kabel_mv';
        $fileValue = $newFileName;

        // Insert or update the column in the $unit table
        $sql_upload = "UPDATE $unit SET $columnName = '$fileValue' WHERE bulan = '$bulan' AND trafo = '$trafo'";
        if ($conn->query($sql_upload) === TRUE) {
            $response['message'] .= ' and database updated successfully.';
        } else {
            $response['status'] = 'error';
            $response['message'] .= ' but failed to update database: ' . $conn->error;
        }

        // Close the database connection
        $conn->close();
    } else {
        // File upload failed
        $response = array(
            'status' => 'error',
            'message' => 'There was an error moving the uploaded file.'
        );
    }
} else {
    // No file uploaded or there was an upload error
    $response = array(
        'status' => 'error',
        'message' => 'No file uploaded or there was an upload error.'
    );
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);
?>