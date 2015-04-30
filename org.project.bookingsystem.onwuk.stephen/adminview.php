<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link type="text/css" rel="stylesheet" href="./css/styles.css" />
<link rel="stylesheet" href="./css/jquery-ui/jquery-ui.css"
	type="text/css" />
<link rel="stylesheet" href="./css/extra-styles.css" type="text/css" />
<script src="./scripts/jquery-1.11.2.js" type="text/javascript"></script>
<script src="./scripts/jquery.js" type="text/javascript"></script>
<script src="./scripts/jquery-ui.js" type="text/javascript"></script>
<script src="./scripts/ajax.js" type="text/javascript"></script>
<script type="text/javascript"></script>
<title>Insert title here</title>
</head>
<body>

<?php

include "ttop.php";

?>


<div id="contents">
<input type='text'>
		<div id="adminNav">
			<ul id="navList">
				<li><a href="?view=bookings">Booking</a></li>
				<li><a href="?view=room">Room</a></li>
				<li><a href="?view=user">User</a></li>
				<li><a href="?view=building">Building</a></li>
				<li><a href="?view=campus">Campus</a></li>
				<li><a href="?view=course">Course</a></li>
				<li><a href="?view=current_bookings">Module</a></li>
				<li><a href="?view=moduletutor">Module Tutor</a></li>
				<li><a href="?view=tutor">Tutor</a></li>

			</ul>

		</div>
		<div id="adminView">


			<form name="frmSearch">
		<?php if ($_GET['view'] =="bookings"){ ?>
		<div>
					<h2>Bookings</h2>
					<label>Filter:</label> <input name="txtSearch" type="text"
						size="35"><input type="button" value="Search"
						onclick="filterBookings(frmSearch)"><select name="searchType">
						<option value="Booking_Id">Booking Id</option>
						<option value="User_Id">User ID</option>
						<option value="Room_Id">Room ID</option>
						<option value="Module_ID">Module ID</option>
						<option value="BookingDate">Date</option>
					</select>
				</div>
				<div>
					<label>Booking:</label> <select name="type"
						onchange="filterBookings(frmSearch)">
						<option value="current">Current</option>
						<option value="history">History</option>
						<option value="all">All</option>
					</select><select name="orderBy"
						onchange="filterBookings(frmSearch)">
						<option value="ASC">date assending</option>
						<option value="DESC">date desending</option>
					</select>
				</div><?php
		
} 

		else if ($_GET ['view'] == "user") {
			?>
	<h2>User</h2>
				<div>
					<label>Filter:</label> <input name="txtSearch" type="text"
						size="35"><input type="button" value="Search"
						onclick="filterUser(frmSearch)"><select name="searchType">
						<option value="User_Id">User Id</option>
						<option value="FirstName">First Name</option>
						<option value="surname">Surname</option>
						<option value="Email">Email</option>
						<option value="Access">Acess level</option>
						<option value="JobRole">Job Role</option>
					</select>
				</div>
	
<?php }else if ($_GET['view'] =="building"){?>
<div>
					<h2>Building</h2>
					<label>Filter:</label> <input name="txtSearch" type="text"
						size="35"> <input type="button" value="Search"
						onclick="filterBookings(frmSearch)"><select name="searchType">
						<option value="Building_Id">Building Id</option>
						<option value="BuildingName">Building Name</option>
						<option value="Campus_Id">Campus ID</option>
					</select>
				</div>
	<?php }else if ($_GET['view'] =="campus"){?>
	
	<div>
					<h2>Campus</h2>
					<label>Filter:</label> <input name="txtSearch" type="text"
						size="35"><input type="button" value="Search"
						onclick="filterBookings(frmSearch)"><select name="searchType">
						<option value="Campus_Id">Campus Id</option>
						<option value="CamusName">Campus Name</option>
					</select>
				</div><?php }elseif ($_GET['view'] =="room"){?>
	<h2>Room</h2>
				<div>
					<label>Filter:</label> <input name="txtSearch" type="text"
						size="35"><input type="button" value="Search"
						onclick="filterRooms(frmSearch)"><select name="searchType">
						<option value="Room_Id">Room Id</option>
						<option value="RoomName">Room Name</option>
						<option value="RoomType">Room Type</option>
						<option value="Building_Id">Building ID</option>
					</select>
				</div>


<?php }?>
</form>
			<button onclick="showQrGenDialog()">Generate Qr codes</button><a href="View Qr codes"></a>
		
<div id="tableView" onload="viewBooking('bookings.php')"></div>
		</div>

		<div id="dialogWrapper"></div>








	</div> 
		
<?php include "tbottom.php"; ?>


</body>

</html>
