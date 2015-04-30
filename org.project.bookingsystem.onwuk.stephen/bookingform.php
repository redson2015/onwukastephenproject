<?php
require_once 'DOA.php';
require_once 'genInputs.php';
require_once 'disableControl.php';

?><?php
$BookingID ="";
$BookingDate = "";
$UserID = "";
$RoomID = "";
$TimeStarting = "";
$EndTime ="";
$ModuleID = "";
$dateBooked = "";
$Notes = "";
$function="addbooking";


if(isset($_GET['updatebooking'])){
	
$booking = json_decode(getBooking($_GET['updatebooking'], "Booking_ID","ASC"),true);
if (count($booking)!=0){
	$BookingID= $booking[0]['Booking_Id'];
	$BookingDate = $booking[0]['BookingDate'];
	$UserID = $booking[0]['User_Id'];
	$RoomID = $booking[0]['Room_Id'];
	$TimeStarting = $booking[0]['TimeStarting'];
	$EndTime =$booking[0]['EndTime'];
	$ModuleID = $booking[0]['Module_Id'];
	$dateBooked=$booking[0]['DateBooked'];
	$Notes = $booking[0]['Notes'];
	$function="updatebooking";
	
}

}
echo "<form id='bookingForm'>
			<input name='request' type='hidden' value='".$function."'>
<table id = 'bookingEdit'>
  <tr>
    <td><label id='errorMsg'></label>
			<input id='bookingID' type='hidden' value='".$BookingID."'></td>
    </tr>
    <tr>
    <td>
    
    ".getUserIDCon($UserID)."
    </td></tr>
    
    <tr>
       <td>
    <label>Room ID<span>*</span></label>
    <select id='roomID' name='roomID'>".getOptions2(getRoomIds(),$RoomID).
"</select>
    </td> </tr>
    <tr>		
        <td>
    <label>Module ID</label>
    <select id='moduleID' name='moduleID'>".getOptions2(getModuleIds(),$ModuleID)."
</select>
    </td></tr>
    
    	 <td><label>Date Booked<span>*</span></label>
    		<input id ='dateBooked' name='dateBooked' type='text' value='".$dateBooked."'>
    		
    		</td></tr> 		
    		
    		<tr>
        <td>
    <label>Time Starting<span>*</span></label>
    <select id='tmstr' name='tmstr'>".getTime($TimeStarting)."
</select>
    </td></tr>
    		
   	<tr>
   
    <tr>
    <td>
    <label>Time Ending<span>*</span></label>
    <select id='tmend' name='tmend'>".getTime($EndTime)."</select>
    </td></tr>
    <tr>
    <td>";
$buttontext="";
if(isset($_GET['updatebooking'])){
	$buttontext = "Update";
	
}else{
		$buttontext = "Submit";
		
	}
	
	echo "<button onclick='add_UpdateBooking()' type='button'>".$buttontext."</button>";
	
    echo "<button type='button' onclick='closeDialog()'> Cancel</button>
    </td></tr>
</table>


</form>";



function  getuserIdcon($UserID){
	if(isset($_GET['updatebooking'])){
		
		return "<label>User ID: ".$UserID."</label><input id ='userID' type='hidden' value='".$UserID."'>";
	}else {
	return "<label>User ID<span>*</span></label><select id='userID'>".getOptions2(getUserIds(),$UserID).
	"</select>";
	}
	
}

?>