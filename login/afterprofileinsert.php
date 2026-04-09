<?php
session_start();

require("connect.php");

$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['rolemaster_id'];
$users_id = $_REQUEST['users_id'];
$firstname = $_REQUEST['firstname'];
$lastname = $_REQUEST['lastname'];
$email = $_REQUEST['email'];
$contact = $_REQUEST['contact'];
$location = $_REQUEST['location'];
$about = $_REQUEST['about'];
$facebook = $_REQUEST['facebook'];
$twitter = $_REQUEST['twitter'];
$instagram = $_REQUEST['instagram'];
$youtube = $_REQUEST['youtube'];
$achivementdyidd = $_REQUEST['achivementdyidd'];
$projectsdyid = $_REQUEST['projectsdyid'];
// echo $achivementdyidd.'a';
//echo $projectsdyid.'p';

$targetFilePath = '';
if (isset($_FILES["imageprofolio"]) && $_FILES["imageprofolio"]["error"] == UPLOAD_ERR_OK) {
	// Define a target directory for file portfolio
	$targetDir = "../portfolio/";
	// Create the target directory if it doesn't exist
	if (!file_exists($targetDir)) {
		mkdir($targetDir, 0777, true);
	}
	// Get the filename
	$filename = basename($_FILES["imageprofolio"]["name"]);
	// Construct the full path
	$targetFilePath = $targetDir . $filename;
	// Move the uploaded file to the target directory
	if (move_uploaded_file($_FILES["imageprofolio"]["tmp_name"], $targetFilePath)) {
		//  echo "The file " . $filename . " has been uploaded.";
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
}

$checkProfile = $con->query("SELECT id FROM `profile_details` WHERE rolemaster_id='$users_id'");
if ($checkProfile->rowCount() > 0) {
    if (!empty($targetFilePath)) {
        $sql = $con->query("UPDATE `profile_details` SET `about`='$about', `facebook`='$facebook', `twitter`='$twitter', `instagram`='$instagram', `youtube`='$youtube', `imagevedioprotfloio`='$targetFilePath', `admin_status`=1 WHERE rolemaster_id='$users_id'");
    } else {
        $sql = $con->query("UPDATE `profile_details` SET `about`='$about', `facebook`='$facebook', `twitter`='$twitter', `instagram`='$instagram', `youtube`='$youtube', `admin_status`=1 WHERE rolemaster_id='$users_id'");
    }
} else {
    $sql = $con->query("INSERT INTO `profile_details`(`id`, `rolemaster_id`, `about`, `facebook`, `twitter`, `instagram`, `youtube`, `imagevedioprotfloio`, `created_by`, `created_on`, `admin_status`) VALUES (NULL,'$users_id','$about','$facebook','$twitter','$instagram','$youtube','$targetFilePath','$users_id',now(),1)");
}

for ($i = 1; $i <= $achivementdyidd; $i++) {
	$filedirc = '';
	$title_1 = $_REQUEST['title_' . $i];
	$year_1 = $_REQUEST['year_' . $i];
	$awardedby_1 = $_REQUEST['awardedby_' . $i];
	$description_1 = $_REQUEST['description_' . $i];
	$youtubeLink_1 = $_REQUEST['youtubeLink_' . $i];

	if (isset($_FILES['image_' . $i]) && $_FILES['image_' . $i]["error"] == UPLOAD_ERR_OK) {
		// Define a target directory for file uploads
		$targetDir = "../achivementuploads/";
		// Create the target directory if it doesn't exist
		if (!file_exists($targetDir)) {
			mkdir($targetDir, 0777, true);
		}
		// Get the filename
		$filename = basename($_FILES['image_' . $i]["name"]);

		// Construct the full path
		$filedirc = $targetDir . $filename;

		// Move the uploaded file to the target directory
		if (move_uploaded_file($_FILES['image_' . $i]["tmp_name"], $filedirc)) {
			// echo "The file " . $filename . " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}

	if ($sql) {
		$upd = $con->query("update `profile_details` set title_$i='$title_1',year_$i='$year_1',awardedby_$i='$awardedby_1',description_$i='$description_1',image_$i='$filedirc',youtubeLink_$i='$youtubeLink_1'  where rolemaster_id='$users_id'");

		//echo "update `profile_details` set title_$i='$title_1',year_$i='$year_1',awardedby_$i='$awardedby_1',description_$i='$description_1',image_$i='$filedirc',youtubeLink_$i='$youtubeLink_1'  where rolemaster_id='$users_id'";
	}
}

for ($i = 1; $i <= $projectsdyid; $i++) {
	$pjtitle_1 = $_REQUEST['pjtitle_' . $i];
	$link_1 = $_REQUEST['link_' . $i . '_1'];
	$link_2 = $_REQUEST['link_' . $i . '_2'];
	$link_3 = $_REQUEST['link_' . $i . '_3'];
	$link_4 = $_REQUEST['link_' . $i . '_4'];
	$link_5 = $_REQUEST['link_' . $i . '_5'];

	if ($sql) {
		$upd = $con->query("update `profile_details` set pjtitle_$i='$pjtitle_1',link_" . $i . "_1='$link_1',link_" . $i . "_2='$link_2', link_" . $i . "_3='$link_3' ,link_" . $i . "_4='$link_4',link_" . $i . "_5='$link_5'  where rolemaster_id='$users_id'");

		// echo "update `profile_details` set pjtitle_$i='$pjtitle_1',link_".$i."_1='$link_1',link_".$i."_2='$link_2', link_".$i."_3='$link_3' ,link_".$i."_4='$link_4',link_".$i."_5='$link_5'  where rolemaster_id='$users_id'";
	}
}

if ($upd) {
	$updatesql = $con->query("update `user_master` set name='$firstname',last_name='$lastname',email='$email',mobile_no='$contact',profile_update_status=1,location='$location',admin_status=1 where id='$users_id'");
	if ($updatesql) {
		echo "<script>alert('profile update successfully!')</script>";
		echo "<script>window.location.href='../home.php'</script>";
	} else {
		echo "<script>alert('SomethingWent Wrong!')</script>";
		echo "<script>window.location.href='/rythm/login/login.php'</script>";
	}
	//echo 1;

} else {
	echo "<script>alert('SomethingWent Wrong!')</script>";
	echo "<script>window.location.href='/rythm/login/login.php'</script>";
}
