<?php
require '../../connect.php';
session_start();
$type=$_SESSION['title'];
$music_director_name=$_REQUEST['music_director_name'];
$status=$_REQUEST['status'];

$sql=$con->query("insert into music_directors(`music_director_name`,`status`,`singer_type`) values('$music_director_name','$status','$type')"); 


?>