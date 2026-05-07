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
    $follower = $con->prepare("SELECT um.users_id, um.user_name, um.profile_img
        FROM user_master um
        LEFT JOIN following_details fd 
        ON um.users_id = fd.following_id AND fd.follower_id = 3
        WHERE um.users_id = :usernameId
        OR (fd.following_sts = 1)
        ORDER BY (um.users_id = :usernameId) DESC;");
    $follower->bindParam(':usernameId', $usernameId);
    $follower->execute();
    $followerrow = $follower->fetchAll(PDO::FETCH_ASSOC);


    //get the following
    // $following = $con->prepare("SELECT COUNT(following_id) AS followingCount FROM `following_details` WHERE following_id = :usernameId;");
    // $following->bindParam(':usernameId', $usernameId);
    // $following->execute();
    // $followingrow = $following->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => true,
        'data' =>  $followerrow,
        // 'following' => $followingrow['followingCount']

    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'message' => 'DB Error'
    ]);
}
