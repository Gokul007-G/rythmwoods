<?php

include("user.php");
$username=$_SESSION['username'];
$rolemaster_id=$_SESSION['rolemaster_id'];
require("connect.php");

$date = $_REQUEST['date'];
$time = $_REQUEST['time'];
$title = $_REQUEST['title'];
$description = $_REQUEST['description'];
$organizer = $_REQUEST['organizer'];
$amount = $_REQUEST['amount'];
//$songs = $_REQUEST['songs'];
$sql = $con->query("INSERT INTO `daily_event`(`id`,`users_id`,`date`, `time`, `title`, `description`, `organizer`, `amount`, `songs`, `created_on`,`createdby`) VALUES (NULL,'$rolemaster_id','$date','$time','$title','$description','$organizer','$amount','-',now(),'$username')");

//echo "INSERT INTO `daily_event`(`id`,`users_id`, `date`, `time`, `title`, `description`, `organizer`, `amount`, `songs`, `created_on`,`createdby`) VALUES (NULL,'$rolemaster_id','$date','$time','$title','$description','$organizer','$amount','$songs',now(),'$username')";
exit;
if ($sql != '') {
       // echo 'ifff';
        echo "<script>alert('Save successfully')</script>";
        // echo "<script>window.location.href='/neha/index.php';</script>";s
        // exit;
    } else {
		//echo "else";
        // handle the case when passwords do not match
        echo "<script>alert('SomethingWent Wrong')</script>";
        // echo "<script>window.location.href='/neha/createschedule.php';</script>";
        // exit;
    }


    
    ?>


