<?php
//print_r($_POST);
//print_r($_FILES);


/*session_start(); // Start the session
$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['rolemaster_id'];
require("connect.php");	


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file is uploaded
    if(isset($_FILES["upload_file"]) && $_FILES["upload_file"]["error"] == UPLOAD_ERR_OK) {
        // Define a target directory for file portfolio
        $targetDir = "/xampp/htdocs/rythm/posters/";

        // Create the target directory if it doesn't exist
        if (!file_exists(filename: $targetDir)) {
            mkdir(directory: $targetDir, permissions: 0777, recursive: true);
        }

        // Get the filename
        $filename = basename(path: $_FILES["upload_file"]["name"]);

        // Construct the full path
        $targetFilePath = $targetDir . $filename;

        // Move the uploaded file to the target directory
        if (move_uploaded_file(from: $_FILES["upload_file"]["tmp_name"], to: $targetFilePath)) {
            // Insert data into database
            $caption = $_POST["caption"];
            $location = $_POST["location"];
            $poster_type = $_POST['poster_type'];
            $getusername = $con->query("SELECT * FROM `user_master` where role_master_id='$rolemaster_id'");
            $usernameget = $getusername->fetch();
            $gotusername = $usernameget['user_name'];
              
			  
			  $imgpattht=trim(string: $targetFilePath,characters: "/xampp/htdocs/");
			  $insertimgpath='/'.$imgpattht;
            // Perform the database insertion here
             $stmt = $con->query("INSERT INTO `posters`(`id`, `username`, `username_id`, `poster_id`, `post_type`, `postimg`, `postvideos`, `location`, `posters_caption`, `likestatus`, `liker_id`, `likesdate`, `ownlikessts`, `status`, `created_on`) VALUES (NULL,'$gotusername','$rolemaster_id','0','$poster_type','$insertimgpath','','$location','$caption','0','','','0','1',now())");
			 
			 if($stmt)
			 {
				 $getpostid=$con->query("SELECT * FROM `posters` where username_id='$rolemaster_id' order by id desc");
				 
				 $getidd=$getpostid->fetch();
				 $id=$getidd['id'];
				 $updque=$con->query("UPDATE `posters` SET `poster_id`='$id' where id='$id'");
				 
				 if($updque)
				 {
					 echo 1;
				 }
				 
			 }
			 else
			 {
				 echo 0;
			 }
			 
			//echo "INSERT INTO `posters`(`id`, `username`, `username_id`, `poster_id`, `post_type`, `postimg`, `postvideos`, `location`, `posters_caption`, `likestatus`, `liker_id`, `likesdate`, `ownlikessts`, `status`, `created_on`) VALUES (NULL,'$gotusername','$rolemaster_id','0','$poster_type','$targetFilePath','','$location','$caption','0','','','0','1',now())";

           // echo "Data inserted successfully";
        } else {
            echo 0;
        }
    } else {
        echo 0;
    }
}*/

session_start(); // Start the session

require("connect.php");	

if (!isset($_SESSION['username']) || !isset($_SESSION['users_id'])) {
    die("Unauthorized access!");
}

$username = $_SESSION['username'];
$users_id = $_SESSION['users_id'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file is uploaded
    if (isset($_FILES["upload_file"]) && $_FILES["upload_file"]["error"] == UPLOAD_ERR_OK) {
        
        // Define target directory
        $targetDir = $_SERVER['DOCUMENT_ROOT'] . "/rythm/posters/";

        // Create the target directory if it doesn't exist
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        // Get the filename and construct the full path
        $filename = basename($_FILES["upload_file"]["name"]);
        $targetFilePath = $targetDir . $filename;
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["upload_file"]["tmp_name"], $targetFilePath)) {

            // Get form data
            $caption = $_POST["posters_caption"] ?? "";
            $hastag = $_POST["posters_hashtag"] ?? "";
            $location = $_POST["location"] ?? "";
            $poster_type = $_POST["poster_type"] ?? "";

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
                VALUES (?, ?, 0, ?, ?, '', ?, ?, ?, 0, '', '', 0, 1, NOW())");
            $stmt->execute([$gotusername, $users_id, $poster_type, $insertimgpath, $location, $caption, $hastag]);

            // Get the last inserted post ID
            $postId = $con->lastInsertId();

            // Update poster_id in the same row
            $updateStmt = $con->prepare("UPDATE posters SET poster_id = ? WHERE id = ?");
            $updateStmt->execute(params: [$postId, $postId]);

            echo 1; // Success
        } else {
            echo 0; // File move failed
        }
    } else {
        echo 0; // No file uploaded or upload error
    }
}
?>



