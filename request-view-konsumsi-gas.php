<?php
//Viewing existing data at Form Entry
 date_default_timezone_set('Asia/Jakarta'); 

     $sql_select = "SELECT * FROM $unit";
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

$query = "SELECT verifikasi FROM `$unit` WHERE tanggal = '$tanggal' LIMIT 1";
$result = mysqli_query($conn, $query);

$isVerified = false;
if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $isVerified = $row['verifikasi'];
}

// Function to format the value
function formatValue($value) {
    if (is_numeric($value)) {
        // If the value is a float and has .00 as decimals, return it as an integer
        if (floor($value) == $value) {
            return number_format(intval($value));
        } else {
            // Return the value formatted with commas but preserving its decimal part
            return number_format($value, 2);
        }
    } else {
        // Otherwise, return the original value
        return $value;
    }
}



// Example usage:
//$value = 10.00;
//echo formatValue($value); // Output: 10

//$value = 10.50;
//echo formatValue($value); // Output: 10.5

//$value = 10000.00;
//echo formatValue($value); // Output: 10,000
//
//$value = 10500.75;
//echo formatValue($value); // Output: 10,500.75
//
//$value = 1000000;
//echo formatValue($value); // Output: 1,000,000
?>

