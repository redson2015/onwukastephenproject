<?php
include 'DOA.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (isset($_POST['request'])){

		if ($_POST['request']=="addcampus"){

				
$response = addCampus($_POST['campusname']);
							
echo $response;
		}elseif ($_POST['request']=="updatecampus"){


updateCampus($_POST['campusID'],$_POST['campusname']);				
		}elseif ($_POST['request']=="deletecampus"){

			deleteCampus($_POST['IDdelete']);
		}

	}else {


		//show error msg
	}


}elseif ($_SERVER["REQUEST_METHOD"] == "GET"){
	if (isset($_GET['request'])){
		if ($_GET['request']=="viewcampus"){
				
			if (isset($_GET['searchterm']) and isset($_GET['searchtype']) ){

				$results= searchCampus($_GET['searchterm'],$_GET['searchtype']);
	echo $results;
			} else {
						$results = getAllCampus();
		echo $results;
			}

		}



	}else{
		//show error

	}
}



?>
