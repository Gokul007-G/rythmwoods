<?php 
session_start(); // Start the session

// Check if the video_name field is set in the POST request
if(isset($_FILES["upload_file"])) {
    if (!isset($_SESSION['users_id'])) {
        die("Unauthorized");
    }
    $users_id = $_SESSION['users_id'];
    $username = $_SESSION['username'];
    $filename = $_FILES['upload_file']['name'];

    require("connect.php");

    $videoName = $_FILES["upload_file"]['name'];
    $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/rythm/posters/";

    // Move the uploaded video file to the target directory
    $targetFilePath = $targetDir . $videoName;
    $tempFilePath = $_FILES["upload_file"]["tmp_name"]; // Temporary file path of the uploaded video
    
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }
    
    if(move_uploaded_file($tempFilePath, $targetFilePath)) {

         // Get form data
         $caption = $_POST["posters_caption"] ?? "";
         $location = $_POST["location"] ?? "";
         $hastag = $_POST["posters_hashtag"] ?? "";
         $poster_type = "video"; // Force video type for video uploads

         // Fetch username from DB
         $stmt = $con->prepare("SELECT user_name FROM user_master WHERE id = ?");
         $stmt->execute([$users_id]);
         $user = $stmt->fetch();
         $gotusername = $user["user_name"] ?? $username;

         // Store relative file path
         $insertimgpath = "/rythm/posters/" . $filename;

         // Insert into database
         $stmt = $con->prepare("INSERT INTO posters 
             (username, username_id, poster_id, post_type, postimg, postvideos, location, posters_caption, posters_hashtag, likestatus, liker_id, likesdate, ownlikessts, status, created_on) 
             VALUES (?, ?, 0, ?, '', ?, ?, ?, ?, 0, '', '', 0, 1, NOW())");
         $stmt->execute([$gotusername, $users_id, $poster_type, $insertimgpath, $location, $caption, $hastag]);

         // Get the last inserted post ID
         $postId = $con->lastInsertId();

         // Update poster_id in the same row
         $updateStmt = $con->prepare("UPDATE posters SET poster_id = ? WHERE id = ?");
         $updateStmt->execute([$postId, $postId]);

        // File was successfully uploaded and moved
        echo "1"; 
    } else {
        // Failed to move the file
        echo "0";
    }
} else {
    echo "0";
} 
?>
