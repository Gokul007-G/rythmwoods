<?php

include("connect.php");
include("smtp_mail.php");


$Inputfirstname = $_POST['Inputfirstname'];
$Inputlastname  = $_POST['Inputlastname'];
$contactno      = $_POST['contactno'];
$email          = $_POST['email'];
$inputpassword  = $_POST['password'];
$selectedValue  = $_POST['typeofcategory'];

// duplicate email check
$checkStmt = $con->prepare("SELECT id FROM user_master WHERE email = ?");
$checkStmt->execute([$email]);


if ($checkStmt->rowCount() > 0) {
    echo "<script>alert('Already you have an account. Please use another email!')</script>";
    echo "<script>window.location.href='/rythm/login/login.php'</script>";
    exit;
}

$password = password_hash($inputpassword, PASSWORD_DEFAULT); 
$title = ""; 

$categoryMap = [
    1 => "Singer",
    3 => "Musician",
    4 => "Band",
    5 => "Event Manager",
    6 => "Lighting",
    7 => "Sound",
    8 => "User"
];

$title = $categoryMap[$selectedValue] ?? "User";

if (
    $Inputfirstname != '' &&
    $Inputlastname != '' &&
    $contactno != '' &&
    $email != '' &&
    $inputpassword != '' &&
    $selectedValue != ''
) {
    try {

        $otp = rand(100000,999999); // OTP

        $stmt = $con->prepare("INSERT INTO user_master 
        (role_master_id, name, last_name, user_name, password, email, title, status, mobile_no, created_on, otp, is_verified) 
        VALUES (?, ?, ?, ?, ?, ?, ?, '1', ?, NOW(), ?, 0)");

        $success = $stmt->execute([
            $selectedValue,
            $Inputfirstname,
            $Inputlastname,
            $Inputfirstname,
            $password,
            $email,
            $title,
            $contactno,
            $otp
        ]);

    
        if ($success) {

            $last_id = $con->lastInsertId();
            $update = $con->prepare("UPDATE user_master SET users_id = ? WHERE id = ?");
            $update->execute([$last_id, $last_id]);

            $msg = "Your OTP is: ".$otp;
            smtp_mailer($email, "Email Verification OTP", $msg);

            echo "<script>alert('Registration successful! Please verify your email.')</script>";
            echo "<script>window.location.href='/rythm/login/verify.php?email=" . urlencode($email) . "'</script>";
        } else {
            echo "<script>alert('Something went wrong!')</script>";
            echo "<script>window.location.href='/rythm/login/register.php'</script>";
        }
    } catch (PDOException $e) {
        // Log error if needed: error_log($e->getMessage());
        echo "<script>alert('Error: " . addslashes($e->getMessage()) . "')</script>";
        echo "<script>window.location.href='/rythm/login/register.php'</script>";
    }
} else {
	echo "<script>alert('Required parameters not set!')</script>";
	echo "<script>window.location.href='/rythm/login/register.php'</script>";
}
