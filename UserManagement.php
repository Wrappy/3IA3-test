<?php
	include 'Database.php';
	class UserManagement {
		function addUser(/*string*/ $userName, /*string*/ $password) {
			
			//connect to database
			include 'Credentials.php';
			$database = new Database();
			$con = $database->loginDatabase();
			
			if (mysqli_connect_errno($con)) {
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			//on connection success, add new user
			else {
				$hash = new Credentials();
				$hash = $hash->hashPassword($password);
				$sql = "INSERT INTO credentials (username, password) VALUES ('$userName','$hash')";
				
				if (!mysqli_query($con,$sql))
				{
					die('Error: ' . mysqli_error($con));
				}
				echo "1 record added";
			}
		}
	}
	
	$userName = "testUser";
	$password = "pass";
	
	$addUser = new UserManagement();
	$addUser->addUser($userName, $password)
?>