<?php

include("connect.php");
session_start();


$code1=$_POST['digit1'];
$code2=$_POST['digit2'];
$code3=$_POST['digit3'];
$code4=$_POST['digit4'];

$inputotpcode=$code1.''.$code2.''.$code3.''.$code4;

if (isset($_SESSION["fromailid"], $_SESSION["newpasswordd"], $_SESSION["newconfirmmpasswordd"])) {
  
    $receivedEmail = $_SESSION["fromailid"];
    $newPassword = $_SESSION["newpasswordd"];
    $newConfirmPassword = $_SESSION["newconfirmmpasswordd"];

   
  // echo "Received Email: $receivedEmail<br>";
    //echo "New Password: $newPassword<br>";
   // echo "New Confirm Password: $newConfirmPassword<br>";
	$sql=$con->query("SELECT * FROM `S` WHERE email='$receivedEmail' and password='$newPassword' and confirmpassword='$newConfirmPassword' ORDER BY id DESC");
	
	$row = $sql->fetch(PDO::FETCH_ASSOC);
	
	
	if($row)
	{
		//echo $row['otpcode'].'sdfghj';
		
		$tableotp=$row['otpcode'];
		if($tableotp==$inputotpcode)
		{
			$newinputPassword=md5($newPassword);
			$sql2=$con->query("UPDATE `user_master` SET `password`='$newinputPassword' WHERE email='$receivedEmail'");
			if($sql2)
			{
				echo 1;
				//echo "<script>alert('Password update Successfully!')</script>";
		       // echo "<script>window.location.href='/rythm/login/login.php'</script>";
			}
			else
			{
				echo 2;
				//echo "<script>alert('SomethingWent Wrong!')</script>";
		        //echo "<script>window.location.href='/rythm/login/forgotpass.php'</script>";
			}
		}
		else
		{
			echo 3;
			//echo "<script>alert('Please Check Otp code In Your Email!')</script>";
		   // echo "<script>window.location.href='/rythm/login/optverifypage.php'</script>";
		}
		
		
	}
	
	
} 
else {
    
    echo 4;
}
?>