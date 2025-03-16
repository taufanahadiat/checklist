<?php
require 'database.php';

if (session_id() == '') {
    session_start();
  }
  if (empty($_SESSION['loggedin'])) {
      header("Refresh: 0; url=../");
      exit();
  }

  $trafoArray = array(
    'tr1', 'tr2', 'tr3', 'tr4', 'tr5', 'tr6', 'tr7', 'tr8', 'tr9', 'tr10', 
    'tr11', 'tr12', 'tr13', 'tr14', 'tr15', 'tr16', 'tr16a', 'tr17', 'tr18', 'tr19', 
    'tr20', 'tr21', 'tr22', 'tr23', 'tr24', 'tr25', 'trg3', 'trg4', 'trg5', 'trg6', 
    'trg7', 'trg8', 'trg9', 'trg10', 'trg11'
  );


$unit = $_GET['selectedUnit']; 
date_default_timezone_set('Asia/Jakarta'); 
$bulan = $_GET['selectedMonth']; 

foreach ($trafoArray as $trafo) {
    $sql_exist = "SELECT * FROM $unit WHERE bulan = '$bulan' AND trafo = '$trafo'";
    
    $result_exist = mysqli_query($conn, $sql_exist);
    if (!$result_exist) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    $existing_record = mysqli_fetch_assoc($result_exist);
    ${"record_$trafo"} = $existing_record;
}


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

?>
