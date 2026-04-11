<?php
session_start();
// include("user.php");
$username=$_SESSION['username'];
$rolemaster_id=$_SESSION['role_master_id'];
require(".././connect.php");
$eventid=$_REQUEST['eventid'];//eventid
$eventname=$_REQUEST['eventname'];
$eventdate=$_REQUEST['eventdate'];
$eventtime=$_REQUEST['eventtime'];

$soloDuteSelect = $_POST['soloDuteSelect'] ?? 'nd';
$sql = '';
if($soloDuteSelect!='nd'){


$songsid=$_POST['selectedSongs'];//checkbox id array type

$songsid = implode(",", array_map('intval', $songsid));



if($soloDuteSelect=='solo')
{
	$sql=$con->query("INSERT INTO `addsongsinevent`(`id`,`eventid`, `tilte`, `date`, `time`, `songslistid`,`pairtype`,`paircount`,`pairname`,`created_by`,`created_on`) VALUES (NULL,'$eventid','$eventname','$eventdate','$eventtime','$songsid','$soloDuteSelect',0,'','$username',now())");
//echo "INSERT INTO `addsongsinevent`(`id`, `tilte`, `date`, `time`, `songslistid`,`pairtype`,`paircount`,`pairname`) VALUES (NULL,'$eventname','$eventdate','$eventtime','$songsid','$soloDuteSelect','NULL','NULL')";

}	
else
{
	
$pairCountSelect = $_POST['pairCountSelect'] ?? 0;
$pairNames = $_POST["pairname"] ?? [];
if(!empty($pairNames))
{
$commaSeparatedPairNames = implode(",", $pairNames);
}
else
{
$commaSeparatedPairNames = "";
}
$sql=$con->query("INSERT INTO `addsongsinevent`(`id`,`eventid`, `tilte`, `date`, `time`, `songslistid`,`pairtype`,`paircount`,`pairname`,`created_by`,`created_on`) VALUES (NULL,'$eventid','$eventname','$eventdate','$eventtime','$songsid','$soloDuteSelect','$pairCountSelect','$commaSeparatedPairNames','$username',now())");
//echo "INSERT INTO `addsongsinevent`(`id`, `tilte`, `date`, `time`, `songslistid`,`pairtype`,`paircount`,`pairname`) VALUES (NULL,'$eventname','$eventdate','$eventtime','$songsid','$soloDuteSelect','$pairCountSelect','$commaSeparatedPairNames')";
}
}
if ($sql != '') {
    echo "1";
} else {
    echo "0";
}


?>
