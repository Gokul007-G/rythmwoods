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

    //total posters count
    $totalCount = $con->prepare("SELECT count(id) as totalCount FROM `posters` WHERE username_id = :usernameId");
    $totalCount->bindParam(':usernameId', $usernameId);
    $totalCount->execute();
    $countRow = $totalCount->fetch(PDO::FETCH_ASSOC);

    echo json_encode([
        'status' => true,
        'totalPosters' => $countRow['totalCount'],
    ]);
} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'message' => 'DB Error'
    ]);
}
