<?php
include_once 'systemdatabse.php';
function searchBooking($searchterm, $searchType, $symbolIn, $orderIn) {
	$sql = "Booking_Id, DATE_FORMAT(DateBooked,'%d/%m/%Y') as 'DateBooked', User_Id, DATE_FORMAT(BookingDate,'%d/%m/%Y') as 'BookingDate', Room_Id ,DATE_FORMAT(TimeStarting, '%H:%i') as 'TimeStarting' , DATE_FORMAT(EndTime, '%H:%i') as 'EndTime', Module_Id , Authorised, Notes FROM Booking WHERE DateBooked " . $symbolIn . "NOW() AND " . $searchType . "='" . $searchterm . "' ORDER BY DateBooked " . $orderIn;
	return executeSelect ( $sql );
}
function getAllBookings($orderIn) {
	$sql = "Booking_Id, DATE_FORMAT(DateBooked,'%d/%m/%Y') as 'DateBooked', User_Id,DATE_FORMAT(BookingDate,'%d/%m/%Y') as 'BookingDate', Room_Id ,DATE_FORMAT(TimeStarting, '%H:%i') as 'TimeStarting',DATE_FORMAT(EndTime, '%H:%i') as 'EndTime', Module_Id ,  CASE Authorised WHEN 0 THEN '&#10006;' WHEN 1 THEN '&#10004' WHEN 3 THEN 'NP' ELSE Authorised END 'Authorised', Notes FROM booking ORDER BY DateBooked " . $orderIn;
	return executeSelect ( $sql );
}
function getNote($id) {
	$sql = "Booking_Id, Notes FROM booking WHERE Booking_Id = " . $id;
	return executeSelect ( $sql );
}
function addNote($id, $note) {
	$sql = "Booking SET Notes = '" . $note . "' WHERE Booking_Id =" . $id;
	executeInsert ( $sql );
}
function getBooking($searchterm, $searchType, $orderIn) {
	$sql = "Booking_Id, DATE_FORMAT(DateBooked,'%d/%m/%Y') as 'DateBooked', User_Id,DATE_FORMAT(BookingDate,'%d/%m/%Y') as 'BookingDate', Room_Id ,DATE_FORMAT(TimeStarting, '%H:%i') as 'TimeStarting',DATE_FORMAT(EndTime, '%H:%i') as 'EndTime', Module_Id , Authorised, Notes FROM booking WHERE " . $searchType . "='" . $searchterm . "' ORDER BY DateBooked " . $orderIn;
	return executeSelect ( $sql );
}
function filterBookings($symbolIn, $orderIn) {
	$sql = "Booking_Id, DATE_FORMAT(DateBooked,'%d/%m/%Y') as 'DateBooked', User_Id,DATE_FORMAT(BookingDate,'%d/%m/%Y') as 'BookingDate', Room_Id ,TimeStarting,EndTime, Module_Id , Authorised, Notes FROM Booking WHERE DateBooked " . $symbolIn . "NOW() ORDER BY BookingDate " . $orderIn;
	
	return executeSelect ( $sql );
}

