<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Ensure PHPMailer is installed

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $php_name = $_POST['ajax_name'];
    $php_email = $_POST['ajax_email'];
    $php_message = $_POST['ajax_message'];

    if (!filter_var($php_email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
        exit;
    }

    $mail = new PHPMailer(true);

    try {
        // SMTP Configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'zubayrlatie007@gmail.com';  // Replace with your Gmail
        $mail->Password = 'ukcvyncjsarwkobz';  // Use an App Password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Sender & Recipient
        $mail->setFrom($php_email, $php_name);
        $mail->addAddress('business.zubayr@gmail.com'); // Your email

        // Email Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Message';
        $mail->Body = "
            <h3>New Contact Form Message</h3>
            <p><strong>Name:</strong> $php_name</p>
            <p><strong>Email:</strong> $php_email</p>
            <p><strong>Message:</strong><br> $php_message</p>
        ";

        // Send Email
        $mail->send();
        echo "Message sent successfully!";
    } catch (Exception $e) {
        echo "Error: {$mail->ErrorInfo}";
    }
} else {
    echo "Invalid request.";
}
?>
