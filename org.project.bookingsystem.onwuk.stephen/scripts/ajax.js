
function updateRecord(id){
var path = document.getElementById("formPath").value+"?update"+document.getElementById("heading").innerHTML.toLowerCase()+"="+id;
getForm(path,"Update "+ document.getElementById("heading").innerHTML + " ID " + "<span class='dioup'>" +id+ "</span>");

}


function getXMLHttp(){
	var xmlhttp
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xmlhttp;
	
	
}



function viewBooking(pathIn)
{
var xmlhttp = getXMLHttp();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var obj = xmlhttp.responseText;
    var records = parseJason(obj);
   	
    	if (records.length!=0){
     	 
    	    var rows = new Array(records.length);
    	    for (var i = 0; i < records.length; i++) {
    						var data = records[i];
    						rows[i] = [data.Booking_Id, data.BookingDate, data.User_Id,data.Room_Id, data.Module_Id,data.DateBooked ,data.TimeStarting,
    						data.EndTime,"<div onclick='authoriseBooking("+data.Booking_Id+")'>"+convertAuthrised(data.Authorised)+"</div>", "<div onclick='AddBookingNote("+data.Booking_Id+")'>"+data.Notes+"</div>",getButtons(data.Booking_Id),"<button name= 'del' class='btnAdmin' type='button' value='" + data.Booking_Id + "' onclick='deleteBooking(this.value)'>del</button>"];
    						
    						}
    	    
    	    var headings = ["Booking ID","Booking Date", "User ID", "Room ID", "Module ID", "Date Booked" ,"Time Starting","Time Ending", "Authorised","Notes"];
    		var table = getTable(headings, rows);
    	    
    		  
    		insetTableHTML(table);
    	
    }
    }
  }
sendGetRequest(xmlhttp,pathIn);
}


function getTable(headings, rows) {
	var table = "<table id='adminTable'>\n"
			+ getTableHeadings(headings) + getTableBody(rows) + "</table>";
	return (table);
}

function getTableHeadings(headings) {
	var firstRow = "  <tr>";
	for (var i = 0; i < headings.length; i++) {
		firstRow += "<th>" + headings[i] + "</th>";
	}
	firstRow += "<th></th><th></th></tr>\n";
	return (firstRow);
}


function getTableBody(rows) {
	var body = "";
	for (var i = 0; i < rows.length; i++) {
		
		if (i%2==0) {
			body += "  <tr>";
		}else{
			

			body += "  <tr class='alt'>";
		}
		
		var row = rows[i];
		for (var j = 0; j < row.length; j++) {
				body += "<td>" + row[j] + "</td>";
			
		}
		body += "</tr>\n";
	}
	return (body);
}
function searchBookings() {
	var path = "bookings.php?request=viewbooking";
	/*viewBooking(form.type.value, form.orderBy.value)*/
	var form = getSearchTerm();
	path+= "&view="+ form.view.value + "&order=" +form.orderBy.value;	
	if(form.txtSearch.value!=""){
		var searchTerm = form.txtSearch.value;
		var searchType = form.searchType.value;
		path += "&searchterm="+ searchTerm + "&searchtype=" +
		searchType;
	} 
	viewBooking(path);
	
}
function getSearchTerm(){
return document.getElementById("frmSearch");

}

