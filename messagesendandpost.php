<?php
session_start();

include("connect.php");


 $username = $_SESSION['username'];
$rolemaster_id = $_SESSION['rolemaster_id'];

if ($post_id != '' && $tosenderid != '' && $messagecontent != '') {
  try {
    // Determine if multiple IDs (comma separated)
    $ids = explode(',', $tosenderid);
    $success = true;
    
    $stmt = $con->prepare("INSERT INTO `shareposter` (`posters_id`, `postfrom_id`, `postto_id`, `message_content`, `created_on`) VALUES (?, ?, ?, ?, NOW())");
    
    foreach ($ids as $to_id) {
        $to_id = trim($to_id);
        if(!empty($to_id)) {
            if (!$stmt->execute([$post_id, $rolemaster_id, $to_id, $messagecontent])) {
                $success = false;
            }
        }
    }
    
    echo ($success) ? 1 : 0;
  } catch (PDOException $e) {
    echo 0;
  }
} else {
  echo 0;
}
  
?>