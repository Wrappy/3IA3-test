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
		session_start();
		
		//$_SESSION['login'] = 1;
		//$_SESSION['username'] = username;
		//$_SESSION['permission'] = 2;
		
		if (isset($_SESSION['login'])) {
			if (isset($_GET['id'])) {
				session_start();
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
					if ($serv->hasServerCredentials($_SESSION['username'], $row['ServerID'])) {
						$serverId = $row['ServerID'];
						$serverName = $row['ServerName'];
						$serverIp = $row['ServerIP'];
						echo "<a href=\"linuxMain.php?id=$serverId\">";
			  			echo "$serverName - $serverIp ";
						echo "</a>";
					}
				}
				echo '<h3>Control Panel</h3>';
				echo '<a href="addServerCredentials.php">Add server credentials</a><br>';
				if ($_SESSION['permission'] == 1) {
					echo '<a href="addServer.php">Add a new server</a><br>';
	        		echo '<a href="newUser.php">Add a new user</a><br>';
	        		echo '<a href="removeUser.php">Remove a user</a><br>';
	        	}
			}
		}
	?>

</div>
<div align="left" id = "content">
        
	<fieldset>
    		<legend>New User</legend>
    			<p>
    			<?php
    			

    			
    			include_once "SSH.php";
    			
    			$ssh = new SSH;
    			session_start();
    			if (isset($_SESSION['login'])) {
					$username = $_SESSION['username'];
					echo '<form action="newUser.php" method="post">
						username: <input name="username" type="text" id="username"><br>
						password: <input name="password" type="password" id="password"><br>
    					Name: <input name="name" type="text" id="name"><br>
    				    Permission Level: <select id="permissionLevel" name="permissionLevel">
    						<option value="1">Admin</option>
    						<option value="2">User</option>
    					</select><br>
    					Location: <input name="location" type="text" id="location"><br>
						<input type="submit">
    					';
				}
				else {
					echo "You are not logged in!<br>";
				}
				
				if (isset($_POST['username'])) {
				
					include_once 'UserManagement.php';
					$username = $_POST['username'];
					$password = $_POST['password'];
					$permissionLevel= (int) $_POST['permissionLevel'];
					$name = $_POST['name'];
					$location = $_POST['location'];
					
					
					$addUser = new UserManagement();
					
					if ($username == "" || $password == "" || $name == "" || $location == "" || $username == $null) {
						echo "Failure, new user was not added.";
					}
					
					else if ($addUser->addUser($username, $password,$permissionLevel,$name,$location)){
					
						echo "Success, new user was added.";
					
					}
					else {
						echo "Failure, new user was not added.";
					}
				}

?>

			</p>
  	</fieldset>

</div>	
</body>
</html>

<!-- Nikolay Krivulin 1130530-->


