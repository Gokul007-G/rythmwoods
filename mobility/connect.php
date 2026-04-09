<?php

class Connect {
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $dbname = "rythm";

    public function db_connect() {
		try {
			// Create connection
			$con = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
			// Check connection
			if ($con->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			} 
			
			return $con;
		} catch (Exception $e) {
			echo $e->getMessage();
		}
    }
	public function getStatus($status, $message, $data) {
		$result = [];
		array_push($result, array("status"=>$status));
		array_push($result, array("message"=>$message));
		array_push($result, array("data"=>$data));
		
		return json_encode($result);
	}
}

// error_reporting(0);

?>