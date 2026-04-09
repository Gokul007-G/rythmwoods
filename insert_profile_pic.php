<?php
session_start();
require("connect.php"); 

$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['rolemaster_id'];

// Directory where uploaded files will be saved
$uploadDir = '/wamp62/www/rythm/profile_photos/';

// Create directory if it doesn't exist
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true); // Change permissions as needed
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profileImage'])) {
    $uploadedFile = $_FILES['profileImage'];
    $filePath = $uploadDir . basename($uploadedFile['name']);
    
    if (move_uploaded_file($uploadedFile['tmp_name'], $filePath)) {
		
		$inserrfilepath=trim($filePath,"/wamp62/www/");
		$tobeinsert='/'.$inserrfilepath;
		
        $stmt = $con->query("INSERT INTO `profile_photo_uploaded`(`id`, `rolemaster_id`, `photo_path`, `created_on`, `created_by`) VALUES (NULL,'$rolemaster_id','$tobeinsert',now(),'$username')");
        if($stmt) {
			echo 1;
            //echo "File uploaded successfully.";
        } else {
			echo 0;
           // echo "Error in database insertion.";
        }
    } else {
		echo 0;
       // echo "Error uploading file.";
    }
} else {
	echo 0;
    //echo "No file uploaded.";
}
?>
