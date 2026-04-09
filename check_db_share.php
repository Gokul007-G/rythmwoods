<?php
require_once("includes/config.php");
try {
    $stmt = $con->query("DESCRIBE shareposter");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        print_r($row);
        echo "\n";
    }
} catch (PDOException $e) {
    echo "Table shareposter not found or: " . $e->getMessage();
}
?>
