<?php
require 'PHPMailer/PHPMailerAutoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

function sendMail($email, $subject, $message){

   $mail = new PHPMailer;
   $mail->isSMTP();
   $mail->Host = 'webmail.bluebase.in';
   $mail->Port = 587;
   $mail->SMTPDebug = 2;
   $mail->SMTPAuth = true;
   $mail->SMTPSecure = 'tls';
   $mail->Pool = true;
   $mail->Mailer   = 'smtp';
   $mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
		'allow_self_singed' => true,
    ]
];
   $mail->Username = 'pmgplay2021@bluebase.in';
   $mail->Password = 'pmg2021..';

   $mail->setFrom('pmgplay2021@bluebase.in', 'PMG Play App');
   $mail->addReplyTo('pmgplay2021@bluebase.in', 'PMG Play App');
   $mail->addAddress($email);

   $mail->isHTML(true);	
   $mail->Subject = $subject;
   $mail->Body = $message;

  if(!$mail->send()) {
		echo 'Message was not sent.';
		 echo 'Mailer error: ' . $mail->ErrorInfo;
		 return false;
	} 
	else {
		 echo 'Message has been sent';		
		 return true;
	}
   
/* $mail = new PHPMailer;
$mail->SMTPDebug = 2; 
$mail->Mailer = "smtp";
$mail->IsSMTP(true); 
$mail->Port = 587;
$mail->Host = 'webmail.bluebase.in';        
$mail->SMTPAuth = true;                              // Enable SMTP authentication
$mail->Username = 'pmgplay2021@bluebase.in';
$mail->Password = 'pmg2021..';                           // SMTP password
$mail->SMTPSecure = 'tls'; 
$mail->SMTPOptions = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
		'allow_self_singed' => true,
    ]
];

$mail->setFrom('pmgplay2021@bluebase.in', 'PMG Play App');//Sets the From email address for the message
$mail->addReplyTo('pmgplay2021@bluebase.in', 'PMG Play App');
$mail->addAddress($email);//Adds a "To" address
   		
$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
$mail->isHTML(true);                                 // Set email format to HTML

$mail->Subject = $subject;
$mail->Body = $message;
   
   
if(!$mail->send()) {
		echo 'Message was not sent.';
		 //echo 'Mailer error: ' . $mail->ErrorInfo;
		 return false;
	} 
	else {
		 echo 'Message has been sent';		
		 return true;
	}
	 */
	
} 
?>
