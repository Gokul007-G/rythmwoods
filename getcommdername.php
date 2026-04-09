<?php

session_start();

include("connect.php");


$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['rolemaster_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $postId = $_POST['post_id'];
//$likeStatus = $_POST['like_status'];

$commder_id=$_POST['commder_id'];

$getcountoflikes = $con->query("SELECT * FROM `posters` WHERE username_id='$commder_id' and poster_id='$postId'");

$row = $getcountoflikes->fetch(PDO::FETCH_ASSOC);

echo "SELECT * FROM `posters` WHERE username_id='$commder_id' and poster_id='$postId'";


   
 
  
}
 else {
    echo "Invalid request method";

}
?>
