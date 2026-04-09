<?php
require_once("includes/config.php");
try {
    $stmt = $con->query("DESCRIBE poster_download");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        print_r($row);
        echo "\n";
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
