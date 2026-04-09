<?php
include "connect.php";
$id = $_GET['id'];
$action = $_GET['action'];

if ($action === 'approve') {
    $stmt = $con->prepare("
        UPDATE verification_requests vr 
        JOIN user_master u ON vr.user_id = u.id 
        SET vr.status = 'approved', u.verified = 1 
        WHERE vr.id = ?
    ");
} else {
    $stmt = $con->prepare("UPDATE verification_requests SET status = 'rejected' WHERE id = ?");
}

$stmt->execute([$id]);
header("Location: admin_verifications.php");
exit();
