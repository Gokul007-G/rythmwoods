<?php
session_start();
require("connect.php");

if (!isset($_SESSION['username']) || !isset($_SESSION['rolemaster_id'])) {
    echo 0;
    exit;
}

$id = $_REQUEST['id'];

$stmt = $con->prepare("SELECT * FROM user_master WHERE id = ?");
$stmt->execute([$id]);
$profiledtils = $stmt->fetch(PDO::FETCH_ASSOC);

if ($profiledtils) {
    $rolemasterid = $profiledtils['role_master_id'];
    $upd2 = $con->prepare("UPDATE profile_photo_uploaded SET admin_status = 1 WHERE rolemaster_id = ?");
    $result = $upd2->execute([$rolemasterid]);

    echo $result ? 1 : 0;
} else {
    echo 0;
}
