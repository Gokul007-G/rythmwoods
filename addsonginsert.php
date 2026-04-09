<?php

/*include("user.php");
$username=$_SESSION['username'];
$rolemaster_id=$_SESSION['rolemaster_id'];
require("./connect.php");
$eventid=$_REQUEST['eventid'];//eventid
$eventname=$_REQUEST['eventname'];
$eventdate=$_REQUEST['eventdate'];
$eventtime=$_REQUEST['eventtime'];
$type=$_SESSION['title'];

$songsid=$_POST['selectedSongs'];//checkbox id array type

$songsid = implode(",", array_map('intval', $songsid));



$pairNames = $_POST["pairname"];
$commaSeparatedPairNames = implode(separator: ",", array: array_map('mysqli_real_escape_string', array: $pairNames));
//echo $commaSeparatedPairNames.'jijojoj';
$sql=$con->query("INSERT INTO `addsongsinevent`(`id`,`eventid`, `tilte`, `date`, `time`, `songslistid`,`pairname`,`created_by`,`created_on`,`singer_type`) VALUES (NULL,'$eventid','$eventname','$eventdate','$eventtime','$songsid','$commaSeparatedPairNames','$username','now()','$type')");
//echo "INSERT INTO `addsongsinevent`(`id`, `tilte`, `date`, `time`, `songslistid`) VALUES (NULL,'$eventname','$eventdate','$eventtime','$songsid')";

if ($sql != '') {
       // echo 'ifff';
        echo "<script>alert('Add Songs Successfully')</script>";
        echo "<script>window.location.href='/rythm/homee.php';</script>";
        exit;
    } else {
		//echo "else";
        // handle the case when passwords do not match
        echo "<script>alert('SomethingWent Wrong')</script>";
        echo "<script>window.location.href='/rythm/homee.php';</script>";
        exit;
    } */




include("user.php");
require("./connect.php");

session_start();

$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['rolemaster_id'];
$type = $_SESSION['title'];

$eventid = $_REQUEST['eventid'];
$eventname = $_REQUEST['eventname'];
$eventdate = $_REQUEST['eventdate'];
$eventtime = $_REQUEST['eventtime'];

// Check if 'selectedSongs' exists and is an array
if (isset($_POST['selectedSongs']) && is_array($_POST['selectedSongs'])) {
    $songsid = implode(",", array_map('intval', $_POST['selectedSongs']));
} else {
    echo "<script>alert('No songs selected'); window.location.href='/rythm/homee.php';</script>";
    exit;
}

// Check if 'pairname' exists and is an array
if (isset($_POST['pairname']) && is_array($_POST['pairname'])) {
    // Escape each pair name properly using PDO::quote()
    $pairNames = array_map(function ($name) use ($con) {
        return $con->quote($name);  // PDO quote for escaping
    }, $_POST['pairname']);

    // Corrected implode function
    $commaSeparatedPairNames = implode(",", $pairNames);
} else {
    echo "<script>alert('No pair names provided'); window.location.href='/rythm/homee.php';</script>";
    exit;
}

// Prepare and execute the query securely using prepared statements
$stmt = $con->prepare("INSERT INTO addsongsinevent (eventid, tilte, date, time, songslistid, pairname, created_by, created_on, singer_type) VALUES (?, ?, ?, ?, ?, ?, ?, NOW(), ?)");

// Check if prepare() is successful
if ($stmt === false) {
    die("Prepare failed: " . htmlspecialchars($con->errorInfo()[2]));
}

// Bind parameters
$stmt->execute([$eventid, $eventname, $eventdate, $eventtime, $songsid, $commaSeparatedPairNames, $username, $type]);

// Check if query execution is successful
if ($stmt) {
    echo "<script>alert('Add Songs Successfully');</script>";
    echo "<script>window.location.href='/rythm/homee.php';</script>";
} else {
    echo "<script>alert('Something Went Wrong');</script>";
    echo "<script>window.location.href='/rythm/homee.php';</script>";
}

// Close database connection
$con = null;
?>
