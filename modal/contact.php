<?php

// Set the recipient email address
$php_main_email = "business.zubayr@gmail.com";

// Fetching values from the POST request
$php_name = $_POST['ajax_name'];
$php_email = $_POST['ajax_email'];
$php_message = $_POST['ajax_message'];

// Sanitizing the email
$php_email = filter_var($php_email, FILTER_SANITIZE_EMAIL);

// Validate the email after sanitization
if (filter_var($php_email, FILTER_VALIDATE_EMAIL)) {
    
    $php_subject = "Message from Contact Form";
    
    // Set the email headers
    $php_headers = "MIME-Version: 1.0" . "\r\n";
    $php_headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
    $php_headers .= "From: " . $php_email . "\r\n"; // Sender's Email
    $php_headers .= "Reply-To: " . $php_email . "\r\n"; // Reply-To Sender

    // Email Template
    $php_template = '<div style="padding:20px; font-family:Arial, sans-serif; background-color:#f8f8f8; color:#333;">
        <h2>Contact Form Submission</h2>
        <p><strong style="color:#f00a77;">Name:</strong> ' . htmlspecialchars($php_name) . '</p>
        <p><strong style="color:#f00a77;">Email:</strong> ' . htmlspecialchars($php_email) . '</p>
        <p><strong style="color:#f00a77;">Message:</strong> ' . nl2br(htmlspecialchars($php_message)) . '</p>
        <br>
        <p>This is an automated confirmation email. We will get back to you as soon as possible.</p>
    </div>';

    // Send the email
    if (mail($php_main_email, $php_subject, $php_template, $php_headers)) {
        echo "Success: Your message has been sent.";
    } else {
        echo "Error: Unable to send the message. Please try again.";
    }
} else {
    echo "<span class='contact_error'>* Invalid email *</span>";
}

?>
