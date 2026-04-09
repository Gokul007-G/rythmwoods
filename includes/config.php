<?php
/**
 * Rythm Project Configuration & Database Connection
 */

// Database Credentials
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'rythm');

// Application Constants
define('BASE_URL', '/rythm/');
define('ASSETS_PATH', BASE_URL . 'assets/');
define('INCLUDES_PATH', __DIR__ . '/');

try {
    $con = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
    // Set PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Session Start
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
