<?php
session_start();

include("connect.php");
//include("user.php");

$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['rolemaster_id'];
//echo "hiiiiiii";

 $followingsts=$_REQUEST['followingsts'];
 $user_id=$_REQUEST['user_id'];
 

if ($followingsts == 1 && !empty($user_id)) {
    try {
        // Check if already following
        $check = $con->prepare("SELECT id FROM following_details WHERE user_id = ? AND role_master_id = ?");
        $check->execute([$user_id, $rolemaster_id]);
        
        if ($check->rowCount() == 0) {
            $stmt = $con->prepare("INSERT INTO `following_details` (`user_id`, `role_master_id`, `following_sts`, `created_on`) VALUES (?, ?, '1', CURDATE())");
            if ($stmt->execute([$user_id, $rolemaster_id])) {
                // Update user_master to mark as followed (if that's the logic)
                $con->prepare("UPDATE `user_master` SET `followsts` = '1' WHERE `role_master_id` = ?")->execute([$user_id]);
                echo 1;
            } else {
                echo 0;
            }
        } else {
            // Already following, maybe toggle/unfollow logic if needed, but for now just success
            echo 1;
        }
    } catch (PDOException $e) {
        echo 0;
    }
} else if ($followingsts == 0 && !empty($user_id)) {
    // Unfollow logic
    try {
        $stmt = $con->prepare("DELETE FROM following_details WHERE user_id = ? AND role_master_id = ?");
        if ($stmt->execute([$user_id, $rolemaster_id])) {
            echo 1;
        } else {
            echo 0;
        }
    } catch (PDOException $e) {
        echo 0;
    }
}

?>
