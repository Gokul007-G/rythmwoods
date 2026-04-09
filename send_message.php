<?php
include 'connect.php';

$data = json_decode(file_get_contents("php://input"));

$sender_id = $data->sender_id ?? 0;
$receiver_id = $data->receiver_id ?? 0;
$message = $data->message ?? '';

if ($sender_id && $receiver_id && !empty($message)) {
    try {
        $stmt = $con->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?, ?, ?)");
        if ($stmt->execute([$sender_id, $receiver_id, $message])) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "info" => "Execution failed"]);
        }
    } catch (PDOException $e) {
        echo json_encode(["status" => "error", "message" => $e->getMessage()]);
    }
} else {
    echo json_encode(["status" => "error", "info" => "Invalid input"]);
}
?>
