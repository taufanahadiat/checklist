<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/opt/lampp/htdocs/vendor/autoload.php'; // Include PHPMailer

$mail = new PHPMailer(true);

include 'html_email.php'; // Include the HTML content

$ccmail = [
//    "Fuad Hasan"   => "fuad@arghakarya.co.id",
//    "Iwan Hermawan"    => "iwan.hermawan@arghakarya.co.id",
    "Taufan Ahadiat"   => "taufan.ahadiat@arghakarya.co.id"
];

try {
    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host       = 'mail.arghakarya.co.id'; // Your SMTP server
    $mail->SMTPAuth   = true;
    $mail->Username   = 'arghapedia@arghakarya.co.id'; // Your email
    $mail->Password   = 'KSJSU012425'; // Replace with actual password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // SSL encryption
    $mail->Port       = 465; // SSL port
    //$mail->SMTPDebug  = 2; 
    $mail->SMTPAutoTLS = false;

    // ✅ Disable SSL verification
    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    // Collect unique recipient emails from $recepientEmails
    $recipients = [];
    foreach ($recepientEmails as $recipient) {
        if (!empty($recipient['email'])) {
            $recipients[$recipient['email']] = $recipient['name'];
        }
    }
    
    if (empty($recipients)) {
        echo "⚠ No valid recipients found. Email not sent.<br>";
        exit;
    }


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
//    $attachmentPath = "/opt/lampp/htdocs/checklist/email/checker_report.xlsx";
//    if (file_exists($attachmentPath)) {
//        $mail->addAttachment($attachmentPath);
//    } else {
//        echo "⚠️ Attachment file not found: $attachmentPath<br>";
//    }

    // Email Content
    $mail->isHTML(true);
    $mail->Subject = "Online Checklist Alert";
    $mail->Body    = $html;

    $mail->send();
    echo "✅ Email sent successfully to: " . implode(', ', array_keys($recipients)) . "<br>";
} catch (Exception $e) {
    echo "❌ Email could not be sent. Error: {$mail->ErrorInfo}<br>";
}

mysqli_close($conn);

?>
