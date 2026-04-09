<?php
require_once("includes/config.php");
try {
    $stmt = $con->query("DESCRIBE posters_commads");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        print_r($row);
        echo "\n";
    }
} catch (PDOException $e) {
    echo "Error describing table: " . $e->getMessage();
}
?>
