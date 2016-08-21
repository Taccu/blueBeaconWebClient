<?php
/**
 * Database class
 *
 * @package default
 * 
 */
Class Database
{
	private $str_user ='myuser';
	private $str_pw  = "";
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