function searchTutor($searchterm, $searchType) {
	$sql = "Tutor_ID,Room_ID,User_Id, officeHours FROM Tutor WHERE " . $searchType . "='" . $searchterm . "'";
	
	return executeSelect ( $sql );
}
function getAllTutors() {
	$sql = "Tutor_ID,Room_ID,User_Id, officeHours FROM Tutor";
	
	return executeSelect ( $sql );
}
function addTutor($tutorID, $userID, $roomID, $officeHours) {
	$sql = "Tutor (Tutor_ID, User_Id,Room_ID, officeHours) VALUES ('" . $tutorID . "', '" . $userID . "','" . $roomID . "', '" . $officeHours . "')";
	executeInsert ( $sql );
}
function updateTutor($tutorID, $userID, $roomID, $officeHours) {
	$sql = "Tutor SET User_Id = '" . $userID . "',Room_ID = '" . $roomID . "', officeHours = '" . $officeHours . "' WHERE Tutor_ID =" . $tutorID;
	executeUpdate ( $sql );
}
function deleteTutor($id) {
	$sql = "Tutor WHERE Tutor_ID =" . $id;
	executeDelete ( $sql );
}
function searchUsers($searchTerm, $searchType) {
	$sql = "User_Id, Email, Title, FirstName, LastName, AccessLevel, JobRole, password FROM user WHERE " . $searchType . "='" . $searchTerm . "'";
	// $results = getUsers($sql);
	return executeSelect ( $sql );
}
function getAllUsers() {
	$sql = "User_Id, Email, Title, FirstName, LastName, AccessLevel, JobRole, password FROM user";
	// $results = getUsers($sql);
	
	return executeSelect ( $sql );
}
function searchRoom($searchterm, $searchType) {
	$sql = "Room_Id,RoomName, RoomType,Facility, SeatingLayout,Capicity,Building_Id, Computers FROM room WHERE " . $searchType . "='" . $searchterm . "'";
	return executeSelect ( $sql );
}
function getAllRooms() {
	$sql = "Room_Id,RoomName, RoomType,Facility, SeatingLayout,Capicity,Building_Id, Computers FROM Room";
	return executeSelect ( $sql );
}
function generateDayTimetable($roomId, $date) {
	$sql = "b.DateBooked,DATE_FORMAT(b.TimeStarting, '%k') as 'TimeStart', DATE_FORMAT(b.EndTime, '%k') as 'TimeEnd', m.ModuleName,r.RoomName, CONCAT(u.Title,' ', u.FirstName,' ', u.LastName) as 'Booker' FROM booking b JOIN Module m on 
			b.Module_Id = m.Module_Id JOIN room r ON b.Room_Id = r.Room_ID JOIN user u ON b.User_Id = u.User_Id WHERE b.DateBooked ='" . $date . "' AND b.Room_Id ='" . $roomId . "'";
	return executeSelect ( $sql );
}
function generateweeklytimetable($roomId, $date) {
	$sql = "b.DateBooked,DATE_FORMAT(b.TimeStarting, '%k') as 'TimeStart',
DATE_FORMAT(b.TimeStarting, '%k') as 'TimeStart', DAYOFWEEK(DateBooked) AS 'Day' , 
DATE_FORMAT(b.EndTime, '%k') as 'TimeEnd', m.ModuleName,r.RoomName FROM booking b JOIN Module m on b.Module_Id = 
m.Module_Id JOIN room r ON b.Room_Id = r.Room_ID WHERE WEEK(b.DateBooked,0) = WEEK('" . $date . "',0) 
AND b.Room_Id = '" . $roomId . "'";
	return executeSelect ( $sql );
}
function roomqrcode($searchterm) {
	$sql = "Room_Id, RoomName FROM room WHERE Room_Id='" . $searchterm . "'";
	return executeSelect ( $sql );
}
function deleteBooking($id) {
	$sql = "booking WHERE Booking_Id =" . $id;
	executeDelete ( $sql );
}
function deleteUser($id) {
	$sql = "User WHERE User_Id =" . $id;
	executeDelete ( $sql );
}
function deleteRoom($id) {
	$sql = "Room WHERE Room_Id =" . $id;
	executeDelete ( $sql );
}
function searchBuilding($searchterm, $searchType) {
	$sql = "Building_ID,BuildingName, Campus_ID FROM Building WHERE " . $searchType . "='" . $searchterm . "'";
	return executeSelect ( $sql );
}
function getAllBuildings() {
	$sql = "Building_ID,BuildingName, Campus_ID FROM Building";
	return executeSelect ( $sql );
}
function searchCampus($searchterm, $searchType) {
	$sql = "Campus_ID, CampusName FROM Campus WHERE " . $searchType . "='" . $searchterm . "'";
	
	return executeSelect ( $sql );
}
function getAllCampus() {
	$sql = "Campus_ID, CampusName FROM Campus";
	return executeSelect ( $sql );
}
function deleteCampus($id) {
	$sql = "Campus WHERE Campus_ID =" . $id;
	executeDelete ( $sql );
}
function searchCourse($searchterm, $searchType) {
	$sql = "Course_ID, CourseName FROM Course WHERE " . $searchType . "='" . $searchterm . "'";
	
	return executeSelect ( $sql );
}
function getAllCourses() {
	$sql = "Course_ID, CourseName FROM Course";
	
	return executeSelect ( $sql );
}
function deleteCourse($id) {
	$sql = "Course WHERE Course_ID ='" . $id . "'";
	executeDelete ( $sql );
}
function searchModule($searchterm, $searchType) {
	$sql = "Module_ID, ModuleName, Course_ID FROM Module WHERE " . $searchType . "='" . $searchterm . "'";
	
	return executeSelect ( $sql );
}
function getAllModules() {
	$sql = "Module_ID, ModuleName, Course_ID FROM Module";
	
	return executeSelect ( $sql );
}
function deleteModule($id) {
	$sql = "Module WHERE Module_ID =" . $id;
	executeDelete ( $sql );
}
function deleteBuilding($id) {
	$sql = "Building WHERE Building_ID =" . $id;
	executeDelete ( $sql );
}
function addUser($title, $lastName, $firstName, $email, $password, $jobRole, $accessLevel) {
	$sql = "User (LastName, FirstName, Title, Email, password, JobRole, AccessLevel) VALUES ('" . $lastName . "', '" . $firstName . "', '" . $title . "', '" . $email . "', '" . $password . "', '" . $jobRole . "', '" . $accessLevel . "')";
	executeInsert ( $sql );
}
function updateUser($userid, $title, $lastName, $firstName, $email, $password, $jobRole, $accessLevel) {
	$sql = "User SET LastName = '" . $lastName . "', FirstName = '" . $firstName . "', Title = '" . $title . "', Email = '" . $email . "', password = '" . $password . "', JobRole = '" . $jobRole . "', AccessLevel = '" . $accessLevel . "' WHERE User_Id =" . $userid;
	executeUpdate ( $sql );
}
function getUserIds() {
	$sql = "User_ID FROM User";
	return executeSelect ( $sql );
}
function getRoomIds() {
	$sql = "Room_ID FROM Room";
	return executeSelect ( $sql );
}
function getModuleIds() {
	$sql = "Module_ID FROM Module";
	return executeSelect ( $sql );
}
function getCourseIds() {
	$sql = "Course_ID FROM Course";
	return executeSelect ( $sql );
}
function getBuildingIds() {
	$sql = "Building_ID FROM Building";
	return executeSelect ( $sql );
}
function getCampusIds() {
	$sql = "Campus_ID FROM Campus";
	return executeSelect ( $sql );
}
function updateCourse($courseID, $courseName) {
	$sql = "Course SET CourseName = '" . $courseName . "' WHERE Course_ID =" . $courseID;
	
	executeUpdate ( $sql );
}
function updateModule($moduleID, $moduleName, $courseID) {
	$sql = "Module SET ModuleName = '" . $moduleName . "',Course_ID = '" . $courseID . "' WHERE Module_ID =" . $moduleID;
	
	executeUpdate ( $sql );
}
function updateCampus($campusID, $campusName) {
	$sql = "Campus SET CampusName = '" . $campusName . "' WHERE Campus_ID =" . $campusID;
	
	executeUpdate ( $sql );
}
function updateBuilding($buildingID, $buildingName, $campusID) {
	$sql = "Building SET BuildingName = '" . $buildingName . "',Campus_ID = '" . $campusID . "' WHERE building_ID =" . $buildingID;
	
	executeUpdate ( $sql );
}
function addBuilding($buildingName, $campusID) {
	$sql = "Building (BuildingName, campus_ID) VALUES ('" . $buildingName . "', '" . $campusID . "')";
	executeInsert ( $sql );
}
function updateBooking($bookingID, $userID, $roomID, $moduleID, $dateBooked, $timeStart, $timeEnd) {
	$sql = "Booking SET User_Id = '" . $userID . "', Room_Id = '" . $roomID . "', DateBooked = '" . $dateBooked . "', TimeStarting = '" . $timeStart . "', EndTime = '" . $timeEnd . "' WHERE Booking_Id =" . $bookingID;
	executeUpdate ( $sql );
}
function addBooking($userID, $roomID, $moduleID, $dateBooked, $timeStart, $timeEnd) {
	$sql = "Booking(User_Id, Room_Id, Module_Id, BookingDate, DateBooked , TimeStarting, EndTime, Notes) VALUES ('" . $userID . "', '" . $roomID . "', '" . $moduleID . "',CURDATE(), '" . $dateBooked . "', '" . $timeStart . "', '" . $timeEnd . "', NULL)";
	executeInsert ( $sql );
}
function addCampus($campusName) {
	$sql = "Campus (CampusName) VALUES ('" . $campusName . "')";
	
	executeInsert ( $sql );
}
function addCourse($courseID, $courseName) {
	$sql = "Course (CourseName) VALUES ('" . $courseName . "')";
	executeInsert ( $sql );
}
function addModule($moduleID, $moduleName, $campusID) {
	$sql = "Module (Module_Id, ModuleName, Course_ID) VALUES ('" . $moduleID . "', '" . $moduleName . "', '" . $campusID . "')";
	executeInsert ( $sql );
}
function addRoom($roomName, $roomType, $buildingID, $seating, $capacity, $facilities) {
	$sql = "Room (RoomName, RoomType, Building_ID, Facility,SeatingLayout , Capicity, Computers) VALUES ('" . $roomName . "', '" . $roomType . "', '" . $buildingID . "', '" . $facilities . "', '" . $seating . "', '" . $capacity . "', '1')";
	executeInsert ( $sql );
}
function updateRoom($roomID, $roomName, $roomType, $buildingID, $seating, $capacity, $facilities) {
	$sql = "Room SET Building_ID = '" . $buildingID . "', RoomName = '" . $roomName . "', RoomType = '" . $roomType . "', Facility = '" . $facilities . "', SeatingLayout = '" . $seating . "', Capicity = '" . $capacity . "', Computers = '4' WHERE Room_Id =" . $roomID;
	
	executeUpdate ( $sql );

}
function checkRoomAvailiablity($roomId, $date, $TimeStart, $timeEnd) {
	$sql = " Room_Id FROM Booking Where ((TimeStarting >='" . $TimeStart . "' AND TimeStarting < '" . $timeEnd . "') OR (EndTime >'" . $TimeStart . "' AND EndTime <  '" . $timeEnd . "')) AND DateBooked='" . $date . "' AND Room_Id=" . $roomId;
	return executeSelect ( $sql );
}

