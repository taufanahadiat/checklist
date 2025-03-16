<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
header('Content-Type: application/json');

require 'database.php'; // Database connection

// Sanitize input parameters
$tanggal = isset($_GET['tanggal']) ? $_GET['tanggal'] : null;
$bulan = isset($_GET['bulan']) ? $_GET['bulan'] : null;
$area = isset($_GET['area']) ? $_GET['area'] : null;

error_log("Received parameters: tanggal=$tanggal, area=$area");

// List of valid table names for safety
$tanggalTables = array('chiller', 'compressor', 'genset', 'boiler', 'trafo');
$bulanTables = array('trafo_pm', 'panel_lvdp', 'capbank_lvdp', 'crane');

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
    // Check if the area is 'trafo' and the tanggal is a Saturday or Sunday
    if ($area == 'trafo') {
        $dayOfWeek = date('N', strtotime($tanggal));
        if ($dayOfWeek == 6 || $dayOfWeek == 7) { // 6 = Saturday, 7 = Sunday
            echo json_encode(array('message' => 'off day'));
            exit;
        }
    }

    $query = "SELECT * FROM verifreport_daily WHERE area = '$area' AND tanggal = '$tanggal' LIMIT 1";
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
} else if ($bulan && ($area == 'crane_line4' || $area == 'crane_line5' || $area == 'crane_line6' || $area == 'crane_line7' || $area == 'crane_line8' || $area == 'crane_bopet' || $area == 'crane_metalize' || $area == 'crane_coating' || $area == 'crane_small_slitter')) {
    $query = "SELECT * FROM verifreport_monthly WHERE area = '$area' AND bulan = '$bulan' LIMIT 1";
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
    $query = "SELECT * FROM verifreport_monthly WHERE area = '$area' AND bulan = '$bulan' LIMIT 1";
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
    echo json_encode(array('message' => ''));
} else {
    echo json_encode($data);
}

$conn->close();
?>
