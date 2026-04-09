<?php
/**
 * Rythm Logout Logic
 */
session_start();
session_unset();
session_destroy();

header("Location: /rythm/pages/login.php");
exit();
?>
