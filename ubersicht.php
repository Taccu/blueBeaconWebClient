      <?php
	//	header("Location:".$_SERVER['PHP_SELF']);
      


//auflistung der Maschien mit zugeordeten Beacons
$zahl=$beacon_1->countBeacset();
$query_rwa=$beacon_1->getBeaconsWithMchines();
$query =$query_rwa->fetchAll();
$query_rwa2 = $beacon_1->getBeaconsWithMchines();
$query_2 = $query_rwa2->fetchAll();
echo"<div class='formBlock three'> <h2 class='formBlockHead'>Liste zugeordneter Maschinen</h2>";
	if($zahl> 0)
	{
		foreach ($query as $line => $arr) 
		{
			
		$mach_id=$arr['MachineID'];
		$mach_name=$arr['Name'];
		$mach_uuid=$arr['UUID'];
		$mach_Minor=$arr['Minor'];
		$mach_Major=$arr['Major'];
			
			echo"
			<div class='machineInfo'>
			<h3 class='machineInfoHead'>Maschine ID $mach_id</h3>
			<table>
			<tr>
			<th>Maschinen Name:</th>
			<td>$mach_name</td>
			</tr>
			<tr>
			<th>UUID:</th>
			<td>$mach_uuid</td>
			</tr>
			<tr>
			<th>Minor:</th>
			<td>$mach_Minor</td>
			</tr>
			<tr>
			<th>Major:</th>
			<td>$mach_Major</td>
			</tr>
			</table>
			</div>
			 			
			 			";
			}
	}else
		{
		echo "<p class='noValue'>Keine zugeordneten Maschinen</p>";	
		}
	 echo"</div>
	 <div class='formBlock four'>
	 <h2 class='formBlockHead'> Zuordnung Löschen</h2>
	 <form  action='' method='post'>
	 <table>
	 <tr>
	 <th><label for='del'>Maschine:</label></th>
	 <td><select id='del' name='del'>";
	
	if($zahl> 0)
	{	echo "<option selected='selected' disabled='disabled'>Bitte auswählen</option>";
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
			echo "<option>Keine Maschinen verfügbar</option>";
		}
	
	echo"</select></td>
		</tr>
		</table>
		<input class='btn del' type='submit' value='Löschen' onsubmit='window.location.reload()' />
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
						//	echo "<script>window.location.reload(); </script>";
							
				//			echo "<script>alert('Die Beacons wurden von der Maschine getrennt')</script>"; 
		}


