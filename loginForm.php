<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<title>Login</title>
</head>
<body>
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
</body>
</html>
