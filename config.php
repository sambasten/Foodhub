<?php
ini_set("display_errors", true);
error_reporting( E_ERROR);
define("MYSQLSERVER","localhost"); 
define("MYSQLDB","shop_cart_mysql_1"); 
define("MYSQLUSER","root"); 
define("MYSQLPASSWORD",""); 

class dbConn {

	private $dbConnection;
	
	function __construct(){
		$this->dbConnection = new mysqli(MYSQLSERVER, MYSQLUSER, MYSQLPASSWORD, MYSQLDB);
	}
	
	function __destruct(){
		$this->dbConnection->close();
	}

	public function getConnection(){
		return $this->dbConnection;
	}
}
?>