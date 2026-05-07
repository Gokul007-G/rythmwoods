<?php
session_start();
ini_set('display_errors', 0);

header('Content-Type: application/json');

// require('../../connect.php');
include('../auth.php');


try {
    $query = $con->prepare("SELECT * FROM `posters` WHERE status = '1' AND post_type = 'video' order by id desc");
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
