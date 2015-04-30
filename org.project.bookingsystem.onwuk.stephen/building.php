	<?php 
	include 'DOA.php';

	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
		if (isset($_POST['request'])){
	
			if ($_POST['request']=="addbuilding"){
	
					
$response = addBuilding($_POST['buildingname'],$_POST['campusID']);					
	echo $response;
			}elseif ($_POST['request']=="updatebuilding"){
	
	
	updateBuilding($_POST['buildingID'],$_POST['buildingname'],$_POST['campusID']);
									
			}elseif ($_POST['request']=="deletebuilding"){
	
deleteBuilding($_POST['IDdelete']);			}
	
		}else {
	
	
			//show error msg
		}
	
	
	}elseif ($_SERVER["REQUEST_METHOD"] == "GET"){
		if (isset($_GET['request'])){
			if ($_GET['request']=="viewbuilding"){
					
				if (isset($_GET['searchterm']) and isset($_GET['searchtype']) ){
	
						$results= searchBuilding($_GET['searchterm'],$_GET['searchtype']);
				echo $results;
				} else {
					$results = getAllBuildings();
				echo $results;
				}
	
			}
	
	
	
		}else{
			//show error
	
		}
	}
	
	
			?>