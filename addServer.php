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
    		<legend>New Server</legend>
    			<p>
    			<?php
    			include_once "SSH.php";
    			
    			$ssh = new SSH;
    			session_start();
    			if (isset($_SESSION['login'])) {
					$username = $_SESSION['username'];

						session_start();
				
				if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
					echo '<form action="addServer.php" method="post">
						server name: <input name="serverName" type="text" id="serverName"><br>
    					server description: <input name="serverDescription" type="text" id="serverDescription"><br>
    					server IP: <input name="serverIP" type="text" id="serverIP"><br>
						server Port: <input name="serverPort" type="text" id="serverPort"><br><br>
    					server Username: <input name="serverUsername" type="text" id="serverUsername"><br>
    					server Password: <input name="serverPassword" type="password" id="serverPassword"><br>
    					Verify your password: <input name="password" type="password" id="password"><br>
						<input type="submit">
    					';
				}
				else {
					echo 'You\'re not logged in';
				}
				
				if (isset($_POST['serverName'])) {

					include_once "ServerManagement.php";
					include_once "Credentials.php";
    							
    				$serv = new ServerManagement();
					$cred = new Credentials();
    				
    				$typeID = 1;
					$serverName = $_POST['serverName'];
					$serverDescription = $_POST['serverDescription'];
					$serverIP= $_POST['serverIP'];
					$serverPort = $_POST['serverPort'];
					$serverUsername = $_POST['serverUsername'];
					$serverPassword = $_POST['serverPassword'];
					$password = $_POST['password'];
					
					if ($serv->addServer($typeID, $serverName, $serverDescription, $serverIP, $serverPort, $serverID)) {
						echo "Server was added successfully";
						
						$cred->addServerPrivlage($_SESSION['username'], $password, $serverID, $serverUsername, $serverPassword);
						
					}
					else {
						echo "failed to add server";
					}
					
					
					
				}
						 
				}
		else {
			echo "You are not logged in!<br>";
		}

?>

			</p>
  	</fieldset>

</div>	
</body>
</html>

<!-- Nikolay Krivulin 1130530-->


				

