<?php
session_start();
require_once("includes/config.php");

if (!isset($_SESSION['username'])) {
    echo "0";
    exit();
}

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    try {
        $stmt = $con->prepare("DELETE FROM daily_event WHERE id = ?");
        if ($stmt->execute([$id])) {
            echo "1";
        } else {
            echo "0";
        }
    } catch (PDOException $e) {
        echo "0";
    }
} else {
    echo "0";
}
?>
