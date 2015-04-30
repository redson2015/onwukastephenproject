<!DOCTYPE>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<link type="text/css" rel="stylesheet" href="./css/styles.css" />
<script src="./scripts/time.js" type="text/javascript"></script>
<title>Time Table</title>
</head>
<?php
include_once 'DOA.php';
$date=null;

if (isset($_GET['roomid'])) {
	$room = $_GET['roomid'];
	$roomID = substr($room,0,-33);
	$result = json_decode(roomqrcode($roomID),true);
	if (count($result)==0) {
		//redirect to error page
	} else{
		
		$roomName=$result[0]["RoomName"];
		
	}
		
	



?>

<?php if (isset($_GET["pre"])) {
	$date=date_create($_GET["previousdate"]);
	date_add($date,date_interval_create_from_date_string("-1 day"));
	//echo date_format($date,"Y-m-d");
}elseif (isset($_GET["Next"])){
	
	$date=date_create($_GET["previousdate"]);
	date_add($date,date_interval_create_from_date_string("1 day"));
	//echo date_format($date,"Y-m-d");
	
}else{
	
	$date=date_create();
	//echo date_format($date,"Y-m-d");
}

$fdate= date_format($date,"Y-m-d");


?>
<body id="timetable" onload=<?php echo "dayTimeTable(".$roomID.",'".$fdate."')"; ?> >
<h1 class='tmetitle'><?php echo date_format($date,"l d F Y")?><br>Room <?php echo $roomName?>&nbsp;Time Table</h1><form><input name="roomid" type="hidden" value="<?php echo $room?>"><input name="previousdate" type="hidden" value="<?php echo $fdate?>"><div id='btnWrapper'>
<button name="pre" class='btnprevious'>Pre</button><button name="Next" class='btnprevious'>Next</button></div></form>
<?php
$startTable = "<table id ='dayview'><tr id='dayViewHead'><th></th><th>". date_format($date,"l")."</th></tr>";
$t = 8;
$ti = "am";
for($i = 8; $i <21; $i++){
	if ($t >12){
		$t = 1;
		$ti = "pm";
	}
	$startTable.="<tr id='".$i."'><th>".$t.$ti."</th></tr>";
	$t++;

}
echo $startTable."</table><div class='viewtme'><a href='weektimetable.php?roomid=".$_GET["roomid"]."'>View week</a></div>";
}else{
	
	
	echo "error";
}
?>
</body>
</html>