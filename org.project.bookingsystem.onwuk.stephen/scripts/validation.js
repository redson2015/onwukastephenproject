function loginValidation(form){
	var logginErr ="";
	if(contact.user.value==""){
		logginErr = "Please enter user name";
		settxtBorderColor(contact.user, "red");
		setErrMsg(logginErr);
		return false;
	} else{
		settxtBorderColor(contact.password, "")
		if(contact.password.value==""){
			logginErr = "Please enter password";
			settxtBorderColor(contact.password, "red")
			setErrMsg(logginErr);
			return false;
		}else{
			return true;
			} 
		}
 
}
function setErrMsg(err) {
	document.getElementById('errMsg').innerHTML = "<span class='lErr'>" + err + "</span>" ;
	
}
function settxtBorderColor(inputIn, colour) {
	inputIn.style.borderColor= colour;
}
function bookRoomVal(form){
	var errors =0;
	if(form.date.value ==""){
		settxtBorderColor(form.date, "red");
		errors++;
	
	} else{
		settxtBorderColor(form.date, "");
		
	}
	if(form.module.value==""){
		settxtBorderColor(form.module, "red");
		errors++;
	} else{
		
		settxtBorderColor(form.module, "");
		
	} 
	if(errors>0){
		
		setErrMsg("Please complete the booking form");
		return false;
		
	} else{
		
		
		if(form.timeStart.value>= form.timeEnd.value){
			setErrMsg("Time End need to be greater than time End");
			return false;
		} else{
		
		if(dateVal(form.date.value,form.timeStart.value)){
			
			
			return true;
			
		} else{
			
			return false;
		}
			
		}	
		
	}
	
	
}


function dateVal(date,timestart){
	
	var start = timestart.split(":");
	var today = new Date();
	
	var txtDate = date.split("-");
	var today = new Date();
	var bDate = new Date(txtDate[2], parseInt(txtDate[1]) -1,txtDate[0],start[0],start[1]);
	if (today>bDate){
		setErrMsg("Booking Date can not be in the past");
		return false;
		} else{
			
			return true;	
		}
	
	
	
	
}

function checkhours(startIn,endIn){
	
	var start = startIn.split(":");
	var end = endIn.split(":");
	h = parseInt(end)-parseInt(start);
	if (h>=1 && h<4){
	return true;
	}else{
		
	return false;
	}
}
function formUserBookRoomVal(){
var form = document.getElementById("userBookingForm");
var errors =0;
	if(form.date.value ==""){
		settxtBorderColor(form.date, "red");
		errors++;
	
	} else{
		settxtBorderColor(form.date, "");
		
	}
	if(form.module.value==""){
		settxtBorderColor(form.module, "red");
		errors++;
	} else{
		
		settxtBorderColor(form.module, "");
		
	} 
	if(errors>0){
		
		setErrMsg("Please complete the booking form");
		return false;
		
	} else{	
				
		if(form.timeStart.value>= form.timeEnd.value){
			
			setErrMsg("Time End need to be greater than time End");
			return false;
		}else if(!checkhours(form.timeStart.value,form.timeEnd.value)){
			setErrMsg("You can only book a room for upto 3 hours");
			return false;
			
		}else{
		
			return dateVal(form.date.value,form.timeStart.value)
			
		}	
		
	}
	return true;

}
