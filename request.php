<?php
if (session_id() == '') {
    session_start();
}
require 'database.php';
if (isset($_SESSION['name_user'])) {
    $name_user = $_SESSION['name_user']; // Access session variable
}

$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string

date_default_timezone_set('Asia/Jakarta'); // Set timezone to Asia/Jakarta

// Determine if the current time is between 00:00-06:00
$currentHour = (int) date('H');
if ($currentHour >= 0 && $currentHour < 8) {
    $tanggal = date("Y-m-d", strtotime("-1 day")); // Yesterday's date
} else {
    $tanggal = date("Y-m-d"); // Today's date
}

// Use the determined date for the SELECT query
$sql = "SELECT *
        FROM $unit
        WHERE tanggal LIKE '%{$tanggal}%'";

$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $article = mysqli_fetch_assoc($results);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if there's an existing record for the determined date
    $sql_select = "SELECT * FROM $unit WHERE tanggal = '$tanggal'";
    $result_select = mysqli_query($conn, $sql_select);

    if (!$result_select) {
        echo "Error: " . mysqli_error($conn);
    } else {
        // Check if there is an existing record for the determined date
        $existing_record = mysqli_fetch_assoc($result_select);

        // Prepare to build the SQL query for INSERT or UPDATE
        $columns = array();
        $values = array();

        // Arrays to track which pic and time columns should be updated
        $pic_updates = array();
        $time_updates = array();

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

            // Check if the key corresponds to a pic column
            // Check if the key matches the excluded patterns
            if (preg_match('/(_8_14|_16_22|_0_6)$/', $key)) {
                continue; // Skip this key
            }
        
            // Extract the last one or two numeric characters from the key
            preg_match('/(\d{1,2})$/', $key, $matches);
            $last_num = isset($matches[1]) ? $matches[1] : '';
        
            // Check if the last numeric characters are valid pic and time columns
            $pic_column = "pic_" . $last_num;
            $time_column = "time_" . $last_num;
        
            if (in_array($pic_column, array('pic_0', 'pic_2', 'pic_4', 'pic_6', 'pic_8', 'pic_10', 'pic_12', 'pic_14', 'pic_16', 'pic_18', 'pic_20', 'pic_22')) && !empty($value)) {
                $pic_updates[$pic_column] = mysqli_real_escape_string($conn, $name_user);
            }
        
            if (in_array($time_column, array('time_0', 'time_2', 'time_4', 'time_6', 'time_8', 'time_10', 'time_12', 'time_14', 'time_16', 'time_18', 'time_20', 'time_22')) && !empty($value)) {
                $current_time = date('d/m/Y H:i'); // Current timestamp in dd/mm/yyyy hh:mm format
                $time_updates[$time_column] = mysqli_real_escape_string($conn, $current_time);
            }
        }

        if (empty($columns)) {
            echo "<script>alert('No valid fields to update.');</script>";
        } else {
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

                // Add the pic and time updates to the set clause
                foreach ($pic_updates as $pic_column => $pic_value) {
                    $set_clause[] = "$pic_column = '$pic_value'";
                }
                foreach ($time_updates as $time_column => $time_value) {
                    $set_clause[] = "$time_column = '$time_value'";
                }

                // Construct the UPDATE query
                $sql_update = "UPDATE $unit SET " . implode(", ", $set_clause) . " WHERE tanggal = '$tanggal'";
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
                foreach ($pic_updates as $pic_column => $pic_value) {
                    $columns[] = "`$pic_column`";
                    $values[] = "'$pic_value'";
                }
                foreach ($time_updates as $time_column => $time_value) {
                    $columns[] = "`$time_column`";
                    $values[] = "'$time_value'";
                }

                $columns_sql = implode(", ", $columns);
                $values_sql = implode(", ", $values);

                // Construct the INSERT query
                $sql_insert = "INSERT INTO $unit (tanggal, $columns_sql) VALUES ('$tanggal', $values_sql)";
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
