<?php
session_start();
include("includes/config.php");

if(!isset($_SESSION['users_id'])){
    exit("unauthorized");
}

$sender = $_SESSION['users_id'];
$receiver = $_POST['receiver_id'] ?? 0;
$message = trim($_POST['message'] ?? '');

if($receiver == 0 || $message == ''){
    exit;
}

$stmt = $con->prepare("
    INSERT INTO messages (sender_id, receiver_id, message, timestamp, is_read)
    VALUES (?, ?, ?, NOW(), 0)
");

$stmt->execute([$sender, $receiver, $message]);

echo 1;
?>