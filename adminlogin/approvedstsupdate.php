<?php
session_start();

require("connect.php");	

$username = $_SESSION['username'];
 $rolemaster_id = $_SESSION['role_master_id'];
 
$id=$_REQUEST['id'];

$detuser=$con->query("SELECT * FROM `user_master`where id='$id'");

 $profiledtils = $detuser->fetch(PDO::FETCH_ASSOC);
	  
  $rolemasterid=$profiledtils['role_master_id'];

$upd1=$con->query("update `user_master` set admin_status=1 where id='$id'");
$upd2=$con->query("update `profile_details` set admin_status=1 where rolemaster_id='$rolemasterid'");

if($upd1 && $upd2)
{
	echo 1;
}
else
{
		echo 0;
}
	
?>
