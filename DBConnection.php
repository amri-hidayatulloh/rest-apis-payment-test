<?php
class DBConnection
{
	private $credentials;
	private $conn;

	function __construct($credentials = [])
	{
		if(!isset($credentials['host'])) {
			throw new Exception("DB Host undefined");
		}
		if(!isset($credentials['user'])) {
			throw new Exception("DB User undefined");
		}
		if(!isset($credentials['scheme'])) {
			throw new Exception("DB Scheme undefined");
		}

		$this->credentials = $credentials;
		$this->connect();
	}

	public function connect() {
		try {
		 	$this->conn = new PDO("mysql:host=".$this->credentials['host'].";dbname=".$this->credentials['scheme'], $this->credentials['user'], $this->credentials['password']);
		 	$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
		 	throw new Exception("Connection failed: " . $e->getMessage());
		}
	}

	public function getConnection() {
		return $this->conn;
	}
}