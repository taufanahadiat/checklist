<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/opt/lampp/htdocs/vendor/autoload.php'; // Include PHPMailer
require '../database.php'; // Include database connection

$mail = new PHPMailer(true);

// Define the verifiers, their areas, and email addresses
$verifiers = [
    "Guruh Juniawan"   => ["areas" => ["chiller", "compressor", "genset"], "email" => "taufanahadiat@gmail.com"],
    "Arya Bima Putra"  => ["areas" => ["boiler"], "email" => "taufan.ahadiat@arghakarya.co.id"],
//    "Nano Hartono"     => ["areas" => ["trafo"], "email" => "nano@arghakarya.co.id"],
    "Syamsul Pandiangan" => ["areas" => ["boiler"], "email" => "taufan.ahadiat@arghakarya.co.id"],
    "Hermansyah"       => ["areas" => ["chiller", "compressor", "genset", "trafo"], "email" => "taufanahadiat@gmail.com"],
//    "Teiffur Zaman"    => ["areas" => ["crane"], "email" => "teiffur@arghakarya.co.id"]
];
$ccmail = [
//    "Iwan Hermawan"    => "iwan.hermawan@arghakarya.co.id",
    "Taufan Ahadiat"   => "taufan.ahadiat@arghakarya.co.id",
//    "Fuad Hasan"   => "fuad@arghakarya.co.id"
];

// Query to get records from the last 7 days where verifications are NULL
$sql = "
    SELECT area, tanggal, verifikasi_name_1, verifikasi_name_2, verifikasi_name_3, verifikasi_name_4 
    FROM verifreport_daily 
    WHERE tanggal >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("❌ Database query failed: " . mysqli_error($conn));
}

// Process the results
$verified_names = [];
$area_verifications = [];

// Collect existing verifications
while ($row = mysqli_fetch_assoc($result)) {
    $area = strtolower(trim($row['area']));

    // Store names that already verified within 7 days
    foreach (['verifikasi_name_1', 'verifikasi_name_2', 'verifikasi_name_3', 'verifikasi_name_4'] as $col) {
        if (!empty($row[$col])) {
            $verified_names[$row[$col]] = true; // Mark as verified
        }
    }

    // Store verification status for each area
    if (
        empty($row['verifikasi_name_1']) &&
        empty($row['verifikasi_name_2']) &&
        empty($row['verifikasi_name_3']) &&
        empty($row['verifikasi_name_4'])
    ) {
        $area_verifications[$area][] = $row['tanggal']; // Track missing verifications
    }
}

// Find names who should have verified but didn't
$missing_verifications = [];

foreach ($verifiers as $name => $info) {
    if (!isset($verified_names[$name])) { // Exclude verified names
        foreach ($info['areas'] as $area) {
            if (isset($area_verifications[$area])) {
                // Get all dates in the last 7 days
                $dates_in_last_7_days = [];
                for ($i = 1; $i <= 7; $i++) { // Start from 1 to exclude today
                    $dates_in_last_7_days[] = date('Y-m-d', strtotime("-$i days"));
                }
            
                // Check for missing dates
                $missing_dates = [];
                foreach ($dates_in_last_7_days as $date) {
                    if (!in_array($date, $area_verifications[$area])) {
                        $missing_dates[] = $date;
                    }
                }
            
                // Check for missing dates beyond the last 7 days
                $start_date = null;
                if (!empty($missing_dates)) {
                    $start_date = date('d/m/Y', strtotime($missing_dates[count($missing_dates) - 1]));
                    $end_date = date('d/m/Y', strtotime($missing_dates[0]));

                    // Check previous dates until a valid verification is found
                    $current_date = strtotime($missing_dates[count($missing_dates) - 1]);
                    $limit_date = strtotime('2025-02-03');
                    while (true) {
                        $current_date = strtotime('-1 day', $current_date);
                        $current_date_str = date('Y-m-d', $current_date);
                        if ($current_date < $limit_date || (isset($area_verifications[$area]) && in_array($current_date_str, $area_verifications[$area]))) {
                            break;
                        }
                        $start_date = date('d/m/Y', $current_date);
                    }

                    $missing_verifications[$name][] = "Area: $area ($start_date to $end_date)";
                }
            } else {
                // If no records exist for this area in the last 7 days, mark as missing
                $start_date = date('d/m/Y', strtotime('-7 days'));
                $end_date = date('d/m/Y', strtotime('-1 day'));
            
                // Check previous dates until a valid verification is found
                $current_date = strtotime('-7 days');
                $limit_date = strtotime('2025-02-03');
                while (true) {
                    $current_date = strtotime('-1 day', $current_date);
                    $current_date_str = date('Y-m-d', $current_date);
                    if ($current_date < $limit_date || (isset($area_verifications[$area]) && in_array($current_date_str, $area_verifications[$area]))) {
                        break;
                    }
                    $start_date = date('d/m/Y', $current_date);
                }
            
                $missing_verifications[$name][] = "Area: $area ($start_date to $end_date)";
            }
        }
    }
}

