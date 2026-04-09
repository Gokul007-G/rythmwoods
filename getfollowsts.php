<?php
session_start();

include("connect.php");
//include("user.php");

$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['rolemaster_id'];
//echo "hiiiiiii";

 $user_id=$_REQUEST['userid'];
 

$folowesuggeslist=$con->query("SELECT * FROM `user_master` where users_id='$user_id'");
//echo "SELECT * FROM `user_master` where id='$user_id'";
$followstsget = $folowesuggeslist->fetch(PDO::FETCH_ASSOC);

echo $followstsget['followsts'];


?>
