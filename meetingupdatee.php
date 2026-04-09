<?php

require("./connect.php");

$id = $_GET['id'];
$date = $_REQUEST['date'];
$time = $_REQUEST['time'];
$title = $_REQUEST['title'];
$description = $_REQUEST['description'];
$organizer = $_REQUEST['organizer'];
$amount = $_REQUEST['amount'];


$sql = $con->query("UPDATE `daily_event` SET `date`='$date',`time`='$time',`title`='$title',`description`='$description',`organizer`='$organizer',`amount`='$amount' WHERE id='$id'");

if ($sql != '') {
       // echo 'ifff';
        echo "<script>alert('update successfully')</script>";
        echo "<script>window.location.href='/rythm/homee.php';</script>";
        exit;
    } 
	else {
		//echo "else";
        // handle the case when passwords do not match
        echo "<script>alert('somethingWent Wrong')</script>";
        echo "<script>window.location.href='/rythm/homee.php';</script>";
        exit;
    }

//echo $date.'jijijijij'.$id;
?>
