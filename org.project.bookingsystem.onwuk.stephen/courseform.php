
<?php
require_once 'DOA.php';
require_once 'disableControl.php';

?><?php
$courseID ="";
$courseName="";
$function="addcourse";


if(isset($_GET['updatecourse'])){
	
$id = $_GET['updatecourse'];
$course = json_decode(searchCourse($_GET['updatecourse'], "Course_ID"),true);
if ($course!=""){
	$courseID= $course[0]['Course_ID'];
	$courseName= $course[0]['CourseName'];
	$function="updatecourse";
}

}
echo "<form id='courseform'>
			<input name='request' type='hidden' value='".$function."'>
<table id = 'bookingEdit'>
    <tr>
    <td><label id='errorMsg'></label>
    <label>Course ID<span>*</span></label>
   <input id ='courseID' name='courseID' type='text' value='".$courseID."'".disable($courseID)."></td></tr>
 <tr>
    <td>
    <label>Course Name<span>*</span></label>
    <input id='courseName' name='courseName' type='text' value='".$courseName."'>
    </td></tr>		
       	   <tr>
    <td>";
$buttontext="";
if(isset($_GET['updatecourse'])){
	$buttontext = "Update";

}else{
	$buttontext = "Submit";

}

echo "<button onclick='add_UpdateCourse()' type='button'>".$buttontext."</button>";

echo "<button type='button' onclick='closeDialog()'> Cancel</button>
    </td></tr>
</table>

</form>";?>