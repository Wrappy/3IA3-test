<?php
	//grab username and password, pass to login
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	include 'Credentials.php';
	$username = $_POST['username'];
	$password = $_POST['password'];

	
	$login = new Credentials();
	if ($login->login($username, $password)){
	
	echo "success";
	header("location: linuxMain.php");
	}
	
	else {
	header("location: loginForm.php");
	}
	
	
	
	
	
?>