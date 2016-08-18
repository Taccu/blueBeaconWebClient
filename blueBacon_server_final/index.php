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
			 echo "<option>Keine zum Löschen verfügbare Beacons</option>" ;
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
	
	}	
?>

<!DOCTYPE html>
<html lang="en">
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
		<script type="text/javascript">var tabs;
        jQuery(function($) {
            tabs = $('.tabscontent').tabbedContent({loop: true}).data('api');
            // switch to tab...
            $('a[href=#click-to-switch]').on('click', function(e) {
                var tab = prompt('Tab to switch to (number or id)?');
                if (!tabs.switchTab(tab)) {
                    alert('That tab does not exist :\\');
                }
                e.preventDefault();
            });
            // Next and prev actions
            $('.controls a').on('click', function(e) {
                var action = $(this).attr('href').replace('#', '');
                tabs[action]();
                e.preventDefault();
            });
        });</script>
	</head>

	<body>

		<div>
			<header>
				<h1>Blue Bacon Verwaltung</h1>
			</header>
			<ul class="tabs">
				<li>
					<a href="#tab-1">Hinzufügen</a>
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
		<div class="tabscontent" id="wrapper">
			<div id="tab-1" style="width: 600px; margin-left: auto; margin-right: auto">
			<script>$('#tab-1').load(document.URL +  ' #tab-1');
			//window.location.reload(); </script>
			<div style="float: left; margin-left: auto; width: 350px">
					<h2>Beacon Hinzufügen</h2>
					<form action=" " method="post" >
					 <div  >
					 	
						<p style="float: left; width: 175px">UUID:<br>
							<input type="text" name="UUID" required />
						
						
						<br>Minor:<br>
							<input type="number" name="Minor" required/>
						
						 
						 <br>Major:<br>
							<input type="number" name="Major"required />
							<br><input type="submit" value="Hinzufügen" />
							
						</p>
						<p style="float: right;width: 175px">Position X:<br>
							<input type="number" name="posx" required/>
						
						 
						 <br>Position Y:<br>
							<input type="number" name="posy" required/>
					
					</div>	 
					</form>
					 <div  >
					 	<h2 style="float: left">Maschine Hinzufügen</h2>

						<form action=" " method="post">
							<p style="float: left; width: 175px">Maschinen Name:<br>
								<input type="text" name="mname" required/>
							
							<br>Beschreibung:<br>
								<input type="text" name="descrip" />
								<br><input type="submit" value="Hinzufügen" />
							</p>
							<p style="float: right; width: 175px">Produktionsstatus:<br>
								<input type="text" name="prostat" />
							
							<br>Wartungsstatus:<br>
								<input type="text" name="mainstat" />
							</p>
						
							
						</form>
					
					</div>	
					</form>
			</div>
		<div style="float: right; width: 250px">
			<div >
					<h2>Beacon Löschen</h2>

					<form action=" " method="post" >
					 <div >
					 	
						<p>Beacons:
							<select name="beac">
								<?php
								allBeaconsList($beacon_1);
								?>
							</select>
						</p>
						
						<p>
							<input type="submit" value="Löschen" />
						</p>
					</div>	 
					 
					</form>
			</div>
			
			<div >
					<h2>Maschine Löschen</h2> 
					<form action=" " method="post" >
					 <div >
					 	
						<p>Maschinen:
							<select name="mach">
								<?php
								allMachinesList($machine_1);
								?>
							</select>
						</p>
						
						<p>
							<input type="submit" value="Löschen" />
						</p>
					</div>	 
					 
					</form>
			</div>
</div>
</div><!--Ende tab 1 -->


  <div id="tab-2">
 <script>//$('#tab-2').load(document.URL +  ' #tab-2'); </script>
   <?php

		require("ubersicht.php");

	?>
  </div> <!--Ende tab 2-->


<div id="tab-3">
	<script>
	//$('#tab-3').load(document.URL +  ' #tab-3'); 
	</script>
	<h1 style="text-align: center"> Zuordnung von Beacons zur Maschine</h1>
	
	<?php	
		require("zuordnung.php");
		
	?>	
</div> <!--Ende tab 3-->

<div id="tab-4" style="margin-left: auto; margin-right: auto; width: 350px">
	<script>
	//$('#tab-3').load(document.URL +  ' #tab-3'); 
	</script>
	<h1 style="text-align: center"> Bearbeiten von Maschienen</h1>
	
	<?php	
		require("bearbeiten.php");
		
	?>	
</div> <!--Ende tab 3-->


</div> <!--Ende Wrapper -->
			<footer style="margin-top: 700px">
				<p>
					&copy; Copyright  by TIF13A
				</p>
			</footer>
		</div>
	</body>
</html>
