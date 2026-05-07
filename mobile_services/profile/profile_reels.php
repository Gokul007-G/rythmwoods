<?php
session_start();
ini_set('display_errors', 1);

header('Content-Type: application/json');


include('../auth.php');

$userId = $_GET['username_id'] ?? '';

try {
    if (empty($userId)) {
        echo json_encode([
            'status' => false,
            'message' => 'userId Requried'
        ]);
        exit();
    }

    $query = $con->prepare("SELECT u.profile_img AS userProfile ,
        CASE 
        WHEN pd.poster_id IS NOT NULL THEN true 
        ELSE false 
    END AS isSaved,
    p.*
    FROM posters p
    LEFT JOIN poster_download pd ON pd.poster_id = p.poster_id AND pd.downloader_id = :usernameId  AND pd.donwload_sts = 1
    LEFT JOIN user_master u ON p.username_id = u.users_id
    WHERE p.username_id = :usernameId AND  p.status = '1' AND p.post_type = 'video'
    ORDER BY p.id DESC");
    $query->bindParam(':usernameId', $userId);
    $query->execute();
    $row = $query->fetchAll(PDO::FETCH_ASSOC);


    echo json_encode([
        'status' => true,
        'data' => $row
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'message' => 'DB Error'
    ]);
}
