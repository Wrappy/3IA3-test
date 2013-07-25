
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">



<head>
<link rel="stylesheet" type="text/css" href="style.css"/>
<title>3IA3 feedback </title>
</head>

<body>

<div id="header">
	<img src="contact.jpg" alt="Contact info" height="334" width="550">
</div>

<div id="menu">
	<?php 
		error_reporting(0);
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
			if (isset($_SESSION('username'))) {
				echo "Welcome ";
				echo $_SESSION('username');
				echo '<a href="logout.php">(logout)</a><br>';
			}
			echo '<h5>Server Selection</h5>';
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
		}
	
	?>

</div>
<div align="center" id = "content">
        
	<fieldset>
    		<legend>Personal Information</legend>
    			<p>
    			<?php
    			include_once "SSH.php";
    			
    			$ssh = new SSH;
    			session_start();
    			$sshOutput = "";
    			
    			if (isset($_SESSION['login'])) {
					$username = $_SESSION['username'];
					if (isset($_GET['id'])) {

						$serverID = $_GET['id']; //Grabs the server's ID for use in SSH commands (identifies the server to send SSH requests too)
						
						$input = "top";
						echo $ssh->sshStartScreen($serverID, $username, $input);
						
						
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
	<a href="addServer.php">Add a new server</a><br>
	<a href="newUser.php">Add a new user</a><br>


</div>	
</body>
</html>

<!-- Nikolay Krivulin 1130530-->