<?php
require '../database.php'; // Include database connection

$verifiers = [
    "Guruh Juniawan"   => ["daily_areas" => ["chiller", "compressor", "genset"], "monthly_areas" => [], "email" => "be14almighty@gmail.com"],
    "Arya Bima Putra"  => ["daily_areas" => ["boiler"], "monthly_areas" => [], "email" => "ivan_top@yahoo.com"],
    "Nano Hartono"     => ["daily_areas" => ["trafo"], "monthly_areas" => ["trafo_pm", "capbank_lvdp", "panel_lvdp"], "email" => "ivan_top1@yahoo.com"],
    "Syamsul Pandiangan" => ["daily_areas" => ["boiler"], "monthly_areas" => ["crane"], "email" => "ivan_top3@yahoo.com"],
    "Hermansyah"       => ["daily_areas" => ["chiller", "compressor", "genset", "trafo"], "monthly_areas" => ["trafo_pm", "capbank_lvdp", "panel_lvdp"], "email" => "taufanahadiat@gmail.com"],
    "Teiffur Zaman"  => ["daily_areas" => [], "monthly_areas" => ["crane"], "email" => "ivan_top86@yahoo.com"]
];

$checklistForms = [
    "chiller"     => ["name" => "Chiller", "table" => "chiller_trane_67bopet, chiller_trane_45met34, chiller_trane_coat14met12, chiller_hitachi_45met34, chiller_hitachi_67bopet, chiller_hitachi_coat14met12"],
    "compressor"  => ["name" => "Compressor", "table" => "compressor, air_dryer, air_receiver_tank"],
    "genset"      => ["name" => "Genset", "table" => "common_unit, fuel_booster, fuel_oil_feeder, fuel_transfer_pump_unit, genset_man, genset_wartsila_01, genset_wartsila_02, heater_oil, hfo_separator_pump_unit, hfo_unloading_pump_unit, kebocoran_fuel_tank"],
    "boiler"      => ["name" => "Boiler", "table" => "boiler"],
    "trafo"       => ["name" => "Pengamanan Trafo (Daily)", "table" => "trafo_daily_bopet, trafo_daily_coating, trafo_daily_line4, trafo_daily_line5, trafo_daily_line6, trafo_daily_line7, trafo_daily_line8, trafo_daily_met2, trafo_daily_met34, trafo_daily_office"],
    "trafo_pm"    => ["name" => "PM Transformator (Monthly)", "table" => ""],
    "capbank_lvdp"  => ["name" => "Capacitor Bank", "table" => ""],
    "panel_lvdp"    => ["name" => "Panel LVDP", "table" => ""],
    "crane_line4"   => ["name" => "Crane Line 4", "table" => ""],
    "crane_line5"   => ["name" => "Crane Line 5", "table" => ""],
    "crane_line6"   => ["name" => "Crane Line 6", "table" => ""],
    "crane_line7"   => ["name" => "Crane Line 7", "table" => ""],
    "crane_line8"   => ["name" => "Crane Line 8", "table" => ""],
    "crane_bopet"   => ["name" => "Crane BOPET", "table" => ""],
    "crane_metalize"=> ["name" => "Crane Metalize", "table" => ""],
    "crane_coating" => ["name" => "Crane Coating", "table" => ""],
    "crane_small_slitter" => ["name" => "Crane Small Slitter", "table" => ""]
];

$missingRecords = [];

$today = date('Y-m-d');
$sevenDaysAgo = date('Y-m-d', strtotime('-7 days', strtotime($today)));
$startDate = '2025-03-03';
$startMonth = '2025-03';

// Daily Report Checker
$sql = "SELECT area, tanggal, verifikasi_name_1, verifikasi_name_2, verifikasi_name_3, verifikasi_name_4 
        FROM verifreport_daily 
        WHERE tanggal >= '$startDate'";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("❌ Database query failed: " . mysqli_error($conn));
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['tanggal']][$row['area']] = [
        $row['verifikasi_name_1'],
        $row['verifikasi_name_2'],
        $row['verifikasi_name_3'],
        $row['verifikasi_name_4']
    ];
}