// Gather all recipients and their missing verifications
$recipients = [];
$missing_names = [];
foreach ($missing_verifications as $name => $missing_areas) {
    $email = $verifiers[$name]['email'];
    $recipients[$email][] = [
        'name' => $name,
        'missing_areas' => $missing_areas
    ];
    $missing_names[] = $name;
}

// Create the "Dear" section with all missing names
$dear_section = "Dear " . implode(", ", array_slice($missing_names, 0, -1));
if (count($missing_names) > 1) {
    $dear_section .= ", and " . end($missing_names);
} else {
    $dear_section = "Dear " . end($missing_names);
}

// Send a single email with all missing verifications
$body = "<h3>$dear_section,</h3>";
$body .= "<p>Mohon diperhatikan bahwa yang bersangkutan belum melakukan pengecekan checklist pada area berikut:</p>";
$body .= "<ul>";

foreach ($recipients as $email => $infos) {
    foreach ($infos as $info) {
        $body .= "<li><strong>{$info['name']}:</strong><ul>";
        foreach ($info['missing_areas'] as $area_info) {
            $body .= "<li>$area_info</li>";
        }
        $body .= "</ul></li>";
    }
}

$body .= "</ul>";
$body .= '<p>Dimohon untuk segera dikonfirmasi dan dilakukan pengecekan di link berikut:<br> 
<a href="http://131.107.251.10/checklist/" target="_blank">http://131.107.251.10/checklist/</a><br> 
(Jika link tidak berfungsi, <i>copy</i> link di atas dan <i>paste</i> ke browser Anda)</p>';
$body .= "<p>Regards,<br>Arghapedia Admin</p>";
$body .= "<p><i>This is an automated email. Please do not reply to this email.</i></p>";

try {
    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host       = 'mail.arghakarya.co.id'; // Your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'arghapedia@arghakarya.co.id'; // Your email
    $mail->Password   = 'KSJSU012425'; // Replace with actual password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL encryption
    $mail->Port       = 465; // SSL port
    $mail->SMTPDebug  = 2; 
    $mail->SMTPAutoTLS = false;

    // ✅ Disable SSL verification
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    // Sender & Recipient
    $mail->setFrom('arghapedia@arghakarya.co.id', 'Arghapedia');
    foreach ($recipients as $email => $infos) {
        foreach ($infos as $info) {
            $mail->addAddress($email, $info['name']);
        }
    }
    foreach ($ccmail as $name => $email) {
        $mail->addCC($email, $name);
    }

    // Add attachment
    $attachmentPath = "/opt/lampp/htdocs/checklist/email/checker_report.xlsx";
    if (file_exists($attachmentPath)) {
        $mail->addAttachment($attachmentPath);
    } else {
        echo "⚠️ Attachment file not found: $attachmentPath<br>";
    }

    // Email Content
    $mail->isHTML(true);
    $mail->Subject = "Online Checklist Alert";
    $mail->Body    = $body;

    $mail->send();
    echo "✅ Email sent successfully!";
} catch (Exception $e) {
    echo "❌ Email could not be sent. Error: {$mail->ErrorInfo}";
}
?>
