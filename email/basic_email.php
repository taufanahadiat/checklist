<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/opt/lampp/htdocs/vendor/autoload.php'; // Include PHPMailer
require '../database.php'; // Include database connection

$mail = new PHPMailer(true);

// Define the verifiers, their areas, and email addresses
$verifiers = [
    "Guruh Juniawan"   => ["areas" => ["chiller", "compressor", "genset"], "email" => "guruh@arghakarya.co.id"],
    "Arya Bima Putra"  => ["areas" => ["boiler"], "email" => "arya@arghakarya.co.id"],
    "Nano Hartono"     => ["areas" => ["trafo"], "email" => "nano@arghakarya.co.id"],
    "Syamsul Pandiangan" => ["areas" => ["boiler"], "email" => "syamsul@arghakarya.co.id"],
    "Hermansyah"       => ["areas" => ["chiller", "compressor", "genset", "trafo"], "email" => "hermansyah@arghakarya.co.id"],
    "Teiffur Zaman"    => ["areas" => ["crane"], "email" => "teiffur@arghakarya.co.id"]
];
$ccmail = [
    "Iwan Hermawan"    => "iwan.hermawan@arghakarya.co.id",
    "Taufan Ahadiat"   => "taufan.ahadiat@arghakarya.co.id",
    "Fuad Hasan"   => "fuad@arghakarya.co.id"
];


// Send a single email with all missing verifications
$body = "<h3>Dear Utility Leaders,</h3>";
$body .= "<p>Sebagai informasi, terhitung mulai 03/03/2025, email alert checklist telah aktif. Oleh karena itu, mohon diperhatikan kembali form-form checklist di area masing-masing agar tidak ada yang terlewat.</p>";
$body .= '<p>Email alert akan terkirim secara otomatis apabila form terkait belum dicek selama 7 hari. Untuk pengecekan form checklist bisa dilakukan di link berikut:<br> 
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
    foreach ($verifiers as $name => $details) {
        $mail->addAddress($details['email'], $name);
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
