<?php
 date_default_timezone_set('Asia/Jakarta'); // Replace 'YOUR_TIMEZONE' with the appropriate timez
// Define the datasets and shifts
$datasets = array('compressor', 'air_dryer', 'air_receiver_tank');

$shifts = array(1, 2, 3);
$comp_line = array('4&5', '6&7');

// Initialize an array to hold the results
$results_data = array();

foreach ($datasets as $table) {
    foreach ($comp_line as $lines) {
        foreach ($shifts as $shift) {
            $sql = "SELECT * FROM $table WHERE tanggal LIKE '%{$tanggal}%' AND line LIKE '%{$lines}%' AND shift LIKE $shift";
            $result = mysqli_query($conn, $sql);

            if ($result === false) {
                echo mysqli_error($conn);
            } else {
                // Store the result in a structured array
                $results_data[$table][$lines][$shift] = mysqli_fetch_assoc($result);
            }
        }
    }
}

// Assign the results to specific variables

$article_comp45_1 = isset($results_data['compressor']['4&5'][1]) ? $results_data['compressor']['4&5'][1] : null;
$article_comp45_2 = isset($results_data['compressor']['4&5'][2]) ? $results_data['compressor']['4&5'][2] : null;
$article_comp45_3 = isset($results_data['compressor']['4&5'][3]) ? $results_data['compressor']['4&5'][3] : null;

$article_airDryer45_1 = isset($results_data['air_dryer']['4&5'][1]) ? $results_data['air_dryer']['4&5'][1] : null;
$article_airDryer45_2 = isset($results_data['air_dryer']['4&5'][2]) ? $results_data['air_dryer']['4&5'][2] : null;
$article_airDryer45_3 = isset($results_data['air_dryer']['4&5'][3]) ? $results_data['air_dryer']['4&5'][3] : null;

$article_airReceiver45_1 = isset($results_data['air_receiver_tank']['4&5'][1]) ? $results_data['air_receiver_tank']['4&5'][1] : null;
$article_airReceiver45_2 = isset($results_data['air_receiver_tank']['4&5'][2]) ? $results_data['air_receiver_tank']['4&5'][2] : null;
$article_airReceiver45_3 = isset($results_data['air_receiver_tank']['4&5'][3]) ? $results_data['air_receiver_tank']['4&5'][3] : null;

$article_comp67_1 = isset($results_data['compressor']['6&7'][1]) ? $results_data['compressor']['6&7'][1] : null;
$article_comp67_2 = isset($results_data['compressor']['6&7'][2]) ? $results_data['compressor']['6&7'][2] : null;
$article_comp67_3 = isset($results_data['compressor']['6&7'][3]) ? $results_data['compressor']['6&7'][3] : null;

$article_airDryer67_1 = isset($results_data['air_dryer']['6&7'][1]) ? $results_data['air_dryer']['6&7'][1] : null;
$article_airDryer67_2 = isset($results_data['air_dryer']['6&7'][2]) ? $results_data['air_dryer']['6&7'][2] : null;
$article_airDryer67_3 = isset($results_data['air_dryer']['6&7'][3]) ? $results_data['air_dryer']['6&7'][3] : null;

$article_airReceiver67_1 = isset($results_data['air_receiver_tank']['6&7'][1]) ? $results_data['air_receiver_tank']['6&7'][1] : null;
$article_airReceiver67_2 = isset($results_data['air_receiver_tank']['6&7'][2]) ? $results_data['air_receiver_tank']['6&7'][2] : null;
$article_airReceiver67_3 = isset($results_data['air_receiver_tank']['6&7'][3]) ? $results_data['air_receiver_tank']['6&7'][3] : null;



// Function to format the value
function formatValue($value) {
    if (is_numeric($value)) {
        // If the value is a float and has .00 as decimals, return it as an integer
        if (floor($value) == $value) {
            return number_format(intval($value));
        } else {
            // Return the value formatted with commas but preserving its decimal part
            return number_format($value, 2);
        }
    } else {
        // Otherwise, return the original value
        return $value;
    }
}

// Example usage:
$value = 10.00;
//echo formatValue($value); // Output: 10

$value = 10.50;
//echo formatValue($value); // Output: 10.5
?>
