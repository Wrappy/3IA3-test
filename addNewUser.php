<?php
	//grab username and password, pass to login
	header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
	header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
	
	include_once 'UserManagement.php';
	$username = $_POST['username'];
	$password = $_POST['password'];
	$permissionLevel= (int) $_POST['permissionLevel'];
	$name = $_POST['name'];
	$location = $_POST['location'];
	
	
	$addUser = new UserManagement();
	if ($addUser->addUser($username, $password,$permissionLevel,$name,$location)){
	
	echo "success, new user was added";
	
	}
	else {
		echo "failure, new user was not added";
	}
	
	
	
	
?>