<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

header('Content-Type: application/json');

require('../../connect.php');

$email = $_GET['email'] ?? '';
$password = $_GET['password'] ?? '';
$md5password = md5($password);

try {
    if (!isset($con)) {
        echo json_encode([
            'status' => false,
            'message' => 'DB connection not loaded',
        ]);
        exit;
    }
    $query = $con->prepare("SELECT * FROM user_master WHERE email = :email");
    $query->bindParam(':email', $email);
    $query->execute();

    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user) {

        // ✅ Compare password (use password_hash in DB)
        if (password_verify($password, $user['password'])) {
            // ✅ Generate token
            $token = bin2hex(random_bytes(32));

            // ✅ Store token in DB (important)
            $update = $con->prepare("UPDATE user_master SET apptoken = :token WHERE id = :id");
            $update->bindParam(':token', $token);
            $update->bindParam(':id', $user['id']);
            $update->execute();

            echo json_encode([
                'status' => true,
                'message' => 'Login successful',
                // 'user' => $user,

                'user' => [
                    'userid' => $user['users_id'],
                    'email' => $user['email'],
                    'username' => $user['user_name'],
                    'token' => $token,
                    'title' => $user['title'],
                    'profile_img' => $user['profile_img'],
                    'name' => $user['name'],
                    'role_master_id' => $user['role_master_id'],
                ]
            ]);
        } else {
            echo json_encode([
                'status' => false,
                'message' => 'Invalid password',
            ]);
        }
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'User not found',
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'message' => 'DB Error',
        'e' => $e
    ]);
}
