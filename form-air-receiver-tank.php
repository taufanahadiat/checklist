<?php
// Sanitize the 'selectedUnit' parameter from the query string
$unit = htmlspecialchars($_GET['selectedUnit']); 
$shift = htmlspecialchars($_GET['selectedShift']);
$line = htmlspecialchars($_GET['selectedLine']);
require 'database.php';
require 'request-compressor.php';

// Get the user's IP address
$user_ip = $_SERVER['REMOTE_ADDR'];
$allowed_user = $_SESSION["type_user"];

$allowed_ip = '';
if($line === '4&5'){
    $allowed_ip = '131.107.7.210';
}else if($line === '6&7'){
    $allowed_ip = '131.107.7.217';
}
// Check if the user's IP matches the allowed IP
if ($_SESSION["id"] !== '1' && $user_ip !== $allowed_ip) {
    // If not, set an error message and redirect to selection.php
    echo "<script>alert('Anda sedang tidak terhubung dengan WiFi di area compressor Line $line. Pastikan koneksi WiFi anda tidak terputus'); window.location.href = './selection.php';</script>";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Checklist</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" type="image/x-icon" href="../../img/icon.ico">
    <script src="jquery-3.7.1.min.js"></script>
    <link rel="stylesheet" href="fontawesome/css/all.css">
</head>
<body>
<?php include 'header.php'; ?>
<main>
<?php include 'switch-to-view.php'; ?>
<?php
    if($line === '4&5'){
        include 'form-air-receiver-tank45.php';
    }else if($line === '6&7'){
        include 'form-air-receiver-tank67.php';
    }
?>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.getElementById("exit").onclick = function () {
            location.href = 'selection.php';
        };
        $(".enum").prop("selectedIndex", -1);
        $(".enum_long").prop("selectedIndex", -1);
        $(".input-field").val('');

    });
</script>
</body>
</html>
