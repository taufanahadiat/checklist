<?php
//Viewing existing data at Form Entry
 date_default_timezone_set('Asia/Jakarta'); // Replace 'YOUR_TIMEZONE' with the appropriate timez
 // Determine if the current time is between 00:00-06:00
 $currentHour = (int) date('H');
 if ($currentHour >= 0 && $currentHour < 6) {
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


// Function to format the value
function formatValue($value) {
    // Check if the value is a float and has .00 as decimals
    if (is_numeric($value) && floor($value) == $value) {
        return intval($value); // Return integer value
    } else {
        return $value; // Otherwise, return the original value
    }
}

// Example usage:
$value = 10.00;
//echo formatValue($value); // Output: 10

$value = 10.50;
//echo formatValue($value); // Output: 10.5
?>