<?php
/**
 * Maschine class
 *
 * @package default
 * 
 */
class Maschine
{
private $db;
private $uuid_beacon;
private $str_status;

	
	 function __construct() 
	 {
		$this->db = new Database();
     }
	 /**
	  * Ein Maschine in die Datenbank aufnehemn
	  * @param $str_machine_name (Der Machinenname)
	  */
	 public function addMaschine($str_machine_name, $str_machine_descr, $str_machine_prod_stat, $str_machine_maint_stat)
	 {
	 	$str_addMachine_sql = "INSERT INTO `Maschine`(`MachineID`, `Name`, `Description`, `Productionstatus`, `Maintenancestatus`) VALUES (NULL, :machname, :machdes, :prodstat, :maintstat)"
;
	 		$stmt= $this->db->connection();
		$abfrage=$stmt->prepare($str_addMachine_sql);
		$abfrage->bindParam(':machname', $str_machine_name);
	 	$abfrage->bindParam(':machdes', $str_machine_descr);
		$abfrage->bindParam(':prodstat', $str_machine_prod_stat);
		$abfrage->bindParam(':maintstat', $str_machine_maint_stat);
		
	 	$abfrage->execute();
		$stmt=null;
		echo "<script>alert('Maschine hinzugefügt')</script>"; 
	 }
	 
	/**
	 * Alle löchbaren Maschinen werden zurüchgeben
	 */
	 public function getallMachines()
	 {
	 	$pdo=$this->db->connection();
		$int_id=0;
		$abfrage=$pdo->query('SELECT * FROM Maschine where Geadded=0');
		//$abfrage->bindParam(':intID', $int_id);
		//$abfrage->execute();
		$result= $abfrage->fetchAll();
			
	 	$pdo=null;
		//header("Location:".$_SERVER['PHP_SELF']);
		return $result;									 
				 
				
	 	
	 }
	 
	 function countmach()
	 {
	 $pdo=$this->db->connection();
		$int_id=0;
		$abfrage=$pdo->query('SELECT Count(*) FROM Maschine where Geadded= 0');
		$abfrage->bindParam(':intID', $int_id);
	$abfrage->execute();
			$result= $abfrage->fetchColumn();
			return $result;
			$pdo=null;
			
	 }	
	 	
	 
	 /**
	  * Ein Maschine wird als zugeordnet geflaggt
	  */
	 function setgeadded($str_machineID)
	 {
	 	$str_set_geadded_sql="UPDATE Maschine SET Geadded=1 WHERE MachineID=:machID";
		$pdo=$this->db->connection();
		$abfrage=$pdo->prepare($str_set_geadded_sql);
		$abfrage->BindParam(':machID', $str_machineID);
		$abfrage->execute();
		//$pdo->query($str_set_geadded_sql);
		//$this->db->closedb();
		
		$pdo=null;
	 }
	 
	 /**
	  * Trennen der Zurodnung
	  */
	 function revertgeadded($str_machineID)
	 {
	 	$str_revert_geadded_sql="UPDATE Maschine SET Geadded=0 WHERE MachineID=:machID";
		$pdo=$this->db->connection();
		$abfrage = $pdo->prepare($str_revert_geadded_sql);
		$abfrage->bindParam(":machID", $str_machineID);
		$abfrage->execute();
		
		$pdo=null;
		//$this->db->closedb();
	//	echo"<script>$('#tab-2').load(document.URL +  ' #tab-2'); </script>";
		//header("Location:".$_SERVER['PHP_SELF']);
	 }
	 
	 /**
	  * Löschen einer Maschine aus der Datenbank
	  */
	 function deleteMachine($int_machine_id)
		{
			$str_del_bacon_sql = "DELETE from Maschine where MachineID=:machID";
			$pdo=$this->db->connection();
			$abfrage=$pdo->prepare($str_del_bacon_sql);
			$abfrage->BindParam(':machID', $int_machine_id);
			$abfrage->execute();
			$pdo=null;
			
						//header("Location:".$_SERVER['PHP_SELF']);
			 echo "<script>alert('Maschine gelöscht')</script>"; 
						
				
		}
		
		function changeMaintStatus($mach_id, $str_maint_stat)
		{
			$str_change_maint_stat_sql ="UPDATE Maschine SET Maintenancestatus=:maintStat WHERE MachineID=:machID";
			$pdo=$this->db->connection();
			$abfrage=$pdo->prepare($str_change_maint_stat_sql);
			$abfrage->BindParam(':machID', $mach_id);
			$abfrage->BindParam(':maintStat', $str_maint_stat);	
			$abfrage->execute();
			$pdo=null;
		}
		
		function changeProdStatus($mach_id, $str_prod_stat)
			{
				$str_change_prod_stat_sql ="UPDATE Maschine SET Productionstatus=:prodStat WHERE MachineID=:machID";
				$pdo=$this->db->connection();
				$abfrage=$pdo->prepare($str_change_prod_stat_sql);
				$abfrage->BindParam(':machID', $mach_id);
				$abfrage->BindParam(':prodStat', $str_prod_stat);	
				$abfrage->execute();
				$pdo=null;
			}
	
	
	/**
	 * Alle Maschinen für die Json Ausgabe
	 */
	function getjsonData()
	{
		$get_ID_sql = "SELECT * FROM Maschine";
			$pdo=$this->db->connection();
			
			$db_query =$pdo->query($get_ID_sql);
			//$this->db->closedb();
			$pdo=null;
			return $db_query;									 
					  
	}	

}

