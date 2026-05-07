<?php
session_start();
ini_set('display_errors', 0);

header('Content-Type: application/json');

include('../auth.php');

$usernameId = $_POST['username_id'] ?? '';

try {
    // Handle Profile Image Upload
    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] === 0) {

        $tmp_name = $_FILES['profile_img']['tmp_name'];

        $ext = strtolower(pathinfo($_FILES['profile_img']['name'], PATHINFO_EXTENSION));
        $new_name = time() . "." . $ext;

        $upload_dir = dirname(__DIR__, 2) . "/uploads/profile/";
        $upload_path = $upload_dir . $new_name;

        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        if (move_uploaded_file($tmp_name, $upload_path)) {

            $stmt = $con->prepare("UPDATE user_master SET profile_img=? WHERE users_id=?");
            $stmt->execute(["uploads/profile/" . $new_name, $usernameId]);

            echo json_encode([
                'status' => true,
                'message' => 'Successfully updated',
                'image' => $new_name,
                'usernameId' => $usernameId,
                'upload_path' => $upload_path,

            ]);
        }
    } else {
        echo json_encode([
            'status' => false,
            'message' => 'image error'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'message' => 'DB Error'
    ]);
}
