<?php session_start();
require_once 'checklogin.php';
if (isset($_SESSION['accessLevel'])){
if ($_SESSION['accessLevel']!="AL"){
	header('Location: findRoom.php?roomname=G107');
	exit;
}
}
?>

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
<title>Admin Area</title>
</head>
<body id="adminpage" onload="adminView()">
<div id="wrapper">
<?php

include_once 'DOA.php';
include_once 'header.php';
?>


<div id="contents">

		<div id="adminNav">
			<ul id="navList">
				<li class="nl1"><a onclick="bookingView()">Booking</a></li>
				<li class="nl2"><a onclick="roomView()">Room</a></li>
				<li class="nl3"><a onclick="userView()">User</a></li>
				<li class="nl4"><a onclick="buildingView()">Building</a></li>
				<li class="nl5"><a onclick="campusView()">Campus</a></li>
				<li class="nl6"><a onclick="courseView()">Course</a></li>
				<li class="nl7"><a onclick="moduleView()">Module</a></li>
				<li class="nl9"><a onclick="tutorView()">Tutor</a></li>

			</ul>

		</div>
		<div id="adminView">

<div id="adminSearchC">
			<form id ="frmSearch" name="frmSearch" method="get">
			<h2 id="heading"></h2>
			<div id="searchHolder"></div>
			<input type="hidden" id="tabledisplay" name="tabledisplay" value="">
		</form><input type='hidden' id='formPath' value=''><div id='buttons'></div>
			</div>
<div id="tableView"></div>
		</div>

		<div id="dialogWrapper"></div>








	
	<div id="message"></div>
	</div>	
<?php include_once 'footer.php';?>

</div>
</body>

</html>
