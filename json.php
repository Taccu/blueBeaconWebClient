<?php
require("model/maschine.php");
require("model/beacon.php");
require("controller/database.php");

$return_arr = array(
	"machines" => array(),
	"beacons" => array()
);

$machine_1 = new Maschine();
$beacon_1 = new Beacon();

$result_1 = $beacon_1->getjsondata();
$result_2 = $machine_1->getjsonData();
while($object = $result_1->fetch(PDO::FETCH_OBJ)) 
{
	$return_arr["beacons"][] = $object;
}
while($object = $result_2->fetch(PDO::FETCH_OBJ)) 
{
	$return_arr["machines"][] = $object;
}
$pdo = $this->db->connection();
$sStmt = "SELECT * FROM bb_mapping";
$db_query = $pdo->query($sStmt);
while($object = $db_query->fetch(PDO:FETCH_OBJ))
{
	$return_arr["mapping"][] = $object;
}
$pdo=null;

echo json_encode($return_arr);

