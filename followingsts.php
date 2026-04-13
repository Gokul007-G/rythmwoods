<?php
session_start();
include("connect.php");

// Logged-in user (UNIQUE ID)
$follower_id = $_SESSION['users_id'] ?? 0;

// Target user (whom to follow/unfollow)
$following_id = $_POST['user_id'] ?? 0;

// Action (1 = follow, 0 = unfollow)
$followingsts = $_POST['followingsts'] ?? '';

if (!$follower_id || !$following_id) {
    echo 0;
    exit;
}

try {

    // ✅ FOLLOW
    if ($followingsts == 1) {

        // Check if already exists
        $check = $con->prepare("
            SELECT id FROM following_details 
            WHERE follower_id = ? AND following_id = ?
        ");
        $check->execute([$follower_id, $following_id]);

        if ($check->rowCount() == 0) {

            // Insert new follow
            $stmt = $con->prepare("
                INSERT INTO following_details 
                (follower_id, following_id, following_sts, created_on) 
                VALUES (?, ?, 1, NOW())
            ");

            echo $stmt->execute([$follower_id, $following_id]) ? 1 : 0;

        } else {

            // Already exists → just update status
            $update = $con->prepare("
                UPDATE following_details 
                SET following_sts = 1 
                WHERE follower_id = ? AND following_id = ?
            ");

            echo $update->execute([$follower_id, $following_id]) ? 1 : 0;
        }
    }

    // ✅ UNFOLLOW
    if ($followingsts == 0) {

        $stmt = $con->prepare("
            UPDATE following_details 
            SET following_sts = 0 
            WHERE follower_id = ? AND following_id = ?
        ");

        echo $stmt->execute([$follower_id, $following_id]) ? 1 : 0;
    }

} catch (PDOException $e) {
    echo 0;
}
?>