<?php
session_start();
require("./connect.php");

$id = $_GET['id'];

$sql = $con->query("DELETE FROM `daily_event` WHERE id='$id'");

if ($sql != '') {
    // echo 'ifff';
    echo "<script>alert('Delete successfully')</script>";
    echo "<script>window.location.href='/neha/index.php';</script>";
    exit;
} else {
    //echo "else";
    // handle the case when passwords do not match
    echo "<script>alert('somethingWent Wrong')</script>";
    echo "<script>window.location.href='/neha/index.php';</script>";
    exit;
}

//echo $date.'jijijijij'.$id;
