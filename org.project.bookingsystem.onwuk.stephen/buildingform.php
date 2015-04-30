
<?php
require_once 'DOA.php';
require_once 'genInputs.php';
require_once 'disableControl.php';
?><?php
$buildingID ="";
$buildingName="";
$campusID ="";
$function="addbuilding";

if(isset($_GET['updatebuilding'])){
	
$building = json_decode(searchBuilding($_GET['updatebuilding'], "Building_ID"),true);
if ($building!=""){
	$buildingID= $building[0]['Building_ID'];
	$buildingName= $building[0]['BuildingName'];
	$campusID = $building[0]["Campus_ID"];
	$function="updatebuilding";
}

}
echo "<form id='buildingform'>
			<input name='request' type='hidden' value='".$function."'>
<table id = 'bookingEdit'>
			
    <tr>
    <td><label id='errorMsg'></label>

   <input id ='buildingID' name='buildingID' type='hidden' value='".$buildingID."'></td></tr>
 <tr>
    <td>
    <label>Building Name<span>*</span></label>
    <input id='buildingName' name='buildingName' type='text' value='".$buildingName."'>
    </td></tr>		
    <tr>
    <td>
    <label>Campus ID<span>*</span></label>
  <select id='campusID' name='campusID'>".getOptions2(getCampusIds(),$campusID)."
</select>
    </td></tr>
      	   <tr>
    <td>";

$buttontext="";
if(isset($_GET['updatebuilding'])){
	$buttontext = "Update";

}else{
	$buttontext = "Submit";

}

echo "<button onclick='add_UpdateBuilding()' type='button'>".$buttontext."</button>";

echo "<button type='button' onclick='closeDialog()'> Cancel</button>

    </td></tr>
</table>

</form>";?>

