<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require 'database.php'; // Database connection

// Sanitize input parameters
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : null;
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : null;
$area = isset($_GET['area']) ? $_GET['area'] : null;
$line = isset($_GET['line']) ? $_GET['line'] : null;

error_log("Received parameters: tanggal=$tanggal, area=$area");

// List of valid table names for safety
$tanggalTables = array('chiller_trane_67bopet', 'compressor', 'genset_man', 'boiler', 'trafo_daily_office');
$bulanTables = array('trafo_monthly', 'panel_lvdp3', 'capbank_lvdp3', 'crane');

$data = array(); // Initialize data as empty array

// Function to abbreviate names
function abbreviateName($name) {
    $words = explode(' ', $name);
    if (count($words) > 1) {
        // Abbreviate all words except the first one
        for ($i = 1; $i < count($words); $i++) {
            $words[$i] = strtoupper(substr($words[$i], 0, 1)) . '.'; // First letter of each word followed by a dot
        }
        return implode(' ', $words); // Join the words back together
    }
    return $name; // Return the original name if it's a single word
}

if ($tanggal && $area && in_array($area, $tanggalTables)) {
    $query = "SELECT * FROM `$area` WHERE tanggal = '$tanggal' LIMIT 1";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Check and abbreviate name fields before adding to data
            foreach ($row as $key => $value) {
                if (strpos($key, 'name') !== false && !empty($value)) { // Check if the field contains 'name'
                    $row[$key] = abbreviateName($value); // Abbreviate the name
                }
            }
            $data[] = $row;
        }
    }
} else if ($tanggal && ($area == 'crane_single_girder' || $area == 'crane_double_girder' || $area == 'crane_monorail' || $area == 'crane_cargo_lift')) {
    $query = "SELECT * FROM `$area` WHERE tanggal = '$tanggal' AND line = '$line' LIMIT 1";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Check and abbreviate name fields before adding to data
            foreach ($row as $key => $value) {
                if (strpos($key, 'name') !== false && !empty($value)) { // Check if the field contains 'name'
                    $row[$key] = abbreviateName($value); // Abbreviate the name
                }
            }
            $data[] = $row;
        }
    }
} else if ($bulan && $area && in_array($area, $bulanTables)) {
    $query = "SELECT * FROM `$area` WHERE bulan = '$bulan' LIMIT 1";
    $result = $conn->query($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            // Check and abbreviate name fields before adding to data
            foreach ($row as $key => $value) {
                if (strpos($key, 'name') !== false && !empty($value)) { // Check if the field contains 'name'
                    $row[$key] = abbreviateName($value); // Abbreviate the name
                }
            }
            $data[] = $row;
        }
    }
}

// If no data is found, return an explicit response
if (empty($data)) {
    echo json_encode(array('message' => 'Form tidak terisi'));
} else {
    echo json_encode($data);
}

$conn->close();
?>
