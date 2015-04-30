<?php
session_start();
include_once  "DOA.php";
$userNotFound="";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$user = $_POST["user"];
$password = $_POST["password"];
	
$results = json_decode(getUserLogin($user, md5($password)),true);
if (count($results)!=0){
	// output data of each row
	
	$_SESSION['loggedIn'] = true;
	$_SESSION['userID'] = $results[0]["User_Id"];
	$_SESSION['userEmail'] = $results[0]["Email"];
	$_SESSION['accessLevel'] = $results[0]["AccessLevel"];
	$_SESSION['userName'] = $results[0]["Title"]." ".$results[0]["FirstName"]." ".$results[0]["LastName"];
	header('Location: findRoom.php?roomname=G107');
	exit;
} else{
	$userNotFound = "<span class='lErr'>Uable to find user login on details</span>";
	
}
}

?>
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
<div id="contents">
<div id ="loginPage">
<div id="loginHeader">Login</div>
<form id=contact onsubmit="return loginValidation(this)" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?> name ="loginForm" method="post">
<table id ="loginTable">
 <tr class="terror">
    <td></td>
    <td id ='errMsg'><?php echo $userNotFound;?></td>		
  </tr>
  <tr>
    <td>User Name:</td>
    <td><input type="text" name="user" size="35px" required maxlength="50"></td>		
  </tr>
  <tr>
    <td>Password:</td>
    <td class="tdButton"><input type="password" name="password" size="35px" ><input type="hidden" name="check" value="submit" required></td>		
  </tr>
  <tr>
    <td></td>
    <td> <input value="Login" type="submit"></td>		
  </tr>
</table>
</form>
</div>
</div>
</body>
</html>
