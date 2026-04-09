<?php
require_once("includes/config.php");
try {
    $stmt = $con->query("DESCRIBE event_details");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        print_r($row);
        echo "\n";
    }
} catch (PDOException $e) {
    echo "Error describing table event_details: " . $e->getMessage();
}
?>
