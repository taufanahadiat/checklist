<?php
require 'database.php';

if (session_id() == '') {
    session_start();
  }
  if (empty($_SESSION['loggedin'])) {
      header("Refresh: 0; url=../");
      exit();
  }

$unit = $_GET['selectedUnit'];
$shift = $_GET['selectedShift'];

date_default_timezone_set('Asia/Jakarta');

$currentHour = (int) date('H');
$tanggal = ($currentHour >= 0 && $currentHour < 8) ? date("Y-m-d", strtotime("-1 day")) : date("Y-m-d");

$sql = "SELECT * FROM $unit WHERE tanggal = '$tanggal' AND shift LIKE '%$shift%'";
$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $existing_record = mysqli_fetch_assoc($results);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $columns = array();
    $values = array();

    foreach ($_POST as $key => $value) {
        $escaped_key = mysqli_real_escape_string($conn, $key);
        $escaped_value = mysqli_real_escape_string($conn, $value);
        
        // Check if the value is empty or whitespace, and set it to NULL if so
        $escaped_value = ($escaped_value === "" || ctype_space($escaped_value)) ? "NULL" : "'$escaped_value'";
        
        // Store the escaped key and value
        array_push($columns, "`$escaped_key`");
        array_push($values, $escaped_value);
    }

    if (empty($columns)) {
        echo "<script>alert('No valid fields to update.');</script>";
    } else {
        if ($existing_record) {
            // Existing record found, perform an UPDATE
            $set_clause = array();

            for ($i = 0; $i < count($columns); $i++) {
                if ($values[$i] !== "NULL") {
                    array_push($set_clause, $columns[$i] . " = " . $values[$i]);
                }
            }
            
            if (!empty($set_clause)) {
                $sql_update = "UPDATE $unit SET " . implode(", ", $set_clause) . " WHERE tanggal = '$tanggal' AND shift LIKE '%$shift%'";
                $result_update = mysqli_query($conn, $sql_update);

                if ($result_update === false) {
                    echo "<script>alert('Error updating existing record: " . mysqli_error($conn) . "');</script>";
                } else {
                    echo "<script>alert('Existing record updated successfully for date: " . $tanggal . " and shift: " . $shift . "'); window.location.href = window.location.href;</script>";
                }
            }
        } else {
            // No existing record found, perform an INSERT
            $columns_sql = implode(", ", $columns);
            $values_sql = implode(", ", $values);
            
            $sql_insert = "INSERT INTO $unit (tanggal, shift, $columns_sql) VALUES ('$tanggal', '$shift', $values_sql)";
            $result_insert = mysqli_query($conn, $sql_insert);

            if ($result_insert === false) {
                echo "<script>alert('Error inserting new record: " . mysqli_error($conn) . "');</script>";
            } else {
                echo "<script>alert('New record submitted successfully for date: " . $tanggal . " and shift: " . $shift . "'); window.location.href = window.location.href;</script>";
            }
        }
    }

    mysqli_close($conn); 
}
?>
