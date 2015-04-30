<?php 
include "phpqrcode/qrlib.php";
include 'DOA.php';

	if (isset($_POST['roomid'])){
	$PNG_TEMP_DIR ="";
	$results= json_decode(searchRoom($_POST['roomid'], "Room_Id"),true);
	
	if(count($results)!=0){
		$room = $_POST['roomid'];
		
		$PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'roomqrcodes'.DIRECTORY_SEPARATOR;
		
		if (!file_exists($PNG_TEMP_DIR)){
			mkdir($PNG_TEMP_DIR);
		}
		$PNG_WEB_DIR = 'roomqrcodes/';
		$x = getPath();
		$url=$x.$room."_".md5($room);
		
		$filename = $PNG_TEMP_DIR.$room."_".md5($room).'.png';
		QRcode::png($url, $filename, "L", 4, 4);
		echo "QR code sucessfully generated";
	} else{
		
		echo "Room Id does not exist";
		
		
	}
	}
	function getPath(){
	
		return "http://".$_SERVER['SERVER_NAME']."/daytimetable.php?roomid=";
	
	}
	
	

?>