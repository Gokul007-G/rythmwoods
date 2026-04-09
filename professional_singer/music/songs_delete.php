<?php
require '../../connect.php';
// include("../../user.php");

$id=$_REQUEST['id'];
//echo "<pre>";print_r($candidate_id);exit();
 

$sql2= $con->query("DELETE FROM song_master WHERE  id='$id'");
	//echo "DELETE FROM movies WHERE where id='$id'";
?>