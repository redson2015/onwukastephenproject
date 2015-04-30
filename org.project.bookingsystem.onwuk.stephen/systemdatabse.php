<?php
define("database","mysql:host=localhost;dbname=redson_10147179");
define("pass","redson123");
define("user","redson_rogue");

function getDatabaseConnection(){
try {
	$connection = new PDO(database, user, pass);
	// set the PDO error mode to exception
	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $connection;
	//echo "Connected successfully";
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
}
}

function executeSelect($sql){
	$connection = getDatabaseConnection();
	$stmnt = $connection->prepare("SELECT "."$sql");
	$stmnt->execute();
	$result = $stmnt->fetchAll(PDO::FETCH_ASSOC);
	return  json_encode($result);
	
	
}

function executeInsert($sql){
	$connection = getDatabaseConnection();
	$connection->exec("INSERT INTO ".$sql);
	$last_id = $connection->lastInsertId();
	return "ID:". $last_id;
	
	
}

function executeUpdate($sql){
	$connection = getDatabaseConnection();
	$stmnt = $connection->prepare("UPDATE ".$sql);

	$stmnt->execute();
	
	echo "OK:Record Succesfully updated";
	
	
}
function executeDelete($sql){
	$connection = getDatabaseConnection();
	$connection->exec("DELETE FROM ".$sql);
	echo "OK:Record sucessfully deleted";
	
	
}





?>
