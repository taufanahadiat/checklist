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
date_default_timezone_set('Asia/Jakarta'); 

$tanggal = date("Y-m-d");
$today = date('d');

if ($today >= 21) {
    $formBulan = date('Y-m', strtotime('+1 month'));  // Next month
} else {
    $formBulan = date('Y-m');  // Current month
}


// Initialize variables
if ($today >= 21) {
    // Start from the 20th of this month
    $startDate = date("Y-m-20");
    // End on the 20th of the next month
    $endDate = date("Y-m-20", strtotime("+1 month"));
    $formBulan = date('Y-m', strtotime('+1 month'));  // Next month
} else {
    // Start from the 20th of the previous month
    $startDate = date("Y-m-20", strtotime("-1 month"));
    // End on the 20th of this month
    $endDate = date("Y-m-20");
    $formBulan = date('Y-m');  // Current month
}

$startTimestamp = strtotime($startDate);
$endTimestamp = strtotime($endDate);

$id_num = (floor(($endTimestamp - $startTimestamp) / (60 * 60 * 24))) + 1; // +1 to include the start day

$total_day = $id_num - 2; // Exclude the first and last rows

$maxInlet1 = 0;
$maxInlet2 = 0;
$maxInlet3 = 0;

// Initialize an empty array to store the dates
$dateArray = array();

// Populate the dateArray with all the $currentDate values
for ($i = 0; $i < $id_num; $i++) {
    $currentDate = date("Y-m-d", strtotime("+$i day", $startTimestamp));
    $dateArray[] = $currentDate; // Add the date to the array
}

foreach ($dateArray as $date) {
    $sql_exist = "SELECT * FROM $unit WHERE tanggal = '$date'";
    
    $result_exist = mysqli_query($conn, $sql_exist);
    if (!$result_exist) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    $existing_data = mysqli_fetch_assoc($result_exist);
    ${"record_$date"} = $existing_data;
}



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date = mysqli_real_escape_string($conn, $_POST['tanggal']); // Get trafo value from the hidden field

    // Check if there's an existing record for the determined date
    $sql_select = "SELECT * FROM $unit WHERE tanggal = '$date'";
    $result_select = mysqli_query($conn, $sql_select);
    
    if (!$result_select) {
        echo "Error: " . mysqli_error($conn);
    } else {
        // Check if there is an existing record for the determined date
        $existing_record = mysqli_fetch_assoc($result_select);

        // Prepare to build the SQL query for INSERT or UPDATE
        $columns = array();
        $values = array();
        

        foreach ($_POST as $key => $value) {
            if ($key == 'tanggal') {
                continue;  // Skip these since they're already assigned
            }

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

        if (empty($columns)) {
            echo "<script>alert('No valid fields to update.');</script>";
        } else {
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
                $sql_update = "UPDATE $unit SET " . implode(", ", $set_clause) . " WHERE tanggal = '$date'";
                $result_update = mysqli_query($conn, $sql_update);

                if ($result_update === false) {
                    echo "<script>alert('Error updating existing record: " . mysqli_error($conn) . "');</script>";
                } else {
                    echo "<script>alert('Existing record updated successfully for tanggal: " . $date . "');
                            window.location.href = window.location.href;
                    </script>";
                }
            } else {
                // No existing record found, perform an INSERT
                $columns_sql = implode(", ", $columns);
                $values_sql = implode(", ", $values);
                
                // Construct the INSERT query
                $sql_insert = "INSERT INTO $unit (tanggal, $columns_sql) VALUES ('$date', $values_sql)";
                $result_insert = mysqli_query($conn, $sql_insert);

                if ($result_insert === false) {
                    echo "<script>alert('Error inserting new record: " . mysqli_error($conn) . "');</script>";
                } else {
                    echo "<script>alert('New record submitted successfully for tanggal: " . $date . "');
                            window.location.href = window.location.href;
                    </script>";
                }
            }
        }
    }

    mysqli_close($conn); 
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
