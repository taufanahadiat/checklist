<?php
header('Content-Type: application/json');
require 'database.php'; // Include your database connection

$shift = isset($_GET['shift']) ? mysqli_real_escape_string($conn, $_GET['shift']) : '';
$table = isset($_GET['table']) ? mysqli_real_escape_string($conn, $_GET['table']) : '';
$field = isset($_GET['field']) ? mysqli_real_escape_string($conn, $_GET['field']) : '';
$times = array("1", "2", "3");

$query_plot = "SELECT * FROM $table";
$result_plot = mysqli_query($conn, $query_plot);

$data_plot = array();
if ($result_plot && $result_plot->num_rows > 0) {
    while ($row_plot = $result_plot->fetch_assoc()) {
        $tanggal_plot = $row_plot['tanggal'];
        $values_plot = array();

        // Ensure `$times` is defined and contains valid time strings
        if (isset($times) && is_array($times)) {
            foreach ($times as $time) {
                $column_plot = $field; 
                $values_plot[] = isset($row_plot[$column_plot]) ? (float)$row_plot[$column_plot] : null;
            }
        }

        $data_plot[] = array(
            'tanggal' => $tanggal_plot,
            'values' => $values_plot
        );
    }
}

echo json_encode($data_plot);
?>
