<?php
    /**
     /**
      * Mapping class
      *
      * @package default
      * 
      */
    class Mapping  {
        
	private $db;
	
	function	__construct()
	{
		$this->db = new Database();
		
	}
	
	function getJSONData()
	{
		$pdo = $this->db->connection();
		$sStmt = "SELECT * FROM bb_mapping";
		$db_query = $pdo->query($sStmt);
		$pdo=null;
		return $db_query;
	}	
    }
    
