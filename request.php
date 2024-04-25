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
        $columns = [];
        $values = [];

        foreach ($_POST as $key => $value) {
            $escaped_value = mysqli_real_escape_string($conn, $value);
            if (!empty($escaped_value)) {
                $columns[] = "`$key` = '$escaped_value'";
            }
        }

        if (empty($columns)) {
            echo "<script>alert('No valid fields to update.');</script>";
        } else {
            if ($existing_record === null) {
                // No existing record, perform an INSERT
                $sql_insert = "INSERT INTO $unit (tanggal, " . implode(", ", array_keys($_POST)) . ") 
                               VALUES (CURDATE(), " . implode(", ", array_map(function($value) use ($conn) {
                                    return "'" . mysqli_real_escape_string($conn, $value) . "'";
                                }, $_POST)) . ")";

                $result_insert = mysqli_query($conn, $sql_insert);

                if ($result_insert === false) {
                    echo "<script>alert('Error inserting new record: " . mysqli_error($conn) . "');</script>";
                } else {
                    echo "<script>alert('New record submitted successfully for date: $date');</script";
                }
            } else {
                // Existing record found, perform an UPDATE
                $sql_update = "UPDATE $unit SET " . implode(", ", $columns) . " WHERE tanggal = CURDATE()";

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
