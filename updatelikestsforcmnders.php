<?php

session_start();

include("connect.php");


$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['rolemaster_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $postId = $_POST['post_id'];
$likeStatus = $_POST['like_status'];
$commder_id=$_POST['commder_id'];

$getcountoflikes = $con->query("SELECT *, SUM(likests_cmd) as likescount FROM `posters_commads` WHERE posterid='$postId' and `id` = '$commder_id'");

$row = $getcountoflikes->fetch(PDO::FETCH_ASSOC);

$countoflike = $row['likescount']; // total number of likes

if ($likeStatus == 1) {
    $addlikes = $countoflike + 1;
	
	 // Use prepared statements to prevent SQL injection
    $updateQuery = $con->query("UPDATE `posters_commads` SET `likests_cmd` = '$addlikes',`likeorno` = '1' WHERE `posterid` = '$postId' and `id` = '$commder_id'");
	
    
   
} 
else if ($likeStatus == 0) { // Change from -1 to 0 for dislikes
 
     $addlikes = $countoflike-1;
	 
 // Use prepared statements to prevent SQL injection
    $updateQuery = $con->query("UPDATE `posters_commads` SET `likests_cmd` = '$addlikes',`likeorno` = '0' WHERE `posterid` = '$postId' and `id` = '$commder_id'");
	//echo "UPDATE `posters_commads` SET `likests_cmd` = '$likeStatus' WHERE `id` = '$postId'";
    
   
   // echo $addlikes . 'fghgdfgh';
}


   
  if($updateQuery)
  {
	//echo 'likests"'.$likeStatus.'"';  
	$countoflikests=$con->query("SELECT *,SUM(likests_cmd) as likesttcount FROM `posters_commads` WHERE posterid='$postId' and `id` = '$commder_id' and likests_cmd!=0");
	
	$row1=$countoflikests->fetch(PDO::FETCH_ASSOC);
	 
	 echo $row1['likesttcount'].'likes';
	 
	 
		 
  }
  else
  {
	  $countoflikests=$con->query("SELECT *,SUM(likests_cmd) as likesttcount FROM `posters_commads` WHERE posterid='$postId' and `id` = '$commder_id' and likests_cmd!=0");
	  $row2=$countoflikests->fetch(PDO::FETCH_ASSOC);
	  
	   echo ($row2['likesttcount'] ?? 0).'likes';
  }
   
}
 else {
    echo "Invalid request method";

}
?>
