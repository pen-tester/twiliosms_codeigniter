<?php
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";

  	$_from=$_POST["From"];
    $_to=$_POST["To"];
    $_body= $_POST["Body"];
/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
*/
require "PhpMailer/PHPMailerAutoload.php";
$username = 'talent.anddev@yandex.com';
$password = '3edc$RFV5tgb';
$smtpHost = 'smtp.yandex.com';
$smtpPort = 587;
$to = 'andrew.lidev@yandex.com';


$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = $smtpHost;  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = $username;                 // SMTP username
$mail->Password = $password;                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = $smtpPort;                                    // TCP port to connect to

$mail->setFrom($username, 'Mailer');
//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
$mail->addAddress($to);               // Name is optional
//$mail->addReplyTo($username, 'Information');
//$mail->addCC($username);
//$mail->addBCC($username);

//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Sms Received from .'.$_from;
//$mail->Body    = $_body;
$mail->Body    = 'This is for test';
//$mail->AltBody = $_body;
$mail->send();

?>
<Response>

</Response>