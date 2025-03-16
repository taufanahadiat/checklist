<?php
 date_default_timezone_set('Asia/Jakarta'); // Replace 'YOUR_TIMEZONE' with the appropriate timez
// Define the datasets and shifts
$datasets = array(
    '67bopet' => array($t67bopet, $h67bopet),
    '45met34' => array($t45met34, $h45met34),
    'coat14met12' => array($tcoat14met12, $hcoat14met12)
);

$shifts = array(1, 2, 3);

// Initialize an array to hold the results
$results_data = array();

foreach ($datasets as $dataset_key => $tables) {
    foreach ($tables as $unit_key => $table) {
        $unit_name = $unit_key == 0 ? 'trane' : 'hitachi';
        foreach ($shifts as $shift) {
            $sql = "SELECT * FROM $table WHERE tanggal LIKE '%{$tanggal}%' AND shift LIKE $shift";
            $result = mysqli_query($conn, $sql);

            if ($result === false) {
                echo mysqli_error($conn);
            } else {
                // Store the result in a structured array
                $results_data[$dataset_key][$unit_name][$shift] = mysqli_fetch_assoc($result);
            }
        }
    }
}

// Assign the results to specific variables

// 67BOPET Trane
$article_67bopet_trane_1 = isset($results_data['67bopet']['trane'][1]) ? $results_data['67bopet']['trane'][1] : null;
$article_67bopet_trane_2 = isset($results_data['67bopet']['trane'][2]) ? $results_data['67bopet']['trane'][2] : null;
$article_67bopet_trane_3 = isset($results_data['67bopet']['trane'][3]) ? $results_data['67bopet']['trane'][3] : null;

// 67BOPET Hitachi
$article_67bopet_hitachi_1 = isset($results_data['67bopet']['hitachi'][1]) ? $results_data['67bopet']['hitachi'][1] : null;
$article_67bopet_hitachi_2 = isset($results_data['67bopet']['hitachi'][2]) ? $results_data['67bopet']['hitachi'][2] : null;
$article_67bopet_hitachi_3 = isset($results_data['67bopet']['hitachi'][3]) ? $results_data['67bopet']['hitachi'][3] : null;

// 45MET34 Trane
$article_45met34_trane_1 = isset($results_data['45met34']['trane'][1]) ? $results_data['45met34']['trane'][1] : null;
$article_45met34_trane_2 = isset($results_data['45met34']['trane'][2]) ? $results_data['45met34']['trane'][2] : null;
$article_45met34_trane_3 = isset($results_data['45met34']['trane'][3]) ? $results_data['45met34']['trane'][3] : null;

// 45MET34 Hitachi
$article_45met34_hitachi_1 = isset($results_data['45met34']['hitachi'][1]) ? $results_data['45met34']['hitachi'][1] : null;
$article_45met34_hitachi_2 = isset($results_data['45met34']['hitachi'][2]) ? $results_data['45met34']['hitachi'][2] : null;
$article_45met34_hitachi_3 = isset($results_data['45met34']['hitachi'][3]) ? $results_data['45met34']['hitachi'][3] : null;

// COAT14MET12 Trane
$article_coat14met12_trane_1 = isset($results_data['coat14met12']['trane'][1]) ? $results_data['coat14met12']['trane'][1] : null;
$article_coat14met12_trane_2 = isset($results_data['coat14met12']['trane'][2]) ? $results_data['coat14met12']['trane'][2] : null;
$article_coat14met12_trane_3 = isset($results_data['coat14met12']['trane'][3]) ? $results_data['coat14met12']['trane'][3] : null;

// COAT14MET12 Hitachi
$article_coat14met12_hitachi_1 = isset($results_data['coat14met12']['hitachi'][1]) ? $results_data['coat14met12']['hitachi'][1] : null;
$article_coat14met12_hitachi_2 = isset($results_data['coat14met12']['hitachi'][2]) ? $results_data['coat14met12']['hitachi'][2] : null;
$article_coat14met12_hitachi_3 = isset($results_data['coat14met12']['hitachi'][3]) ? $results_data['coat14met12']['hitachi'][3] : null;


// Example: Accessing the data for Trane unit, shift 1
// $article_trane_1

// Example: Accessing the data for Hitachi unit, shift 3
// $article_hitachi_3

// Function to format the value
function formatValue($value) {
    // Check if the value is a float and has .00 as decimals
    if (is_numeric($value) && floor($value) == $value) {
        return intval($value); // Return integer value
    } else {
        return $value; // Otherwise, return the original value
    }
}

// Example usage:
$value = 10.00;
//echo formatValue($value); // Output: 10

$value = 10.50;
//echo formatValue($value); // Output: 10.5
?>
