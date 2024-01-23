<?php
// $to      = 'udinmalang123456789@gmail.com';
// $subject = 'the subject';
// $message = 'hello';
// $headers = 'From: webmaster@example.com'       . "\r\n" .
//     'Reply-To: webmaster@example.com' . "\r\n" .
//     'X-Mailer: PHP/' . phpversion();

// mail($to, $subject, $message, $headers);

$to = "recipient@example.com";
$subject = "Test Subject";
$message = "This is a test email.";
$headers = "From: your_email@example.com";

$smtpUsername = "your_smtp_username";
$smtpPassword = "your_smtp_password";
$smtpHost = "smtp.example.com";
$smtpPort = 587; // Use the appropriate port for your SMTP server

ini_set("SMTP", $smtpHost);
ini_set("smtp_port", $smtpPort);
ini_set("sendmail_from", "your_email@example.com");

$additionalHeaders = "X-Mailer: PHP/" . phpversion();

// Use the 'mail' function with additional headers for SMTP authentication
mail($to, $subject, $message, $headers, "-fyour_email@example.com", "-oi -f $smtpUsername", "-au$smtpUsername", "-ap$smtpPassword", $additionalHeaders);