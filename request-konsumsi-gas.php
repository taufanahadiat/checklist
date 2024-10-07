<?php
if (session_id() == '') {
    session_start();
}
require 'database.php';

// Check if $bulan is set
if (!isset($bulan)) {
    // If $bulan is not set, get the current month, name, and days in the current month
    $currentMonth = date('n');    // Get the current month number (1-12)
    $daysInMonth = date('t');     // Get the total days in the current month (28-31)
    $monthName = date('F Y');       // Get the full name of the current month (e.g., "October")
} else {
    // If $bulan is set, extract the month from the value in YYYY-MM format
    $currentMonth = date('n', strtotime($bulan));   // Extract the month from $bulan
    $daysInMonth = date('t', strtotime($bulan));    // Get the total days in the given month of $bulan
    $monthName = date('F Y', strtotime($bulan));      // Get the full name of the month from $bulan (e.g., "October")
}

$unit = $_GET['selectedUnit']; // Get the 'unit' parameter from the query string

date_default_timezone_set('Asia/Jakarta'); // Set timezone to Asia/Jakarta

$tanggal = date("Y-m-d"); // Today's date

$lines = array(
    '4&5-a',
    '4&5-b',
    '6',
    '7',
    '6&7-central',
    '8',
    'bopet-a',
    'bopet-b',
    'coating-a',
    'coating-b',
    'coating-c',
    'coating-d'
);

// Define the mapping of lines to database columns
$lineToColumnMap = array(
    '4&5-a' => 'bg45_a',
    '4&5-b' => 'bg45_b',
    '6' => 'bg6',
    '7' => 'bg7',
    '6&7-central' => 'bg67_central',
    '8' => 'bg8',
    'bopet-a' => 'bgpet_a',
    'bopet-b' => 'bgpet_b',
    'coating-a' => 'bgcc_a',
    'coating-b' => 'bgcc_b',
    'coating-c' => 'bgcc_c',
    'coating-d' => 'bgcc_d'
);

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

