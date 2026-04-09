<?php
include 'connect.php';

$sql = "SELECT * FROM user_master";
$result = $conn->query($sql);
$users = [];

while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
?>
