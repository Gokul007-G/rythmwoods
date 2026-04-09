<?php
/**
 * Rythm Root Redirector
 */
session_start();

// Central Routing Logic
if (isset($_SESSION['username'])) {
    header("Location: /rythm/pages/home.php");
} else {
    header("Location: /rythm/login/login.php");
}
exit();
?>
