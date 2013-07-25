<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>New User</title>
		<link rel="stylesheet" type="text/css" href="default.css"/>
		<body>

			<?php
				session_start();
				
				if (isset($_SESSION['login']) && $_SESSION['login'] == 1) {
					echo '<form action="addServer.php" method="post">
    					new server<br>
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
			?>
		</body>
		
	</head>

</html>