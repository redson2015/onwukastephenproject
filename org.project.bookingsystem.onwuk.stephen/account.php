<?php session_start(); 
require_once 'checklogin.php';?>
<!DOCTYPE html>
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
<title>Accounts</title>
</head>
<body>
<?php include_once 'header.php';
include_once 'DOA.php';

?>

<div id="userContents">
		<div id="accountDetails">
			<?php
			if (isset($_GET["view"])){
	
	$view = $_GET["view"];
	switch ($view) {
		case "current_bookings" :
			$label = "Current Bookings";
			showCurrentBookings($label);
					
			break;
		case "booking_history" :
			$label = "Booking History";
			showBookingHistory($label);
			break;
		default :
			$label = "Accounts";
			showUserDetails($label);
			break;
			
			};
} 			?>
<?php 
function showUserDetails($label){
	
	
	
$result = json_decode(searchUsers($_SESSION['userID'],"User_Id"),true);
if (count($result)!= 0) {
 echo "<h2>".$label."</h2>"?> 
<table id="adminTable">
  <tr>
    <td> User Id:</td>
    <td><?php echo $result[0]['User_Id'] ?></td>		
  </tr>
  <tr>
    <td>First Name</td>
    <td><?php echo $result[0]['FirstName'] ?></td>		
  </tr>
<tr>
    <td>Surname:</td>
    <td><?php echo $result[0]['LastName'] ?></td>		
  </tr>
  <tr>
    <td>Job Role:</td>
    <td><?php echo $result[0]['JobRole'] ?></td>		
  </tr>
<tr>
    <td>Email</td>
    <td><?php echo $result[0]['Email'] ?></td>		
  </tr>
</table><?php }}

function showBookingHistory($label){
	echo "<h2>".$label."</h2>";
	
	$results = json_decode(getUserBookingHistory($_SESSION['userID']),true);
	
	if (count($results)==0){
		echo "no booking history available";
	}else{
	showBooking($results);
	}
}

function showCurrentBookings($label){
	echo "<h2>".$label."</h2>";
	$results = json_decode(getUserCurrentBookings($_SESSION['userID']),true);
	if (count($results==0)){
		
		echo "no current bookings";
	}else{
	showBooking($results);
	}
}

function showBooking($results){
	$data = getUserBookings($results);
	$heading = getHeading();
	$table = getTable($heading, $data);
	echo $table;
}


function getTable($headings, $tableRows) {
	$table = "<table id='adminTable'>\n".getTableHeadings($headings).getTableBody($tableRows)."</table>";
	return ($table);
}

function getTableHeadings($headings) {
	$firstRow = "<tr>";
	for ($i = 0; $i < count($headings); $i++) {
		$firstRow .="<th>".$headings[$i]."</th>";
	}
	$firstRow .= "</tr>\n";
	return ($firstRow);
}

function getUserBookings($results){
	$resultRows = array();
	for ($i = 0; $i < count($results); $i++) {
		$resultRows[$i]= [$results[$i]['Booking_Id'], $results[$i]['BookingDate'], $results[$i]['Room_Id'], $results[$i]['RoomName'], $results[$i]['Module_Id'],$results[$i]['TimeStarting'],
				$results[$i]['EndTime']];
	}

	return $resultRows;

}



function getTableBody($rows) {
		
	$body = "";
	for ($i = 0; $i < count($rows); $i++) {
	
		if ($i%2==0) {
			$body .= "  <tr>";
		}else{
				
	
			$body.= "  <tr class='alt'>";
		}
	
		$row = $rows[$i];
		for ($j = 0; $j < count($row); $j++) {
			$body.= "<td>".$row[$j]."</td>";
				
		}
		$body .= "</tr>\n";
	}
	return ($body);
	
}


function getHeading(){
	
	$headings = array("Booking ID", "Booking Date", "Room_Id", "Room Name", "Module", "Time Starting", "Time Ending" );
	return $headings;
	
}




?>
		</div>
		<div id="accountNav">
			<ul id="navList">
				<li class="nl1"><a href="?view=details">Account details</a></li>
				<li class="nl2"><a href="?view=current_bookings">Current Bookings</a></li>
				<li class="nl3"><a href="?view=booking_history">Booking history</a></li>
			</ul>

		</div>
		
	</div>
<div id="acf">
	
<div id="hcon"><a href="#">Help</a> | <a href="#">Contact Us</a></div>
</div>

</body>
</html>