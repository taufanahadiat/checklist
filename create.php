<?php
include 'database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (!empty($_POST['nama'])) {
    $nama = $_POST['nama'];
    if ($conn){
        $sql_insert = "INSERT INTO test_andro (nama) VALUES ('".$nama."')";
        $result_insert = mysqli_query($conn, $sql_insert);
        if ($result_insert) {
            echo "Success";
        } else {
            echo "Failed to insert data";
        }
    } else {
        echo "Failed to connect database";
    }
    mysqli_close($conn); 
}
}
?>
