<?php

session_start();
require('connect.php');

$username = trim($_POST['Inputusername'] ?? '');
$password = trim($_POST['InputPassword'] ?? '');

if ($username == '' || $password == '') {
    die("Empty input");
}


$stmt = $con->prepare("SELECT * FROM user_master WHERE email = ?");
$stmt->execute([$username]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user) {

 
    if (password_verify($password, $user['password'])) {

       
        if ($user['is_verified'] == 0) {
            echo "<script>alert('Please verify your email first')</script>";
            echo "<script>window.location='verify.php?email=".$user['email']."'</script>";
            exit;
        }

      
        $_SESSION['users_id'] = $user['id'];
        $_SESSION['username'] = $user['email'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['role_master_id'] = $user['role_master_id'];
        $_SESSION['title'] = $user['title'];

        $_SESSION['start'] = time();
        $_SESSION['expire'] = $_SESSION['start'] + (60 * 60); 

        
        if ($user['profile_update_status'] != 1) {
            header('Location:profilecreate.php');
        } else {
            header('Location:../home.php');
        }

    } else {
        echo "<script>alert('Wrong Password')</script>";
        echo "<script>window.location='login.php'</script>";
    }

} else {
    echo "<script>alert('User not found')</script>";
    echo "<script>window.location='login.php'</script>";
}
?>