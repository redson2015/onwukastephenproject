<?php session_start(); 
require_once 'checklogin.php';?>
<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link type="text/css" rel="stylesheet" href="./css/styles.css"/>
<title>Insert title here</title>
</head>
<body>
<?php include "header.php"; ?>
	<div id="contents">
	<div id ="searchBox">
	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"><input type="text" size="30"> <button>Search</button></form>
	
	</div>
	<div id ="qrgen">	
	
	<?php 
	
	
	if(isset($_POST['generate'])){
		
		
	}
	
	
	

    $dir = 'roomqrcodes/';
    $d = dir($dir);
	while (false!== ($file = $d->read())) {
		if ($file=="." || $file==".."){
			continue;
		}
		echo "<figure><figcaption>123445j</figcaption><img class='qrcodeImage' src='".$dir.basename($file)."'/>
			<figcaption><input type='checkbox' name='vehicle' value='Bike'></figcaption></figure>";
	}
    
    ?>
	
	<!-- for every image in cookie create-->
	
	</div>
	
	
	
	
	
	</div>
<?php include "footer.php"; ?>

</body>
</html>
	
	
	