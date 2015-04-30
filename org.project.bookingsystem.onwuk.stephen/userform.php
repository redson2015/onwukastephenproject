
<?php
require_once 'DOA.php';
require_once 'disableControl.php';

?><?php
$userID ="";
$email="";
$title="";
$firstName ="";
$lastName = "";
$accessLevel="";
$jobRole="";
$password="";
$function="adduser";

if(isset($_GET['updateuser'])){
	
$id = $_GET['updateuser'];
$user = json_decode(searchUsers($id, "User_ID"), true) ;
if (count($user)!=0){
	$userID = $user[0]['User_Id'];
	$title = $user[0]['Title'];
	$firstName = $user[0]['FirstName'];
	$lastName = $user[0]['LastName'];
	$email= $user[0]['Email'];
	$accessLevel =  $user[0]['AccessLevel'];
	$jobRole= $user[0]['JobRole'];
	$password=$user[0]['password'];
	$function="updateuser";
}

}

echo "<form id='userform'>
		<input name='request' type='hidden' value='".$function."'>
<table id = 'bookingEdit'>
    <tr>
    <td>
	<label id='errorMsg'></label>
     <input id='userID' name='userID' type='hidden' value='".$userID."'></td>
   		
   		</tr>
    
    <tr>
       <td>
    <label>Title<span>*</span></label>
  <select id='title'  name='title'>
  <option value='Mr'>Mr</option>
		<option value='Mrs'>Mrs</option>
		<option value='Miss'>Miss</option>
		<option value='Dr'>Dr</option>
		<option value='Prof'>Prof</option>
</select>
    </td> </tr>
    <tr>		
        <td>
    <label>Last Name<span>*</span></label>
  <input id='lastName' name='lastName' type='text' value='".$lastName."'>
    </td></tr>
    <tr>
    <td><label>First Name<span>*</span></label>
		<input id='firstName' name='firstName'  type='text' value='".$firstName."'></td></tr>
    <tr>
        <td>
    <label>Email<span>*</span></label>
   <input id='email' name='email' type='text' value='".$email."'>
    </td></tr>
    <tr>
    <td>
    <label>Job Role<span>*</span></label>
 <input id='jobRole' name='jobRole' type='text' value='".$jobRole."'>
    </td></tr>
		
		 <tr>
    <td>
    <label>Acess Type<span>*</span></label>
    <select id ='accessType' name='accessType'>
 	<option value='UL'".setAccessType("UL").">UL (User)</option>
  <option value='AL'".setAccessType("AL").">AL (Administrator)</option>
	
</select>
    </td></tr>
	 <tr>
    <td>
    <label>Password<span>*</span></label>
   <input id='password' type='password' value ='".$password."'>
    </td></tr>
    
   	   <tr>
    <td>";

$buttontext="";
if(isset($_GET['updateuser'])){
	$buttontext = "Update";

}else{
	$buttontext = "Submit";

}

echo "<button onclick='add_UpdateUser()' type='button'>".$buttontext."</button>";

echo "<button type='button' onclick='closeDialog()'> Cancel</button>
    </td></tr>
</table>

</form>";



function setAccessType($data){
	 
	if (isset($_GET['updateuser'])){

		global $accessLevel;
		if (trim($data)!="" and $accessLevel==$data) {
			return "selected";
		}

	}
	 
	 
}







?>