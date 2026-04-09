<?php
require '../../connect.php';
session_start();
$type=$_SESSION['title'];
$language=$_REQUEST['language'];
$status=$_REQUEST['status'];

$sql=$con->query("insert into languages(`language_name`,`status`,`singer_type`) values('$language','$status','$type')"); 


?>