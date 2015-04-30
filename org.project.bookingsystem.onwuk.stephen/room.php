
<?php 
include 'DOA.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (isset($_POST['request'])){

		if ($_POST['request']=="addroom"){

			
			$facilities="";
			if (isset($_POST['facility'])){
			
				$facilities = implode(",",$_POST['facility']);
			}
			
			$room = addRoom($_POST['roomname'],$_POST['roomtype'],$_POST['buildingID'],$_POST['seating'],$_POST['capacity'],$facilities);
			if (isset($_FILES["file"])){
					
				saveRoomIage(substr($room,3,strlen($room)));
			}
			
			echo $room;

		}elseif ($_POST['request']=="updateroom"){

			if (isset($_FILES["file"])){
			
				saveRoomIage();
			}
			$facilities="";
			if (isset($_POST['facility'])){
			
				$facilities = implode(",",$_POST['facility']);
			}
			
			updateRoom($_POST['roomID'],$_POST['roomname'],$_POST['roomtype'],$_POST['buildingID'],$_POST['seating'],$_POST['capacity'],$facilities);
			
		}elseif ($_POST['request']=="deleteroom"){
				
			deleteRoom($_POST['IDdelete']);
		}elseif ($_POST['request']=="addnote"){

			addNote($_POST['note'],$_POST['notetext']);
				
		}

	}else {


		//show error msg
	}


}elseif ($_SERVER["REQUEST_METHOD"] == "GET"){
	if (isset($_GET['request'])){
		
		if($_GET['request']=="autocomplete"){
			$results = rommAutoComplete();
			echo $results;
		}elseif($_GET['request']=="viewroom"){
		if(isset($_GET['roomdetails'])){//why do I have this
			$results = getRoomById($_GET['roomdetails']);
			echo $results;
		
		}else{
		
			if (isset($_GET['searchterm']) and isset($_GET['searchtype']) ){
					
				$results= searchRoom($_GET['searchterm'],$_GET['searchtype']);
				echo $results;
			} else {
					
				$results = getAllRooms();
				echo $results;
			}
		}		
		
			
				
		}



	}else{
		//show error

	}
}


function saveRoomIage($room){
	
	$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
	
	if (!file_exists($PNG_TEMP_DIR)){
		mkdir($PNG_TEMP_DIR);
		echo "does not exist";
	}
	$newimage = $PNG_TEMP_DIR.basename($room.".png");
	
	if (!(move_uploaded_file($_FILES["file"]["tmp_name"],$newimage))){
	
	//show error
	
	}
	
}
?>