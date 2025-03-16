<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '/opt/lampp/htdocs/vendor/autoload.php'; // Include PHPMailer

$mail = new PHPMailer(true);

include 'html_gmail_trial.php'; // Include the HTML content

try {
    // SMTP Configuration
    $mail->isSMTP();
    $mail->Host       = $_ENV['SMTP_HOST'];
    $mail->SMTPAuth   = true;
    $mail->Username   = $_ENV['SMTP_USERNAME'];
    $mail->Password   = $_ENV['SMTP_PASSWORD'];
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    //$mail->SMTPDebug  = 2; // Set to 0 for production

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
