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

    //get the user profile picture
    $profile = $con->prepare("SELECT profile_img FROM `user_master` WHERE users_id  = :usernameId");
    $profile->bindParam(':usernameId', $usernameId);
    $profile->execute();
    $profileRow = $profile->fetch(PDO::FETCH_ASSOC);

    //total posters count
    $totalCount = $con->prepare("SELECT * FROM `posters` WHERE username_id = :usernameId");
    $totalCount->bindParam(':usernameId', $usernameId);
    $totalCount->execute();
    $countRow = $totalCount->fetchAll(PDO::FETCH_ASSOC);

    //get the follower and following count

    $query = $con->prepare("SELECT u.profile_img AS userProfile ,
        CASE 
        WHEN pd.poster_id IS NOT NULL THEN true 
        ELSE false 
    END AS isSaved,
    p.*
    FROM posters p
    LEFT JOIN poster_download pd ON pd.poster_id = p.poster_id AND pd.downloader_id = :usernameId  AND pd.donwload_sts = 1
    LEFT JOIN user_master u ON p.username_id = u.users_id
    WHERE p.username_id = :usernameId AND  p.status = '1' AND p.post_type = 'image'
    ORDER BY p.id DESC");
    $query->bindParam(':usernameId', $usernameId);
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => true,
        // 'profile' => $profileRow['profile_img'],
        // 'totalCount' => count($countRow),
        'data' => $row
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'message' => 'DB Error'
    ]);
}