function viewUser(){
	path="user.php?request=viewuser";
	var form = getSearchTerm();
	if(form.txtSearch.value.trim()!=""){
		
		path += "&searchterm="+ form.txtSearch.value + "&searchtype=" +
		form.searchType.value;
		
	}
		
	var xmlhttp = getXMLHttp();
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    var obj = xmlhttp.responseText;
	    var records = parseJason(obj);
	   	
    	if (records.length!=0){
	    	    var rows = new Array(records.length);
	    	    for (var i = 0; i < records.length; i++) {
	    						var data = records[i];
	 
	    						rows[i] = [data.User_Id, data.Title, data.LastName, data.FirstName, data.Email, data.JobRole, data.AccessLevel,getButtons(data.User_Id),"<button name= 'del' class='btnAdmin' type='button' value='" + data.User_Id + "' onclick='deleteUser(this.value)'>del</button>"];
	    						
	    						}
	    	    
	    	    var headings = ["User ID", "Title", "Last Name", "First Name", "Email", "Job Role","Access level"];
	    		var table = getTable(headings, rows);
	    	    
	    		  
	    		insetTableHTML(table);
	    	
	    }
	    }
	  }
	sendGetRequest(xmlhttp,path);
	
}

function viewBuilding(){
	path="building.php?request=viewbuilding";
	var form = getSearchTerm();
	if(form.txtSearch.value.trim()!=""){
		path += "&searchterm="+ form.txtSearch.value + "&searchtype=" +
		form.searchType.value;
		
	}
	
	var xmlhttp = getXMLHttp();
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    var obj = xmlhttp.responseText;
	    var records = parseJason(obj);
	   	
    	if (records.length!=0){
	    	    var rows = new Array(records.length);
	    	    for (var i = 0; i < records.length; i++) {
	    						var data = records[i];
	 
	    						rows[i] = [data.Building_ID, data.BuildingName,data.Campus_ID, getButtons(data.Building_ID),"<button name= 'del' class='btnAdmin' type='button' value='" + data.Building_ID + "' onclick='deleteBuilding(this.value)'>del</button>"];
	    						
	    						}
	    	    
	    	    var headings = ["Building", "Building Name", "Campus Id"];
	    		var table = getTable(headings, rows);
	    	    
	    		  
	    		insetTableHTML(table);
	    	
	    }
	    }
	  }
	sendGetRequest(xmlhttp,path);
	
}

function viewCampus(){
var form = getSearchTerm();
	path="campus.php?request=viewcampus";
	
	if(form.txtSearch.value.trim()!=""){
		
		path += "&searchterm="+ form.txtSearch.value + "&searchtype=" +
		form.searchType.value;
		
	}
	
	var xmlhttp = getXMLHttp();
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    var obj = xmlhttp.responseText;
	    var records = parseJason(obj);
	   	
    	if (records.length!=0){
	       	    var rows = new Array(records.length);
	    	    for (var i = 0; i < records.length; i++) {
	    						var data = records[i];
	 
	    						rows[i] = [data.Campus_ID, data.CampusName,getButtons(data.Campus_ID),"<button name= 'del' class='btnAdmin' type='button' value='" + data.Campus_ID + "' onclick='deleteCampus(this.value)'>del</button>"];
	    						
	    						}
	    	    
	    	    var headings = ["Campus ID", "Campus Name"];
	    		var table = getTable(headings, rows);
	    	    
	    		  
	    		insetTableHTML(table);
	    	
	    }
	    }
	  }
	sendGetRequest(xmlhttp,path);
	
}

function viewCourse(){
var form = getSearchTerm();
	path="course.php?request=viewcourse";
	if(form.txtSearch.value.trim()!=""){
		
		path += "&searchterm="+ form.txtSearch.value + "&searchtype=" +
		form.searchType.value;
		
	}
	
	var xmlhttp = getXMLHttp();
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    var obj = xmlhttp.responseText;
		
	    var records = parseJason(obj);
	   	
    	if (records.length!=0){
	    	    var rows = new Array(records.length);
	    	    for (var i = 0; i < records.length; i++) {
	    						var data = records[i];
	 
	    						rows[i] = [data.Course_ID, data.CourseName,getButtons(data.Course_ID),"<button name= 'del' class='btnAdmin' type='button' value='" + data.Course_ID + "' onclick='deleteCourse(this.value)'>del</button>"];
	    						
	    						}
	    	    
	    	    var headings = ["Course ID", "Course Name"];
	    		var table = getTable(headings, rows);
	    	    
	    		  
	    		insetTableHTML(table);
	    	
	    }
	    }
	  }
	sendGetRequest(xmlhttp,path);
	
}

