<?php
session_start();
ini_set('display_errors', 0);

header('Content-Type: application/json');

// require('../../connect.php');
include('../auth.php');

$usernameId = $_GET['username_id'] ?? '';

try {
    if (empty($usernameId)) {
        echo json_encode([
            'status' => false,
            'message' => 'username Id required'
        ]);
        exit();
    }

    //get the follower 
    $follower = $con->prepare("SELECT COUNT(follower_id) AS followerCount FROM `following_details` WHERE follower_id = :usernameId;");
    $follower->bindParam(':usernameId', $usernameId);
    $follower->execute();
    $followerrow = $follower->fetch(PDO::FETCH_ASSOC);

    //get the following
    $following = $con->prepare("SELECT COUNT(following_id) AS followingCount FROM `following_details` WHERE following_id = :usernameId;");
    $following->bindParam(':usernameId', $usernameId);
    $following->execute();
    $followingrow = $following->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => true,
        'data' => [
            'followers' => $followerrow['followerCount'],
            'following' => $followingrow['followingCount']
        ]
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'message' => 'DB Error'
    ]);
}
