<?php
session_start();
ini_set('display_errors', 1);

header('Content-Type: application/json');


include('../auth.php');

$user_id = $_POST['users_id'] ?? $_GET['users_id'] ?? 0;

$post_id = $_POST['post_id'] ?? $_GET['post_id'] ?? 0;

if ($user_id == 0 && $post_id == 0) {
    echo json_encode([
        'status' => false,
        'message' => 'User Id & post Id Requried'
    ]);
    exit();
}
try {
    // check already liked
    $check = $con->prepare("SELECT * FROM poster_likes WHERE post_id=? AND user_id=?");
    $check->execute([$post_id, $user_id]);
    $row = $check->fetch(PDO::FETCH_ASSOC);

    if ($row) {
        // toggle like status instead of always setting 1
        $like_status = ($row['like_status'] == '1') ? 0 : 1;

        $stmt = $con->prepare("UPDATE poster_likes SET like_status=? WHERE post_id=? AND user_id=?");
        $stmt->execute([$like_status, $post_id, $user_id]);

        echo json_encode([
            'status' => true,
            'message' => 'updated successfully',
            'like_status' => $like_status
        ]);
        exit();
    } else {
        // first time like → default = 1
        $stmt = $con->prepare("INSERT INTO poster_likes (post_id, user_id, like_status) VALUES (?, ?, 1)");
        $stmt->execute([$post_id, $user_id]);

        echo json_encode([
            'status' => true,
            'message' => 'like Added successfully',
            'like_status' => 1
        ]);
        exit();
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'message' => 'DB Error'
    ]);
}