function viewTutor(){
	
	var form = getSearchTerm();
		var path="tutor.php?request=viewtutor";
		if(form.txtSearch.value.trim()!=""){
			
			path += "&searchterm="+ form.txtSearch.value + "&searchtype=" +form.searchType.value;
			
			
		}
		
		
		var xmlhttp = getXMLHttp();
		xmlhttp.onreadystatechange=function()
		  {
		  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
		    var obj = xmlhttp.responseText;
		    var records = parseJason(obj);
		   	
	    	if (records.length!=0){
		    	    var rows = new Array(records.length);
		    	    for (var i = 0; i < records.length; i++) {
		    						var data = records[i];
		 
		    						rows[i] = [data.Tutor_ID, data.User_Id,data.Room_ID,data.officeHours,getButtons(data.Tutor_ID),"<button name= 'del' class='btnAdmin' type='button' value='" + data.Tutor_ID + "' onclick='deleteTutor(this.value)'>del</button>"];
		    						
		    						}
		    	    
		    	    var headings = ["Tutor ID", "User ID", "Room ID" , "Ofice Hours"];
		    		var table = getTable(headings, rows);
		    	    
		    		  
		    		insetTableHTML(table);
		    	
		    }
		    }
		  }
		sendGetRequest(xmlhttp,path);	
}

function viewModule(){
var form = getSearchTerm();
	path="module.php?request=viewmodule";
	if(form.txtSearch.value.trim()!=""){
		
		path += "&searchterm="+ form.txtSearch.value + "&searchtype=" +
		form.searchType.value;
		
		
	}
	
	var xmlhttp = getXMLHttp();
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    var obj = xmlhttp.responseText;
	    var records = parseJason(obj);
	   	
    	if (records.length!=0){
	    	    var rows = new Array(records.length);
	    	    for (var i = 0; i < records.length; i++) {
	    						var data = records[i];
	 
	    						rows[i] = [data.Module_ID, data.ModuleName,data.Course_ID,getButtons(data.Module_ID),"<button name= 'del' class='btnAdmin' type='button' value='" + data.Module_ID + "' onclick='deleteModule(this.value)'>del</button>"];
	    						
	    						}
	    	    
	    	    var headings = ["Module ID", "Module Name", "Course ID"];
	    		var table = getTable(headings, rows);
	    	    
	    		  
	    		insetTableHTML(table);
	    	
	    }
	    }
	  }
	sendGetRequest(xmlhttp,path);
	
}




function viewRooms(){
	var form = getSearchTerm();
	path="room.php?request=viewroom";
	
	if(form.txtSearch.value!=""){
		
		path +="&searchterm="+ form.txtSearch.value + "&searchtype=" +
		form.searchType.value;
		
	}
	
	var xmlhttp = getXMLHttp();
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    var obj = xmlhttp.responseText;
	    var records = parseJason(obj);
	   	
    	if (records.length!=0){
	    	    var rows = new Array(records.length);
	    	    for (var i = 0; i < records.length; i++) {
	    						var data = records[i];
	 
	    						rows[i] = [data.Room_Id, data.RoomName, data.RoomType,  data.Building_Id, data.Facility, data.SeatingLayout, data.Capicity,getButtons(data.Room_Id,"Room"),"<button name= 'del' class='btnAdmin' type='button' value='" + data.Room_Id + "' onclick='deleteRoom(this.value)'>del</button>"];
	    						
	    						}
	    	    
	    	    var headings = ["Room ID", "Room Name", "Room Type", "Building ID","Facility", "Seating Layout","Capicity"];
	    		var table = getTable(headings, rows);
	    	    
	    		  
	    		insetTableHTML(table);
	    	
	    }
	    }
	  }
	sendGetRequest(xmlhttp,path);
	
}
function sendGetRequest(xmlhttp,path){
	xmlhttp.open("GET",path,true);
	xmlhttp.send();
	
	
}
function sendPostRequest(xmlhttp,path, values){

	xmlhttp.open("POST",path,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(values);

}

function insetTableHTML(table){
	
	document.getElementById("tableView").innerHTML= table;
	
}

function showQrGenDialog(){
	var obj = "<form><label>Room ID </label><input id='txtRoomId' name='txtRoomId' onfocus='RefreshQRGen()' class='txtQr' type ='text' size ='35'><div class='qrGenBtn'><input type='button' onclick='generateQRCode(txtRoomId.value)' value='Generate code'><input type='button' onclick='closeDialog()' value='Close'></form><br><a href='viewqrcodes.php'>View Codes</a><div  id='qrFeedBack' class='diologueBtm'></div></div>";

	setDialogue("Generate QR code", obj);

}
function RefreshQRGen(){
	document.getElementById("qrFeedBack").innerHTML="";
	document.getElementById("txtRoomId").value="";
}

function generateQRCode(qrgen){
var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	document.getElementById("qrFeedBack").innerHTML= xmlhttp.responseText;
	
    }
  }