if (isset($_POST['synchronize'])) {

    foreach ($lines as $line) {
        for ($i = 1; $i <= $daysInMonth; $i++) {

            if (isset($bulan)) {
                $day = str_pad($i, 2, '0', STR_PAD_LEFT);
                $currentDate = "$bulan-$day";
            } else {
                $currentDate = date('Y-m-') . str_pad($i, 2, '0', STR_PAD_LEFT); // Format the day as 'YYYY-MM-DD'
            }

            // First, check if the date exists in the konsumsi_gas table
            $check_date_sql = "SELECT tanggal FROM konsumsi_gas WHERE tanggal = '$currentDate'";
            $check_date_result = mysqli_query($conn, $check_date_sql);
            
            if (mysqli_num_rows($check_date_result) === 0) {
                // The date does not exist, so insert a new row with just the date
                $insert_date_sql = "INSERT INTO konsumsi_gas (tanggal) VALUES ('$currentDate')";
                mysqli_query($conn, $insert_date_sql);
            }

            $sql = "SELECT 
                        COALESCE(counter_vol_7, counter_vol_6, counter_vol_5, counter_vol_4, counter_vol_3, 
                                 counter_vol_2, counter_vol_1, counter_vol_0, counter_vol_23, counter_vol_22, 
                                 counter_vol_21, counter_vol_20, counter_vol_19, counter_vol_18, counter_vol_17, 
                                 counter_vol_16, counter_vol_15, counter_vol_14, counter_vol_13, counter_vol_12, 
                                 counter_vol_11, counter_vol_10, counter_vol_9) AS vol_7,
                        COALESCE(counter_vol_8, counter_vol_9, counter_vol_10, counter_vol_11, counter_vol_12, 
                                 counter_vol_13, counter_vol_14, counter_vol_15, counter_vol_16, counter_vol_17, 
                                 counter_vol_18, counter_vol_19, counter_vol_20, counter_vol_21, counter_vol_22, 
                                 counter_vol_23, counter_vol_0, counter_vol_1, counter_vol_2, counter_vol_3, 
                                 counter_vol_4, counter_vol_5, counter_vol_6) AS vol_8
                    FROM boiler 
                    WHERE tanggal = '$currentDate' 
                    AND line = '$line'";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                $row = mysqli_fetch_assoc($result);
                $vol_7 = $row['vol_7'];
                $vol_8 = $row['vol_8'];

                // Calculate volume difference if values are not NULL
                if ($vol_7 !== NULL && $vol_8 !== NULL) {
                    $volume_diff = $vol_7 - $vol_8;

                    // Check if there is an existing record for the date
                    $check_sql = "SELECT * FROM konsumsi_gas WHERE tanggal = '$currentDate'";
                    $check_result = mysqli_query($conn, $check_sql);

                    // Initialize total for this date
                    if (!isset($totalPerDay[$currentDate])) {
                        $totalPerDay[$currentDate] = 0;
                    }

                    if (mysqli_num_rows($check_result) > 0) {
                        // Record exists, fetch the existing value
                        $existing_row = mysqli_fetch_assoc($check_result);
                        $existing_value = $existing_row[$lineToColumnMap[$line]]; // Get the current value of the column

                        // Check if the existing value ends with .1
                        if (substr((string)$existing_value, -2) !== '.1') {
                            // The existing value does not end with .1, perform an UPDATE
                            $update_sql = "UPDATE konsumsi_gas 
                                           SET {$lineToColumnMap[$line]} = {$volume_diff} 
                                           WHERE tanggal = '$currentDate'";
                            mysqli_query($conn, $update_sql);
                        }

                        // Use existing value for totalPerDay if it exists
                        $totalPerDay[$currentDate] += is_numeric($existing_value) ? $existing_value : 0; // Add only numeric values to total
                    } else {
                        // Record doesn't exist, perform an INSERT
                        $insert_sql = "INSERT INTO konsumsi_gas (tanggal, {$lineToColumnMap[$line]}) 
                                       VALUES ('$currentDate', {$volume_diff})";
                        mysqli_query($conn, $insert_sql);

                        // Add the volume_diff to totalPerDay if the record is newly created
                        $totalPerDay[$currentDate] += is_numeric($volume_diff) ? $volume_diff : 0; // Add only numeric values to total
                    }
                }
            } 
            if (!isset($totalPerDay[$currentDate])) {
                $totalPerDay[$currentDate] = 0;
            }
            $check_sql = "SELECT * FROM konsumsi_gas WHERE tanggal = '$currentDate'";
            $check_result = mysqli_query($conn, $check_sql);

            $existing_row = mysqli_fetch_assoc($check_result);
            $existing_value = $existing_row[$lineToColumnMap[$line]]; // Get the current value of the column
            $totalPerDay[$currentDate] += is_numeric($existing_value) ? $existing_value : 0; // Add only numeric values to total
        }
    }

    // After processing all lines, update total_pemakaian_m3, total_pemakaian_sm3, mmbtu, and selisih_sm3 for each day
    foreach ($totalPerDay as $date => $total) {
        // Calculate sm3 using the provided formula
        $sm3 = round($total * ((1.01325 + 2) / 1.01559) * (288.71 / (273.15 + 31)) * (1 + (0.0002 * 2)));

        // Calculate mmbtu based on sm3
        $mmbtu = round($sm3 / 27.4954);

        // Prepare to update total_pemakaian_m3, total_pemakaian_sm3, mmbtu
        $total_sql = "UPDATE konsumsi_gas 
                      SET total_pemakaian_m3 = $total, total_pemakaian_sm3 = $sm3, mmbtu = $mmbtu 
                      WHERE tanggal = '$date'";
        mysqli_query($conn, $total_sql);
    }

    // Handle data_harian_widar submissions
    if (isset($_POST['data_harian_widar'])) {
        foreach ($_POST['data_harian_widar'] as $date => $value) {
            if (!is_null($value) && $value !== '') {
                // Sanitize input to prevent SQL injection
                $sanitizedValue = mysqli_real_escape_string($conn, $value);
                    
                // Prepare the update SQL query for data_harian_widar
                $update_sql = "UPDATE konsumsi_gas SET data_harian_widar = '$sanitizedValue' WHERE tanggal = '$date'";
                mysqli_query($conn, $update_sql);
    
                // Get the total gas usage for that date
                if (isset($totalPerDay[$date])) {
                    $total = $totalPerDay[$date];
    
                    // Calculate sm3 using the provided formula
                    $sm3 = round($total * ((1.01325 + 2) / 1.01559) * (288.71 / (273.15 + 31)) * (1 + (0.0002 * 2)));
    
                    // Calculate selisih_sm3
                    $selisih_sm3 = $sanitizedValue - $sm3;
    
                    // Update selisih_sm3 in the database
                    $selisih_sql = "UPDATE konsumsi_gas SET selisih_sm3 = $selisih_sm3 WHERE tanggal = '$date'";
                    mysqli_query($conn, $selisih_sql);
                }
            }
        }
    } else{
        if (isset($totalPerDay[$currentDate])) {
            $total = $totalPerDay[$currentDate];

            // Calculate sm3 using the provided formula
            $sm3 = round($total * ((1.01325 + 2) / 1.01559) * (288.71 / (273.15 + 31)) * (1 + (0.0002 * 2)));

            // Calculate selisih_sm3
            $selisih_sm3 = $sanitizedValue - $sm3;
        }
    }

    if (isset($_POST['mmbtu_widar'])) {
        foreach ($_POST['mmbtu_widar'] as $date => $value) {
            if (!is_null($value) && $value !== '') {
                // Sanitize input to prevent SQL injection
                $sanitizedValue = mysqli_real_escape_string($conn, $value);
                    
                // Prepare the update SQL query for mmbtu_widar
                $update_sql = "UPDATE konsumsi_gas SET mmbtu_widar = '$sanitizedValue' WHERE tanggal = '$date'";
                mysqli_query($conn, $update_sql);
    
                // Get the total gas usage for that date
                if (isset($totalPerDay[$date])) {
                    $total = $totalPerDay[$date];
    
                    // Calculate sm3 using the provided formula
                    $sm3 = round($total * ((1.01325 + 2) / 1.01559) * (288.71 / (273.15 + 31)) * (1 + (0.0002 * 2)));
                    $mmbtu = round($sm3 / 27.4954);
    
                    // Calculate selisih_mmbtu
                    $selisih_mmbtu = $sanitizedValue - $mmbtu ;
    
                    // Update selisih_mmbtu in the database
                    $selisih_sql = "UPDATE konsumsi_gas SET selisih_mmbtu = $selisih_mmbtu WHERE tanggal = '$date'";
                    mysqli_query($conn, $selisih_sql);
                }
            }
        }
    }
    
    

    echo "<script>alert('Synchronization successful!'); window.location.href = window.location.href;</script>";
}
?>
