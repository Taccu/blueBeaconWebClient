<?php
require("model/maschine.php");
require("model/beacon.php");
require("model/mapping.php");
require("controller/database.php");

$return_arr = array(
	"machines" => array(),
	"beacons" => array(),
	"mapping" => array()
);

$machine = new Maschine();
$beacon = new Beacon();
$mapping = new Mapping();

$result_1 = $beacon->getJSONData();
$result_2 = $machine->getJSONData();
$result_3 = $mapping->getJSONData();
while($object = $result_1->fetch(PDO::FETCH_OBJ)) 
{
	$return_arr["beacons"][] = $object;
}
while($object = $result_2->fetch(PDO::FETCH_OBJ)) 
{
	$return_arr["machines"][] = $object;
}
while($object = $result_3->fetch(PDO::FETCH_OBJ))
{
	$return_arr["mapping"][] = $object;
}

echo json_encode($return_arr);

