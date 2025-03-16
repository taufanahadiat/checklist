<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");

include 'database.php';
error_reporting(E_ALL ^ E_DEPRECATED);

$unit = isset($_GET['unit']) ? $_GET['unit'] : null;
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : null;
$trafo = isset($_GET['trafo']) ? $_GET['trafo'] : null;

// Check if there's an existing record for the determined date and trafo
$sql_select = "SELECT * FROM $unit WHERE bulan = '$bulan' AND trafo = '$trafo'";
$result_select = mysqli_query($conn, $sql_select);

// Check if there is an existing record for the determined date and trafo
$existing_record = mysqli_fetch_assoc($result_select);

// Prepare to build the SQL query for INSERT or UPDATE
$columns = array(); 
$values = array();

foreach ($_POST as $key => $value) {
    $escaped_key = mysqli_real_escape_string($conn, $key);
    $escaped_value = mysqli_real_escape_string($conn, $value);
    
    // Check if the value is empty or just whitespace, and set it to NULL if so
    if ($escaped_value === "" || ctype_space($escaped_value)) {
        $escaped_value = "NULL";
    } else {
        $escaped_value = "'" . $escaped_value . "'";
    }
    
    // Store the escaped key and value
    array_push($columns, "`$escaped_key`");
    array_push($values, $escaped_value);
}

// Check if an existing record was found
if ($existing_record) {
    // Existing record found, perform an UPDATE
    $set_clause = array();

    for ($i = 0; $i < count($columns); $i++) {
        if ($values[$i] === "NULL") {
            continue;
        } else {
            array_push($set_clause, $columns[$i] . " = " . $values[$i]);
        }
    }
    
    // Construct the UPDATE query
    $sql_update = "UPDATE $unit SET " . implode(", ", $set_clause) . " WHERE bulan = '$bulan' AND trafo = '$trafo'";
    $result_update = mysqli_query($conn, $sql_update);

    echo $return = mysqli_affected_rows($conn);

} else {
    // No existing record found, perform an INSERT
    $columns_sql = implode(", ", $columns);
    $values_sql = implode(", ", $values);
    
    // Construct the INSERT query
    $sql_insert = "INSERT INTO $unit (bulan, trafo, $columns_sql) VALUES ('$bulan', '$trafo', $values_sql)";
    $result_insert = mysqli_query($conn, $sql_insert);

    echo $return = mysqli_affected_rows($conn);
}
?>