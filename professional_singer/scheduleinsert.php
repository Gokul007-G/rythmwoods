<?php

include("../user.php");
$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['rolemaster_id'];
require("../connect.php");

$date = $_REQUEST['date'];
$time = $_REQUEST['time'];
$title = $_REQUEST['title'];
$description = $_REQUEST['description'];
$organizer = $_REQUEST['organizer'];
$amount = $_REQUEST['amount'];
$location = $_REQUEST['location'];

// Get current date
$currentDate = date('Y-m-d');

$sql = '';
// Check if provided date is current date or later
if ($date >= $currentDate) {
    $sql = $con->query("INSERT INTO `daily_event`(`id`,`users_id`,`date`, `time`, `title`, `description`, `location`, `organizer`, `amount`, `songs`, `created_on`,`createdby`) VALUES (NULL,'$rolemaster_id','$date','$time','$title','$description','$location','$organizer','$amount','-',now(),'$username')");
	// $con->exec($sql);
}
 $base_url = '/rythm/profile.php';

if ($date < $currentDate) {
    echo "<script>alert('Cannot schedule events in the past')</script>";
    exit;
}

if ($sql) {
    echo "<script>alert('Save successfully')</script>";
    echo "<script>window.location.href = '$base_url';</script>";
    exit;
} else {
    echo "<script>alert('Something Went Wrong')</script>";
    exit;
}








