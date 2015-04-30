
<?php
require_once 'DOA.php';
require_once 'genInputs.php';
require_once 'disableControl.php';

?><?php
$moduleID ="";
$moduleName="";
$couseID="";
$function="addmodule";
if(isset($_GET['updatemodule'])){
	
$module = json_decode(searchModule($_GET['updatemodule'], "Module_ID"),true);
if ($module!=""){
	$moduleID= $module[0]['Module_ID'];
	$moduleName= $module[0]['ModuleName'];
	$couseID = $module[0]['Course_ID'];
	$function="updatemodule";
}

}
echo "<form id='moduleform'>
			<input name='request' type='hidden' value='".$function."'>
<table id = 'bookingEdit'>
    <tr>
    <td>
	<label id='errorMsg'></label>
    <label>Module ID<span>*</span></label>
    <input id='moduleID' name='moduleID' type='text' value='".$moduleID."'".disable($moduleID)."></td></tr>
 <tr>
    <td>
    <label>Module Name<span>*</span></label>
    <input id ='moduleName' name='moduleName' type='text' value='".$moduleName."'>
    </td></tr>		
    
    	<tr>		
        <td>
    <label>Course ID</label>
    <select id='campusID' name='campusID'>".getOptions2(getCourseIds(),$couseID)."
</select>
    </td></tr>	
    		
      <tr>
    <td>";
$buttontext="";
if(isset($_GET['updatmodule'])){
	$buttontext = "Update";

}else{
	$buttontext = "Submit";

}

echo "<button onclick='add_UpdateModule()' type='button'>".$buttontext."</button>";

echo "<button type='button' onclick='closeDialog()'> Cancel</button>
    </td></tr>
</table>

</form>";?>		
    	