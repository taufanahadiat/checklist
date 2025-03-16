<?php
header('Content-Type: application/json');
require 'database.php'; // Include your database connection

$line = isset($_GET['line']) ? mysqli_real_escape_string($conn, $_GET['line']) : '';
$field = isset($_GET['field']) ? mysqli_real_escape_string($conn, $_GET['field']) : '';
$times = array(
    "8.00", "9.00", "10.00", "11.00", "12.00", "13.00", "14.00",
    "15.00", "16.00", "17.00", "18.00", "19.00", "20.00", "21.00", "22.00",
    "23.00", "0.00", "1.00", "2.00", "3.00", "4.00", "5.00", "6.00", "7.00"
);

$query_plot = "SELECT * FROM boiler WHERE line LIKE '$line'";
$result_plot = mysqli_query($conn, $query_plot);

$data_plot = array();
if ($result_plot && $result_plot->num_rows > 0) {
    while ($row_plot = $result_plot->fetch_assoc()) {
        $tanggal_plot = $row_plot['tanggal'];
        $values_plot = array();

        // Ensure `$times` is defined and contains valid time strings
        if (isset($times) && is_array($times)) {
            foreach ($times as $time) {
                $hour = str_replace(".00", "", $time);
                $column_plot = $field . "_" . $hour; // Corrected concatenation without extra quotes
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
