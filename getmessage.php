<?php
session_start();
include("includes/config.php");

if(!isset($_SESSION['users_id'])){
    exit("unauthorized");
}

$sender = $_SESSION['users_id'];
$receiver = $_POST['user_id'] ?? 0;

if($receiver == 0){
    exit;
}

$stmt = $con->prepare("
    SELECT * FROM messages 
    WHERE (sender_id=? AND receiver_id=?)
    OR (sender_id=? AND receiver_id=?)
    ORDER BY id ASC
");

$stmt->execute([$sender,$receiver,$receiver,$sender]);

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

    $msg = htmlspecialchars($row['message'], ENT_QUOTES, 'UTF-8');

    if($row['sender_id'] == $sender){
        echo "<div style='text-align:right'>
                <p style='background:#0084ff;color:#fff;display:inline-block;padding:8px;border-radius:10px;'>
                ".$msg."
                </p>
              </div>";
    } else {
        echo "<div>
                <p style='background:#eee;padding:8px;border-radius:10px;display:inline-block;'>
                ".$msg."
                </p>
              </div>";
    }
}
?>