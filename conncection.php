<?php

$dbhost = "localhost";
$dbname = "checklistnew_24";
$dbuser = "root";
$dbpass = "blank";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
}

$sql = "SELECT *
        FROM genset_wartsila_01
        ORDER BY tanggal";

$results = mysqli_query($conn, $sql);

if ($results === false) {
    echo mysqli_error($conn);
} else {
    $articles = mysqli_fetch_all($results, MYSQLI_ASSOC);

    var_dump($articles);
}
