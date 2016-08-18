<?php
    	echo "
			<form action='' method='post'>
			<p style='float: right; width: 150px'>Produktionsstatus:<br>
								<input type='text' name='prostat' />
							
							<br>Wartungsstatus:<br>
								<input type='text' name='mainstat' />
								<br><input type='submit' value='Ändern' />
							</p>
							
			Maschinen: <select name='machine' style='center: right; width 200px'>";
						$countmach = $machine_1->countmach();
			
		$allMachines = $machine_1->getjsonData();
		//$num_2 = $allMachines->fetchColumn();
		
		$num_2=$countmach;
		//$result_2 = $allMachines->fetchAll();
		
	 	
	 	if($countmach > 0)
		{						
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
				 echo "<option>Keine zum Löschen verfügbare Maschinen</option>" ;
			}	
	
			 echo "</select>";
			 
		
			
				echo "	
				</form>"; 
				
			if(!empty($_POST['machine']) and !empty($_POST['mainstat']) and !empty($_POST['prostat']))
				{
					$str_ausgewaehlte_machine = $_POST['machine'];
					$str_new_pord_stat = $_POST['prostat'];
					$str_new_maint_stat = $_POST['mainstat'];
					$str_masch_id = substr($str_ausgewaehlte_machine,0,strpos($str_ausgewaehlte_machine," "));
						
					$machine_1->changeMaintStatus($str_masch_id, $str_new_maint_stat);
					$machine_1->changeProdStatus($str_masch_id, $str_new_pord_stat);
	
							echo "<script>window.location.reload(); </script>";
	
				}elseif(!empty($_POST['machine']) and !empty($_POST['mainstat']))
				{
					$str_ausgewaehlte_machine = $_POST['machine'];
					$str_masch_id = substr($str_ausgewaehlte_machine,0,strpos($str_ausgewaehlte_machine," "));
					$str_new_maint_stat = $_POST['mainstat'];

					$machine_1->changeMaintStatus($str_masch_id, $str_new_maint_stat);

							echo "<script>window.location.reload(); </script>";
										
				}elseif(!empty($_POST['machine']) and !empty($_POST['prostat']))
				{
					$str_ausgewaehlte_machine = $_POST['machine'];
					$str_masch_id = substr($str_ausgewaehlte_machine,0,strpos($str_ausgewaehlte_machine," "));
					$str_new_pord_stat = $_POST['prostat'];

					$machine_1->changeProdStatus($str_masch_id, $str_new_pord_stat);

							echo "<script>window.location.reload(); </script>";
										
				}
