<?php
session_start();

include("connect.php");
//include("user.php");

$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['role_master_id'];
//echo "hiiiiiii";

 $post_id=$_REQUEST['post_id'];
  $poserts_path=$_REQUEST['posters_path'];
 $save_no=$_REQUEST['save_status'];



	
   if ($save_no!=0) 
   {
	  
                $insertQuery = $con->query("INSERT INTO `poster_download`(`id`, `poster_id`, `downloader_id`, `donwload_sts`, `poster_path`, `created_on`) VALUES(NULL,'$post_id','$rolemaster_id','$save_no','$poserts_path',now())");
			
			 if($insertQuery)
			  {
				  echo 1;
				 
			  }
			  else
			 {
				  echo 0;
				
			  }
			   
   }
   else if ($save_no!=1) 
   {
	   
	   $updateuery=$con->query("DELETE FROM `poster_download` WHERE poster_id='$post_id' and downloader_id='$rolemaster_id' and donwload_sts='1'");
	   
	   if($updateuery)
			  {
				  echo 0;
				 
			  }
			  else
			 {
				  echo 1;
				
			  }
   }

?>
