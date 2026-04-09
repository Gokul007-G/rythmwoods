<?php
require 'phpmailer/class.phpmailer.php';
require 'phpmailer/class.smtp.php';
require 'phpmailer/PHPMailerAutoload.php';

function sendMail($email, $subject, $message){
	
   $mail = new PHPMailer();
   
   $mail->isSMTP();
   $mail->SMTPDebug = 2;
   $mail->SMTPAuth = true;// Enable SMTP authentication
   $mail->SMTPSecure = 'ssl';// Enable encryption,'ssl', 'tsl' also accepted
  
  
   $mail->Host = 'mail.bluebase.in';
   $mail->Port = 587;// TCP port to connect to465,587  
   $mail->isHTML(true);
   $mail->debug =true;
   $mail->Mailer   = 'smtp';
   $mail->SMTPKeepAlive = true; // add it to keep SMTP connection open after each email sent
 
   //$mail->Username = 'pmgplay2021@gmail.com';
   //$mail->Password = 'pmg2021..';// SMTP password
   
   $mail->Username = 'praveen.m@bluebase.in';
   $mail->Password = 'BBwonder@123';// SMTP password
   
   $mail->Body = "Hello PMG Play";
   
   $mail->setFrom('praveen.m@bluebase.in', 'PMG Play App');
   $mail->addReplyTo('praveen.m@bluebase.in', 'PMG Play App');
   
   $mail->addAddress($email);

   $mail->Subject = $subject;
   $mail->Body = $message;
   
if(!$mail->send()) {
		echo 'Message was not sent.';
		 echo 'Mailer error: ' . $mail->ErrorInfo;
		 return true;
	} 
	else {
		 echo 'Message has been sent';		
		 return false;
	}
} 
?>
