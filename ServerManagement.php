<?php
	include_once 'Database.php';
	class ServerManagement {
		
		function addServer(/*int*/ $typeID, /*string*/ $serverName, /*string*/ $serverDescription, /*string*/ $serverIP, /*string*/ $serverPort, &$serverID) {
				
			//connect to database
			//include_once 'Credentials.php';
			$database = new Database();
			$con = $database->loginDatabase();
				
			if (mysqli_connect_errno($con)) {
				$message = "Failed to connect to MySQL: " . mysqli_connect_error();
				return false;
			}
			else {
				//$hash = new Credentials();
				//$hash = $hash->hashPassword($password);
				$sql = "INSERT INTO serverinfo (TypeID, ServerName, ServerDescription, ServerIP, ServerPort ) VALUES ('$typeID','$serverName','$serverDescription','$serverIP','$serverPort')";
			
				if (!mysqli_query($con,$sql))
				{
					$message = 'Error: ' . mysqli_error($con);
					return false;
				}
				$message = "1 record added";
				$serverID = mysqli_insert_id($con);
			}
			return true;
		}
		function getServer(/*int*/ $serverID, /*string*/ &$ip, /*string*/ &$port ) {
			$database = new Database();
			$con = $database->loginDatabase();
			
			$sql = "SELECT * FROM serverinfo WHERE serverID='$serverID'";
			if (!mysqli_query($con,$sql))
			{
				$message = 'Error: ' . mysqli_error($con);
				return false;
			}
			$results = mysqli_query($con,$sql);
			$row = mysqli_fetch_array($results);
			$ip = $row['ServerIP'];
			$port = $row['ServerPort'];
			return true;
		}
		
		function serverList() {
			$database = new Database();
			$con = $database->loginDatabase();
			
			$sql = "SELECT * FROM serverinfo";
			
			if (!mysqli_query($con,$sql))
			{
				return ($message = 'Error: ' . mysqli_error($con));
			}
			
			$results = mysqli_query($con,$sql);
			return ($results);
		}
		
		function hasServerCredentials($username, $serverID) {
			$database = new Database();
			$con = $database->loginDatabase();
				
			$sql = "SELECT * FROM userpermissions WHERE username='$username' AND serverID='$serverID'";
			
			if (!mysqli_query($con,$sql))
			{
				$message = 'Error: ' . mysqli_error($con);
				return false;
			}
				
			//$sql = "SELECT * FROM userpermissions WHERE username='$username' AND serverID='$serverID'";
				
			$results = mysqli_query($con,"SELECT * FROM userpermissions WHERE username='$username' AND serverID='$serverID'");
				
			$row = mysqli_fetch_array($results);
			
			if ($row == $null) {
				return false;
			}
			else {
				return true;
			}
		}
		
		
	}

?>

