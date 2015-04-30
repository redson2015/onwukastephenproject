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
<script src="./scripts/validation.js" type="text/javascript"></script>
<title>Book Room</title>
 <script>
  $(function() {
    $( "#datepicker" ).datepicker({dateFormat: 'dd-mm-yy'});
  });
  </script>
</head>
<body>

<?php

include_once 'header.php';
include "DOA.php";
include 'genInputs.php';
$unAvailableMsg="";
$available= false;
if (isset($_POST['submit1'])){
$date = new DateTime($_POST['date']);
$results=json_decode(checkRoomAvailiablity($_POST['roomID'], date_format($date, 'Y-m-d'),$_POST['timeStart'], $_POST['timeEnd']),true);
if (count($results)==0) {
	$available = true;

} else{
	$unAvailableMsg.="The room is not available at the specified date and time";
}
}
?>
	
	<div id="userPageBackground">
<div id="userContents2">
	<?php if(isset($_POST['bookRoom']) AND $available==false){?>
	
			<div id="bookRoom">
		<form id="userBookingForm" onsubmit="return formUserBookRoomVal()" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> name ="loginForm" method="post">
		
				
				<!-- should be value of post or session -->

				<div class="frmpad">
				<div id="errMsg" class="errMsg"><?php echo $unAvailableMsg?></div>
					<div class="formlbl">Room ID</div>
					<div class="formData">
					<input name="bookRoom" type="hidden" value="<?php $_POST['bookRoom']?>">
						<input type="text" name="roomID"
							value=<?php echo $_POST['roomID']?>>
					</div>
				</div>
				<div class="frmpad">
					<div class="formlbl">Room Name</div>
					<div class="formData">
						<input name="roomName"type="text" value=<?php echo $_POST['roomName']?>
							name="roomBookingNme" size="35px" required>
					</div>
				</div>

				<div class="frmpad">
					<div class="formlbl">Module</div>
					<div class="formData">
							<select name="module"><?php echo  getOptions2(getModuleIds(),"")?></select>
					</div>
				</div>

				<div class="frmpad">
					<div class="formlbl">Date</div>
					<div class="formData">
						<!-- <input type="text" name="roomBookingDate" size="35px"> -->
						<input type="text" name="date" id="datepicker" size="35" required>
					</div>
				</div>
				<div class="frmpad">
					<div class="formlbl">Time</div>
					<div class="formData">
						<select id="time" name="timeStart" class="hrsfrm" required>

						<?php echo getTime("")?>
						</select>
					</div>
				</div>
				<div class="frmpad">
					<div class="formlbl">Duration</div>
					<div class="formData">
						<select id="time" name="timeEnd" class="hrsfrm" required>
							<?php echo getTime("")?>
						</select>
					</div>
				</div>
				<input type="hidden" name="submit1" value="checkroom">
				<div class="frmpad">
					<input value="Submit" type="submit">
				</div>

			</form>
		</div>
			
			<?php }elseif ($available){
			
				$roomId =  $_POST['roomID'];
				$date =  $_POST['date'];
				$TimeStart = $_POST ['timeStart'];
				$timeEnd =  $_POST ['timeEnd'];
				$module = $_POST['module'];
				$date = $_POST['date'];
				$results = json_decode(getRoomById($roomId),true);
				
				?>
	
				
				<div id="ConfirmReservation">
				<h2 class="h2">Confirm Booking</h2>
				<hr class=hrconFrm>
				<p class="p12">Please review the booking sumery below and confrm your booking</p>
							<form id='confirmationForm' method="post" action="bookingdetails.php">
				
								<table id="userConfrm">
									<tr>
										<td>User Id</td>
										<td><?php echo $_SESSION['userID'] ?><input type="hidden"
											name="useId" value=<?php echo $_SESSION['userID'] ?>></td>
									</tr>
									<tr>
										<td>Name</td>
										<td><?php echo $_SESSION['userName'] ?></td>
									</tr>
									<tr>
										<td>Room ID</td>
										<td><?php echo $results[0]['Room_Id']; ?><input type="hidden"
											name="roomId" value=<?php echo $results[0]['Room_Id']; ?>></td>
									</tr>
				
				
									<tr>
										<td>Room Name</td>
										<td><?php echo $results[0]['RoomName']; ?></td>
									</tr>
									<tr>
										<td>Building</td>
										<td><?php echo  $results[0]['BuildingName']; ?></td>
									</tr>
									<tr>
										<td>Campus</td>
										<td><?php echo $results[0]['CampusName']; ?></td>
									</tr>
								<tr>
										<td>Module</td>
										<td><?php echo $module ?><input type="hidden" name="moduleID" value=<?php echo $module?>></td>
									</tr>
									<tr>
										<td>Date</td>
										<td><?php echo $date ?><input type="hidden" name="dateBooked" value=<?php echo $date?>></td>
									</tr>
									<tr>
										<td>Time Starting</td>
										<td><?php echo $TimeStart?><input type="hidden" name="startTime"
											value=<?php echo $TimeStart?>></td>
									</tr>
									<tr>
										<td>time Ending</td>
										<td><?php echo $timeEnd?><input type="hidden" name="endTime"
											value=<?php echo $timeEnd?>></td>
									</tr>
				
								</table>
								<input type="submit" class="btnCancel" name="btnConfirm" value="Confirm"> <input class="btnCancel" onclick="canceluserbooking()" type="button" value="Cancel">
							</form>
						</div>	
				
				
				
				
			<?php }?>
	
	
			
			
			
			
		
	</div>
		

<?php include_once 'footer.php'; ?>
</div>
</body>
</html>