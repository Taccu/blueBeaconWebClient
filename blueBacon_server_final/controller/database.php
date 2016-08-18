<?php
/**
 * Database class
 *
 * @package default
 * 
 */
Class Database
{
	private $host ='localhost';
	private $str_user ='root';
	private $str_db_name = 'blueBacon';
	private $str_pw  = "";
	private $db;
	private $dsn="mysql:host=localhost;dbname=blueBacon";
	
function __construct()
	{
		//$this->connection();
		
		
	}
	
	 /**
	  * Verbindungsaufbau mit der Datenbank
	  *
	  */
	public function connection()
		{
			try{     
				    $pdo = new PDO($this->dsn, $this->str_user, $this->str_pw);
				}catch (PDOException $e){
				     die ('DB Error');
				}
			
			return $pdo;
		}


	



}

