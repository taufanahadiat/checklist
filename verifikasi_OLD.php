<?php
include 'database.php';
if (session_id() == '') {
    session_start();
}

// Retrieve and sanitize form inputs
$tanggal = isset($_POST['tanggal']) ? mysqli_real_escape_string($conn, $_POST['tanggal']) : null;
$bulan = isset($_POST['bulan']) ? mysqli_real_escape_string($conn, $_POST['bulan']) : null;
$unit = mysqli_real_escape_string($conn, $_POST['unit']);
$unit2 = isset($_POST['unit2']) ? mysqli_real_escape_string($conn, $_POST['unit2']) : null;
$name = mysqli_real_escape_string($conn, $_POST['name']);
$time = mysqli_real_escape_string($conn, $_POST['time']);
//$submittedHashedPassword = isset($_POST['password']) ? mysqli_real_escape_string($conn, $_POST['password']) : '';

// Check if 'line' is set and sanitize if it exists
$line = isset($_POST['line']) ? mysqli_real_escape_string($conn, $_POST['line']) : null;
// Retrieve hashed password from session
//$sessionHashedPassword = $_SESSION['password'];

// Bypass password verification if session ID is 13107 or 1
//if ($_SESSION['id'] != 13107 && $_SESSION['id'] != 14201) {
//    // Verify the submitted password
//    if ($submittedHashedPassword !== $sessionHashedPassword) {
//        echo json_encode(array("status" => "error", "message" => "Incorrect password."));
//        mysqli_close($conn);
//        exit();
//    }
//}

// Check if the name already exists in verifikasi_name_1, verifikasi_name_2, or verifikasi_name_3
if ($line) {
    $nameCheckQuery = "SELECT verifikasi_name_1, verifikasi_name_2, verifikasi_name_3 
                       FROM `$unit` 
                       WHERE line = '$line' AND tanggal = '$tanggal' LIMIT 1";
} else if ($bulan) {
    $nameCheckQuery = "SELECT verifikasi_name_1, verifikasi_name_2, verifikasi_name_3 
                       FROM `$unit` 
                       WHERE bulan = '$bulan' LIMIT 1";
} else {
    $nameCheckQuery = "SELECT verifikasi_name_1, verifikasi_name_2, verifikasi_name_3 
                       FROM `$unit` 
                       WHERE tanggal = '$tanggal' LIMIT 1";
}

$nameCheckResult = mysqli_query($conn, $nameCheckQuery);

if (!$nameCheckResult) {
    echo json_encode(array("status" => "error", "message" => "Error: " . mysqli_error($conn)));
    exit();
}

if ($nameCheckResult && mysqli_num_rows($nameCheckResult) > 0) {
    $nameCheckRow = mysqli_fetch_assoc($nameCheckResult);
    if (in_array($name, $nameCheckRow)) {
        echo json_encode(array("status" => "already_verified", "message" => "Verifikasi gagal. Anda sudah cek pada form ini."));
        mysqli_close($conn);
        exit();
    }
}

// Proceed with the original verification query
if ($line) {
    $query = "SELECT verifikasi_1, verifikasi_2, verifikasi_3, verifikasi_4 FROM `$unit` WHERE line = '$line' AND tanggal = '$tanggal' LIMIT 1";
} else if($bulan){
    $query = "SELECT verifikasi_1, verifikasi_2, verifikasi_3, verifikasi_4 FROM `$unit` WHERE bulan = '$bulan' LIMIT 1";
} else {
    $query = "SELECT verifikasi_1, verifikasi_2, verifikasi_3, verifikasi_4 FROM `$unit` WHERE tanggal = '$tanggal' LIMIT 1";
}

$result = mysqli_query($conn, $query);

if (!$result) {
    // Error querying the database
    echo json_encode(array("status" => "error", "message" => "Error: " . mysqli_error($conn)));
    exit();
}

if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $isVerifiedArray = array($row['verifikasi_1'], $row['verifikasi_2'], $row['verifikasi_3'], $row['verifikasi_4']);
}

// If not verified, proceed to update
foreach ($isVerifiedArray as $index => $isVerified) {
    if (!$isVerified) {
        $indexPlusOne = $index + 1; 

        if ($bulan){
            $updateQuery = "UPDATE `$unit` 
            SET verifikasi_$indexPlusOne = TRUE, 
                verifikasi_name_$indexPlusOne = '$name', 
                verifikasi_time_$indexPlusOne = '$time' 
            WHERE bulan = '$bulan'";

        }else {
            $updateQuery = "UPDATE `$unit` 
            SET verifikasi_$indexPlusOne = TRUE, 
                verifikasi_name_$indexPlusOne = '$name', 
                verifikasi_time_$indexPlusOne = '$time' 
            WHERE tanggal = '$tanggal'";
        }
        
        if ($line) {
            $updateQuery .= " AND line = '$line'";
        }

        if (mysqli_query($conn, $updateQuery) && ($unit2 === null || mysqli_query($conn, $updateQuery2))) {
            echo json_encode(array("status" => "success", "message" => "Verifikasi berhasil"));
        } else {
            echo json_encode(array("status" => "error", "message" => "Error: " . mysqli_error($conn)));
        }

        break; // Exit the loop after the first successful update
    }
}


// Close the database connection
mysqli_close($conn);
?>
