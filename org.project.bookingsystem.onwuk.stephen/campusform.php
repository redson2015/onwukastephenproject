<?php
require_once 'DOA.php';
require_once 'disableControl.php';

?><?php
$campusID ="";
$campusName="";
$function="addcampus";
if(isset($_GET['updatecampus'])){
	
$campus = json_decode(searchCampus($_GET['updatecampus'], "Campus_ID"),true);
if (count($campus)!=0){
	$campusID= $campus[0]['Campus_ID'];
	$campusName= $campus[0]['CampusName'];
	$function="updatecampus";
}

}
echo "<form id='campusform'>
			<input name='request' type='hidden' value='".$function."'>
<table id = 'bookingEdit'>
    <tr>
    <td>
	<label id='errorMsg'></label>
    <input  id='campusID' name='campusID' type='hidden' value='".$campusID."'></td></tr>
 <tr>
    <td>
    <label>Campus Name<span>*</span></label>
 <input id='campusName' name='campusName' type='text' value='".$campusName."'>
    </td></tr>

 		
 	   <tr>
    <td>";
$buttontext="";
if(isset($_GET['updatecampus'])){
	$buttontext = "Update";

}else{
	$buttontext = "Submit";

}

echo "<button onclick='add_UpdateCampus()' type='button'>".$buttontext."</button>";

echo "<button type='button' onclick='closeDialog()'> Cancel</button>
    </td></tr>
</table>

</form>";?>