<?php

$dbhost = "localhost";
$dbname = "checklistnew_24";
$dbuser = "root";
$dbpass = "akpidev3";

// Use require_once to prevent multiple inclusions
$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if (mysqli_connect_error()) {
    echo mysqli_connect_error();
    exit;
}
