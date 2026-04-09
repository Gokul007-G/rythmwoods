<?php
session_start();
require_once("includes/config.php");

if (!isset($_SESSION['username'])) {
    header("Location: /rythm/login/login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $title = $_POST['title'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $location = $_POST['location'];
    $organizer = $_POST['organizer'];
    $description = $_POST['description'];

    try {
        $stmt = $con->prepare("UPDATE daily_event SET title = ?, date = ?, time = ?, location = ?, organizer = ?, description = ? WHERE id = ?");
        if ($stmt->execute([$title, $date, $time, $location, $organizer, $description, $id])) {
            echo "1";
        } else {
            echo "0";
        }
    } catch (PDOException $e) {
        echo "0";
    }
} else {
    header("Location: /rythm/event.php");
}
?>
