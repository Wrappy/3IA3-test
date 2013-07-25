<!DOCTYPE html>
<html>
<head>
<meta charset="ISO-8859-1">
<META HTTP-EQUIV="Cache-Control" CONTENT="no-cache">
<meta http-equiv="refresh" content="3;url=loginForm.php">
<title>Login</title>
</head>
<body>		
		<?php
				session_start();
				if (isset($_SESSION['login'])) {
					echo "You have logged out successfully";
					session_destroy();
				}
				else {
					echo "You have not logged in yet!";
				}
		?>
	</form>
</body>
</html>