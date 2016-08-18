<?php
    /**
     /**
      * Beacon class
      *
      * @package default
      * 
      */
    class Beacon  {
        
	private $int_id;
	private $int_uuid;
	private $int_major;
	private $int_minor;
	private $db;
	
	function	__construct()
	{
		$this->db = new Database();
		
	}
	
	
	/**  
	 * Ein beacon in die Datenbank schreiben
	 * @Param $str_uuid   (die UUID des Beacon)
	 * @param $int_major  (Major des Beacon)
	 * @param $int_minor  (Minor des Beacon)
	 */
   function addBeacon($str_uuid, $int_major, $int_minor, $double_posx, $double_posy)
   {
	   	$pdo=$this->db->connection();
	   
	   	$str_Beacon_sql = "INSERT INTO Beacon (`BeaconID`, `UUID`, `Major`, `Minor`,`PositionX`, `PositionY`, `MachineID`) VALUES (NULL, :uuid, :major, :minor, :posx, :posy, '')";
	  	$abfrage=$pdo->prepare($str_Beacon_sql);
	  	$abfrage->bindParam(':uuid', $str_uuid);
		$abfrage->bindParam(':major',$int_major);
		$abfrage->bindParam(':minor',$int_minor);
		$abfrage->bindParam(':posx',$double_posx);
		$abfrage->bindParam(':posy',$double_posy);
	  	$abfrage->execute();
		echo "<script>alert('Beacon hinzugefügt')</script>"; 
   }
 
		
	/** 
	 *Alle Beacons die Löschbar sind 
	 * 
	 */
	function getallBeacons()
	{
	$int_id=0;
		$pdo=$this->db->connection();
		 $abfrage=$pdo->query('SELECT * FROM Beacon where MachineID= 0');
		//$abfrage->bindParam(':mach_id', $int_id);
		//$result=$abfrage->execute();
	$result=$abfrage->fetchAll();
	$pdo=null;
	return $result;
		//$get_ID_sql = "SELECT * FROM Beacon where MachineID =:mach_id";
		//$db_query = $this->db->query($get_ID_sql);
		//$this->db->closedb();			
				
	}
	
	function countBeac()
	{
		$pdo=$this->db->connection();
		$int_id=0;
		$abfrage=$pdo->prepare('SELECT Count(*) FROM Beacon where MachineID= :intID');
		$abfrage->bindParam(':intID', $int_id);
	$abfrage->execute();
			$result= $abfrage->fetchColumn();
			return $result;
			$pdo=null;
	}
	
	function countBeacSet()
	{
		$pdo=$this->db->connection();
		$int_id=0;
		$abfrage=$pdo->prepare('SELECT Count(*) FROM Beacon where MachineID!= :intID');
		$abfrage->bindParam(':intID', $int_id);
	$abfrage->execute();
			$result= $abfrage->fetchColumn();
			return $result;
			$pdo=null;
	}
	
	/**
	 * Zuordnung der Maschine
	 */
	function setMachine($str_masch_id, $str_geschnitte_id)
	{
		$str_add_machine_to_beacon="UPDATE Beacon SET MachineID=:machID WHERE BeaconID=:beacID";
		$pdo=$this->db->connection();
		$abfrage=$pdo->prepare($str_add_machine_to_beacon);
		$abfrage->BindParam(':machID', $str_masch_id);
		$abfrage->BindParam(':beacID', $str_geschnitte_id);
		$abfrage->execute();
		echo "<br>";
	//	echo "<script>alert('Die Beacons wurden der Maschine zugeordnet')</script>"; 
						//echo "<script>$('#tab-3').load(document.URL +  ' #tab-3');
						// </script>";
		
		//header("Location:".$_SERVER['PHP_SELF']);
	$pdo=null;	
	}
	/**
	 * Gibt  die zugeordente Maschinen zurück
	 */
	function getBeaconsWithMchines()
	{
		$pdo=$this->db->connection();
			
		$get_all_beacons_with_machines_sql= "SELECT m.MachineID, m.Name, b.UUID, b.Minor, b.Major from Maschine m
		INNER JOIN Beacon b ON m.MachineID =b.MachineID order by m.MachineID";
		
		 $db_query=$pdo->query($get_all_beacons_with_machines_sql);
	$pdo=null;
		//$num = $db_query->num_rows;
		//$this->db->closedb();
		//	$db_query= $abfrage->fetchAll();	
				//		echo "<script>window.location.reload(); </script>";
			
		return $db_query;									 
			
	}
/**
 * Setzt die MachineID in einem beacon wieder auf 0.
 * @Param $machine_id ist die MachinenID welche wieder auf 0 gesetzt werden soll.
 */		
function delMachine($machine_id)
	{
		$pdo=$this->db->connection();
				$str_del_machine_from_beacon="UPDATE Beacon SET MachineID=0 WHERE MachineID=:machID";
		
		$abfrage=$pdo->prepare($str_del_machine_from_beacon);
		$abfrage->BindParam(':machID', $machine_id);
		$abfrage->execute();
		$pdo=null;
		//$db_query = $pdo->query($str_del_machine_from_beacon);
		//$this->db->closedb();

		//header("Location:".$_SERVER['PHP_SELF']);
				
		
	}
	
		/**	
		 * Beacon mit einer Bestimmten MachineID zurückgeben
		 */
	function getBeaconWtihMachineID($machine_id)
	{
		$pdo=$this->db->connection();
		
		$str_get_beacon_machinde_ID_sql="SELECT * From Beacon where MachineID=:machID";
		$abfrage=$pdo->prepare($str_get_beacon_machinde_ID_sql);
		$abfrage->BindParam(':machID', $machine_id);
		 $abfrage->execute();
		$db_query=$abfrage->fetchColumn();
		$pdo=null;
		//die(print_r($db_query));
		//$db_query = $this->db->query($str_get_beacon_machinde_ID_sql);
		//$this->db->closedb();
						
		return $db_query;
		
	}	
	
	/**
	 * Löschen eines Beacons aus der Datenbank
	 * @param $int_beacon_id (die Id des Beacon)
	 */
	function deleteBeacon($int_beacon_id)
		{
			$pdo=$this->db->connection();
				
			
			$str_del_bacon_sql = "DELETE from Beacon where BeaconID=:beacID";
			$abfrage=$pdo->prepare($str_del_bacon_sql);
			$abfrage->BindParam(':beacID', $int_beacon_id);
			$abfrage->execute();
			$pdo=null;
			//$db_query = $this->db->query($str_del_bacon_sql);
		//	$this->db->closedb();
			echo "<script>alert('Beacon gelöscht')</script>"; 
			
						//header("Location:".$_SERVER['PHP_SELF']);
				
		}
		
	/**	
	 * Alle Becons für die json ausgabe
	 */
	function getjsondata()
	{
		$pdo=$this->db->connection();	
		$str_get_beacon_machinde_ID_sql="SELECT * From Beacon";
		$db_query = $pdo->query($str_get_beacon_machinde_ID_sql);
		$pdo=null;
	//	$this->db->closedb();		
		return $db_query;
	}	
		
		
    }
    
