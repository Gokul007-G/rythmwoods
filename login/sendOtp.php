<?php

include("connect.php");
session_start();

$receivedemail = $_REQUEST['Inputemail'];
$newpassword = $_REQUEST['InputPassword'];
// $newconfirmapassword = $_REQUEST['InputconfirmPassword'];

$_SESSION["fromailid"] = $receivedemail;
$_SESSION["newpasswordd"] = $newpassword;
// $_SESSION["newconfirmmpasswordd"] = $newconfirmapassword;

$otp = rand(1000, 9999);

$subject = 'OTP Verification';
$emailbody = 'Your 4 Digit OTP Code: ';

include('smtp/PHPMailerAutoload.php');
echo smtp_mailer($receivedemail, $subject, $emailbody . $otp);

function smtp_mailer($to, $subject, $msg)
{
	global $con;
	$mail = new PHPMailer();
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'tls';
	$mail->Host = "smtp.gmail.com";
	$mail->Port = 587;
	$mail->IsHTML(true);
	$mail->CharSet = 'UTF-8';
	$mail->SMTPDebug = 2;
	$mail->Username = "priyadevibluebase@gmail.com"; // Sender's Email
	$mail->Password = "efuz qpxc hqqn syii"; //Sender's Email App Password
	$mail->SetFrom("priyadevibluebase@gmail.com"); // Sender's Email
	$mail->Subject = $subject;
	$mail->Body = $msg;
	$mail->AddAddress($to);
	$mail->SMTPOptions = array('ssl' => array(
		'verify_peer' => false,
		'verify_peer_name' => false,
		'allow_self_signed' => false
	));
	if (!$mail->Send()) {
		echo "<script>alert('Mail does Not send!')</script>";
		echo "<script>window.loction.href='/rythm/login/forgotpass.php'</script>";
	}
}
$updateQuery = $con->query("INSERT INTO `otptable`(`id`, `email`, `password`, `confirmpassword`, `otpcode`, `created_on`, `modify_on`) VALUES (NULL, '$receivedemail', '$newpassword', '', '$otp', now(), '0000-00-00')");

if ($updateQuery) {
	echo "<script>alert('Mail Send Successfully!')</script>";
	echo "<script>window.location.href='/rythm/login/otpverifypage.php'</script>";
} else {
	echo "<script>alert('Mail Sent Successfully! Database query failed.')</script>";
	echo "<script>window.loction.href='/rythm/login/forgotpass.php'</script>";
}
