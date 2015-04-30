<?php session_start();
require_once 'checklogin.php';?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link type="text/css" rel="stylesheet" href="./css/styles.css" />
<link rel="stylesheet" href="./css/jquery-ui/jquery-ui.css"
	type="text/css" />
<link rel="stylesheet" href="./css/extra-styles.css" type="text/css" />
<script src="./scripts/jquery-2.1.3.js" type="text/javascript"></script>
<script src="./scripts/jquery.js" type="text/javascript"></script>
<script src="./scripts/jquery-ui.js" type="text/javascript"></script>
<script src="./scripts/ajax.js" type="text/javascript"></script>
<script src="./scripts/controls.js" type="text/javascript"></script>
<script src="./scripts/script.js"></script>
<title>View QR codes</title>
</head>
<body>
<?php include "header.php"; ?>
	<div id="contentsqr">
	
	<h2 class="qrhr">Room Qr codes</h2>
	<hr class="qrhr">
	<form name="roomQrCodes">
	<div id ="searchBox">
<input type="button" value="Select all" onclick="qrcodeSelectAll(roomQrCodes)">
	<input type="button" value="deselect" onclick="qrcodeDeSelectAll(form)">
	<input type="button" value="Print" onclick="testerqrprint(roomQrCodes)">
	</div>
		
	<div id ="qrgen">	
	<?php 
	
	

    $dir = "roomqrcodes/";
    $d = dir($dir);
	while (false!== ($file = $d->read())) {
		if ($file=="." || $file==".."){
			continue;
		}
		echo "<figure><figcaption>"."Room ID: ".substr($file,0,-37)."</figcaption><img class='qrcodeImage' src='".$dir.basename($file)."'/>
			<figcaption><input id='bob' type='checkbox' name='code' value=".substr($file,0,-37)."></figcaption></figure>";
	}
    
    ?>

	<!-- for every image in cookie create-->
	
	</div>
	</form>
	
	
	</div>
<?php include_once "footer.php"; ?>

</body>
</html>
	
	
	