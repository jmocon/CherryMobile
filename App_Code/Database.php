<?php
session_start();
class Database{
/**
 * Connect to the mysql database.
 */
	private $conn;
	public function __construct(){
		/*
		$dbhost = 'localhost';
		$dbuser = 'propertyzeonline';
		$dbpass = 'k9n6mS*wm6jz';
		$dbname = 'propertyzeonline';
		*/
		$dbhost = 'localhost';
		$dbuser = 'root';
		$dbpass = '';
		$dbname = 'CherryMobile';

		$this->conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname) or die("Connection Error");
	}

	public function GetConn(){
		return $this->conn;
	}

}
?>
