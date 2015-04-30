<?php
include 'DOA.php';

if (isset($_GET['roomid']) AND isset($_GET['date']) ) {
	$results= generateweeklytimetable($_GET['roomid'], $_GET['date']);
toJason($results);

}
function toJason($results){
	if ($results!=null){
		echo json_encode($results);

	} else {
		echo "";

	}

}

?>