xmlhttp.open("POST","qrcodegenerator.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send("roomid="+qrgen);


}


function qrcodeSelectAll(form){
var qrcodes = form;

//chkBox = document.getElementsByTagName("input");
for (i = 0; i < qrcodes.length; i++){
if (qrcodes[i].type == 'checkbox')   {
      qrcodes[i].checked = true;
    }

} 

}


function qrcodeDeSelectAll(form){

var qrcodes = form;

//chkBox = document.getElementsByTagName("input");
for (i = 0; i < qrcodes.length; i++){
if (qrcodes[i].type == 'checkbox')   {
      qrcodes[i].checked = false;
    }

}

}

function bd(form){
var printqe="";
var code= 1;
var qrcodes = form;
for (i = 0; i < qrcodes.length; i++){
if (qrcodes[i].type == 'checkbox')   {
     if(qrcodes[i].checked==true){
	 printqe+="qrcode"+code+"="+qrcodes[i].value +"&";
	 code++;
	 }
	  
    }

}
var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	var x = xmlhttp.responseText;
	 var myWindow = window.open("application/pdf", "MsgWindow", "width=200, height=100");
    myWindow.document.write(x);
	document.close();
	
    }
  }
xmlhttp.open("POST","tester1.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(printqe);

}

function testerqrprint(form){
var codes = [];
var qrcodes = form;
var element=0;
for (i = 0; i < qrcodes.length; i++){
if (qrcodes[i].type == 'checkbox')   {
     if(qrcodes[i].checked==true){
	 
	 codes[element]=qrcodes[i].value;
	 element++;
	 }
	  
    }

}
document.cookie="codes="+codes;
window.open("pdftest.php");
//document.cookie="codes=k";


}

function confirmDelete(title,path,req){
var title = title;
var obj = "<form id ='deleteRecord'><input type='hidden' name='path' value='"+path+"'><input type='hidden' name='req' value='"+req+"'></form><p class='dioMsg'>Are you sure you want to delete this record </p><div class='diologueBtm'><button type='button' onclick='deleteRecord()'>Yes</button><button onclick='closeDialog()'>No</button><div>";
setDialogue(title,obj);


}


function postRecord(path, req){
var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	var x = xmlhttp.responseText;
	message(x);
	setTableView();
    }
  }
