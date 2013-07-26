<?php
	include_once 'Database.php';
	
	class Credentials 
	{
		private $salt = "passthesalt";
		
		public function hashPassword(/*string*/ $password) {
			
			$output = crypt($password, $this->salt);
			return $output;
			
		}
		
		public function getSalt() {
			return $salt;
		}
		
		public function verifyPassword(/*string*/ $hash, /*string*/ $username) {
			// Create connection
			$database = new Database();
			$con = $database->loginDatabase();
			
			// Check connection
			if (mysqli_connect_errno($con)) {
			  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			  return false;
			}
			else {
				$result = mysqli_query($con,"SELECT * FROM users WHERE Username='$username'");
				$row = mysqli_fetch_array($result);
				if ($row['Password'] == $hash && $row['Username'] == $username) {
					echo "correct";
					return true;
				}
				else {
					echo "error finding credentials";
					return false;
				}
			}
		}
		
		public function login(/*string*/ $username, /*string*/ $password) {
			if ($this->verifyPassword($this->hashPassword($password), $username)) {
				$this->createSession($username, $password);
				return true;
			}
			else {
				echo "Failed";
				//header("location: login.php");
				return false;
			}
		}
		
		public function createSession(/*string*/ $username, /*string*/ $password) {
			
			include_once "Database.php";
			session_start();
			/*
			 * permissions code
			 */
			$database = new Database();
			$con = $database->loginDatabase();
			
			$results = mysqli_query($con,"SELECT PermissionLevel FROM users WHERE Username='$username'");
			
			$row = mysqli_fetch_array($results);
			
			$_SESSION['permission'] = $row['PermissionLevel'];
			$_SESSION['login']= 1;
			$_SESSION['username']= $username;
		}
		
		public function addServerPrivlage(/*string*/ $username, /*string*/ $password, /*int*/ $serverID, /*string*/ $serverUser, /*string*/ $serverPass) {
			
			//connect to database
			$database = new Database();
			$con = $database->loginDatabase();
			
			//check if the username exists, and verify password
			if (!($this->verifyPassword(($this->hashPassword($password)), $username))) {
				return false;
			}
			if (!(mysqli_query($con,"SELECT * FROM serverinfo WHERE ServerID='$serverID'"))) {
				return false;
			}
			
			/*
				Place encrpytion code here
			*/
			
			$sql = "INSERT INTO userpermissions (serverID, Username, ServerUsername, ServerPassword ) VALUES ('$serverID','$username','$serverUser','$serverPass')";
			
			if (!mysqli_query($con,$sql))
			{
				$message = 'Error: ' . mysqli_error($con);
				return false;
			}
			$message = "1 record added";
			return true;
		
		}
		
		public function getServerCredentials(/*string*/ $username, /*int*/ $serverID, /*string*/ &$serverUser, /*string*/ &$serverPass) {
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
			
			$serverUser = $row['ServerUsername'];
			$serverPass = $row['ServerPassword'];
				
			return true;
		}
	}



	
?>