
<?php
include 'DOA.php';




if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (isset($_POST['request'])){

		if ($_POST['request']=="addtutor"){
			
				
$response = addTutor($_POST['tutorID'],$_POST['userID'],$_POST['roomID'],$_POST['officeHours']);				
if (isset($_FILES["file"])){
		
	savetutorPicture(substr($response,3,strlen($response)));
}
echo $response;


		}elseif ($_POST['request']=="updatetutor"){


	updateTutor($_POST['tutorID'],$_POST['userID'],$_POST['roomID'],$_POST['officeHours']);
							
		}elseif ($_POST['request']=="deletetutor"){

			
	deleteTutor($_POST['IDdelete']);
		}

	}else {


		//show error msg
	}


}elseif ($_SERVER["REQUEST_METHOD"] == "GET"){
	if (isset($_GET['request'])){
		if ($_GET['request']=="viewtutor"){
				
			if (isset($_GET['searchterm']) and isset($_GET['searchtype']) ){

				$results= searchTutor($_GET['searchterm'],$_GET['searchtype']);
		echo $results;
			} else {
				$results = getAllTutors();
		echo $results;
			}

		}



	}else{
		//show error

	}
}

function savetutorPicture($id){

	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'tutor_pics'.DIRECTORY_SEPARATOR;

	if (!file_exists($PNG_TEMP_DIR)){
		mkdir($PNG_TEMP_DIR);
		echo "does not exist";
	}
	$newimage = $PNG_TEMP_DIR.basename(trim($id).".png");
	if (!(move_uploaded_file($_FILES["file"]["tmp_name"],$newimage))){

		
	}

}

?>