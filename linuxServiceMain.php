<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">



<head>
<link rel="stylesheet" type="text/css" href="style.css"/>
  <title>Network Administration</title>	
</head>

<body>

<div id="header">
	<img src="contact.jpg" alt="Contact info" height="334" width="550">
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
<div align="center" id = "content">
        
	<fieldset>
    		<legend>Personal Information</legend>
    			<p>
    			<?php
    			include_once "Parse/PortInfo.php";
    			include_once "SSH.php";
    			
    			$ssh = new SSH;
    			session_start();
    			
    			if (isset($_SESSION['login'])) {
					$username = $_SESSION['username'];
					if (isset($_GET['id'])) {
						
						$serverID = $_GET['id']; //Grabs the server's ID for use in SSH commands (identifies the server to send SSH requests too)
						
						//Code Block to add a command
						$input = "service --status-all"; //Command you would like to execute
						$sshOutput = explode("\n",$ssh->sshStart($serverID, $username, $input)); //don't change this, this requests a function to execute ssh commands
						
						/*Regular Expression*/
						
						# URL that generated this code:
						# http://txt2re.com/index-php.php3?s=1:%20lo:%20%3CLOOPBACK,UP,LOWER_UP%3E%20mtu%2016436%20qdisc%20noqueue%20state%20UNKNOWN%20%20%20%20%20%20link/loopback%2000:00:00:00:00:00%20brd%2000:00:00:00:00:00%20%20%20%20%20inet%20127.0.0.1/8%20scope%20host%20lo%20%20%20%20%20inet6%20::1/128%20scope%20host%20%20%20%20%20%20%20%20%20valid_lft%20forever%20preferred_lft%20forever%202:%20eth0:%20%3CBROADCAST,MULTICAST,UP,LOWER_UP%3E%20mtu%201500%20qdisc%20pfifo_fast%20state%20UP%20qlen%201000%20%20%20%20%20link/ether%2008:00:27:6f:7a:96%20brd%20ff:ff:ff:ff:ff:ff%20%20%20%20%20inet%20192.168.100.10/24%20brd%20192.168.100.255%20scope%20global%20eth0%20%20%20%20%20inet6%20fe80::a00:27ff:fe6f:7a96/64%20scope%20link%20%20%20%20%20%20%20%20%20valid_lft%20forever%20preferred_lft%20forever&168


						echo "<div id=table>";
						echo "<table>";
						echo "<tr>";
						echo "<td>State</td>";
						echo "<td>Service Name</td>";
						echo "<td>Options</td>";
						echo "</tr>";
			
							for ($i = 0; $i < $c; $i++) {
								
								
								//get all the components of each port
								$port = new PortInfo();

								$portID = $matches[0][$i];
								$input = "ifconfig $portID"; //Command you would like to execute
								$sshOutput = $ssh->sshStart($serverID, $username, $input); //don't change this, this requests a function to execute ssh commands
								
								$status = $port->getIP($sshOutput);
								$mask = $port->getMask($sshOutput);
								$mac = $port->getMac($sshOutput);
								
								echo "<tr>";
								echo "<td><a href=\"linuxNetMod.php?id=$serverID&port=$portID\">$portID</a></td>";
								echo "<td>$ip</td>";
								echo "<td>$mask</td>";
								echo "<td>$mac</td>";
								echo "</tr>";
							}
							echo "</table>";
							echo "</div>";
						

						

						
						echo "<br>"; //new line
						//End of Code Block
						
						
					}
					else {
						echo "Please select a server!<br>";
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