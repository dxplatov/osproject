<?php
use PHPMailer\PHPMailer\PHPMailer;

date_default_timezone_set('Etc/UTC');
// require 'src/PHPMailer.php';

require 'vendor/autoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

$mail->isSMTP();
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
$mail->Port = 587;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "osproject2019.2020@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "asilbek5999";
//Set who the message is to be sent from
$mail->setFrom('osproject2019.2020@gmail.com', 'First Last');
//Set an alternative reply-to address
$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('yeban99@fuck.com', 'John Doe');
//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';
$mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
// $mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
// $mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}