foreach ($verifiers as $name => $info) {
    $varName = str_replace(" ", "", $name) . "Missing";
    $missingRecords[$varName] = [
        "name" => $name,
        "email" => $info["email"],
        "missing_areas" => []
    ];

    $isMissingOnSevenDaysAgo = false; // Flag to check if verifier is missing on $sevenDaysAgo

    // Check for missing records in the past (from $sevenDaysAgo to $startDate)
    $dateToCheck = $sevenDaysAgo;
    while (strtotime($dateToCheck) >= strtotime($startDate)) {
        foreach ($info['daily_areas'] as $area) {
            $dayOfWeek = date('N', strtotime($dateToCheck)); // 1 (for Monday) through 7 (for Sunday)
            if ($area === 'trafo' && ($dayOfWeek == 6 || $dayOfWeek == 7)) {
                // Skip Saturdays and Sundays for "trafo"
                continue;
            }
            if (!isset($data[$dateToCheck][$area]) || !in_array($name, $data[$dateToCheck][$area])) {
                $missingRecords[$varName]['missing_areas'][$area][] = $dateToCheck;
                
                // If missing on $sevenDaysAgo, set the flag to true
                if ($dateToCheck === $sevenDaysAgo) {
                    $isMissingOnSevenDaysAgo = true;
                }
            }
        }
        $dateToCheck = date('Y-m-d', strtotime('-1 day', strtotime($dateToCheck)));
    }

    // Only check future dates if the verifier was missing on $sevenDaysAgo
    if ($isMissingOnSevenDaysAgo) {
        $dateToCheck = date('Y-m-d', strtotime('+1 day', strtotime($sevenDaysAgo)));
        while (strtotime($dateToCheck) < strtotime($today)) { 
            foreach ($info['daily_areas'] as $area) {
                $dayOfWeek = date('N', strtotime($dateToCheck)); // 1 (for Monday) through 7 (for Sunday)
                if ($area === 'trafo' && ($dayOfWeek == 6 || $dayOfWeek == 7)) {
                    // Skip Saturdays and Sundays for "trafo"
                    continue;
                }
                if (!isset($data[$dateToCheck][$area]) || !in_array($name, $data[$dateToCheck][$area])) {
                    $missingRecords[$varName]['missing_areas'][$area][] = $dateToCheck;
                }
            }
            $dateToCheck = date('Y-m-d', strtotime('+1 day', strtotime($dateToCheck)));
        }
    }
}

// Monthly Report Checker
$craneTables = [
    'crane_line4',
    'crane_line5',
    'crane_line6',
    'crane_line7',
    'crane_line8',
    'crane_bopet',
    'crane_metalize',
    'crane_coating',
    'crane_small_slitter'
];

$sql = "SELECT area, bulan, verifikasi_name_1, verifikasi_name_2, verifikasi_name_3, verifikasi_name_4 
        FROM verifreport_monthly 
        WHERE bulan >= '$startMonth'";

$result = mysqli_query($conn, $sql);
if (!$result) {
    die("❌ Database query failed: " . mysqli_error($conn));
}

$data = [];
while ($row = mysqli_fetch_assoc($result)) {
    $data[$row['bulan']][$row['area']] = [
        $row['verifikasi_name_1'],
        $row['verifikasi_name_2'],
        $row['verifikasi_name_3'],
        $row['verifikasi_name_4']
    ];
}

foreach ($verifiers as $name => $info) {
    $varName = str_replace(" ", "", $name) . "Missing";

    // Check for missing records in the past (from $startMonth to the month before today)
    $monthToCheck = $startMonth;
    while (strtotime($monthToCheck) < strtotime(date('Y-m', strtotime($today)))) {
        foreach ($info['monthly_areas'] as $area) {
            $tables = $area === 'crane' ? $craneTables : [$area];
            foreach ($tables as $table) {
                if (!isset($data[$monthToCheck][$table]) || !in_array($name, $data[$monthToCheck][$table])) {
                    $missingRecords[$varName]['missing_areas'][$table][] = $monthToCheck;
                }
            }
        }
        $monthToCheck = date('Y-m', strtotime('+1 month', strtotime($monthToCheck)));
    }
}

function formatDates($dates) {
    sort($dates);
    $ranges = [];
    $rangeStart = $dates[0];
    $prevDate = $dates[0];

    for ($i = 1; $i < count($dates); $i++) {
        $currentDate = $dates[$i];
        $prevPlusOne = date('Y-m-d', strtotime($prevDate . ' +1 day'));

        if ($currentDate !== $prevPlusOne) {
            if ($rangeStart === $prevDate) {
                $ranges[] = formatDate($rangeStart);
            } else {
                $ranges[] = formatDate($rangeStart) . " s.d. " . formatDate($prevDate);
            }
            $rangeStart = $currentDate;
        }
        $prevDate = $currentDate;
    }

    if ($rangeStart === $prevDate) {
        $ranges[] = formatDate($rangeStart);
    } else {
        $ranges[] = formatDate($rangeStart) . " s.d. " . formatDate($prevDate);
    }

    return implode(', ', $ranges);
}

function formatDate($date) {
    if (strlen($date) == 7) { // Format is Y-m
        return date('M-Y', strtotime($date));
    } else { // Format is Y-m-d
        return date('d-M-Y', strtotime($date));
    }
}


//GENERATE HTML EMAIL
// Collect all unique names for the greeting
$namesList = [];

foreach ($missingRecords as $key => $record) {
    if (!empty($record['missing_areas'])) { // Check if there are missing areas
        $namesList[] = explode(" ", $record['name'])[0]; // Get first name only
    }
}

$uniqueNames = array_unique($namesList);

