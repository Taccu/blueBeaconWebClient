<?php
require("model/maschine.php");
require("model/beacon.php");
require("controller/database.php");

$test_arr = array(
	"machines" => array(),
	"beacons" => array()
);

$machine_1 = new Maschine();
	$beacon_1 = new Beacon();
	
	$result_1=$beacon_1->getjsondata();
	$result_2=$machine_1->getjsonData();
	while ($object = $result_1->fetch(PDO::FETCH_OBJ)) 
	{
		$test_arr["beacons"][] = $object;
	}
	while ($object = $result_2->fetch(PDO::FETCH_OBJ)) 
	{
		$test_arr["machines"][] = $object;
	}
	
	echo json_encode($test_arr);
	
