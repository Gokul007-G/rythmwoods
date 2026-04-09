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
        $stmt = $con->prepare("INSERT INTO `user_master` 
            (`users_id`, `role_master_id`, `name`, `last_name`, `user_name`, `password`, `email`, `title`, `status`, `mobile_no`, `created_on`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, '1', ?, NOW())");
            
        $success = $stmt->execute([
            $selectedValue, $selectedValue, $Inputfirstname, $Inputlastname, $Inputfirstname, $password, $email, $title, $contactno
        ]);

        if ($success) {
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
