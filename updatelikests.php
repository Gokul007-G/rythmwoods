<?php
include("includes/config.php");

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user_id = $_SESSION['users_id'] ?? 0;

$post_id = $_POST['post_id'];
$like_status = $_POST['like_status'];

if ($user_id == 0) {
    echo "0";
    exit;
}

// check already liked
$check = $con->prepare("SELECT * FROM poster_likes WHERE post_id=? AND user_id=?");
$check->execute([$post_id, $user_id]);
$row = $check->fetch(PDO::FETCH_ASSOC);

if ($row) {

    $stmt = $con->prepare("UPDATE poster_likes SET like_status=? WHERE post_id=? AND user_id=?");
    $stmt->execute([$like_status, $post_id, $user_id]);

} else {

    $stmt = $con->prepare("INSERT INTO poster_likes (post_id, user_id, like_status) VALUES (?, ?, ?)");
    $stmt->execute([$post_id, $user_id, $like_status]);
}

// return updated count
$count = $con->prepare("SELECT COUNT(*) as cnt FROM poster_likes WHERE post_id=? AND like_status=1");
$count->execute([$post_id]);
$data = $count->fetch(PDO::FETCH_ASSOC);

echo $data['cnt'];
?>