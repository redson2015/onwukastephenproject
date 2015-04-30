<?php
include 'DOA.php';

if ($_SERVER ["REQUEST_METHOD"] == "POST") {
	
	if (isset ( $_POST ['request'] )) {
		
		if ($_POST ['request'] == "addcourse") {
			
			$response = addCourse ( $_POST ['courseID'], $_POST ['coursename'] );
			echo $response;
		} elseif ($_POST ['request'] == "updatecourse") {
			
			updateCourse ( $_POST ['courseID'], $_POST ['coursename'] );
		} elseif ($_POST ['request'] == "deletecourse") {
			
			deleteCourse ( $_POST ['IDdelete'] );
		}
	} else {
		
		header ( 'Location: error.php' );
	}
} elseif ($_SERVER ["REQUEST_METHOD"] == "GET") {
	if (isset ( $_GET ['request'] )) {
		if ($_GET ['request'] == "viewcourse") {
			
			if (isset ( $_GET ['searchterm'] ) and isset ( $_GET ['searchtype'] )) {
				
				$results = searchCourse ( $_GET ['searchterm'], $_GET ['searchtype'] );
				echo $results;
			} else {
				
				$results = getAllCourses ();
				echo $results;
			}
		}
	} else {
		header ( 'Location: error.php' );
	}
}

?>