xmlhttp.open("POST",path,true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(req);

}
function deleteUser(id){
var path = "user.php";
var title = "Delete User ID:" + id;
var req = "request=deleteuser&IDdelete="+id;
confirmDelete(title,path,req);

}
function deleteBuilding(id){
	
	var path = "building.php";
	var title = "Delete Building ID:" + id;
	var req = "request=deletebuilding&IDdelete="+id;
	confirmDelete(title,path,req);	
	
}
function deleteCourse(id){
	
	var path = "course.php";
	var title = "Delete Course ID:" + id;
	var req = "request=deletecourse&IDdelete="+id;
	confirmDelete(title,path,req);	
	
}
function deleteModule(id){
	
	var path = "Module.php";
	var title = "Delete Module ID:" + id;
	var req = "request=deletemodule&IDdelete="+id;
	confirmDelete(title,path,req);	
	
}
function deleteTutor(id){
	
	var path = "tutor.php";
	var title = "Delete Tutor ID:" + id;
	var req = "request=deletetutor&IDdelete="+id;
	confirmDelete(title,path,req);	
	
}

function deleteBooking(id){
	var path = "bookings.php";
	var title = "Delete Booking ID:" + id;
	var req = "request=deletebooking&IDdelete="+id;
	confirmDelete(title,path,req);
	
	
}
function deleteRoom(id){
	var path = "room.php";
	var title = "Delete Room ID:" + id;
	var req = "request=deleteroom&IDdelete="+id;
	confirmDelete(title,path,req);
	
	
}
function deleteCampus(id){
	var path = "campus.php";
	var title = "Delete Campus ID:" + id;
	var req = "request=deletecampus&IDdelete="+id;
	confirmDelete(title,path,req);
	
	
}

function getButtons(id){
//var btn = "<button type='button' name='Edit' class='btnAdmin' value='" + id + "' onclick='" +edm+"'>Edit</button><button name= 'del' class='btnAdmin' type='button' value='" + id + "' onclick='"+ delm+"'>del</button>";
var btn = "<button type='button' name='Edit' class='btnAdmin' value='" + id + "' onclick='updateRecord(this.value)'>Edit</button>";
return btn;
}


function deleteRecord(){
var form = document.getElementById("deleteRecord");
var path = form.path.value;
var req = form.req.value;
if(path!="" && req!=""){ 
postRecord(path, req);
}
}

function getForm(path, title){
	
	var xmlhttp = getXMLHttp();
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
	    var obj = xmlhttp.responseText;
		setDialogue(title, obj);
	  
	    }
	  }
	sendGetRequest(xmlhttp,path);


}


function valUserForm(form){
if(form.lastName.value.trim()=="" || form.firstName.value.trim()=="" || form.email.value.trim()==""|| form.password.value.trim()==""){
formErrMsg();
return false;
} else{
return true;

}
}

function valCourseForm(form){

if(form.courseID.value.trim()=="" || form.courseName.value.trim()==""){
formErrMsg();
return false;
} else{
return true;

}

}

function formErrMsg(){

document.getElementById("errorMsg").innerHTML = "Please fill in the required fields";
}

function valModuleForm(form){

if(form.moduleID.value.trim()=="" || form.moduleName.value.trim()==""|| form.campusID.value.trim()==""){
formErrMsg();
return false;
} else{
return true;

}

}
function valTutorForm(form){
	if(form.userID.value.trim()=="" || form.tutorID.value.trim()==""|| form.officeHours.value.trim()==""){
		formErrMsg();
		return false;
		} else{
		return true;

		}	
	
}


function valCampusForm(form){
if(form.campusName.value.trim()==""){
formErrMsg();
return false;
} else{
return true;

}

}


function valBuildingForm(form){
if(form.buildingName.value.trim()=="" || form.campusID.value.trim()==""){
formErrMsg();
return false;
} else{
return true;
}
}


