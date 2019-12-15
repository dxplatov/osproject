<?php
 header('Access-Control-Allow-Origin: *');
 header('Content-Type: application/json');
 include_once '../../config/Database.php';
 include_once '../../models/Event.php';

 use PHPMailer\PHPMailer\PHPMailer;

date_default_timezone_set('Etc/UTC');
// require 'src/PHPMailer.php';
require './phpmail/vendor/autoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
$id = intval($_GET['id']);
$database = new Database();
$db = $database->connect();
$event = new Event($db);
$query = 'SELECT * FROM event WHERE id=:id';
$food_query = 'select food_name from food join food_item on food_item.food_id=food.id and food_item.event_id = :id;';
$band_query = 'select band_name from band join band_item on band_item.band_id=band.id and band_item.event_id = :id;';


$stmt = $db->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
print_r($result);

$stmt_food = $db->prepare($food_query);
$stmt_food->bindParam(':id', $id);
$stmt_food->execute();
$food_result = $stmt_food->fetchAll(PDO::FETCH_COLUMN);
print_r($food_result);

//$client_name = $result['client_name']; 

$stmt_band = $db->prepare($band_query);
$stmt_band->bindParam(':id', $id);
$stmt_band->execute();
$band_result = $stmt_band->fetchAll(PDO::FETCH_COLUMN);
print_r($band_result);





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
$mail->setFrom('osproject2019.2020@gmail.com', 'Wedding Hall Yakkasaroy');
//Set an alternative reply-to address
$mail->addReplyTo('osproject2019.2020@gmail.com', 'Wedding Hall Yakkasaroy');
//Set who the message is to be sent to
$mail->addAddress($result['email'], $result['client_name']);
//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';
$mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Confirmation!!!';
    
    $foods = "";
    for($i=0; $i<count($food_result);$i++){
       $foods =  $foods.$food_result[$i].'<br>';
    }
    $bands = "";
    for($i=0; $i<count($band_result);$i++){
        $bands =  $bands.$band_result[$i].'<br>';
     }
    $mail->Body    = 'Dear '.$result['client_name'].' We are glad to inform you that your reservation has been approved<br>
    Your reservation id: '.$result['id'].'<br>
    Foods ordered:<br>'.$foods.'<br>'.'Band ordered:<br>'.$bands;
    //$mail->AltBody = 'We glad to inform you that your reservation has been approved. Your order:<br/>hello';
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
    $event->approve();

} else {
    echo "Message sent!";
}