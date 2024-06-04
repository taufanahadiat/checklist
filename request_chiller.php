<?php
// Assuming you have established a connection to your MySQL database already

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if there's an existing record for today's date
    $sql_select = "SELECT * FROM chiller_trane_67bopet WHERE tanggal = CURDATE()";
    $result_select = mysqli_query($conn, $sql_select);
    
    if (!$result_select) {
        echo "Error: " . mysqli_error($conn);
    } else {
        // Check if there is an existing record for today's date
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

        // Construct the SQL query
        $sql = "INSERT INTO chiller_trane_67bopet (" . implode(", ", $columns) . ") VALUES (" . implode(", ", $values) . ")";

        // Execute the query
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
}
?>
