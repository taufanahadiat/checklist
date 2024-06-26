<?php
// Sanitize the 'selectedUnit' parameter from the query string
$unit = htmlspecialchars($_GET['selectedUnit']); 
$shift = htmlspecialchars($_GET['selectedShift']);
$line = htmlspecialchars($_GET['selectedLine']);
require 'database.php';
require 'request-compressor.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Checklist</title>
    <link rel="stylesheet" href="style.css">
    <script src="jquery-3.7.1.min.js"></script>
</head>
<body>
<?php include 'header.php'; ?>
<main>
<?php
    if($line === '4&5'){
        include 'form-compressor45.php';
    }else if($line === '6&7'){
        include 'form-compressor67.php';
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
