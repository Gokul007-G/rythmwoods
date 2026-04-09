<?php

session_start();
require("connect.php");

$user_id = $_SESSION['user_id'] ?? 0;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['user_name'] ?? '';
    //$bio = $_POST['bio'] ?? '';

    // Profile picture upload
    if (!empty($_FILES['profile_img']['name'])) {
        $uploadDir = "/rythm/posters";
        $fileName = basename($_FILES["profile_img"]["name"]);
        $targetFilePath = $uploadDir . $fileName;

        // Move uploaded file
        if (move_uploaded_file($_FILES["profile_img"]["tmp_name"], $targetFilePath)) {
            $profile_pic = $targetFilePath;
        } else {
            echo "❌ Error uploading profile picture.";
            exit;
        }
    } else {
        // Keep the old profile picture if not changed
        $profile_pic_query = "SELECT profile_img FROM user_master WHERE id = ?";
        $stmt = $conn->prepare($profile_pic_query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $profile_pic = $row['profile_img'];
    }

    // Update user details
    $stmt = $conn->prepare("UPDATE user_master SET user_name = ?, profile_img = ? WHERE id = ?");
    $stmt->bind_param("sssi", $username, $profile_pic, $user_id);

    if ($stmt->execute()) {
        echo "✅ Profile updated successfully!";
        header("Location: profile.php");
        exit();
    } else {
        echo "❌ Error updating profile.";
    }

    $stmt->close();
}

$conn->close();
?>


