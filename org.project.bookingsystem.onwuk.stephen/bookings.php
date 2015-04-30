
<?php
include 'DOA.php';
$symbol = "";
$order = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	
	if (isset($_POST['request'])){
		
		if ($_POST['request']=="addbooking"){
			$results=json_decode(checkRoomAvailiablity($_POST['roomID'], convertDate(trim($_POST['datebooked'])), $_POST['timestart'], $_POST['timeend']),true);
			
			if (count($results)==0) {
				$response = addBooking($_POST['userID'], $_POST['roomID'], $_POST['moduleID'],convertDate(trim($_POST['datebooked'])), $_POST['timestart'], $_POST['timeend']);
				echo $response;
			} else{
				echo "Unavailable";
				
			}	
				
		
		}elseif ($_POST['request']=="updatebooking"){
		
			updateBooking($_POST['bookingID'], $_POST['userID'], $_POST['roomID'], $_POST['moduleID'],convertDate($_POST['datebooked']), $_POST['timestart'], $_POST['timeend']);
		
		}elseif ($_POST['request']=="deletebooking"){
			
			deleteBooking($_POST['IDdelete']);
		}elseif ($_POST['request']=="processbooking"){
			$processed=3;
			if(trim($_POST['decision']=="accept")){
				$processed=1;
				
			}elseif (trim($_POST['decision'])=="reject"){
				$processed=2;
				
			}
			
			processbooking($_POST['booking'],$processed);
			
		}elseif ($_POST['request']=="addnote"){

			addNote($_POST['note'],$_POST['notetext']);
			
		}
		
	}else {
		
		
		//show error msg
	}


}elseif ($_SERVER["REQUEST_METHOD"] == "GET"){
	
	if (isset($_GET['request'])){
		
		if($_GET['request']=="getnote"){
			$results = getNote($_GET['note']);
			echo $results;
		}elseif ($_GET['request']=="checkroomavailability"){
			
			$results = checkRoomAvailiablity($_GET['checkroomavailability'], $_GET['timestart'], $_GET['timeend'],convertDate(trim($_GET['date'])));
			echo $results;
		}elseif ($_GET['request']=="viewbooking"){
			
			if ($_GET['view']=="history") {
				$symbol = "<";
			}else if ($_GET['view']=="current"){
			
				$symbol = ">";
			
			} else{
				$symbol ="";
			}
			if ($_GET ['order'] == "ASC") {
				$order = "ASC";
			} else {
			
				$order = "DESC";
			}
			
			if (isset ( $_GET ['searchterm'] ) and isset($_GET ['searchtype'])) {
				$seachterm = $_GET ['searchterm'];
				if ($_GET ['searchtype']=="BookingDate"|| $_GET ['searchtype']=="DateBooked" ){
					
					$seachterm = convertDate(trim($_GET ['searchterm']));
				}
				if ($symbol!="") {
					$results= searchBooking ($seachterm, $_GET ['searchtype'], $symbol, $order );
				echo $results;
				}else{
			
					$results = getBooking($seachterm, $_GET ['searchtype'], $order);
	echo  $results;
					//get all bookings searth term search type order
				}
			}else{
				if ($symbol!="") {
					$results= filterBookings( $symbol, $order );
					echo $results;
				}else{
			
					$results = getAllBookings($order);
					echo $results;
				}
			}
			
		}
		
		
		
	}else{
		//show error
		
	}
	
	
}

function convertDate($date){
	$conDate = new DateTime($date);
	return date_format($conDate, 'Y-m-d');
	
}	


?>