if (!empty($uniqueNames)) { // Only generate email if there are missing records
    $greeting = "Dear Utility Leaders,";
    //$greeting = "Dear " . implode(', ', $uniqueNames) . ",";

    $html = "<h3><strong>$greeting</strong></h3>";
    $html .= "<p>Mohon diperhatikan bahwa yang bersangkutan belum melakukan pengecekan checklist pada area berikut:</p>";

    $html .= "<ol>"; // Ordered list for numbering names

    foreach ($missingRecords as $key => $record) {
        if (!empty($record['missing_areas'])) { // Skip if there are no missing areas
            $html .= "<li><strong>{$record['name']}:</strong>"; // Numbering for names
            $html .= "<ul>"; // Unordered list for missing areas

            foreach ($record['missing_areas'] as $area => $dates) {
                if (!empty($dates)) { // Ensure the area has missing dates
                    $formattedArea = isset($checklistForms[$area]['name']) ? $checklistForms[$area]['name'] : ucfirst($area); // Get the name from $checklistForms
                    $formattedDates = formatDates($dates);
                    $html .= "<li>Area&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<strong>$formattedArea</strong><br>Tanggal&nbsp;:&nbsp;$formattedDates</li><br>";
                }
            }

            $html .= "</ul></li>"; // Close unordered list for this person
        }
    }

    $html .= "</ol>"; // Close ordered list

} else {
    $html = ""; // No email content if no missing records
}

//MISSING CHECKLIST
$missingChecklist = [];

foreach ($checklistForms as $area => $form) {
    if (!empty($form['table'])) { // Check if the table string is not empty
        $tables = explode(', ', $form['table']);
        foreach ($tables as $table) {
            $sql = "SELECT tanggal 
                    FROM $table
                    WHERE tanggal >= '$sevenDaysAgo' AND tanggal < '$today'";
            
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("❌ Database query failed: " . mysqli_error($conn));
            }

            $dates = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $dates[] = $row['tanggal'];
            }

            $dateToCheck = $sevenDaysAgo;
            while (strtotime($dateToCheck) < strtotime($today)) {
                $dayOfWeek = date('N', strtotime($dateToCheck)); // 1 (for Monday) through 7 (for Sunday)
                if ($area === 'trafo' && ($dayOfWeek == 6 || $dayOfWeek == 7)) {
                    // Skip Saturdays and Sundays for "trafo"
                    $dateToCheck = date('Y-m-d', strtotime('+1 day', strtotime($dateToCheck)));
                    continue;
                }
                if (!in_array($dateToCheck, $dates)) {
                    $missingChecklist[$area][$table][] = $dateToCheck;
                }
                $dateToCheck = date('Y-m-d', strtotime('+1 day', strtotime($dateToCheck)));
            }
        }
    }
}


if (!empty($missingChecklist)) {
    if (!empty($uniqueNames)) {
        $html .= "<p>Adapun ";
    }else{
        $html .= "<p>Mohon diperhatikan ";
    }
    $html .= "untuk area checklist berikut yang tidak terisi pada 7 hari terakhir:</p>";
    $html .= "<ul>"; // Unordered list for missing checklist

    $addedAreas = []; // To keep track of added areas

    foreach ($missingChecklist as $area => $tables) {
        foreach ($tables as $table => $dates) {
            if (!empty($dates) && !isset($addedAreas[$area])) {
                $formattedArea = isset($checklistForms[$area]['name']) ? $checklistForms[$area]['name'] : ucfirst($area); // Get the name from $checklistForms
                $formattedDates = formatDates($dates);
                $html .= "<li>Area&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<strong>$formattedArea</strong><br>Tanggal&nbsp;:&nbsp;$formattedDates</li><br>";
                $addedAreas[$area] = true; // Mark this area as added
            }
        }
    }
    $html .= "</ul>"; // Close unordered list
}

if (!empty($uniqueNames) || !empty($addedAreas)) { // Only generate email if there are missing records
    $html .= '<p>Dimohon untuk segera dikonfirmasi dan dilakukan pengecekan di link berikut:<br> 
    <a href="http://131.107.251.10/checklist/" target="_blank">http://131.107.251.10/checklist/</a><br> 
    (Jika link tidak berfungsi, <i>copy</i> link di atas dan <i>paste</i> ke browser Anda)</p>';
    $html .= "<p>Regards,<br>Arghapedia Admin <i>(ext: 1602)</i></p>";
    $html .= "<p><i style='color: blue;'>This is an automated email. Please do not reply to this email.</i></p>";
}


$recepientEmails = [];
$uniqueEmails = []; // To keep track of unique emails

foreach ($missingRecords as $record) {
    if (!empty($record['missing_areas'])) {
        if (!in_array($record['email'], $uniqueEmails)) {
            $recepientEmails[] = [
                'name' => $record['name'],
                'email' => $record['email']
            ];
            $uniqueEmails[] = $record['email'];
        }
    }
}

// Add verifiers based on added areas
foreach ($addedAreas as $area => $value) {
    if ($value) {
        foreach ($verifiers as $name => $info) {
            if (in_array($area, array_merge($info['daily_areas'], $info['monthly_areas'])) && !in_array($info['email'], $uniqueEmails)) {
                $recepientEmails[] = [
                    'name' => $name,
                    'email' => $info['email']
                ];
                $uniqueEmails[] = $info['email'];
            }
        }
    }
}

echo $html;
print_r($missingRecords);
//echo "<br><br>";
//print_r($missingChecklist);
//echo "<br><br>";
//print_r($addedAreas);
echo "<br><br>";
print_r($recepientEmails);
?>