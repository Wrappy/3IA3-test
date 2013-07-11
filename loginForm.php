<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<title>Login</title>
</head>
<body>
	<form action="login.php" method="post">
		<input name="username" type="text" id="username">
		<input name="password" type="password" id="password">
		<p>hi</p>
		<input type="submit">
		
		<?php
				session_start();
				if (isset($_SESSION['login'])) {
					echo $_SESSION['login'];
					session_destroy();
				}
				else {
					echo "session has not started";
					}
		?>
	</form>
</body>
</html>
