<?php
include 'DOA.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (isset($_POST['request'])){

		if ($_POST['request']=="addmodule"){

				
 $response = addModule($_POST['moduleID'],$_POST['modulename'], $_POST['campusID']);				
echo $response;
		}elseif ($_POST['request']=="updatemodule"){


	updateModule($_POST['moduleID'],$_POST['modulename'], $_POST['campusID']);
							
		}elseif ($_POST['request']=="deletemodule"){

			deleteModule($_POST['IDdelete']);
		}

	}else {


		//show error msg
	}


}elseif ($_SERVER["REQUEST_METHOD"] == "GET"){
	if (isset($_GET['request'])){
		if ($_GET['request']=="viewmodule"){
				
			if (isset($_GET['searchterm']) and isset($_GET['searchtype']) ){

				$results= searchModule($_GET['searchterm'],$_GET['searchtype']);
		echo $results;
			} else {
					$results = getAllModules();
		echo $results;
			}

		}



	}else{
		//show error

	}
}




?>
