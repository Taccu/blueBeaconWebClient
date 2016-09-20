<?php
    	echo "
			<form action='' method='post'>
			<table>
			<tr>
			<th><label for='prostat'>Produktionsstatus:</label></th>
			<td>
			<select id='prostat' name='prostat'>
			<option selected='selected' disabled='disabled'>Bitte auswählen</option>
			<option>OK</option>
			<option>Wartung</option>
			<option>NOK</option>
			</select>
			</td>
			</tr>
			<tr>
			<th><label for='mainstat'>Wartungsstatus:</label></th>
			<td>
			<select id='mainstat' name='mainstat'>
			<option selected='selected' disabled='disabled'>Bitte auswählen</option>
			<option>OK</option>
			<option>In Bearbeitung</option>
			<option>NOK</option>
			</select>
			</td>
			</tr>
			<tr>
			<th><label for='machine'>Maschinen:</label></th>
			<td><select name='machine' style='center: right; width 200px'>";
						$countmach = $machine_1->countmach();
			
		$allMachines = $machine_1->getjsonData();
		//$num_2 = $allMachines->fetchColumn();
		
		$num_2=$countmach;
		//$result_2 = $allMachines->fetchAll();
		
	 	
	 	if($countmach > 0)
		{	echo "<option selected='selected' disabled='disabled'>Bitte auswählen</option>";				
			foreach ($allMachines as $line => $arr) 
			{
				$mach_id= $arr['machine'];
				$mach_name =$arr['name'];
				$mach_descr = $arr['description'];
				$mach_pord_stat = $arr['prodstatus'];
				$mach_maint_stat =  $arr['maintenancestatus'];
				 echo "<option>$mach_id $mach_name $mach_descr $mach_pord_stat $mach_maint_stat</option>" ;
			}
		}else
			{
				 echo "<option>Keine Maschinen verfügbar</option>" ;
			}	
	
			 echo "</select></td></tr>
			 </table>
			<input class='btn add' type='submit' value='Ändern' />";
			 
		
			
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
	
							 echo "<script>$('#tab-4').load(document.URL +  ' #tab-4');</script>";
	
				}elseif(!empty($_POST['machine']) and !empty($_POST['mainstat']))
				{
					$str_ausgewaehlte_machine = $_POST['machine'];
					$str_masch_id = substr($str_ausgewaehlte_machine,0,strpos($str_ausgewaehlte_machine," "));
					$str_new_maint_stat = $_POST['mainstat'];

					$machine_1->changeMaintStatus($str_masch_id, $str_new_maint_stat);

							echo "<script>$('#tab-4').load(document.URL +  ' #tab-4');</script>";
										
				}elseif(!empty($_POST['machine']) and !empty($_POST['prostat']))
				{
					$str_ausgewaehlte_machine = $_POST['machine'];
					$str_masch_id = substr($str_ausgewaehlte_machine,0,strpos($str_ausgewaehlte_machine," "));
					$str_new_pord_stat = $_POST['prostat'];

					$machine_1->changeProdStatus($str_masch_id, $str_new_pord_stat);

							echo "<script>$('#tab-4').load(document.URL +  ' #tab-4');</script>";
										
				}
