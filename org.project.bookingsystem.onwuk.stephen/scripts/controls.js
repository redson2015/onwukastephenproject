function bookingView() {
	document.getElementById("heading").innerHTML = "Booking";
	document.getElementById("tabledisplay").value= "Booking";
	var htmltext = "<input id ='txtSearch' name='txtSearch' type='text' size='35'><button type='button' class='btnAdmin1' onclick='search()'>Search</button><select onchange='getdatePicker(this.value)' id='selSearch' name='searchType'><option value='Booking_ID'>Booking Id</option><option value='User_Id'>User ID</option><option value='Room_Id'>Room ID</option><option value='Module_ID'>Module ID</option><option value='BookingDate'>Booking Date</option><option value='DateBooked'>Date Booked</option></select><div><select name='view' onchange='searchBookings()'><option value='all'>All</option><option value='current'>Current</option><option value='history'>History</option></select><select name='orderBy' onchange='searchBookings()'><option value='ASC'>date assending</option><option value='DESC'>date desending</option></select></div>";
	
	document.getElementById("searchHolder").innerHTML = htmltext;
	setNewformPath("bookingform.php");
	searchBookings();
	setCookieView();
	document.getElementById("buttons").innerHTML= "<button onclick='newRecord()'>+New</button><button onclick='unprocessedBookings()'>unprocessed</button>";
	
	
	
}
function buildingView() {

	var options = "<option value='Building_ID'>Building ID</option><option value='BuldingName'>Building Name</option><option value='Campus_ID'>Campus Id</option>";
	setview("Building", options);
	setNewformPath("buildingform.php");
	viewBuilding();

}

function campusView() {
	var options = "<option value='Campus_Id'>Campus ID</option><option value='CampusName'>Campus Name</option>";
	setview("Campus", options);
	setNewformPath("campusform.php");
	viewCampus();

}

function roomView() {

	var options = "<option value='Room_ID'>Room Id</option><option value='RoomName'>Room Name</option><option value='RoomType'>Room Type</option><option value='Building_ID'>Building ID</option>";
	setview("Room", options);
	setNewformPath("roomform.php");
	viewRooms();

}
function courseView() {
	var options = "<option value='Course_ID'>Course Id</option><option value='CourseName'>Course Name</option>";
	setview("Course", options);
	setNewformPath("courseform.php");
	viewCourse();

}
function moduleView() {
	var options = "<option value='Module_ID'>Module Id</option><option value='ModuleName'>Module Name</option><option value='Course_ID'>Course ID</option>";
	setview("Module", options);
	setNewformPath("moduleform.php");
	viewModule();

}

function userView() {

	var options = "<option value='User_Id'>User Id</option><option value='FirstName'>First Name</option><option value='LastName'>Last Name</option><option value='Email'>Email</option><option value='Access'>Acess level</option><option value='JobRole'>Job Role</option>";
	setview("User", options);
	setNewformPath("userform.php");
	viewUser();

}

function setview(view, options) {
	document.getElementById("heading").innerHTML = view;
	document.getElementById("tabledisplay").value= view;
	var a = "<input id ='txtSearch' name='txtSearch' type='text' size='35'><input class='btnAdmin1' type='button' value='Search' onclick='search()' ><select id='selSearch' name='searchType'>"+options +"</select>";
	document.getElementById("searchHolder").innerHTML = a;
	setCookieView();
	addbuttons();

}
function tutorView(){
	
	var options = "<option value='Tutor_ID'>Tutor ID</option><option value='User_Id'>User ID</option><option value='Room_ID'>Room ID</option>";
	setview("Tutor", options);
	setNewformPath("tutorform.php");
	viewTutor();
	
}

function search(){
	var form = getSearchTerm();
	if (form.txtSearch.value.trim() !=""){
		
		var view = document.getElementById("heading").innerHTML;
		
				
		switch (view) {
		case "Booking":
			searchBookings();
			

			break;
		case "User":
			viewUser();
			break;
		case "Room":
			viewRooms();

			break;
		case "Module":
			viewModule();

			break;
		case "Course":
			viewCourse();

			break;
		case "Building":
			viewBuilding();

			break;
		
		case "Campus":
			viewCampus();

			break;
			
		case "Tutor":
			viewTutor();

			break;


		}

	}
	
}

function setNewformPath(path){
	
	document.getElementById("formPath").value = path;
	
}
function addbuttons(){
	var newfrmBtn= "<button onclick='newRecord()'>+New</button>";
	
	if (document.getElementById("tabledisplay").value=="Room"){
		newfrmBtn += "<button onclick='showQrGenDialog()'>Generate QR code</button>";
		
	}
	document.getElementById("buttons").innerHTML = newfrmBtn;
}