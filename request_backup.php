<?php
$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    // Check if there's an existing record for today's date
    $sql_select = "SELECT * FROM $unit WHERE tanggal = CURDATE()";
    $result_select = mysqli_query($conn, $sql_select);
    $date = date("Y-m-d");

    if (!$result_select) {
        echo "Error: " . mysqli_error($conn);
    } else {
        $existing_record = mysqli_fetch_assoc($result_select);

        // Prepare to build the SQL query for either INSERT or UPDATE
        $columns = array();
        $values = array();

        foreach ($_POST as $key => $value) {
            $escaped_key = mysqli_real_escape_string($conn, $key);
            $escaped_value = mysqli_real_escape_string($conn, $value);
            
            if ($escaped_value === "" || ctype_space($escaped_value)) {
                $escaped_value = "NULL";
            } else {
                $escaped_value = "'" . $escaped_value . "'";
            }
            array_push($columns, "`$escaped_key`");
            array_push($values, $escaped_value);
        }

        if (empty($columns)) {
            echo "<script>alert('No valid fields to update.');</script>";
        } else {
            if ($existing_record === null) {
                // No existing record, perform an INSERT
                $sql_insert = "INSERT INTO $unit (tanggal, " . implode(", ", $columns) . ") 
                            VALUES (CURDATE(), " . implode(", ", $values) . ")";
                
                $result_insert = mysqli_query($conn, $sql_insert);

                if ($result_insert === false) {
                    echo "<script>alert('Error inserting new record: " . mysqli_error($conn) . "');</script>";
                } else {
                    echo "<script>alert('New record submitted successfully for date: $date');</script";
                }
            } else {
                // Existing record found, perform an UPDATE
                $set_clause = array();
        
                for ($i = 0; $i < count($columns); $i++) {
                    if ($values[$i] === "NULL") {
                        continue;
                    }
                        array_push($set_clause, $columns[$i] . " = " . $values[$i]);
                }
                
                $sql_update = "UPDATE $unit SET " . implode(", ", $set_clause) . " WHERE tanggal = CURDATE()";
                $result_update = mysqli_query($conn, $sql_update);

                if ($result_update === false) {
                    echo "<script>alert('Error updating existing record: " . mysqli_error($conn) . "');</script>";
                } else {
                    echo "<script>alert('Existing record updated successfully for date: $date');</script>";
                }
            }
        }
    }

    mysqli_close($conn); 
}
