<?php
/**
 * Database Connection Configuration
 */
header("Access-Control-Allow-Origin: *");

$host = "localhost";
$db_name = "rythm";
$username = "root";
$password = "";

try {
    $con = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $con->exec("set names utf8");
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

/**
 * Procedural $con is provided for backward compatibility.
 * Below is a class-based approach for future object-oriented code.
 */
class Database {
    private $host = "localhost";
    private $db_name = "rythm";
    private $username = "root";
    private $password = "";
    public $con;

    public function getConnection() {
        $this->con = null;
        try {
            $this->con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->con->exec("set names utf8");
        } catch (PDOException $exception) {
            error_log("Connection error: " . $exception->getMessage());
        }
        return $this->con;
    }
}
?>
