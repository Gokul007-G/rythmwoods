<?php
include "db.php";
$id = $_GET['id'];
$action = $_GET['action'];

if ($action === 'approve') {
    $stmt = $conn->prepare("
        UPDATE verification_requests vr 
        JOIN users u ON vr.user_id = u.id 
        SET vr.status = 'approved', u.verified = 1 
        WHERE vr.id = ?
    ");
} else {
    $stmt = $conn->prepare("UPDATE verification_requests SET status = 'rejected' WHERE id = ?");
}

$stmt->bind_param("i", $id);
$stmt->execute();
header("Location: admin_verifications.php");
