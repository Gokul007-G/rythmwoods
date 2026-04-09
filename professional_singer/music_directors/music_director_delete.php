<?php
require '../../connect.php';


$id=$_REQUEST['id'];
//echo "<pre>";print_r($candidate_id);exit();
 

$sql2= $con->query("DELETE FROM music_directors WHERE  id='$id'");
	//echo "DELETE FROM movies WHERE where id='$id'";
?>