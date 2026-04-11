<?php
include('smtp/PHPMailerAutoload.php');

function smtp_mailer($to,$subject, $msg){
	$mail = new PHPMailer(); 
	$mail->IsSMTP(); 
	$mail->SMTPAuth = true; 
	$mail->SMTPSecure = 'tls'; 
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587; 
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';

	$mail->Username = "suryapanneer04@gmail.com"; 
	$mail->Password = "qfmb wvrx xcey mdmn"; 

	$mail->SetFrom("suryapanneer04@gmail.com", "RythmWoods");
	$mail->Subject = $subject;
	$mail->Body = $msg;
	$mail->AddAddress($to);

	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => false
		)
	);

	if(!$mail->Send()){
		echo "<script>alert('Mail does Not send!')</script>";
		echo "<script>window.loction.href='/rythm/login/forgotpass.php'</script>";
	}else{
		return true;
	}
}
?>