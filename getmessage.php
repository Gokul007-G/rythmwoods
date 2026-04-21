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
    $time = date('h:i A', strtotime($row['timestamp']));

    if($row['sender_id'] == $sender){
        // SENDER (RIGHT)
        echo '
        <div class="d-flex flex-column align-items-end mb-2">
            <div style="background: var(--rythm-deep-pink); color: #fff; padding: 10px 18px; border-radius: 20px 20px 0 20px; max-width: 75%; box-shadow: 0 4px 10px rgba(255, 0, 127, 0.1);">
                '.$msg.'
            </div>
            <small style="font-size: 10px; color: #aaa; margin-top: 4px; margin-right: 5px;">'.$time.'</small>
        </div>';
    } else {
        // RECEIVER (LEFT)
        echo '
        <div class="d-flex flex-column align-items-start mb-2">
            <div style="background: #f0f0f0; color: #333; padding: 10px 18px; border-radius: 20px 20px 20px 0; max-width: 75%; border: 1px solid #eee;">
                '.$msg.'
            </div>
            <small style="font-size: 10px; color: #aaa; margin-top: 4px; margin-left: 5px;">'.$time.'</small>
        </div>';
    }
}
?>