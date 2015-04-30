<?php
include 'DOA.php';
if (isset($_GET["request"])){
	if ($_GET["request"]=="daytimetable"){
if (isset($_GET['roomid']) AND isset($_GET['date']) ) {
	$results= generateDayTimetable($_GET['roomid'], $_GET['date']);
	echo $results;
}

}elseif ($_GET["request"]=="weektimetable"){
	$results= generateweeklytimetable($_GET['roomid'], $_GET['date']);
	echo $results;
	
}
}
?>