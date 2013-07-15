<?php
	include_once 'Database.php';
	class ServerManagement {
		
		function addServer(/*int*/ $typeID, /*string*/ $serverName, /*string*/ $serverDescription, /*string*/ $serverIP, /*string*/ $serverPort) {
				
			//connect to database
			//include_once 'Credentials.php';
			$database = new Database();
			$con = $database->loginDatabase();
				
			if (mysqli_connect_errno($con)) {
				$message = "Failed to connect to MySQL: " . mysqli_connect_error();
			}
			else {
				//$hash = new Credentials();
				//$hash = $hash->hashPassword($password);
				$sql = "INSERT INTO serverinfo (TypeID, ServerName, ServerDescription, ServerIP, ServerPort ) VALUES ('$typeID','$serverName','$serverDescription','$serverIP','$serverPort')";
			
				if (!mysqli_query($con,$sql))
				{
					$message = 'Error: ' . mysqli_error($con);
				}
				$message = "1 record added";
			}
			return $message;
			
		}
	}
?>