function valAdminBookingFrm(form){

if(form.userID.value.trim() =="" || form.roomID.value.trim()=="" || form.dateBooked.value.trim()=="" || form.moduleID.value.trim()==""){
		formErrMsg();
		return false;
	
	}else{
	var txtDate = form.dateBooked.value.split("-");
var txtTmeStrt = form.tmstr.value.split(":");
var txtDate = form.dateBooked.value.split("-");
var txtTmeEnd = form.tmend.value.split(":");
var today = new Date();
var bDate = new Date(txtDate[2], parseInt(txtDate[1]) -1,txtDate[0],txtTmeStrt[0],txtTmeStrt[1]);
var endtime = new Date();
endtime.setHours(txtTmeEnd[0]);
if(bDate.getHours()>= endtime.getHours()){
document.getElementById("errorMsg").innerHTML= "Booking  Time must not be before endtime";
return false;
} else{
if (today>bDate){
document.getElementById("errorMsg").innerHTML = "Booking Date can not be in the past";
return false;
}
}

	}
	return true;
}



function newRecord(){
	var path = document.getElementById("formPath").value;
	getForm(path,"Add New "+ document.getElementById("heading").innerHTML);
}

function add_UpdateBooking(){
var form = document.getElementById("bookingForm");

if(valAdminBookingFrm(form)){
	var path = "bookings.php"
	req="request="+ form.request.value +"&bookingID="+form.bookingID.value+ "&userID="+form.userID.value+"&roomID="+form.roomID.value + "&moduleID="+form.moduleID.value +"&datebooked=" + form.dateBooked.value + "&timestart="+form.tmstr.value+"&timeend="+form.tmend.value;
	postRecord(path,req);
}
}

function add_UpdateUser(){
	var form = document.getElementById("userform");
	if(valUserForm(form)){
		var path="user.php";
		req="request="+ form.request.value +"&userId="+form.userID.value+"&title="+form.title.value+"&lastname="+ form.lastName.value +"&firstname="+form.firstName.value+"&email="+form.email.value+"&accesslevel="+form.accessType.value +"&jobrole="+form.jobRole.value +"&password=" +form.password.value;
		postRecord(path,req);
	}
	
}


function add_UpdateBuilding(){
	var form = document.getElementById("buildingform");
	if(valBuildingForm(form)){
		
		var path="building.php";
		var req="request="+ form.request.value + "&buildingID="+form.buildingID.value+"&buildingname="+form.buildingName.value+"&campusID="+form.campusID.value;
		postRecord(path,req);
	}
	
}

function add_UpdateCampus(){
	var form = document.getElementById("campusform");
	if(valCampusForm(form)){
		
		var campusID = document.getElementById("campusID").value;
		var campusName = document.getElementById("campusName").value;
		var path="campus.php";
		var req="request="+ form.request.value +"&campusID="+form.campusID.value+"&campusname="+form.campusName.value;
		postRecord(path,req);
		
		
		
	}
}

function add_UpdateCourse(){
	var form = document.getElementById("courseform");
	if(valCourseForm(form)){
		var path="course.php";
		var req="request="+ form.request.value +"&courseID="+form.courseID.value+"&coursename="+form.courseName.value;
		postRecord(path,req);
		
		
	}
}

function add_UpdateModule(){
	var form = document.getElementById("moduleform");
	if(valModuleForm(form)){
		var path="module.php";
		var req="request="+ form.request.value +"&moduleID="+form.moduleID.value+"&modulename="+form.moduleName.value+"&campusID="+ form.campusID.value;
		postRecord(path,req);
		
	}
}

function valRoomForm(){
var form = document.getElementById("roomForm");
if(form.roomname.value.trim()=="" || form.roomType.value.trim()==""  || form.buildingID.value.trim()==""){
formErrMsg();
return false;
} else{
return true;
}

}

function imageUplaod(){

	if(document.getElementById("image").value=='add'){
		document.getElementById("roomImage").innerHTML = "<input type='file' id='file' name='file' onchange='showImage()'><output id='list'></output><a onclick='cancelImage()'>Cancel</a>";
		document.getElementById("image").value='remove';
	}


}
function cancelImage(){
	

	$('#uploadcontrols').empty();
	
	document.getElementById("image").value='add';
	
	
}

