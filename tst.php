<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$dbname = 'checklistnew_24';

$mysqli = new mysqli('localhost', 'root','');

$sql = "SHOW TABLES FROM $dbname";
$result = $mysqli->query($sql);


while ($row = mysqli_fetch_row($result)) {
    echo "Table: {$row[0]}\n";
}

mysqli_free_result($result);
?>