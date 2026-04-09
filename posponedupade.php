<?php

require("./connect.php");
$currentDate = date('Y-m-d'); // current date
$currentDateTime = date('Y-m-d H:i:s'); // current date and time
$conceptid = $_POST['conceptid'];
$date = $_POST['date'];
$time = $_POST['time'];

// Retrieve original meeting details
$originalDate = $_POST['originalDate'];
$originalTime = $_POST['originalTime'];
$originalTitle = $_POST['originalTitle'];
$originalOrganizer = $_POST['originalOrganizer'];
$originalAmount = $_POST['originalAmount'];
$originalSongs = $_POST['originalSongs'];
$originalDescription = $_POST['originalDescription'];

if ($date != '' && $time != '') {
    // Check if the date and time are not in the past
    $datetime = $date . ' ' . $time;
    if (strtotime($datetime) >= strtotime($currentDate . ' ' . $originalTime) && strtotime($datetime) >= strtotime($currentDateTime)) {
        // Perform your update logic here
        $sql = $con->query("UPDATE `meetinginsert` SET `date`='$date', `time`='$time' WHERE id='$conceptid'");

        if ($sql !== false) 
		{
           echo 0;
        } 
		else {
           echo 1;
        }
    }
	else {
       echo 2;
    }
}
else{
	echo 3;
}
?>
