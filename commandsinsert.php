<?php
session_start();

include("connect.php");

$username = $_SESSION['username'];
$rolemaster_id = $_SESSION['rolemaster_id'];
$alldata = $_REQUEST['alldata'];
//echo $alldata.'#####';
$splitthedata = explode('**', $alldata);
$posterid = $splitthedata[0];
$commanderid = $splitthedata[1];
$commands = $splitthedata[2];

if ($posterid != '' && $commanderid != '' && $commands != '') {
  try {
    // Include likests_cmd and likeorno with default values of 0
    $stmt = $con->prepare("INSERT INTO `posters_commads` (`posterid`, `commander_id`, `commands`, `likests_cmd`, `likeorno`, `created_on`) VALUES (?, ?, ?, 0, 0, NOW())");
    $insertQuery = $stmt->execute([$posterid, $rolemaster_id, $commands]);

    if ($insertQuery) {
      echo 1;
    } else {
      error_log("Comment Insert Failed: " . print_r($stmt->errorInfo(), true));
      echo 0;
    }
  } catch (PDOException $e) {
    error_log("Comment Insert PDO Error: " . $e->getMessage());
    echo 0;
  }
} else {

  echo 0;
  //echo "<scrip>alert('Please Fill the All Requirements!....')</script>";
  //echo "<scrip>wondow.location.href='/rythm/homee.php'</script>";
}
