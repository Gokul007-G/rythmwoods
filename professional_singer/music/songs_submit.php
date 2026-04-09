<?php
require '../../connect.php';
session_start();
$type=$_SESSION['title'];
//include("getid3/getid3.php");

	if(isset($_POST['title1']) || isset($_POST['music_director_id1'])|| isset($_POST['language_id1'])|| isset($_POST['song_file1']) || isset($_POST['lyrics_file1'])){
	 $t1 = $_POST['title1'];
     $c1 = $_POST['music_director_id1'];
     $l1 = $_POST['language_id1'];

     $status = $_POST['status'];


	 $file_name = $_FILES["song_file1"]["name"];
        $tempname1 = $_FILES["song_file1"]["tmp_name"];    
	     $folder1 = "../music/".$file_name;
		
	   $file_name1 = $_FILES["lyrics_file1"]["name"];
       $tempname11 = $_FILES["lyrics_file1"]["tmp_name"];    
	   $folder11 = "../lyrics/".$file_name1;

$sql_query1 = "INSERT INTO `song_master`(`title`,`language_id`,`music_director`,`file_location`,`lyrics_location`,`status`,`singer_type`)VALUES ('$t1','$l1','$c1','$file_name','$file_name1','$status','$type')";
	$con->exec($sql_query1);
	
    if (move_uploaded_file(from: $tempname1, to: $folder1))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
      }
if (move_uploaded_file(from: $tempname11, to: $folder11))  {
            $msg = "Image uploaded successfully";
        }else{
            $msg = "Failed to upload image";
		} 
	}
	else{
	}
	   
?>