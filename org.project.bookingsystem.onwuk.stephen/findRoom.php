<?php session_start();
require_once 'checklogin.php';?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link type="text/css" rel="stylesheet" href="./css/styles.css" />
<link rel="stylesheet" href="./css/jquery-ui/jquery-ui.css"
	type="text/css" />
<link rel="stylesheet" href="./css/extra-styles.css" type="text/css" />
<script src="./scripts/jquery-2.1.3.js" type="text/javascript"></script>
<script src="./scripts/jquery.js" type="text/javascript"></script>
<script src="./scripts/jquery-ui.js" type="text/javascript"></script>
<script src="./scripts/ajax.js" type="text/javascript"></script>
<script src="./scripts/controls.js" type="text/javascript"></script>
<script src="./scripts/script.js"></script>
<title>Room Search</title>
<script src="./scripts/autocomplete.js" type="text/javascript"></script>


                    
</head>
<body>
<?php include_once 'header.php';?>
<div id="userPageBackground">
<div id="userContents">
	<div id ="searchContainer"><form id="searchRooms"><input id="roomSrchbox" placeholder="Search" type="text" name="roomname"><button id="btnRoomSearch" type="submit" form="searchRooms" formmethod="get" formaction=<?php echo $_SERVER['PHP_SELF']; ?>>Search</button></form></div>

<?php
include "DOA.php";


	/* $PNG_TEMP_DIR = dirname(__FILE__).DIRECTORY_SEPARATOR.'images'.DIRECTORY_SEPARATOR;
	 $image = $PNG_TEMP_DIR.basename($roomId.".png"); */

if(isset($_GET['roomname'])){
	$RoomName = $_GET['roomname'];
	$results = json_decode(getRoomDetails($RoomName),true);
	if (count($results)!=0){
?>
	<h2 class="roomHeading">Room Name: <?php echo $results[0]["RoomName"]; ?></h2>
	<div id="rooms">
	<div class="roomlbl">Room ID</div><div class="roomData"><?php echo $results[0]["Room_Id"]; ?></div>
	<div class="roomlbl">Room Type</div><div class="roomData"><?php echo $results[0]["RoomType"]; ?></div>
	<div class="roomlbl">Building</div><div class="roomData"><?php echo  $results[0]["BuildingName"]; ?></div>
	<div class="roomlbl">Campus</div><div class="roomData"><?php if($results[0]["SeatingLayout"]=="Fixed"){
		echo $results[0]["SeatingLayout"]." no movable seats or tables"; 
	}elseif($results[0]["SeatingLayout"]=="not fixed"){
	echo $results[0]["SeatingLayout"]." (movable seats and chairs)";	
		
	} 
	
	
	 ?></div>
	<div class="roomlbl">Facilities</div><div class="roomData"><?php
	$fac = explode(",",$results[0]["Facility"]);
	$list="<ul id='fac'>";
	foreach ($fac as $value){
		$list.="<li class='facli'>".$value."</li>";
		
		
	}
	$list.="</ul>";
echo $list;
	?></div>
	<div class="roomlbl">Capacity <span class="roomdetails">(based on the room layout)</span></div><div class="roomData"><?php echo  $results[0]["Capicity"]?></div>
	<div class="bottom"><form action="#"><input type="hidden" name = "bookRoom" value=<?php echo $results[0]["Room_Id"]; ?>>
	<input type="hidden" name = "roomID" value=<?php echo $results[0]["Room_Id"]; ?>>
	<input type="hidden" name = "roomName" value=<?php echo $results[0]["RoomName"]; ?>>
	<input id="btnBookRoom" name="btnBookRoom" type="submit" value="Book Room" formaction="bookroom.php" formmethod="post" type="submit"></form></div>

	</div>
<div id="image"><?php echo getRoomImage($results[0]["Room_Id"]) ?></div>
			<?php	} else{?>
			
				<div id="noResults">Your search results for &#10077; <?php echo $RoomName ?> &#10078; did not match any rooms. Please try the following sugestions
				<ul><li>Check your spelling</li>
				<li>try another name</li></ul>
				
				</div>
				
			<?php }?>
<?php }	
	?>		

</div>
		

<?php


function getRoomImage($roomIdimage){
	
	$image ="./images/".$roomIdimage.".png";
	if (!file_exists($image)){
		$image ="./images/no_image.png";
	}
	
	return "<img id='roomIme' src='".$image."'>";
}
?>
</div>
<?php  include_once 'footer.php'; ?>



</body>
</html>