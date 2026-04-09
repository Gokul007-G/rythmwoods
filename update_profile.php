<?php
session_start();
require_once("includes/config.php");

if (!isset($_SESSION['users_id'])) {
    exit("Unauthorized");
}

$users_id = $_SESSION['users_id'];
$name = $_POST['name'];
$user_name = $_POST['user_name'];
$title = $_POST['title'];
$mobile_no = $_POST['mobile_no'];

$profile_img_path = "";
if (isset($_FILES['profile_img']) && $_FILES['profile_img']['error'] == 0) {
    $upload_dir = "C:/xampp/htdocs/rythm/profile_photos/";
    if (!file_exists($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }
    $file_ext = pathinfo($_FILES['profile_img']['name'], PATHINFO_EXTENSION);
    $file_name = "user_" . $users_id . "_" . time() . "." . $file_ext;
    $target_file = $upload_dir . $file_name;

    if (move_uploaded_file($_FILES['profile_img']['tmp_name'], $target_file)) {
        $profile_img_path = "/rythm/profile_photos/" . $file_name;
    }
}

try {
    if (!empty($profile_img_path)) {
        $stmt = $con->prepare("UPDATE `user_master` SET `name`=?, `user_name`=?, `title`=?, `mobile_no`=?, `profile_img`=? WHERE `id`=?");
        $stmt->execute([$name, $user_name, $title, $mobile_no, $profile_img_path, $users_id]);
        $_SESSION['profile_img'] = $profile_img_path; // Update session
    } else {
        $stmt = $con->prepare("UPDATE `user_master` SET `name`=?, `user_name`=?, `title`=?, `mobile_no`=? WHERE `id`=?");
        $stmt->execute([$name, $user_name, $title, $mobile_no, $users_id]);
    }
    
    $_SESSION['username'] = $user_name; // Update session
    header("Location: profile.php?status=updated");
} catch (PDOException $e) {
    header("Location: editprofile.php?status=error&msg=" . urlencode($e->getMessage()));
}
exit();
?>
