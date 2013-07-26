<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">



<head>
<link rel="stylesheet" type="text/css" href="style.css"/>
  <title>3IA3 feedback </title>	
</head>

<body>

<div id="header">
	<img src="user_admin.jpg" alt="Admin" height="200" width="200">
</div>

<div id="menu">


	<?php 
		error_reporting(0);
		if (isset($_GET['id'])) {
			session_start();
			$_SESSION['username'] = "testUser";
			if (isset($_SESSION['username'])) {
				echo "Welcome ";
				echo $_SESSION['username'];
				echo '<a href="logout.php">(logout)</a><br>';
			}
			$serverId = $_GET['id'];
			echo "<a href=\"linuxMain.php\">";
			echo 'Return to server selection</a><br>';
			echo "<a href=\"linuxNetMain.php?id=$serverId\">";
			echo 'Network<br></a>';
			echo "<a href=\"linuxSSHMain.php?id=$serverId\">";
			echo 'SSH<br></a>';
			echo "<a href=\"linuxTopMain.php?id=$serverId\">";
			echo 'TOP<br></a>';
		}
		else {
			session_start();
			if (isset($_SESSION['username'])) {
				echo "Welcome ";
				echo $_SESSION['username'];
				echo '<a href="logout.php">(logout)</a><br>';
			}
			echo '<h3>Server Selection</h3>';
			include_once "ServerManagement.php";
			$serv = new ServerManagement();
			$results = new mysqli_result();
			$results = $serv->serverList();
			
			
			
			while ($row = mysqli_fetch_array($results)) {
				$serverId = $row['ServerID'];
				$serverName = $row['ServerName'];
				$serverIp = $row['ServerIP'];
				echo "<a href=\"linuxMain.php?id=$serverId\">";
	  				echo "$serverName - $serverIp ";
				echo "</a>";
			}
			echo '<h3>Control Panel</h3>';
			echo '<a href="addServer.php">Add a new server</a><br>';
			if ($_SESSION['permission'] == 1) {
        		echo '<a href="newUser.php">Add a new user</a><br>';
        		echo '<a href="removeUser.php">Remove a user</a><br>';
        	}
		}
	
	?>

</div>
<div align="left" id = "content">
        
	<fieldset>
    		<legend>Remove Users</legend>
    			<p>
    			<?php
    			include_once "SSH.php";
    			include_once 'UserManagement.php';
    			
    			$ssh = new SSH;
    			session_start();
    			
    			//$_SESSION['login'] = 1;
    			//$_SESSION['username'] = testUser;
    			//$_SESSION['permission'] = 1;
    			//$_POST['user'] = "username";
    			
    			if (isset($_SESSION['login'])) {
					$username = $_SESSION['username'];
					if ($_SESSION['permission'] == 1) {
						
						$user = new UserManagement();

						echo '<form method = "post" action = "removeUser.php">';
						echo 'Users ';
						echo '<select name = "user">';
						
						$results = $user->userList();
						while ($row = mysqli_fetch_array($results)) {
							$username = $row['Username'];
							echo "<option value='$username'>";
		  					echo $username;
							echo '</option>';
						}
						echo '</select>';
						echo '<br><input type = "submit" value = "Submit" /><br>';
					
					}
				else {
					echo "You are not an administrator!<br>";
				}
		}
		else {
			echo "You are not logged in!<br>";
		}
		
		if (isset($_POST['user'])) {
			include_once 'UserManagement.php';
			$user = new UserManagement();
			
			$username = $_POST['user'];
			
			echo $user->removeUser($username);
			
			
		}

?>



			</p>
  	</fieldset>

</div>	
</body>
</html>

<!-- Nikolay Krivulin 1130530-->