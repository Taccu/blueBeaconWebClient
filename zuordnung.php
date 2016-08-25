<?php
		//alle Beacons in einer Auswahliste darstellen
	
	 echo 
			"<form action='' method='post'>
			<table>
			<tr>
			<th><label for='beacons[]'>Beacons:</label></th>
			<td><select id='beacons[]' multiple name='beacons[]' >";
		$countBeac = $beacon_1->countBeac();
		$allBeacons = $beacon_1->getallBeacons();
		$num= $countBeac;
	
			//die("tset". print_r($allBeacons,TRUE));
	 		//$result = $allBeacons->fetchAll();
			//print_r($result);
			//die("tset". print_r($result,TRUE));
	if($num != 0)
	{
	
		foreach ($allBeacons as $line => $arr) 
		{
				$beac_id=$arr['BeaconID'];
				$uuid=$arr['UUID'];
				$minor= $arr['Minor'];
				$major = $arr['Major'];
				$posx= $arr['PositionX'];
				$posy = $arr['PositionY'];
				
					 echo "<option>$beac_id $uuid $minor $major $posx $posy</option>" ;
				
					 
		}
	}else
		{
			 echo "<option>Keine Beacons verfügbar</option>" ;
		} 
			 echo "</select></td></tr>";
		
	 	//alle Maschinen in einer Auswahliste darstellen
	//$allMachines = $machine_1->getallMachines();
		
	 				
			echo 
			"<tr>
			<th><label for='machine'>Maschinen:</label></th>
			<td><select id='machine' name='machine' style='center: right'>";
						$countmach = $machine_1->countmach();
			
		$allMachines = $machine_1->getallMachines();
		//$num_2 = $allMachines->fetchColumn();
		
		$num_2=$countmach;
		//$result_2 = $allMachines->fetchAll();
		
	 	
	 	if($countmach > 0)
		{	echo "<option selected='selected' disabled='disabled'>Bitte auswählen</option>";				
			foreach ($allMachines as $line => $arr) 
			{
				$mach_id= $arr['MachineID'];	
				$mach_name =$arr['Name'];
				$mach_descr = $arr['Description'];
				$mach_pord_stat = $arr['Productionstatus'];
				$mach_maint_stat =  $arr['Maintenancestatus'];
				 echo "<option>$mach_id $mach_name $mach_descr $mach_pord_stat $mach_maint_stat</option>" ;
			}
		}else
			{
				 echo "<option>Keine Maschinen verfügbar</option>" ;
			}	
	
			 echo "</select></td></table>";
			 
		
			
				echo "<input class='btn add' type='submit' value='Zuordnen' />
				</form>"; 
			
			//Ausführung der Zuordung
			if(!empty($_POST['beacons']) and !empty($_POST['machine']))
			{
				$str_ausgewaehlte_beacons = $_POST['beacons'];
				$str_ausgewaehlte_machine = $_POST['machine'];
				$str_masch_id = substr($str_ausgewaehlte_machine,0,strpos($str_ausgewaehlte_machine," "));
			
				$zaehl=0;
				$zaehl = count($str_ausgewaehlte_beacons);
				
			
				//die(print_r($zaehl));
				// Zuordnung wird nur bei 2 Ausgewählten Beacons durchgeführt
				if($zaehl == 2)
				{	
					
					foreach ($str_ausgewaehlte_beacons as $ids) 
					{
					$str_id = $ids;
					$str_geschnitte_id =  substr($str_id,0,strpos($str_id," "));
					  $beacon_1->setMachine($str_masch_id, $str_geschnitte_id);	
					$machine_1->setgeadded($str_masch_id);
					}
					
						echo "<script>$('#tab-3').load(document.URL +  ' #tab-3');</script>";
					
							//echo "<script>alert('Die Beacons wurden der Maschine zugeordnet')</script>"; 
												//echo "<script>window.location.reload(); </script>";
					
				}elseif ($zaehl < 2)
				{
					echo "<div class='notif'><p>Bitte zwei Beacons Auswählen!</p></div>";
				}elseif ($zaehl > 2)
				{
					echo "<div class='notif'><p>Bitte nur zwei Beacons Auswählen!</p></div>";
				}	
			}

