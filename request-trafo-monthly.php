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

//Delete collumn if fields empty
$sql_drop = "SELECT * FROM trafo_monthly";
$result_drop = mysqli_query($conn, $sql_drop);

if (mysqli_num_rows($result_drop) > 0) {
    while ($row = mysqli_fetch_assoc($result_drop)) {
        $bulan = $row['bulan'];
        $trafo = $row['trafo'];

        $allNull = true;
        foreach ($row as $column => $value) {
            if (!in_array($column, array('tanggal', 'bulan', 'pic', 'time', 'trafo')) && $value !== null) {
                $allNull = false;
                break;
            }
        }

        if ($allNull) {
            $deleteSql = "DELETE FROM trafo_monthly WHERE bulan = '$bulan' AND trafo = '$trafo'";
            mysqli_query($conn, $deleteSql);
        }
    }
}  

$unit = $_GET['selectedUnit']; 
date_default_timezone_set('Asia/Jakarta'); 
$tanggal = date("Y-m-d");
$bulan = date("Y-m");

foreach ($trafoArray as $trafo) {
    $sql_exist = "SELECT * FROM $unit WHERE bulan = '$bulan' AND trafo = '$trafo'";
    
    $result_exist = mysqli_query($conn, $sql_exist);
    if (!$result_exist) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    $existing_record = mysqli_fetch_assoc($result_exist);
    ${"record_$trafo"} = $existing_record;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $trafo = mysqli_real_escape_string($conn, $_POST['trafo']); // Get trafo value from the hidden field

    $uploadDir = $_SERVER['DOCUMENT_ROOT'] . '/checklist/uploadTrafo/';
    // Process each file upload based on the input name
    foreach ($_FILES as $fieldName => $file) {
        if ($file['error'] === UPLOAD_ERR_OK) {
            // Retrieve the hidden key fields
            $file_key = isset($_POST['file_key_mv']) ? $_POST['file_key_mv'] : (isset($_POST['file_key_lv']) ? $_POST['file_key_lv'] : '');
            $date = date('Ym');

            // Determine if it's 'lv' or 'mv' based on field name
            $type = strpos($fieldName, 'lv') !== false ? 'lv' : 'mv';

            // Construct the filename and target path
            $newFileName = "{$date}_{$file_key}_{$type}." . pathinfo($file['name'], PATHINFO_EXTENSION);
            $targetPath = $uploadDir . $newFileName;

            if (move_uploaded_file($file['tmp_name'], $targetPath)) {
                // Set column name based on file type
                $columnName = ($type === 'lv') ? 'temp_img_kabel_lv' : 'temp_img_kabel_mv';
                
                // Prepare the value to insert/update
                $fileValue = "{$date}_{$file_key}_{$type}";

                // Insert or update the column in the $unit table
                $sql_upload = "INSERT INTO $unit (bulan, trafo, $columnName)
                        VALUES ('$bulan', '$trafo', '$fileValue')
                        ON DUPLICATE KEY UPDATE $columnName = '$fileValue'";

                if (mysqli_query($conn, $sql_upload)) {
                    echo "<script>alert('Data berhasil disimpan untuk $trafo dan gambar telah terupload');
                        window.location.href = window.location.href;
                        </script>";
                } else {
                    echo "<script>alert('Database update failed: " . mysqli_error($conn) . "');
                        window.location.href = window.location.href;
                        </script>";
                }
            } else {
                echo "<script>alert('Error saving file for $fieldName');
                    window.location.href = window.location.href;
                    </script>";
            }
        } elseif ($file['error'] != UPLOAD_ERR_NO_FILE) {
            echo "<script>alert('Error with file upload for $fieldName');
                window.location.href = window.location.href;
                </script>";
        }
        }

    // Check if there's an existing record for the determined date
    $sql_select = "SELECT * FROM $unit WHERE bulan = '$bulan' AND trafo LIKE '$trafo'";
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
            if ($key == 'trafo' || $key == 'file_key_mv' || $key == 'file_key_lv') {
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
                $sql_update = "UPDATE $unit SET " . implode(", ", $set_clause) . " WHERE bulan = '$bulan' AND trafo LIKE '$trafo'";
                $result_update = mysqli_query($conn, $sql_update);

                if ($result_update === false) {
                    echo "<script>alert('Error updating existing record: " . mysqli_error($conn) . "');</script>";
                } else {
                    echo "<script>alert('Existing record updated successfully for trafo: " . $trafo . " on date: " . $bulan . "');
                            window.location.href = window.location.href;
                            </script>";
                }
            } else {
                // No existing record found, perform an INSERT
                $columns_sql = implode(", ", $columns);
                $values_sql = implode(", ", $values);
                
                // Construct the INSERT query
                $sql_insert = "INSERT INTO $unit (bulan, trafo, $columns_sql) VALUES ('$bulan', '$trafo', $values_sql)";
                $result_insert = mysqli_query($conn, $sql_insert);

                if ($result_insert === false) {
                    echo "<script>alert('Error inserting new record: " . mysqli_error($conn) . "');</script>";
                } else {
                    echo "<script>alert('New record submitted successfully for trafo: " . $trafo . " on date: " . $bulan . "');
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