function getUserLogin($userId, $password) {
	$sql = "User_Id, Email, FirstName, LastName, JobRole, Title, AccessLevel, password FROM user WHERE password = '" .$password."' and email = '".$userId."'";
	return executeSelect($sql);
}

function getRoomDetails($searchTerm){

	$sql = "r.Room_Id,r.RoomName, r.RoomType,r.Facility, r.SeatingLayout,r.Capicity,r.Computers,b.BuildingName, c.CampusName FROM room r JOIN Building b
ON r.Building_ID = b.Building_ID JOIN Campus c ON b.campus_ID = c.Campus_ID WHERE r.RoomName ='".$searchTerm."'";
	return executeSelect($sql);
}


function getRoomById($roomId){

	$sql = "r.Room_Id,r.RoomName, r.RoomType,b.BuildingName, c.CampusName FROM room r JOIN Building b
ON r.Building_ID = b.Building_ID JOIN Campus c ON b.campus_ID = c.Campus_ID WHERE r.Room_Id ='".$roomId."'";
	return executeSelect($sql);

}
function getUserCurrentBookings($userId){

	$sql = "b.Booking_Id,DATE_FORMAT(b.BookingDate,'%m/%d/%Y') as 'BookingDate', b.Room_Id ,DATE_FORMAT(b.DateBooked,'%m/%d/%Y') as 'DateBooked',DATE_FORMAT(b.TimeStarting, '%H:%i') as 'TimeStarting', b.EndTime, b.Module_Id, r.RoomName FROM booking b JOIN Module m on b.Module_Id = m.Module_Id JOIN room r ON b.Room_Id = r.Room_ID Where b.User_Id ='".$userId."' AND b.BookingDate> NOW()";

	return executeSelect($sql);


}
function getUserBookingHistory($userId){

	$sql = "b.Booking_Id,DATE_FORMAT(b.BookingDate,'%m/%d/%Y') as 'BookingDate', b.Room_Id ,DATE_FORMAT(b.DateBooked,'%m/%d/%Y') as 'DateBooked',DATE_FORMAT(b.TimeStarting, '%H:%i') as 'TimeStarting', b.EndTime, b.Module_Id, r.RoomName FROM booking b JOIN Module m on b.Module_Id = m.Module_Id JOIN room r ON b.Room_Id = r.Room_ID Where b.User_Id ='".$userId."' AND b.BookingDate< NOW()";

	return executeSelect($sql);
}















?>