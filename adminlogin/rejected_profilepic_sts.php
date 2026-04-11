<?php
session_start();

require("connect.php");	

$username = $_SESSION['username'];
 $rolemaster_id = $_SESSION['role_master_id'];
 
$id=$_REQUEST['id'];
$reason=$_REQUEST['reason'];

$detuser=$con->query("SELECT * FROM `user_master`where role_master_id='$id'");

 $profiledtils = $detuser->fetch(PDO::FETCH_ASSOC);
	  
 // $rolemasterid=$profiledtils['role_master_id'];

//$upd1=$con->query("update `user_master` set profilepic_reason='$reason' where role_mater_id='$id'");
$upd2=$con->query("update `profile_photo_uploaded` set admin_status=2,profilepic_reason='$reason' where rolemaster_id='$id'");

if($upd2)
{
	echo 1;
}
else
{
		echo 0;
}
	
?>
