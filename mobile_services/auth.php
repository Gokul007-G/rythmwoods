<?php
// require('../connect.php');
require(__DIR__ . '/../connect.php'); // 🔥 FIXED

// $headers = array_change_key_case(getallheaders(), CASE_LOWER);

// $token = '';

// if (isset($headers['authorization'])) {
//     $authHeader = $headers['authorization'];
//     $token = str_replace('Bearer ', '', $authHeader);
// }

// //server token
// $token = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

// $headers = getallheaders();
// $token = '';

// if (isset($headers['Authorization'])) {
//     $authHeader = $headers['Authorization'];
//     $token = str_replace('Bearer ', '', $authHeader);
// }

// $headers = getallheaders();

// $token = '';

// // 1. Standard way
// if (isset($headers['Authorization'])) {
//     $token = $headers['Authorization'];
// }

// // 2. Apache / Nginx fallback
// elseif (isset($_SERVER['HTTP_AUTHORIZATION'])) {
//     $token = $_SERVER['HTTP_AUTHORIZATION'];
// }

// // 3. Another fallback (sometimes needed)
// elseif (function_exists('apache_request_headers')) {
//     $requestHeaders = apache_request_headers();
//     if (isset($requestHeaders['Authorization'])) {
//         $token = $requestHeaders['Authorization'];
//     }
// }

// // Remove "Bearer "
// $token = str_replace('Bearer ', '', $token);


$token = '';

// 1. Try getallheaders()
if (function_exists('getallheaders')) {
    $headers = array_change_key_case(getallheaders(), CASE_LOWER);

    if (isset($headers['authorization'])) {
        $token = $headers['authorization'];
    }
}

// 2. Fallback for server environments
if (empty($token) && isset($_SERVER['HTTP_AUTHORIZATION'])) {
    $token = $_SERVER['HTTP_AUTHORIZATION'];
}

// 3. Apache fallback
if (empty($token) && function_exists('apache_request_headers')) {
    $requestHeaders = array_change_key_case(apache_request_headers(), CASE_LOWER);

    if (isset($requestHeaders['authorization'])) {
        $token = $requestHeaders['authorization'];
    }
}

// Remove "Bearer "
$token = str_replace('Bearer ', '', $token);

if (!$token) {
    echo json_encode([
        'status' => false,
        'message' => 'token missing',
        'token' => $token
    ]);
    exit();
}

$query = $con->prepare("SELECT * FROM user_master WHERE apptoken = :token");
$query->execute(['token' => $token]);

$user = $query->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo json_encode([
        'status' => false,
        'message' => 'Invalid token',
        'token' => $token
    ]);
    exit;
}
