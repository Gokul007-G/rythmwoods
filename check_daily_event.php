<?php
require_once("includes/config.php");
try {
    $stmt = $con->query("DESCRIBE daily_event");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        print_r($row);
        echo "\n";
    }
} catch (PDOException $e) {
    echo "Error describing table daily_event: " . $e->getMessage();
}
?>
