<?php
session_start();

include("connect.php");
//include("user.php");

$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['rolemaster_id'];
//echo "hiiiiiii";

  $user_id=$_REQUEST['userid'];
 

$updatequery=$con->query("DELETE FROM `following_details`  where user_id='$user_id'");

//echo "DELETE FROM `following_details`  where id='$user_id'";
if($updatequery)
{
	
 $updateQuery = $con->query("UPDATE `user_master` SET `followsts` = '0' WHERE `id` = '$user_id'");
 
echo 1;	


}
else
{
	echo 0;
}



?>
