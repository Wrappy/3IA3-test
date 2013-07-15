<?php

class SSH {
	
	function ssh(/*string*/ $ip, /*int*/ $port) {
		;
	}
}
	include_once('Net/SSH2.php');
	
	$ssh = new Net_SSH2('$ip');
	if (!$ssh->login('$username', '$password')) {
		exit('Login Failed');
	}
	
	//echo $ssh->exec('pwd');
	//echo $ssh->exec('ls -la');