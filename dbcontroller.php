<?php
class DBController {
	// ühenduse parameetrid
	private $servername = "localhost";
	private $user = "root";
	private $password = "";
	private $database = "err_rss_uudised";
	private $conn;
	
	function __construct() {
		$conn = $this->connectDB();
	}
	
	function connectDB() {
		$conn = mysqli_connect($this->servername,$this->user,$this->password,$this->database);
		$this->conn = $conn;
		return $conn;
	}
	
	function runQuery($query) {
		$result = mysqli_query($this->conn,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}		
		if(!empty($resultset))
			return $resultset;
	}
	
	function numRows($query) {
		$result  = mysqli_query($this->conn,$query);
		$rowcount = mysqli_num_rows($result);
		return $rowcount;	
	}
	
	// Ühenduse muutuja edastamine läbi funktsiooni kapsedatud klassis
	function getConn() {
		return $this->conn;
	}
	
	
	function closeConnection() {
		mysqli_close($this->conn);
	}
	
}
?>