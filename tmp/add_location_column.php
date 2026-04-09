<?php
require_once("c:/xampp/htdocs/rythm/connect.php");
try {
    $con->exec("ALTER TABLE daily_event ADD COLUMN location VARCHAR(255) AFTER organizer");
    echo "Column added successfully";
} catch (Exception $e) {
    if (strpos($e->getMessage(), 'Duplicate column name') !== false) {
        echo "Column already exists";
    } else {
        echo "Error: " . $e->getMessage();
    }
}
?>
