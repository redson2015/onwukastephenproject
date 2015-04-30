<?php
include 'database.php';



function getUserIds(){
$sql= "User_ID FROM User";
$opt =getOptions($sql, "User_ID");
return $opt;
}

function getRoomIds(){
	$sql= "Room_ID FROM Room";
	$opt =getOptions($sql, "Room_ID");
	return $opt;
}
function getModuleIds(){
	$sql= "Module_ID FROM Module";
	$opt =getOptions($sql, "Module_ID");
	return $opt;
}
function getCourseIds(){
	$sql= "Course_ID FROM Course";
	$opt =getOptions($sql, "Course_ID");
	return $opt;
}
function getBuildingIds(){
	$sql= "Building_ID FROM Building";
	$opt =getOptions($sql, "Building_ID");
	return $opt;
}
function getCampusIds(){
	$sql= "Campus_ID FROM Campus";
	$opt =getOptions($sql, "Campus_ID");
	return $opt;
}



function getOptions($sql, $field){
	
$results =querry($sql);
$options="<option value=''></option>";
foreach($results as $s){
	$options.="<option value='".$s[$field]."'>".$s[$field]."</option>";
}

return $options; 
}

function extractID($data){

	$resultRows = array();
	if (mysqli_num_rows($data) > 0) {
		$count =0;
		while ($row = mysqli_fetch_assoc($data)) {
			$resultRows[$count]= $row;
			$count++;
		}
		return $resultRows;
	}

	return null;
}



?>