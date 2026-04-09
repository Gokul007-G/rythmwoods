<?php
session_start();
session_unset();
session_destroy();
header("Location: /rythm/login/login.php");
exit();
?>
