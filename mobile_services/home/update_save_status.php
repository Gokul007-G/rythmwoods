<?php
ini_set('display_errors', 1);
header('Content-Type: application/json');

include('../auth.php');

try {
    $users_id = $_GET['user_id'] ?? '';
    $post_id = $_GET['post_id'] ?? '';

    if (empty($users_id)) {
        echo json_encode([
            'status' => false,
            'message' => 'user id required'
        ]);
        exit();
    }
    if (empty($post_id)) {
        echo json_encode([
            'status' => false,
            'message' => 'post id required'
        ]);
        exit();
    }
    if (!isset($con)) {
        echo json_encode([
            'status' => false,
            'message' => 'DB connection not loaded',
        ]);
        exit;
    }
    // Check if already saved
    $check = $con->prepare("SELECT id, donwload_sts FROM `poster_download` WHERE poster_id = ? AND downloader_id = ?");
    $check->execute([$post_id, $users_id]);
    $existing = $check->fetch();

    if ($existing) {
        // Toggle status
        $new_status = ($existing['donwload_sts'] == '1') ? '0' : '1';
        $stmt = $con->prepare("UPDATE `poster_download` SET donwload_sts = ? WHERE id = ?");
        $stmt->execute([$new_status, $existing['id']]);

        echo json_encode([
            'status' => true,
            'new_status' => $new_status,
            'message' => 'Update status successfully'
        ]);
    } else {
        // New save
        $stmt = $con->prepare("INSERT INTO `poster_download` (poster_id, downloader_id, donwload_sts, created_on) VALUES (?, ?, '1', NOW())");
        $stmt->execute([$post_id, $users_id]);

        echo json_encode([
            'status' => true,
            'message' => 'insert new row successfully'
        ]);
    }
} catch (Exception $e) {
    echo json_encode([
        'status' => false,
        'message' => 'DB Error'
    ]);
}
