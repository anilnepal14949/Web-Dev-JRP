<?php

trait Database {
	private $dsn = "mysql:host=localhost;dbname=practice";
	private $username = "root";
	private $password = "";
	public $conn;

	public function __construct() {
		try {
			$this->conn = new PDO($this->dsn, $this->username, $this->password);
			  // set the PDO error mode to exception
  			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
			echo 'Error : ' .$e->getMessage();
		}

		return $this->conn;
	}
}
	