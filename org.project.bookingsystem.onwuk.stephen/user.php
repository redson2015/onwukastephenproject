
<?php 
include_once 'DOA.php';



if ($_SERVER["REQUEST_METHOD"] == "POST") {

	if (isset($_POST['request'])){

		if ($_POST['request']=="adduser"){

							
	$response = addUser($_POST['title'], $_POST['lastname'], $_POST['firstname'], $_POST['email'], md5($_POST['password']), $_POST['jobrole'], $_POST['accesslevel']);
			
echo $response;
		}elseif ($_POST['request']=="updateuser"){

						
	updateUser($_POST['userId'],$_POST['title'], $_POST['lastname'], $_POST['firstname'], $_POST['email'],$_POST['jobrole'], $_POST['accesslevel']);
			
		if (strlen($_POST['password'])!=32){
			changePassword(md5($_POST['password']), $_POST['userId']);
	
		}
		
		
		}elseif ($_POST['request']=="deleteuser"){

			deleteUser($_POST['IDdelete']);
		}

	}else {


		//show error msg
	}


}elseif ($_SERVER["REQUEST_METHOD"] == "GET"){
	if (isset($_GET['request'])){
		if ($_GET['request']=="viewuser"){
			
				if (isset($_GET['searchterm']) and isset($_GET['searchtype']) ){
					$results = searchUsers($_GET['searchterm'],$_GET['searchtype']);
				echo $results;
				} else {
				$results = getAllUsers();
					echo $results;
				}

		}



	}else{
		//show error

	}
}

		
?>