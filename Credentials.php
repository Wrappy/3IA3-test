<?php
	include 'Database.php';
	
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
			}
			else {
				$result = mysqli_query($con,"SELECT * FROM credentials WHERE username='$username'");
				$row = mysqli_fetch_array($result);
				if ($row['password'] == $hash && $row['username'] == $username) {
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
			session_start();
			/*
			 * permissions code
			 */
			$_SESSION['login']= 1;
		}
	}
	
?>