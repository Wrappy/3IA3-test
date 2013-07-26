<?php
	include_once 'Database.php';
	class UserManagement {
		function addUser(/*string*/ $username, /*string*/ $password, /*int*/ $permissionLevel, /*string*/ $name, /*string*/ $location) {
			
			//connect to database
			include_once 'Credentials.php';
			$database = new Database();
			$con = $database->loginDatabase();
			
			if (mysqli_connect_errno($con)) {
				$message = "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			
			//on connection success, add new user
			else {
				$hash = new Credentials();
				$hash = $hash->hashPassword($password);
				$sql = "INSERT INTO users (username, password, location, permissionLevel, fullname ) VALUES ('$username','$hash','$location','$permissionLevel','$name')";
				
				if (!mysqli_query($con,$sql))
				{
					$message = 'Error: ' . mysqli_error($con);
				}
				$message = "1 record added";
			}
			return $message;
		}
		
		function userList() {
			$database = new Database();
			$con = $database->loginDatabase();
				
			$sql = "SELECT * FROM users";
				
			if (!mysqli_query($con,$sql))
			{
				return ($message = 'Error: ' . mysqli_error($con));
			}
				
			$results = mysqli_query($con,$sql);
			return ($results);
		}
		
		function removeUser($username) {
			$database = new Database();
			$con = $database->loginDatabase();
			if (mysqli_connect_errno($con)) {
				$message = "Failed to connect to MySQL: " . mysqli_connect_error();
			}
				
			//on connection success, add new user
			else {
				$sql = "DELETE FROM users WHERE username='$username'";
				
				if (!mysqli_query($con,$sql))
				{
					$message = 'Error: ' . mysqli_error($con);
				}
				else {
					$message = "User Deleted Successfully";
				}
			}
			return $message;
			
		}
	}
?>