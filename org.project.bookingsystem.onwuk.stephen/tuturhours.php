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

<div id="tutorWraper">

<table id = "tutorDetails">
<tr>
    <td class='tuturtbl' colspan="2"><h1 id="tutorHeading">Tutor Office Hours</h1></td>
   
  </tr>
  <tr>
    <td class='tuturtbl' colspan="2"><?php echo getTutorImage("555") ?></td>
   
  </tr>
  
  <tr>
    <td class='tuturtbl' colspan="2">Mr John pot</td>
   
  </tr>
   <tr>
    <td class='tuturtbl2'><span>Room:</span></td>
    <td>Jackson</td>		

  </tr>
     <tr>
    <td class='tuturtbl2'><span>Email:</span></td>
    <td>dsds</td>		
  </tr>
   <tr>
   <td colspan="2"><span>Office Hours</span><br>
   jasjkjakshaklsdjaskl jhdkassalksksas
   </td>	
  </tr>
</table>









</div>

</body>
</html>

<?php function getTutorImage($tutorimage){
	
	$image ="./tutor_pics/".$tutorimage.".png";
	if (!file_exists($image)){
		$image ="./images/no_image.png";
	}
	
	return "<img src='".$image."'>";
	
} ?>