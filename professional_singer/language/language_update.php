<?php
require '../../connect.php';



//echo "<pre>";print_r($candidate_id);exit();
 $id=$_REQUEST['get_id'];
 $language_name=$_REQUEST['language_name'];
$status=$_REQUEST['status'];

$sql2= $con->query("Update languages set language_name='$language_name',status='$status' where id='$id'");
	//echo "Update movies set movie_name='$movie_name',year='$year',language_id='$Languages',modified_on=NOW() where id='$id'";
?>