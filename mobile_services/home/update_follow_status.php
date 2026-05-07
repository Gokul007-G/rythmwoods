<?php
session_start();
ini_set('display_errors', 1);

header('Content-Type: application/json');


include('../auth.php');

$follower_id = $_POST['follower_id'] ?? $_GET['follower_id'] ?? '';
$following_id = $_POST['following_id'] ?? $_GET['following_id'] ?? '';

if (empty($follower_id) || empty($following_id)) {
    echo json_encode([
        'status' => false,
        'message' => 'follower_id and following_id required'
    ]);
    exit;
}

try {
    // Check if already exists
    $check = $con->prepare("SELECT * FROM following_details 
            WHERE follower_id = ? AND following_id = ?
        ");
    $check->execute([$follower_id, $following_id]);

    if ($check->rowCount() == 0) {

        // Insert new follow
        $stmt = $con->prepare("INSERT INTO following_details 
                (follower_id, following_id, following_sts, created_on) 
                VALUES (?, ?, 1, NOW())
            ");

        $stmt->execute([$follower_id, $following_id]);
        echo json_encode([
            'status' => true,
            'follower_id' => $follower_id,
            'following_id' => $following_id,
            'message' => 'New follower Added'
        ]);
    } else {
        // 🔥 Fetch existing row
        $row = $check->fetch(PDO::FETCH_ASSOC);

        // 🔥 Toggle status (1 → 0, 0 → 1)
        // 1 follow || 0 unfollow
        $followStatus = $row['following_sts'] == 1 ? 0 : 1;

        // Already exists → just update status
        $update = $con->prepare("UPDATE following_details 
            SET following_sts = ? 
            WHERE follower_id = ? AND following_id = ?");

        $update->execute([$followStatus, $follower_id, $following_id]);
        echo json_encode([
            'status' => true,
            'follower_id' => $follower_id,
            'following_id' => $following_id,
            'followStatus' => $followStatus,
            'message' => 'follower updated'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'message' => 'DB Error'
    ]);
}