function showImage(){
	

	
var x = document.getElementById("file");
  
 var reader = new FileReader();
 reader.readAsDataURL(x.files[0])
 type = "image";
 reader.onload = function(){
	 var html = "";
	 document.getElementById("imageHolder").innerHTML= "<img id ='preview' src=\""+reader.result+"\">";
 };

}

function authoriseBooking(id){
var dio= "<p class='form2'>Authorise or reject booking "+ id+"</p><input type='hidden' id='process' value='"+id+"'><button onclick='proccesBooking(\"accept\")'>Authorise</button><button onclick='proccesBooking(\"reject\")'>Reject</button><button onclick='closeDialog()'>Cancel</button>";
var title = "Proccess Booking ID "+  id;
setDialogue(title,dio);
}

function AddBookingNote(id){
var path = "bookings.php?request=getnote&note="+id;
var xmlhttp = getXMLHttp();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    var obj = xmlhttp.responseText;
    if (obj.trim() == ""){
    	//do something
    } else{
	    
    	 var a = JSON.parse(obj);
		  var x = "<label>Note:</label><textarea id='note' name='note' rows='8' cols='45'>" +a[0].Notes+ "</textarea><button onclick='addNote("+id+")'>Submit</button><button onclick='closeDialog()'>Cancel</button>";
var title = "Note Booking ID: " +a[0].Booking_Id;
setDialogue(title,x);
    	    
    	
    }
    }
  }
sendGetRequest(xmlhttp,path);



}

function addNote(id){
if (document.getElementById("note").value!=""){
var nte = document.getElementById("note").value
var path = "bookings.php";
req = "request=addnote&note="+ id +"&notetext=" +nte;
postRecord(path, req)

}
}

function setDialogue(titleIn, obj){
		document.getElementById("dialogWrapper").innerHTML= obj;
		$(function() {
    $( "#dialogWrapper" ).dialog({
      title:titleIn,
	  modal: true,
		width: 360,
    	 resizable: true,
        });
});

if(document.getElementById("dateBooked")!=null){
$(function() {
    $( "#dateBooked" ).datepicker({dateFormat: 'dd-mm-yy'});
  });
}
    
}

function closeDialog(){
          $( "#dialogWrapper" ).dialog( "close" );
}

function getdatePicker(option){


if(option=="DateBooked" || option == "BookingDate"){
 $(function() {
    $( "#txtSearch" ).datepicker({dateFormat: 'dd-mm-yy'});
  }); 
  } else{
  var isDisabled = $("#txtSearch").datepicker( "destroy" );
  }
}
function destroyDatepicker(element){

//$("#"+element).datepicker( "destroy" );

}

function checkaRoomAvailability(){
var frmBooking = document.getElementById("frmUserBooking");

if(bookRoomVal(frmBooking)){
var roomID = frmBooking.roomId.value;
var module = frmBooking.module.value;
var date = frmBooking.date.value;
var timeStart = frmBooking.timeStart.value;
var timeEnd = frmBooking.timeEnd.value;
var data = "checkroomavailability="+roomID+"&module="+module+"&date="+date+"&timestart="+timeStart+"&timeend="+ timeEnd;
var path= "boookings.php?" + data;
var xmlhttp = getXMLHttp();
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	
	var x = xmlhttp.responseText;
	 if (x.trim()==""){
userConfirmBooking(data);
		
			 
	 } else{
	setErrMsg("The room is not available at the specified date and time");
	 }
	
    }
  }
sendGetRequest(xmlhttp,path);

} 

}

function userConfirmBooking(){
	var form = document.getElementById("confirmBookingform");
	var module = frmBooking.module.value;
	var date = frmBooking.date.value;
	var timeStart = frmBooking.timeStart.value;
	var timeEnd = frmBooking.timeEnd.value;
	var data = "checkroomavailability="+roomID+"&module="+module+"&date="+date+"&timestart="+timeStart+"&timeend="+ timeEnd;
	var path= "boookings.php?" + data;
var xmlhttp;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
	var x = xmlhttp.responseText;
	document.getElementById.innerHTML= x;
		
    }
  }
