
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link type="text/css" rel="stylesheet" href="./css/styles.css"/>
<script src="./scripts/ajax.js" type="text/javascript"></script>
<script src="./scripts/validation.js" type="text/javascript"></script>
<title>Login</title>

</head>
<body>
<?php
require_once 'DOA.php';
require_once 'genInputs.php';
require_once 'disableControl.php';

?><?php
$roomID ="";
$roomName = "";
$roomType = "";
$buildingID = "";
$facility = "";
$seatingLayout ="";
$capacity = "";
$function="addroom";

if(isset($_GET['updateroom'])){
	
$room = json_decode(searchRoom($_GET['updateroom'], "Room_ID"),true);
if ($room!=""){
	$roomID= $room[0]['Room_Id'];
	$roomName = $room[0]['RoomName'];
	$roomType = $room[0]['RoomType'];
	$buildingID = $room[0]['Building_Id'];
	$facility = $room[0]['Facility'];
	$seatingLayout =$room[0]['SeatingLayout'];
	$capacity =$room[0]['Capicity'];
	$function="updateroom";
	
}

}
//form was xr
echo "<form id ='roomForm' enctype='multipart/form-data'>
		<input name='request' type='hidden' value='".$function."'>
<table id = 'bookingEdit'>
  <tr>
    <td><label id='errorMsg'></label>
				<input id='roomID' name='roomID' type='hidden' value='".$roomID."'></td>
    </tr>
    		<tr>
    <td><label>Room Name<span>*</span></label>
    		<input id ='roomName' name='roomname' type='text' value='".$roomName."'>
    		
    		</td></tr>
			
		<tr>
    <td><label>Room Type<span>*</span></label>
    		<input id ='roomType' name ='roomtype' type='text' value='".$roomType."'>
    		
    		</td></tr>
   <tr>
    <td>
    
    <label>Building ID<span>*</span></label>
    <select id='buildingID' name ='buildingID'>".getOptions2(getBuildingIds(),$buildingID).
"</select>
    </td></tr>
    
    <tr>
       <td>
    <label>Facility</label>
	<input name ='facility[]' type='checkbox' value='Linix Computers' class='chkr' ".setCheck($facility,'Linix Computers')."><label class='lblrm'>Linix Computers</label>
<input name='facility[]' type='checkbox' value='Mac Computers' class='chkr' ".setCheck($facility,'Mac Computers')."><label class='lblrm'>Mac Computers</label>
   </td> </tr> <tr>
       <td> 
    <input name='facility[]' type='checkbox' value='Microsoft Computers' class='chkr' ".setCheck($facility,'Microsoft Computers')."><label class='lblrm'>Microsoft Computers</label>
<input name='facility[]' type='checkbox' value='Whiteboard' class='chkr' ".setCheck($facility,'Whiteboard')."><label class='lblrm'>Whiteboard</label>
     </td> </tr>		
   <tr>
       <td> 		
  <input name ='facility[]' type='checkbox' value='DVD player' class='chkr' ".setCheck($facility,'DVD player')."><label class='lblrm'>DVD player</label>
<input name ='facility[]' type='checkbox' value='Microphone Lectern' class='chkr' ".setCheck($facility,'Microphone Lectern')."><label class='lblrm'>Microphone Lectern</label>
    </td> </tr>		
    		
 <tr>
		<td><input name ='facility[]' type='checkbox' value='Laptop Connection'' class='chkr' ".setCheck($facility,'Laptop Connection')."><label class='lblrm'>Laptop Connection</label>
		    		
    </td> </tr>
    <tr>		
        <td>
    <label>Capacity</label>
   <input id='capacity' name='capacity' type='text' value='".$capacity."'>
    </td></tr>
    <tr>
        <td>
    <label>Seating<span>*</span></label>
    <select id='seating' name='seating'><option value='not fixed' ".setSeating('not fixed').">Not fixed (moveable chairs)</option>
    		<option value='Fixed'".setSeating('Fixed').">Fixed (no moveable chairs)</option>
</select>
    </td></tr>
    		
    <tr>
        <td>
    <label id='change'>Image </label>
	<input id ='image' type='hidden' value='add'>".imageOptions()."
    </td></tr> 		
    		
    		

    <tr>
    <td>";

$buttontext="";
if(isset($_GET['updateroom'])){
	$buttontext = "Update";

}else{
	$buttontext = "Submit";

}

echo "<button onclick='add_UpdateRoom()' type='button'>".$buttontext."</button>";

echo "<button type='button' onclick='closeDialog()'> Cancel</button>
    </td></tr>
</table>


</form>";

    function setCheck($fac,$text){
    	if (isset($_GET['updateroom'])){
    		if (strpos($fac,$text)!==false){
    			return "Checked";
    
    		}
    	
    	}
    	
    	
    }

    function setSeating($data){
    	
    	if (isset($_GET['updateroom'])){
    		
    		global $seatingLayout;
    		if (trim($data)!="" and $seatingLayout==$data) {
    			return "selected";
    		}
    		
    	}
    	
    	
    }
    function imageOptions(){
    	if(!isset($_GET['updateroom'])){
    		return "<a onclick='imageAdd()'>+Add</a>
    		<input id ='image' type='hidden' value='add'><div id='uploadcontrols'></div>";
    
    	}
    	 
    	 
    }
    
?>


</body>
</html>