<?php
include "db.php";
$user_id = $_SESSION['user_id'];

$result = $conn->query("SELECT * FROM verification_requests WHERE user_id = $user_id AND status = 'pending'");
if ($result->num_rows == 0) {
    $stmt = $conn->prepare("INSERT INTO verification_requests (user_id) VALUES (?)");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
}

header("Location: profile_verif.php");
