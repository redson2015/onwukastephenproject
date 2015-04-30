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
<title>Book details</title>

</head>
<body>

<?php
include_once 'header.php';
include "DOA.php";

?>
<div id="wrapper">
<div id="contents">
<?php

$response = addBooking($_SESSION['userID'], $_POST['roomId'], $_POST['moduleID'],convertDate(trim($_POST['dateBooked'])), $_POST['startTime'], $_POST['endTime']);
echo "Booking successful ".$response."<br><a href='findRoom.php?roomname=G107'></a>";
?>
</div>
<?php include_once 'footer.php'; ?>
</div>
</body>
</html>
<?php 
function convertDate($date){
	$conDate = new DateTime($date);
	return date_format($conDate, 'Y-m-d');
	
}	
?>