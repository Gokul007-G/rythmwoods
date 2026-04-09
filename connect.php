<?php

header("Access-Control-Allow-Origin: *");

//define("Title", 'Recruitment');
try {
    $con = new pdo('mysql:host=localhost;dbname=rythm', 'root', ''); //admin@123
} catch (Exception $e) {
    echo $e->getMessage();
}

class Database
{
    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "rythm";
    private $username = "root";
    private $password = "";
    public $con;

    // get the database connectio    
    public function getConnection()
    {
        $this->con = null;
        try {
            $this->con = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, username: $this->username, password: $this->password);
            $this->con->exec("set names utf8");
        } catch (PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->con;
    }
}
