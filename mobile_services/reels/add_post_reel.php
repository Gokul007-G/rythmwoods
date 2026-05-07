<?php
session_start();
ini_set('display_errors', 0);

header('Content-Type: application/json');

include('../auth.php');

// require('../../connect.php');

try {

    $userName = $_POST['username'];
    $userId   = $_POST['user_id'];
    $postId   = $_POST['post_id'];
    $postType = $_POST['post_type'] ?? 'image';
    $location = $_POST['location'] ?? '';
    $caption  = $_POST['caption'] ?? '';

    $postImg = "";
    $postVideo = "";

    $uploadDir = $_SERVER['DOCUMENT_ROOT'];

    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    if (!isset($userName) && !isset($userId)) {
        echo json_encode([
            'status' => false,
            'message' => 'Username and UserId Requried'
        ]);
        exit();
    }

    //// ✅ IMAGE UPLOAD
    if (isset($_FILES['post_img']) && $_FILES['post_img']['error'] == 0) {

        $tmpName = $_FILES['post_img']['tmp_name'];
        $original = $_FILES['post_img']['name'];

        $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));
        $allowed = ['jpg', 'jpeg', 'png', 'webp'];

        if (!in_array($ext, $allowed)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid image']);
            exit;
        }

        $postImg = '/rythm/posters/IMG_' . time() . rand(1000, 9999) . "." . $ext;

        move_uploaded_file($tmpName, $uploadDir . $postImg);
    }

    //// ✅ VIDEO UPLOAD
    if (isset($_FILES['post_video']) && $_FILES['post_video']['error'] == 0) {

        $tmpName = $_FILES['post_video']['tmp_name'];
        $original = $_FILES['post_video']['name'];

        $ext = strtolower(pathinfo($original, PATHINFO_EXTENSION));
        $allowed = ['mp4'];

        if (!in_array($ext, $allowed)) {
            echo json_encode(['status' => 'error', 'message' => 'Invalid video']);
            exit;
        }

        $postVideo = '/rythm/posters/VID_' . time() . rand(1000, 9999) . "." . $ext;

        move_uploaded_file($tmpName, $uploadDir . $postVideo);
    }

    //// ✅ INSERT QUERY (FIXED)
    $sql = $con->prepare("INSERT INTO posters 
(username, username_id, poster_id, post_type, postimg, postvideos, location, posters_caption, likestatus, liker_id, likesdate, ownlikessts, status, created_on, filepath) 
VALUES 
(:userName, :userId, :postId, :postType, :postImg, :postVideo, :location, :caption, 0, 0, NOW(), 0, 1, NOW(), '')");

    $sql->execute([
        ':userName' => $userName,
        ':userId' => $userId,
        ':postId' => $postId,
        ':postType' => $postType,
        ':postImg' => $postImg,
        ':postVideo' => $postVideo,
        ':location' => $location,
        ':caption' => $caption,
    ]);

    // Get the last inserted post ID
    $postId = $con->lastInsertId();

    // Update poster_id in the same row
    $updateStmt = $con->prepare("UPDATE posters SET poster_id = ? WHERE id = ?");
    $updateStmt->execute([$postId, $postId]);

    echo json_encode([
        'status' => true,
        'message' => 'Post uploaded successfully',
        'image' => $postImg,
        'video' => $postVideo
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'message' => 'DB Error'
    ]);
}
