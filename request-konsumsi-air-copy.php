<?php
if (session_id() == '') {
    session_start();
}
require 'database.php';
date_default_timezone_set('Asia/Jakarta');

$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string


$tanggal = date("Y-m-d"); // Today's date
$today = date('d');  // Get today's day (1-31)
if ($today >= 21) {
    $formBulan = date('Y-m', strtotime('+1 month'));  // Next month
} else {
    $formBulan = date('Y-m');  // Current month
}

$sql_previous = "SELECT * FROM $unit 
                 WHERE bulan = '$formBulan'
                 AND tanggal < CURDATE() 
                 ORDER BY id ASC";
$result_previous = mysqli_query($conn, $sql_previous);

if (!$result_previous) {
    die("Query failed: " . mysqli_error($conn));
}

// Calculate total days in the previous month
$first_day_of_current_month = new DateTime(date("Y-m-01"));
$last_day_of_previous_month = $first_day_of_current_month->modify('-1 day');
$total_days_previous_month = $last_day_of_previous_month->format('d'); // Get the day of the last day
// Use the determined date for the SELECT query

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get current date's records to check for changes
    $sql_select = "SELECT * FROM $unit WHERE tanggal = '$tanggal'";
    $result_select = mysqli_query($conn, $sql_select);

    if (!$result_select) {
        echo "Error: " . mysqli_error($conn);
    } else {
        // Check if there is an existing record for the determined date
        $existing_record = mysqli_fetch_assoc($result_select);

        // Determine the last id in the table for the previous date
        $last_id_query = "SELECT MAX(id) AS last_id FROM $unit WHERE tanggal < '$tanggal' AND bulan = '$formBulan'";
        $last_id_result = mysqli_query($conn, $last_id_query);
        $last_id_row = mysqli_fetch_assoc($last_id_result);
        
        // Set new id to last_id + 1 or default to 1 if no records
        $new_id = isset($last_id_row['last_id']) ? $last_id_row['last_id'] + 1 : 1;

        // Prepare to build the SQL query for INSERT or UPDATE
        $columns = array();
        $values = array();
        if ($today == 20){
            $columns_20 = array();
            $values_20 = array();
        }

        // Prepare to insert the new id only for new records
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

        if ($today == 20){
        // Prepare to insert the new id only for new records
        foreach ($_POST as $key_20 => $value_20) {
            $escaped_key_20 = mysqli_real_escape_string($conn, $key_20);
            $escaped_value_20 = mysqli_real_escape_string($conn, $value_20);

            // Check if the value is empty or just whitespace, and set it to NULL if so
            if ($escaped_value_20 === "" || ctype_space($escaped_value_20)) {
                $escaped_value_20 = "NULL";
            } else {
                $escaped_value_20 = "'" . $escaped_value_20 . "'";
            }

            // Store the escaped key and value
            array_push($columns_20, "`$escaped_key_20`");
            array_push($values_20, $escaped_value_20);
            
        }
        $columns_20[] = "`max_inlet_1`";
        $values_20[] = 0;
    
        $columns_20[] = "`max_inlet_2`";
        $values_20[] = 0;
    
        $columns_20[] = "`max_inlet_3`";
        $values_20[] = 0;
        }

        // Check if the ID is 1 and set max_dwp$i to the value of meter_dwp$i
        if ($new_id == 1) {
            for ($i = 1; $i <= 7; $i++) {
                if (isset($_POST["meter_dwp$i"])) {
                    // Set max_dwp$i to meter_dwp$i
                    $max_dwp_value = mysqli_real_escape_string($conn, $_POST["meter_dwp$i"]);
                    $max_dwp_value = $max_dwp_value === "" || ctype_space($max_dwp_value) ? "NULL" : "'" . $max_dwp_value . "'";
                    $columns[] = "`max_dwp$i`";
                    $values[] = $max_dwp_value;

                    $instruction_pantau = $max_dwp_value === "NULL" ? "NULL" : "'Pantau terus'";
                    $columns[] = "`instruction_dwp$i`";
                    $values[] =  $instruction_pantau;
        
                }
            }

        
            // Add max_inlet_1, max_inlet_2, and max_inlet_3 once after the loop
            $columns[] = "`max_inlet_1`";
            $values[] = 0;
        
            $columns[] = "`max_inlet_2`";
            $values[] = 0;
        
            $columns[] = "`max_inlet_3`";
            $values[] = 0;

        } else {
            // If new_id is not 1, fetch previous meter_dwp$i values
// Fetch previous meter_dwp$i values from the previous day
$previous_date = date("Y-m-d", strtotime($tanggal . " -1 day"));
$previous_record_query = "SELECT * FROM $unit WHERE tanggal = '$previous_date' AND bulan = '$formBulan'";
$previous_record_result = mysqli_query($conn, $previous_record_query);
$previous_record = mysqli_fetch_assoc($previous_record_result);

// Fetch meter_dwp$i values from two days ago
$two_days_ago = date("Y-m-d", strtotime($tanggal . " -2 days"));
$previous_record_two_days_query = "SELECT * FROM $unit WHERE tanggal = '$two_days_ago' AND bulan = '$formBulan'";
$previous_record_two_days_result = mysqli_query($conn, $previous_record_two_days_query);
$previous_record_two_days = mysqli_fetch_assoc($previous_record_two_days_result);

// Fetch the record for the previous date
$previous_data_id1_query = "SELECT id, volume_dwp1, volume_dwp2, volume_dwp3, volume_dwp4, volume_dwp5, volume_dwp6, volume_dwp7, volume_gudang7 FROM $unit WHERE tanggal = '$previous_date' AND bulan = '$formBulan'";
$previous_data_id1_result = mysqli_query($conn, $previous_data_id1_query);
$previous_data_id1 = mysqli_fetch_assoc($previous_data_id1_result);

// Calculate max_dwp$i using the formula
for ($i = 1; $i <= 7; $i++) {
    // Check if meter_dwp$i is set and not empty in POST data
    if (isset($_POST["meter_dwp$i"]) && !empty($_POST["meter_dwp$i"])) {
        if ($previous_record && isset($previous_record["meter_dwp$i"])) {
            // Previous day's meter_dwp$i value exists
            $previous_max_dwp_value = floatval($previous_record["max_dwp$i"]);
            $previous_meter_dwp_value = floatval($previous_record["meter_dwp$i"]);

            // Calculate max_dwp_value based on the value of $i
            if ($i == 1 || $i == 2 || $i == 4) {
                $max_dwp_value = (1560 / $total_days_previous_month) + $previous_max_dwp_value;
                $max_dwp_value = (1560 / $total_days_previous_month) + $previous_meter_dwp_value;
            } elseif ($i == 3) {
                $max_dwp_value = (1410 / $total_days_previous_month) + $previous_max_dwp_value;
                $max_dwp_value = (1410 / $total_days_previous_month) + $previous_meter_dwp_value;
            } elseif ($i == 5 || $i == 6 || $i == 7) {
                $max_dwp_value = (1920 / $total_days_previous_month) + $previous_max_dwp_value;
                $max_dwp_value = (1920 / $total_days_previous_month) + $previous_meter_dwp_value;
            }        

            $meter_dwp = $_POST["meter_dwp$i"];
            if ($meter_dwp === "" || ctype_space($meter_dwp)) {
                $instruction = "NULL";
            } else {
                    // Determine instruction_dwp$i value based on comparison
                    $instruction = ($meter_dwp > $max_dwp_value) ? "'Change over pompa'" : "'Pantau terus'";
            }

            // Store calculated max_dwp$i value
            $columns[] = "`max_dwp$i`";
            $values[] = "'" . $max_dwp_value . "'"; // Round to nearest integer

            // Add instruction_dwp$i to the columns and values
            $columns[] = "`instruction_dwp$i`";
            $values[] = $instruction;
            
            // Calculate volume_dwp$i
            $volume_dwp_value = floatval($_POST["meter_dwp$i"]) - $previous_meter_dwp_value;
            $previous_record["volume_dwp$i"] = $volume_dwp_value; // Update volume_dwp$i
            $update_volume_clause[] = "`volume_dwp$i` = '" . $previous_record["volume_dwp$i"] . "'";

            if ($previous_data_id1) {
                $previous_data_id1_id = intval($previous_data_id1['id']);

                if ($previous_data_id1_id === 1) {
                    // If id = 1, set kumulatif_dwp$i equal to volume_dwp$i
                    $update_kumulatif_clause[] = "`kumulatif_dwp$i` = `volume_dwp$i`";
                }else{
                // Calculate kumulatif_dwp$i using values from two days ago
                if ($previous_record_two_days && isset($previous_record_two_days["kumulatif_dwp$i"])) {
                    $previous_kumulatif_dwp_value_two_days = floatval($previous_record_two_days["kumulatif_dwp$i"]);
                    $kumulatif_dwp_value = (floatval($_POST["meter_dwp$i"]) - $previous_meter_dwp_value) + $previous_kumulatif_dwp_value_two_days;
                    $update_kumulatif_clause[] = "`kumulatif_dwp$i` = '" . $kumulatif_dwp_value . "'";
                } else {
                    // If no previous record two days ago, set kumulatif_dwp$i to NULL
                    $update_kumulatif_clause[] = "`kumulatif_dwp$i` = NULL";
                    }
                }
            }
        } else {
            // If no previous record, set max_dwp$i and volume_dwp$i to NULL
            $columns[] = "`max_dwp$i`";
            $values[] = "NULL";

            $columns[] = "`instruction_dwp$i`";
            $values[] = "NULL";

            $update_volume_clause[] = "`volume_dwp$i` = NULL";
            $update_kumulatif_clause[] = "`kumulatif_dwp$i` = NULL";    
        }
        
        if ($today == 20){

            $columns_20[] = "`max_dwp$i`";
            $values_20[] = "'" . $meter_dwp . "'"; // Round to nearest integer

            // Add instruction_dwp$i to the columns and values
            $columns_20[] = "`instruction_dwp$i`";
            $values_20[] = "'Pantau terus'";
        }
    } else {
        // If meter_dwp$i is not set or empty, set max_dwp$i, volume_dwp$i, and kumulatif_dwp$i to NULL
        $columns[] = "`max_dwp$i`";
        $values[] = "NULL";

        $columns[] = "`instruction_dwp$i`";
        $values[] = "NULL";
    }
}

if (isset($_POST["meter_gudang7"]) && !empty($_POST["meter_gudang7"])) {
    if ($today == 20){
        $columns_20[] = "meter_gudang7";
        $values_20[] = "'" . $_POST["meter_gudang7"] . "'"; 
    }
    if ($previous_record && isset($previous_record["meter_gudang7"])) {
        // Previous day's meter_gudang7 value exists
        $previous_meter_gudang_value = floatval($previous_record["meter_gudang7"]);

            // Calculate volume_gudang7
            $volume_gudang_value = floatval($_POST["meter_gudang7"]) - $previous_meter_gudang_value;
            $previous_record["volume_gudang7"] = $volume_gudang_value; // Update volume_gudang7
            $update_volume_gudang_clause[] = "`volume_gudang7` = '" . $previous_record["volume_gudang7"] . "'";

            if ($previous_data_id1) {
                $previous_data_id1_id = intval($previous_data_id1['id']);
            
            
            if ($previous_data_id1_id === 1) {
                // If id = 1, set kumulatif_gudang7 equal to volume_gudang7
                $update_kumulatif_gudang_clause[] = "`kumulatif_gudang7` = `volume_gudang7`";
            }else{
            // Calculate kumulatif_gudang7 using values from two days ago
            if ($previous_record_two_days && isset($previous_record_two_days["kumulatif_gudang7"])) {
                $previous_meter_gudang_value = floatval($previous_record["meter_gudang7"]);
                $previous_kumulatif_gudang_value_two_days = floatval($previous_record_two_days["kumulatif_gudang7"]);
                $kumulatif_gudang_value = (floatval($_POST["meter_gudang7"]) - $previous_meter_gudang_value) + $previous_kumulatif_gudang_value_two_days;
                $update_kumulatif_gudang_clause[] = "`kumulatif_gudang7` = '" . $kumulatif_gudang_value . "'";
            } else {
                // If no previous record two days ago, set kumulatif_gudang7 to NULL
                $update_kumulatif_gudang_clause[] = "`kumulatif_gudang7` = NULL";
                }
            }
            } 
        } else {
            $update_volume_gudang_clause[] = "`volume_gudang7` = NULL";
            $update_kumulatif_gudang_clause[] = "`kumulatif_gudang7` = NULL";    
        }
    }

$outlet_fields = array(
    'bopet',
    'chbopet',
    'cooltow_bopet',
    'line48',
    'ch458',
    'cooltow45',
    'cooltow8',
    'office',
    'argha_water',
    'cooltow_met34',
    'cooltow_met12',
    'bg48',
    'waterbath8',
    'waterbath45',
    'waterbath67',
    'cooltow67',
    'cooltow6',
    'cooltow7',
    'hydrant48',
    'hydrant67',
    'line67'
);
$parameter = array(
    'count',
    'volume',
    'kumulatif'
);

foreach($outlet_fields as $field){
    if (isset($_POST["count_$field"]) && !empty($_POST["count_$field"])) {
        if ($today == 20){
            $columns_20[] = "count_$field";
            $values_20[] = "'" . $_POST["count_$field"] . "'"; 
        }

        if ($previous_record && isset($previous_record["count_$field"])) {
            // Previous day's count_$field value exists
            $previous_meter_outlet_value = floatval($previous_record["count_$field"]);
    
                // Calculate volume_$field
                $volume_outlet_value = floatval($_POST["count_$field"]) - $previous_meter_outlet_value;
                $previous_record["volume_$field"] = $volume_outlet_value; // Update volume_$field
                $update_volume_outlet_clause[] = "`volume_$field` = '" . $previous_record["volume_$field"] . "'";
    
                if ($previous_data_id1) {
                    $previous_data_id1_id = intval($previous_data_id1['id']);
                
                
                if ($previous_data_id1_id === 1) {
                    // If id = 1, set kumulatif_$field equal to volume_$field
                    $update_kumulatif_outlet_clause[] = "`kumulatif_$field` = `volume_$field`";
                }else{
                // Calculate kumulatif_$field using values from two days ago
                if ($previous_record_two_days && isset($previous_record_two_days["kumulatif_$field"])) {
                    $previous_meter_outlet_value = floatval($previous_record["count_$field"]);
                    $previous_kumulatif_outlet_value_two_days = floatval($previous_record_two_days["kumulatif_$field"]);
                    $kumulatif_outlet_value = (floatval($_POST["count_$field"]) - $previous_meter_outlet_value) + $previous_kumulatif_outlet_value_two_days;
                    $update_kumulatif_outlet_clause[] = "`kumulatif_$field` = '" . $kumulatif_outlet_value . "'";
                } else {
                    // If no previous record two days ago, set kumulatif_$field to NULL
                    $update_kumulatif_outlet_clause[] = "`kumulatif_$field` = NULL";
                    }
                }
                } 
            } else {
                $update_volume_outlet_clause[] = "`volume_$field` = NULL";
                $update_kumulatif_outlet_clause[] = "`kumulatif_$field` = NULL";    
            }
    }
}



// Update volume_dwp$i in the previous day's record
if (isset($update_volume_clause)) {
    $update_volume_query = "UPDATE $unit SET " . implode(", ", $update_volume_clause) . " WHERE tanggal = '$previous_date'";
    $result_update_volume = mysqli_query($conn, $update_volume_query);

    if ($result_update_volume === false) {
        echo "<script>alert('Error updating previous record with volume: " . mysqli_error($conn) . "');</script>";
    }
}
if (isset($update_volume_gudang_clause)) {
    $update_volume_gudang_query = "UPDATE $unit SET " . implode(", ", $update_volume_gudang_clause) . " WHERE tanggal = '$previous_date'";
    $result_update_volume_gudang = mysqli_query($conn, $update_volume_gudang_query);

    if ($result_update_volume_gudang === false) {
        echo "<script>alert('Error updating previous record with volume: " . mysqli_error($conn) . "');</script>";
    }
}
if (isset($update_volume_outlet_clause)) {
    $update_volume_outlet_query = "UPDATE $unit SET " . implode(", ", $update_volume_outlet_clause) . " WHERE tanggal = '$previous_date'";
    $result_update_volume_outlet = mysqli_query($conn, $update_volume_outlet_query);

    if ($result_update_volume_outlet === false) {
        echo "<script>alert('Error updating previous record with volume: " . mysqli_error($conn) . "');</script>";
    }
}

// Update kumulatif_dwp$i in the previous day's record
if (isset($update_kumulatif_clause)) {
    $update_kumulatif_query = "UPDATE $unit SET " . implode(", ", $update_kumulatif_clause) . " WHERE tanggal = '$previous_date'";
    $result_update_kumulatif = mysqli_query($conn, $update_kumulatif_query);

    if ($result_update_kumulatif === false) {
        echo "<script>alert('Error updating previous record with kumulatif_dwp: " . mysqli_error($conn) . "');</script>";
    }
}
if (isset($update_kumulatif_gudang_clause)) {
    $update_kumulatif_gudang_query = "UPDATE $unit SET " . implode(", ", $update_kumulatif_gudang_clause) . " WHERE tanggal = '$previous_date'";
    $result_update_kumulatif_gudang = mysqli_query($conn, $update_kumulatif_gudang_query);

    if ($result_update_kumulatif_gudang === false) {
        echo "<script>alert('Error updating previous record with kumulatif_gudang_dwp: " . mysqli_error($conn) . "');</script>";
    }
}
if (isset($update_kumulatif_outlet_clause)) {
    $update_kumulatif_outlet_query = "UPDATE $unit SET " . implode(", ", $update_kumulatif_outlet_clause) . " WHERE tanggal = '$previous_date'";
    $result_update_kumulatif_outlet = mysqli_query($conn, $update_kumulatif_outlet_query);

    if ($result_update_kumulatif_outlet === false) {
        echo "<script>alert('Error updating previous record with kumulatif outlet: " . mysqli_error($conn) . "');</script>";
    }
}
        // Fetch the record for the previous date
        $previous_maxinlet_query = "SELECT max_inlet_1, max_inlet_2, max_inlet_3 FROM $unit WHERE tanggal = '$previous_date'";
        $previous_maxinlet_result = mysqli_query($conn, $previous_maxinlet_query);
        $previous_maxinlet = mysqli_fetch_assoc($previous_maxinlet_result);
        
        // Calculate max_inlet_1, max_inlet_2, and max_inlet_3 based on the previous record
        $max_inlet_1 = (1400 / $total_days_previous_month) + floatval($previous_maxinlet['max_inlet_1']);
        $max_inlet_2 = (1500 / $total_days_previous_month) + floatval($previous_maxinlet['max_inlet_2']);
        $max_inlet_3 = (1900 / $total_days_previous_month) + floatval($previous_maxinlet['max_inlet_3']);
        
    
        // Store max_inlet_1, max_inlet_2, and max_inlet_3 in the columns and values for SQL queries
        $columns[] = "`max_inlet_1`";
        $values[] = "'" . $max_inlet_1 . "'"; // Round to nearest integer
    
        $columns[] = "`max_inlet_2`";
        $values[] = "'" . $max_inlet_2 . "'"; // Round to nearest integer
    
        $columns[] = "`max_inlet_3`";
        $values[] = "'" . $max_inlet_3 . "'"; // Round to nearest integer

        }
        

        if (empty($columns)) {
            echo "<script>alert('No valid fields to update.');</script>";
        } else {
            if ($existing_record) {
                // Get next month in 'Y-m' format
                $next_month = date('Y-m', strtotime('+1 month'));
                // Existing record found, perform an UPDATE
                $set_clause = array();
                $set_clause_20 = array();

                for ($i = 0; $i < count($columns); $i++) {
                    if ($values[$i] === "NULL") {
                        continue;
                    } else {
                        array_push($set_clause, $columns[$i] . " = " . $values[$i]);
                    }
                }
                    if ($today == 20) {
                        for ($i = 0; $i < count($columns_20); $i++) {
                            if ($values_20[$i] === "NULL") {
                                continue;
                            } else {
                            array_push($set_clause_20, $columns_20[$i] . " = " . $values_20[$i]);
                            }
                        }
                    }
                

                if ($today == 20) {
                    // Construct and execute the insert query for the next month
                    $sql_update_20 = "UPDATE $unit SET " . implode(", ", $set_clause_20) . " WHERE tanggal = '$tanggal' AND bulan = '$next_month'";
                    $result_update_20 = mysqli_query($conn, $sql_update_20);
                
                    // Error handling for the second query
                    if ($result_update_20 === false) {
                        echo "<script>alert('Error inserting second record for next month: " . mysqli_error($conn) . "');</script>";
                    }
                }

                // Construct the UPDATE query (id is not updated)
                $sql_update = "UPDATE $unit SET " . implode(", ", $set_clause) . " WHERE tanggal = '$tanggal' AND bulan = '$formBulan'";
                $result_update = mysqli_query($conn, $sql_update);

                if ($result_update === false) {
                    echo "<script>alert('Error updating existing record: " . mysqli_error($conn) . "');</script>";
                } else {
                    echo "<script>alert('Existing record updated successfully for date: " . $tanggal . "');
                        window.location.href = window.location.href;
                            </script>";
                }
            } else {
                // Get next month in 'Y-m' format
                $next_month = date('Y-m', strtotime('+1 month'));
                // No existing record found, perform an INSERT
                $columns_sql = implode(", ", $columns);
                $values_sql = implode(", ", $values);
                                
                // Construct the INSERT query with new id
                $sql_insert = "INSERT INTO $unit (tanggal, bulan, id, $columns_sql) VALUES ('$tanggal', '$formBulan', $new_id, $values_sql)";
                $result_insert = mysqli_query($conn, $sql_insert);
                
                // Check if today is the 20th
                if ($today == 20) {
                    $columns_sql_20 = implode(", ", $columns_20);
                    $values_sql_20 = implode(", ", $values_20);
    
                    // Construct and execute the insert query for the next month
                    $sql_insert_20 = "INSERT INTO $unit (tanggal, bulan, id, $columns_sql_20) VALUES ('$tanggal', '$next_month', 1, $values_sql_20)";
                    $result_insert_20 = mysqli_query($conn, $sql_insert_20);
                
                    // Error handling for the second query
                    if ($result_insert_20 === false) {
                        echo "<script>alert('Error inserting second record for next month: " . mysqli_error($conn) . "');</script>";
                    }
                }
                
                // Error handling for the first query
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
