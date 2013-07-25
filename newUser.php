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
					echo '<form action="addNewUser.php" method="post">
    					new user<br>
						username: <input name="username" type="text" id="username"><br>
						password: <input name="password" type="password" id="password"><br>
    					Name: <input name="name" type="text" id="name"><br>
    				    Permission Level: <select id="permissionLevel" name="permissionLevel">
    						<option value="1">Admin</option>
    						<option value="2">User</option>
    					</select>
    					Location: <input name="location" type="text" id="location"><br>
						<input type="submit">
    					';
				}
				else {
					echo 'You\'re not logged in';
				}
				
			?>
		</body>
		
	</head>

</html>