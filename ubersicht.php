      <?php
	//	header("Location:".$_SERVER['PHP_SELF']);
      


//auflistung der Maschien mit zugeordeten Beacons
$zahl=$beacon_1->countBeacset();
$query_rwa=$beacon_1->getBeaconsWithMchines();
$query =$query_rwa->fetchAll();
$query_rwa2 = $beacon_1->getBeaconsWithMchines();
$query_2 = $query_rwa2->fetchAll();
echo"<br><div style= 'float: left; margin-left:100px'> <h2>Liste zugeordneter Maschinen</h2>";
	if($zahl> 0)
	{
		foreach ($query as $line => $arr) 
		{
			
		$mach_id=$arr['MachineID'];
		$mach_name=$arr['Name'];
		$mach_uuid=$arr['UUID'];
		$mach_Minor=$arr['Minor'];
		$mach_Major=$arr['Major'];
			
			echo" <br>Maschinen ID: $mach_id
			 			<br> Maschinen Name: $mach_name
			 			<br>UUID: $mach_uuid
			 			<br> Minor: $mach_Minor
			 			<br>Major: $mach_Major
			 			</br>
			 			";
			}
	}else
		{
		echo "<p>Keine Zugeordneten Maschinen</p>";	
		}
	 echo"<br> </div>
	 <div style='float: right; margin-right: 100px'>
	 <h2> Zurodnung Löschen</h2>
	 <form  action='' method='post'>
	 <select name='del'>";
	
	if($zahl> 0)
	{
		foreach ($query_2 as $line => $arr)
			
		
			{
				$mach_id=$arr["MachineID"];
				$mach_name=$arr["Name"];
				$mach_uuid=$arr["UUID"];
				$mach_Minor=$arr["Minor"];
				$mach_Major=$arr["Major"];
						 	echo "
				 	
				 	<option>
				 			$mach_id
				 			Machine Name: $mach_name
				 			<br>UUID: $mach_uuid
				 			<br> Minor: $mach_Minor
				 			<br>Major: $mach_Major
				 			</option>";
			}	
			 
	}else
		{
			echo "<option>Keine zugeordneten Maschinen Verfügbar</option>";
		}
	
	echo"</select>
		<input type='submit' value='Löschen' onsubmit='window.location.reload()' />
	</form>
	</div>";
	//Löschvorgang
		if(!empty($_POST['del']))
		{
			$auswahl = $_POST['del'];
			$str_geschnitte_id =  substr($auswahl,0,strpos($auswahl," "));
			$query_anzahl= $beacon_1->getBeaconWtihMachineID($str_geschnitte_id);
			
			$machine_1->revertgeadded($str_geschnitte_id);
			//löschen der mascchienID in den Beacons
			for ($i=0; $i < $query_anzahl ; $i++) 
			{ 
				$beacon_1->delMachine($str_geschnitte_id);
			}
							echo "<script>window.location.reload(); </script>";
							
				//			echo "<script>alert('Die Beacons wurden von der Maschine getrennt')</script>"; 
		}


