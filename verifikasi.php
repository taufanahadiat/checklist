<?php
include 'database.php';
if (session_id() == '') {
    session_start();
}

// Retrieve and sanitize form inputs
$tanggal = isset($_POST['tanggal']) ? mysqli_real_escape_string($conn, $_POST['tanggal']) : null;
$bulan = isset($_POST['bulan']) ? mysqli_real_escape_string($conn, $_POST['bulan']) : null;
$table = mysqli_real_escape_string($conn, $_POST['table']);
$area = mysqli_real_escape_string($conn, $_POST['area']);
$name = mysqli_real_escape_string($conn, $_POST['name']);
$time = mysqli_real_escape_string($conn, $_POST['time']);

// Check if the name already exists in verifikasi_name_1, verifikasi_name_2, or verifikasi_name_3
if ($bulan) {
    $nameCheckQuery = "SELECT verifikasi_name_1, verifikasi_name_2, verifikasi_name_3 
                       FROM `$table` 
                       WHERE bulan = '$bulan' AND area = '$area' LIMIT 1";
} else {
    $nameCheckQuery = "SELECT verifikasi_name_1, verifikasi_name_2, verifikasi_name_3 
                       FROM `$table` 
                       WHERE tanggal = '$tanggal' AND area = '$area' LIMIT 1";
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
if($bulan){
    $query = "SELECT verifikasi_1, verifikasi_2, verifikasi_3, verifikasi_4 FROM `$table` WHERE bulan = '$bulan' AND area = '$area' LIMIT 1";
} else {
    $query = "SELECT verifikasi_1, verifikasi_2, verifikasi_3, verifikasi_4 FROM `$table` WHERE tanggal = '$tanggal' AND area = '$area' LIMIT 1";
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
} else {
    // No recent data, insert a new row
    if ($bulan) {
        $insertQuery = "INSERT INTO `$table` (bulan, area, verifikasi_1, verifikasi_name_1, verifikasi_time_1) 
                        VALUES ('$bulan', '$area', TRUE, '$name', '$time')";
    } else {
        $insertQuery = "INSERT INTO `$table` (tanggal, area, verifikasi_1, verifikasi_name_1, verifikasi_time_1) 
                        VALUES ('$tanggal', '$area', TRUE, '$name', '$time')";
    }

    if (mysqli_query($conn, $insertQuery)) {
        echo json_encode(array("status" => "success", "message" => "Verifikasi berhasil"));
    } else {
        echo json_encode(array("status" => "error", "message" => "Error: " . mysqli_error($conn)));
    }

    // Close the database connection
    mysqli_close($conn);
    exit();
}

// If not verified, proceed to update
foreach ($isVerifiedArray as $index => $isVerified) {
    if (!$isVerified) {
        $indexPlusOne = $index + 1; 

        if ($bulan){
            $updateQuery = "UPDATE `$table` 
            SET verifikasi_$indexPlusOne = TRUE, 
                verifikasi_name_$indexPlusOne = '$name', 
                verifikasi_time_$indexPlusOne = '$time' 
            WHERE bulan = '$bulan' AND area = '$area'";

        }else {
            $updateQuery = "UPDATE `$table` 
            SET verifikasi_$indexPlusOne = TRUE, 
                verifikasi_name_$indexPlusOne = '$name', 
                verifikasi_time_$indexPlusOne = '$time' 
            WHERE tanggal = '$tanggal' AND area = '$area'";
        }

        if (mysqli_query($conn, $updateQuery)) {
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