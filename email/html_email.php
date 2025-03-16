<?php
require '../database.php'; // Include database connection

$verifiers = [
    "Guruh Juniawan"   => ["areas" => ["chiller", "compressor", "genset"], "email" => "guruh.juniawan@arghakarya.co.id"],
    "Arya Bima Putra"  => ["areas" => ["boiler"], "email" => "arya.bima@arghakarya.co.id"],
    "Nano Hartono"     => ["areas" => ["trafo"], "email" => "nano.hartono@arghakarya.co.id"],
    "Syamsul Pandiangan" => ["areas" => ["boiler"], "email" => "syamsul.pandi@arghakarya.co.id"],
    "Hermansyah"       => ["areas" => ["chiller", "compressor", "genset", "trafo"], "email" => "hermansyah@arghakarya.co.id"]
];

$missingRecords = [];

$today = date('Y-m-d');
$sevenDaysAgo = date('Y-m-d', strtotime('-7 days', strtotime($today)));
$startDate = '2025-03-03';

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
        foreach ($info['areas'] as $area) {
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
            foreach ($info['areas'] as $area) {
                if (!isset($data[$dateToCheck][$area]) || !in_array($name, $data[$dateToCheck][$area])) {
                    $missingRecords[$varName]['missing_areas'][$area][] = $dateToCheck;
                }
            }
            $dateToCheck = date('Y-m-d', strtotime('+1 day', strtotime($dateToCheck)));
        }
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
                $ranges[] = date('d-M-Y', strtotime($rangeStart));
            } else {
                $ranges[] = date('d-M-Y', strtotime($rangeStart)) . " to " . date('d-M-Y', strtotime($prevDate));
            }
            $rangeStart = $currentDate;
        }
        $prevDate = $currentDate;
    }

    if ($rangeStart === $prevDate) {
        $ranges[] = date('d-M-Y', strtotime($rangeStart));
    } else {
        $ranges[] = date('d-M-Y', strtotime($rangeStart)) . " to " . date('d-M-Y', strtotime($prevDate));
    }

    return implode(', ', $ranges);
}

// Area name mappings
$areaNames = [
    "chiller"     => "Chiller",
    "compressor"  => "Compressor",
    "genset"      => "Genset",
    "boiler"      => "Boiler",
    "trafo"       => "Pengamanan Trafo"
];

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

    $html = "<h3><strong>$greeting</strong></h3>";
    $html .= "<p>Mohon diperhatikan bahwa yang bersangkutan belum melakukan pengecekan checklist pada area berikut:</p>";

    $html .= "<ol>"; // Ordered list for numbering names

    foreach ($missingRecords as $key => $record) {
        if (!empty($record['missing_areas'])) { // Skip if there are no missing areas
            $html .= "<li><strong>{$record['name']}:</strong>"; // Numbering for names
            $html .= "<ul>"; // Unordered list for missing areas

            foreach ($record['missing_areas'] as $area => $dates) {
                if (!empty($dates)) { // Ensure the area has missing dates
                    $formattedArea = isset($areaNames[$area]) ? $areaNames[$area] : ucfirst($area); // PHP 5.5 compatible
                    $formattedDates = formatDates($dates);
                    $html .= "<li>Area&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;<strong>$formattedArea</strong><br>Tanggal&nbsp;:&nbsp;$formattedDates</li><br>";
                }
            }

            $html .= "</ul></li>"; // Close unordered list for this person
        }
    }

    $html .= "</ol>"; // Close ordered list

    $html .= '<p>Dimohon untuk segera dikonfirmasi dan dilakukan pengecekan di link berikut:<br> 
    <a href="http://131.107.251.10/checklist/" target="_blank">http://131.107.251.10/checklist/</a><br> 
    (Jika link tidak berfungsi, <i>copy</i> link di atas dan <i>paste</i> ke browser Anda)</p>';
    $html .= "<p>Regards,<br>Arghapedia Admin <i>(ext. 1602)</i></p>";
    $html .= "<p><i style='color: blue;'>This is an automated email. Please do not reply to this email.</i></p>";
} else {
    $html = ""; // No email content if no missing records
}

echo $html;
//print_r($missingRecords);
?>