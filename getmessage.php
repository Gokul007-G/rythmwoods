<?php
include 'connect.php';

$sender_id = $_GET['sender_id'];
$receiver_id = $_GET['receiver_id'];

$sql = "SELECT * FROM messages 
        WHERE (sender_id = :sender_id AND receiver_id = :receiver_id) 
        OR (sender_id = :receiver_id AND receiver_id = :sender_id)
        ORDER BY timestamp ASC";

$stmt = $con->prepare($sql);
$stmt->execute(['sender_id' => $sender_id, 'receiver_id' => $receiver_id]);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($messages);
?>
