<?php
session_start();
require_once("includes/config.php");

if (!isset($_SESSION['users_id'])) {
    exit("unauthorized");
}

$users_id = $_SESSION['users_id'];
$post_id = $_POST['post_id'] ?? 0;

if ($post_id == 0) {
    exit("invalid_post");
}

try {
    // Check if already saved
    $check = $con->prepare("SELECT id, donwload_sts FROM `poster_download` WHERE poster_id = ? AND downloader_id = ?");
    $check->execute([$post_id, $users_id]);
    $existing = $check->fetch();
    
    if ($existing) {
        // Toggle status
        $new_status = ($existing['donwload_sts'] == '1') ? '0' : '1';
        $stmt = $con->prepare("UPDATE `poster_download` SET donwload_sts = ? WHERE id = ?");
        $stmt->execute([$new_status, $existing['id']]);
        echo $new_status; // Return the new status
    } else {
        // New save
        $stmt = $con->prepare("INSERT INTO `poster_download` (poster_id, downloader_id, donwload_sts, created_on) VALUES (?, ?, '1', NOW())");
        $stmt->execute([$post_id, $users_id]);
        echo "1";
    }
} catch (PDOException $e) {
    echo "0";
}
?>
