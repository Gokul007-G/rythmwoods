<?php
// connect to database
$pdo = new PDO("mysql:host=localhost;dbname=messenger", "root", "");

$query = "SELECT m.message, m.sent_at, u.username FROM messages m 
          JOIN users u ON m.sender_id = u.id 
          WHERE (m.sender_id = 1 AND m.receiver_id = 2) 
          OR (m.sender_id = 2 AND m.receiver_id = 1)
          ORDER BY m.sent_at";

$stmt = $pdo->query($query);
$messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

echo json_encode($messages);
?>
