<!DOCTYPE html>
<html>

<center><img src="user_admin.jpg" alt="Admin" height="300" width="300"></center>

<head>
<meta charset="ISO-8859-1">
<link rel="stylesheet" type="text/css" href="style.css"/>
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<title>Login</title>
</head>
<body>
	<center>
	<form action="login.php" method="post">
		Username: <input name="username" type="text" id="username"><br>
		Password: <input name="password" type="password" id="password"><br>
		<input type="submit"><br>
		
		<?php
				session_start();
				if (isset($_SESSION['login'])) {
					echo "You have logged out successfully";
					session_destroy();
				}
				else {
					//echo "session has not started";
				}
		?>
	</form>
	</center>
</body>
</html>
