/*var colours = [];*/

function dayTimeTable(roomId, dateIn){
	/*var ob = new Date();
	ob.sethour(13,00);
	var h = ob.getHours() +" : " +ob.getMinutes();
	alert(h);*/

	
	var xmlhttp = getXMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			var obj = xmlhttp.responseText;
			day(obj);
		}
	}
	xmlhttp.open("GET", "timetableview.php?request=daytimetable&roomid="+ roomId + "&date="+dateIn, true);
	xmlhttp.send();

}

function day(obj){
	var hour = 8;
	var a ="";
	if(obj.length!="[]"){
	a = JSON.parse(obj);
	}
	do {
	if(a!=""){
		 for (var j = 0; j < a.length; j++) {
				var data = a[j];
				if(data.TimeStart== hour){
					 //var h = document.getElementById(hour).innerHTML;
					 rowspan = data.TimeEnd-data.TimeStart;
					 var clr = '#'+Math.floor(Math.random()*16777215).toString(16);
					var td="<td bgcolor='"+clr + "' rowspan='"+rowspan + "'>" + data.TimeStart + ":00" +" - "+ data.TimeEnd +":00" +"<br>"+ data.Booker +"<br>"+ data.ModuleName +"</td>";
					addcolRow(hour, td)
					 hour+=rowspan;
					
				}
		 }
		 }
		 
		 	//var h = document.getElementById(hour).innerHTML;
			/*var h = h+ ;
			getdocument.getElementById(hour).innerHTML = h;*/
			addcolRow(hour, "<td></td>");
		 hour++;
	} while (hour<21);
}





function getXMLHttpRequest(){
	var xmlhttp
	if (window.XMLHttpRequest) {
		xmlhttp = new XMLHttpRequest();
	} else {
		xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return xmlhttp;	
}


function getweek(obj){
var td = "<th>Monday</th><th>Tuesday</th><th>Wednesday</th><th>Thursday</th><th>Friday</th><th>Saturday</th><th>Sunday</th>"; 
	addcolRow("dayHead", td );
	var a="";
	if(obj!=""){
	a = JSON.parse(obj);
	}
	for (var d = 0; d <7; d++){
	var hour = 8;
	do {
	if(a!=""){
		 for (var j = 0; j < a.length; j++) {
				var data = a[j];
				if(data.TimeStart== hour && data.Day== d){
					 //var h = document.getElementById(hour).innerHTML;
					 rowspan = data.TimeEnd-data.TimeStart;
					 var clr = '#'+Math.floor(Math.random()*16777215).toString(16);
					  var td="<td bgcolor='"+clr + "' rowspan='"+rowspan + "'>" + data.TimeStart + ":00" +" - "+ data.TimeEnd +":00" +"<br>"+data.Booker+ "<br>"+ data.ModuleName +"</td>";
					addcolRow(hour, td);
					 hour+=rowspan;
					
				}
		 }
		 }
		 	//var h = document.getElementById(hour).innerHTML;
			//h = h+ "<td></td>";
		 	addcolRow(hour,"<td></td>");
		 hour++;
	} while (hour<21);

	
}
}


function weektime(roomId, dateIn){

	
	var xmlhttp = getXMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
			
			var obj = xmlhttp.responseText;
			getweek(obj);
		}
	}
	xmlhttp.open("GET", "timetableview.php?request=weektimetable&roomid="+ roomId + "&date="+dateIn, true);
	xmlhttp.send();

}

function addcolRow(location, td){
	document.getElementById(location).innerHTML+= td;
	
}