xmlhttp.open("POST","bookroom.php",true);
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
xmlhttp.send(data);


}

function add_UpdateTutor(){
	var data = document.getElementById("tutorForm");
	var formData = new FormData(data);

		postForm(formData,"tutor.php");

	
		
}

function add_UpdateRoom(){
	if(valRoomForm()){
var data = document.getElementById("roomForm");
	var formData = new FormData(data);
	postForm(formData,"room.php");

	}
}
	
function postForm(formData,req){
	var xmlhttp = getXMLHttp();
	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
	    {
		var x = xmlhttp.responseText;
		message(x);
		setTableView();
			
	    }
	  }
	xmlhttp.open("POST",req,true);
	xmlhttp.send(formData);
	
}

function setCookieView(){

	document.cookie = "tabledisplay=" + document.getElementById("tabledisplay").value;

}

function setTableView(){
var view = getCookieValue("tabledisplay");
switch (view) {
case "Booking":
	bookingView();
	break;
case "User":
	userView();
	break;
case "Room":
	roomView();

	break;
case "Module":
	moduleView();

	break;
case "Course":
	courseView();

	break;
case "Building":
	buildingView();

	break;

case "Campus":
	campusView();

	break;
	
case "Tutor":
	tutorView();

	break;
default:
	bookingView();

}
		
}
function getCookieValue(cookieName){
	var cookie = document.cookie.split(';');
	for (var i = 0; i < cookie.length; i++) {
		var x = cookie[i].split('=')[0];
				
		if(x.trim()==cookieName){
			return cookie[i].split('=')[1]
		}
		
	}
	
}
function adminView(){
	setTableView();
	
	
}

function imageAdd(){
	
	document.getElementById("uploadcontrols").innerHTML="<div id='imageHolder'></div><div id='roomImage'></div>";
	 imageUplaod();
}

function message(response){
	var check = response.trim();
	var res="";
	if(check.substr(0,2)=="OK"){
		res = check.substring(3, check.length);
		closeDialog();
		
	}else if(check.substr(0,2)=="ID") {
		var id = check.substring(3, check.length).trim();
		res = "New Record Created";
		if(id !=0){
			res+=" ID: "+id;
		}
		closeDialog();
	}else{
	res = response;
	}
	document.getElementById("message").innerHTML= "<span class='delDiog'>" + res + "<span></div>" + "<div class='diologueBtm'><button onclick='closeMessage()'>OK</button><div>";
	$(function() {
	    $( "#message" ).dialog({
	    	 resizable: false,
	        });
	});
	
}
function closeMessage(){
	
	 $( "#message" ).dialog( "close" );
	
}

function parseJason(object) {
	try {
		var parsed =  JSON.parse(object);
		if (parsed.length==0){
			
			insetTableHTML("no results found");
		}
		return parsed;
	} catch (e) {
		// TODO: handle exception
	}
	
	
	
	
}

function proccesBooking(decision){
	var booking = document.getElementById("process").value;
	
	var path="bookings.php";
	var req="request=processbooking" + "&booking="+booking+"&decision="+decision;
	postRecord(path, req)

	
}
function convertAuthrised(data){
	notification ="";
	if(data.trim()=="1"){
		notification = "&#10004";
	}else if(data.trim()=="2"){
		notification = "&#10006";
		
	}else{
		notification = "<span class='un1'>NP</span>";
		
	}
	return notification;
}

function unprocessedBookings(){
	
var path = "bookings.php?request=viewbooking&view=all&order=ASC&searchterm=3&searchtype=Authorised";
	viewBooking(path);
}

function canceluserbooking(){
	
	window.location = "findroom.php?roomname=G107";
}








