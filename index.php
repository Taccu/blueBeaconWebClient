<?php
require("model/maschine.php"); 
require("model/beacon.php"); 
require("controller/database.php");

$machine_1 = new Maschine();
$beacon_1 = new Beacon();


	//Beacons in die Datenbank aufnehemen
if (!empty($_POST['UUID']) and !empty($_POST['Minor']) and !empty($_POST['Major']) and !empty($_POST['posx']) and !empty($_POST['posy']))
{
	
		
	$str_uuid = $_POST['UUID'];	
	$int_minor = $_POST['Minor'];
	$int_major =$_POST['Major'] ;
	$double_posx =$_POST['posx'] ;
	$double_posy =$_POST['posy'] ;
	$beacon_1->addBeacon($str_uuid,$int_minor,$int_major, $double_posx, $double_posy);
		
	

}
	 	
	//Maschine in die Datenbank aufnehmen
	if(!empty($_POST['mname']))
	{
		
		$str_machine_name = $_POST['mname'];
		$str_machine_descr = $_POST['descrip'];
		$str_machine_prod_stat = $_POST['prostat'];
		$str_machine_maint_stat = $_POST['mainstat'];
		
		
		$machine_1->addMaschine($str_machine_name, $str_machine_descr, $str_machine_prod_stat, $str_machine_maint_stat);
		
	
	}
	
	
	//Löchen eines Beacons
	if(!empty($_POST['beac']))
	{
			$ausgew_beacon = $_POST['beac'];
		$int_beac_id = substr($ausgew_beacon,0,strpos($ausgew_beacon," "));
		//die(print_r($int_beac_id));
		$beacon_1->deleteBeacon($int_beac_id);
								echo "<script>window.location.reload(); </script>";
		
		
	}
	//Löschen einer Maschine
	if(!empty($_POST['mach']))
	{
		$ausgew_machine = $_POST['mach'];
		$int_mach_id = substr($ausgew_machine,0,strpos($ausgew_machine," "));
		$machine_1->deleteMachine($int_mach_id);
												echo "<script>window.location.reload(); </script>";
		
	}
	
	//Auflistung alles zur Löschung verfügbaren Beacons
	function allBeaconsList($obj_beacon)
	{
		$countBeac = $obj_beacon->countBeac();
		 $allBeacons = $obj_beacon->getallBeacons();
		$num= $countBeac;
	
			//die("tset". print_r($allBeacons,TRUE));
	 		//$result = $allBeacons->fetchAll();
			//print_r($result);
			//die("tset". print_r($result,TRUE));
	if($num != 0)
	{
		echo "<option selected='selected' disabled='disabled'>Bitte auswählen</option>";
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
  
				}	

	
		
	
	
	//Auflistung aller zum Löschen verfügbaren Maschinen
	 function allMachinesList($obj_mchine)
	{
					$countmach = $obj_mchine->countmach();
			
		$allMachines = $obj_mchine->getallMachines();
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
	
	}	
?>

<!DOCTYPE html>
<html lang="de">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>Blue Bacon Verwaltung</title>
		<meta name="description" content="">
		<meta name="author" content="TIF13A">
		<link rel="stylesheet" href="styles.css" />

		<script src="jquery-3.1.0.min.js"></script>
		<script src="tabbedcontent.js"></script>
		<script type="text/javascript">
			var tabs;
			jQuery(function($) {
				tabs = $('.tabscontent').tabbedContent({loop: true}).data('api');
				// Next and prev actions
				$('.controls a').on('click', function(e) {
					var action = $(this).attr('href').replace('#', '');
					tabs[action]();
					e.preventDefault();
				});
			});
		</script>
	</head>

	<body>
		<div id="wrapper">
			<!-- HEADER START -->
			<div id="header">
				<div class="headerInner">
					<div class="headLineTop">
						<img class="logo" src="res/logo.png" alt="Logo" />
						<h1 class="title">BlueBacon Verwaltung</h1>
						<div class="clear"></div>
					</div>
					<div class="headLineBottom">
						<ul class="tabs">
							<li>
								<a href="#tab-1">Bearbeiten</a>
							<!--<a href="ubersicht.php">Übersicht</a> -->
							</li>
							<li>
								<a href="#tab-2">Übersicht</a>
							</li>
							<li>
								<a href="#tab-3">Zuordnung</a>
							</li>
							<li>
								<a href="#tab-4">Maschine Bearbeiten</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<!-- HEADER END -->
			
			<!-- CONTENT START -->
			<div id="content">
				<div class="tabscontent">
					
					<!-- TAB 1 START -->
					<div id="tab-1" class="innerTabcontent">
						<!-- <script>
							$('#tab-1').load(document.URL +  ' #tab-1');
							//window.location.reload();
						</script> -->
						<div class="formBlock one">
							<h2 class="formBlockHead">Beacon Hinzufügen</h2>
							<form action="" method="post" >
								<table>
									<tr>
										<th><label for="UUID">UUID:</label></th>
										<td><input id="UUID" type="text" name="UUID" required /></td>
									</tr>
									<tr>
										<th><label for="Minor">Minor:</label></th>
										<td><input id="Minor" type="number" name="Minor" required /></td>
									</tr>
									<tr>
										<th><label for="Major">Major:</label></th>
										<td><input id="Major" type="number" name="Major"required /></td>
									</tr>
									<tr>
										<th><label for="posx">Position X:</label></th>
										<td><input id="posx" type="number" name="posx" required /></td>
									</tr>
									<tr>
										<th><label for="posy">Position Y:</label></th>
										<td><input id="posy" type="number" name="posy" required /></td>
									</tr>
								</table>
								<input class="btn add" type="submit" value="Hinzufügen" />
							</form>
						</div>
						<div class="formBlock two">
							<h2 class="formBlockHead">Maschine Hinzufügen</h2>
							<form action="" method="post">
								<table>
									<tr>
										<th><label for="mname">Maschinen Name:</label></th>
										<td><input id="mname" type="text" name="mname" required /></td>
									</tr>
									<tr>									
										<th><label for="descrip">Beschreibung:</label></th>
										<td><input id="descrip" type="text" name="descrip" /></td>
									</tr>
									<tr>
										<th><label for="prostat">Produktionsstatus:</label></th>
										<td>
											<select id="prostat" name="prostat">
												<option selected='selected' disabled='disabled'>Bitte auswählen</option>
												<option>OK</option>
												<option>Wartung</option>
												<option>NOK</option>
											</select>
										</td>
									</tr>
									<tr>
										<th><label for="mainstat">Wartungsstatus:</label></th>
										<td>
											<select id="mainstat" name="mainstat">
												<option selected='selected' disabled='disabled'>Bitte auswählen</option>
												<option>OK</option>
												<option>In Bearbeitung</option>
												<option>NOK</option>
											</select>
										</td>
									</tr>
								</table>
								<input class="btn add" type="submit" value="Hinzufügen" />
							</form>
						</div>
						<div class="clear"></div>
						<div class="formBlock three">
							<h2 class="formBlockHead">Beacon Löschen</h2>
							<form action="" method="post" >
								<table>
									<tr>
										<th><label for="beac">Beacons:</label></th>
										<td>
											<select id="beac" name="beac">
												<?php
												allBeaconsList($beacon_1);
												?>
											</select>
										</td>
									</tr>
								</table>
								<input class="btn del" type="submit" value="Löschen" />
							</form>
						</div>
						<div class="formBlock four">
							<h2 class="formBlockHead">Maschine Löschen</h2> 
							<form action="" method="post" >
								<table>
									<tr>
										<th><label for="mach">Maschinen:</label></th>
										<td>
											<select id="mach" name="mach">
												<?php
												allMachinesList($machine_1);
												?>
											</select>
										</td>
									</tr>
								</table>
								<input class="btn del" type="submit" value="Löschen" />
							</form>
						</div>
						<div class="clear"></div>
					</div>
					<!-- TAB 1 END -->
					
					<!-- TAB 2 START -->
					<div id="tab-2">
						<?php
							require("ubersicht.php");
						?>
					</div> 
					<!-- TAB 2 END -->

					<!-- TAB 3 START -->
					<div id="tab-3">
						<div class="formBlock big">
						<h2 class="formBlockHead"> Zuordnung von Beacons zur Maschine</h2>
						<?php	
							require("zuordnung.php");
						?>
						</div>
					</div>
					<!-- TAB 3 END -->
					
					<!-- TAB 4 START -->
					<div id="tab-4">
						<div class="formBlock big">
							<h2 class="formBlockHead"> Bearbeiten von Maschinen</h2>
							<?php	
								require("bearbeiten.php");
							?>
						</div>
					</div>
					<!-- TAB 4 END -->
				</div>
			</div>
			<!-- CONTENT END -->
			
			<!-- FOOTER START -->
			<div id="footer">
				<p>
					&copy; Copyright  by TIF13A
				</p>
			</div>
			<!-- FOOTER END -->
		</div>
	</body>
</html>
