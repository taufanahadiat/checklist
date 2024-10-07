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
$line = $_GET['selectedLine']; 

date_default_timezone_set('Asia/Jakarta'); 

$tanggal = date("Y-m");

// Use the determined date for the SELECT query
$sql = "SELECT *
        FROM $unit
        WHERE tanggal = '$tanggal'
        AND line LIKE '%{$line}%'";

$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
    //echo "not connect";
} else {
    $article = mysqli_fetch_assoc($results);
    //echo "connect";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if there's an existing record for the determined date
    $sql_select = "SELECT * FROM $unit WHERE tanggal = '$tanggal' AND line LIKE '%{$line}%'";
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
                $sql_update = "UPDATE $unit SET " . implode(", ", $set_clause) . " WHERE tanggal = '$tanggal' AND line LIKE '%{$line}%'";
                $result_update = mysqli_query($conn, $sql_update);

                if ($result_update === false) {
                    echo "<script>alert('Error updating existing record: " . mysqli_error($conn) . "');</script>";
                } else {
                    echo "<script>alert('Existing record updated successfully for date: " . $tanggal . "');
                            window.location.href = window.location.href;
                    </script>";
                }
            } else {
                // No existing record found, perform an INSERT
                $columns_sql = implode(", ", $columns);
                $values_sql = implode(", ", $values);
                
                // Construct the INSERT query
                $sql_insert = "INSERT INTO $unit (tanggal, line, $columns_sql) VALUES ('$tanggal', '$line', $values_sql)";
                $result_insert = mysqli_query($conn, $sql_insert);

                if ($result_insert === false) {
                    echo "<script>alert('Error inserting new record: " . mysqli_error($conn) . "');</script>";
                } else {
                    echo "<script>alert('New record submitted successfully for date: " . $tanggal . "');
                            window.location.href = window.location.href;
                    </script>";
                }
            }
        }
    }

    mysqli_close($conn); 
}
?>
