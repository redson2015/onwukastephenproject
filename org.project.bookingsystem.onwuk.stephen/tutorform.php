
<?php
require_once 'DOA.php';
require_once 'disableControl.php';
require_once 'genInputs.php';

?><?php
$tutorID ="";
$userID="";
$roomID="";
$officeHours="";
$function="addtutor";
if(isset($_GET['updatetutor'])){
	
$tutor = json_decode(searchtutor($_GET['updatetutor'], "Tutor_ID"),true);
if (count($tutor)!=0){
	$tutorID= $tutor[0]['Tutor_ID'];
	$userID= $tutor[0]['User_Id'];
	$roomID=$tutor[0]['Room_ID'];
	$officeHours = $tutor[0]['officeHours'];
	$function="updatetutor";
}

}
echo "<form id ='tutorForm' enctype='multipart/form-data'>
			<input name='request' type='hidden' value='".$function."'>
<table id = 'bookingEdit'>
    <tr>
    <td>
	<label id='errorMsg'></label>
      <input  id='TutorID' name='tutorID' type='hidden' value='".$tutorID."'></td></tr>
 
	  <tr>
        <td>
    <label id='change'>Image <a onclick='imageUplaod()'>+/Change</a></label>
	<input id ='image' type='hidden' value='add'>
     <div id='imageHolder'></div>
   <div id='roomImage'>		
    </div>
    </td></tr> 		
			
<tr>
    <td>
    <label>User ID<span>*</span></label>
  <select id='UserID' name='userID'>".getOptions2(getUserIds(),$userID).
"</select>
    </td></tr>
     <tr>
    <td>
    <label>Room ID<span>*</span></label>
  <input  id='RoomID' name='roomID' type='text' value='".$roomID."'>
    </td></tr>
     <tr>
    <td>
    <label>Office Hours<span>*</span></label>
<textarea id='OfficeHours' name='officeHours'>".$officeHours."</textarea>
    </td></tr>

 		
 	   <tr>
    <td>";
$buttontext="";
if(isset($_GET['updatmodule'])){
	$buttontext = "Update";

}else{
	$buttontext = "Submit";

}

echo "<button onclick='add_UpdateTutor()' type='button'>".$buttontext."</button>";

echo "<button type='button' onclick='closeDialog()'> Cancel</button>

    </td></tr>
</table>

</form>";?>
