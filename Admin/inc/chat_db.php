<?php
class Db {
	public $con;
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $database = "chat_db";
	public function __construct(){
		$this->con = new mysqli($this->servername, $this->username, $this->password,$this->database);

		// Check connection
		if ($this->con->connect_error) {
			die("Connection failed: " . $this->con->connect_error);
		}
	}
}