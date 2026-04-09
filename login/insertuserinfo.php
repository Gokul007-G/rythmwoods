<?php

include("connect.php");

$Inputfirstname = $_REQUEST['Inputfirstname'];
$Inputlastname = $_REQUEST['Inputlastname'];
$contactno = $_REQUEST['contactno'];
$email = $_REQUEST['email'];
$inputpassword = $_REQUEST['password'];
$password = md5($inputpassword);
$selectedValue = $_POST["typeofcategory"];
if ($Inputfirstname != '' && $Inputlastname != '' && $contactno != '' && $email != '' && $inputpassword != '' && $selectedValue != 'nd') {
    try {
        $titles = [
            "1" => "singer",
            "3" => "musician",
            "4" => "bands",
            "5" => "event managers",
            "6" => "lighting",
            "7" => "sounds",
            "8" => "user"
        ];
        $title = $titles[$selectedValue] ?? "user";

        $stmt = $con->prepare("INSERT INTO `user_master` 
            (`role_master_id`, `name`, `last_name`, `user_name`, `password`, `email`, `status`, `mobile_no`, `created_on`, `title`) 
            VALUES (?, ?, ?, ?, ?, ?, '1', ?, NOW(), ?)");
            
        $success = $stmt->execute([
             $selectedValue, $Inputfirstname, $Inputlastname, $email, $password, $email, $contactno, $title
        ]);

        if ($success) {
            $lastId = $con->lastInsertId();
            $con->query("UPDATE `user_master` SET `users_id` = '$lastId' WHERE `id` = '$lastId'");
            echo "<script>alert('Signup Successfully!')</script>";
            echo "<script>window.location.href='/rythm/login/login.php'</script>";
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
