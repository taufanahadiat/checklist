<?php
 date_default_timezone_set('Asia/Jakarta'); // Replace 'YOUR_TIMEZONE' with the appropriate timez
// Define the datasets and shifts
$datasets = array(
                'hfo_unloading_pump_unit', 'fuel_transfer_pump_unit', 'genset_wartsila_01', 'genset_wartsila_02', 
                'genset_man', 'common_unit', 'fuel_booster', 'heater_oil','fuel_oil_feeder', 'kebocoran_fuel_tank',
                'hfo_separator_pump_unit', 'lfo_unloading_pump_unit'
            );

// Initialize an array to hold the results
$results_data = array();

foreach ($datasets as $table) {
            $sql = "SELECT * FROM $table WHERE tanggal LIKE '%{$tanggal}%'";
            $result = mysqli_query($conn, $sql);

            if ($result === false) {
                echo mysqli_error($conn);
            } else {
                // Store the result in a structured array
                $results_data[$table] = mysqli_fetch_assoc($result);
            }
}

// Assign the results to specific variables

$article_hfoUnload = isset($results_data['hfo_unloading_pump_unit']) ? $results_data['hfo_unloading_pump_unit'] : null;
$article_fuel = isset($results_data['fuel_transfer_pump_unit']) ? $results_data['fuel_transfer_pump_unit'] : null;
$article_gensetWartsila01 = isset($results_data['genset_wartsila_01']) ? $results_data['genset_wartsila_01'] : null;
$article_gensetWartsila02 = isset($results_data['genset_wartsila_02']) ? $results_data['genset_wartsila_02'] : null;
$article_gensetMan = isset($results_data['genset_man']) ? $results_data['genset_man'] : null;
$article_commonUnit = isset($results_data['common_unit']) ? $results_data['common_unit'] : null;
$article_fuelBooster = isset($results_data['fuel_booster']) ? $results_data['fuel_booster'] : null;
$article_heaterOil = isset($results_data['heater_oil']) ? $results_data['heater_oil'] : null;
$article_fuelOil = isset($results_data['fuel_oil_feeder']) ? $results_data['fuel_oil_feeder'] : null;
$article_kebocoranFuel = isset($results_data['kebocoran_fuel_tank']) ? $results_data['kebocoran_fuel_tank'] : null;
$article_hfoSeparator = isset($results_data['hfo_separator_pump_unit']) ? $results_data['hfo_separator_pump_unit'] : null;
$article_lfoUnloading = isset($results_data['lfo_unloading_pump_unit']) ? $results_data['lfo_unloading_pump_unit'] : null;


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
