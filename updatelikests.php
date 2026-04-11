<?php

session_start();

include("connect.php");


$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['role_master_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $postId = $_POST['post_id'];
$likeStatus = $_POST['like_status'];

$getcountoflikes = $con->query("SELECT *, SUM(likestatus) as likescount FROM `posters` WHERE id='$postId'");

$row = $getcountoflikes->fetch(PDO::FETCH_ASSOC);

$countoflike = $row['likescount']; // total number of likes

if ($likeStatus == 1) {
    $addlikes = $countoflike + 1;
	
	 // Use prepared statements to prevent SQL injection
    $updateQuery = $con->query("UPDATE `posters` SET `likestatus` = '$addlikes',`ownlikessts` = '1' WHERE `id` = '$postId'");
	//echo "UPDATE `posters` SET `likestatus` = '$addlikes',`ownlikessts` = '1' WHERE `id` = '$postId'";
    
   
} 
else if ($likeStatus == 0) { // Change from -1 to 0 for dislikes
 
     $addlikes = $countoflike-1;
	 
 // Use prepared statements to prevent SQL injection
    $updateQuery = $con->query("UPDATE `posters` SET `likestatus` = '$addlikes',`ownlikessts` = '0' WHERE `id` = '$postId'");
	//echo "UPDATE `posters` SET `likestatus` = '$likeStatus' WHERE `id` = '$postId'";
    
   
   // echo $addlikes . 'fghgdfgh';
}


   
  if($updateQuery)
  {
	//echo 'likests"'.$likeStatus.'"';  
	$countoflikests=$con->query("SELECT *,SUM(likestatus) as likesttcount FROM `posters` WHERE id='$postId' and likestatus!=0 ");
	$row1=$countoflikests->fetch(PDO::FETCH_ASSOC);
	 
	 echo $row1['likesttcount'].'likes';
	 
	 
		 
  }
  else
  {
	  $countoflikests=$con->query("SELECT *,SUM(likestatus) as likesttcount FROM `posters` WHERE id='$postId' and likestatus!=0 ");
	  $row2=$countoflikests->fetch(PDO::FETCH_ASSOC);
	  
	  echo $row2['likesttcount'].'likes';
  }
   
}
 else {
    echo "Invalid request method";

}
?>
