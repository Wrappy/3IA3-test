<?php

class SSH {
	
	//private $ssh;
	
	public function sshStart($serverID, $username, $input) {
		if (!($this->sshCredentials($username, $serverID, $serverUser, $serverPass, $ip, $port)))
		{
			return false;
		}
		
		return $this->sshExec($ip, $port, $input, $serverUser, $serverPass);
		
	}
	
	public function sshStartScreen($serverID, $username, $input) {
		if (!($this->sshCredentials($username, $serverID, $serverUser, $serverPass, $ip, $port)))
		{
			return false;
		}
		
		return $this->sshScreen($ip, $port, $input, $serverUser, $serverPass);
	}
	
	public function sshCredentials(/*string*/ $username, /*int*/ $serverID, /*string*/ &$serverUser, /*string*/ &$serverPass, /*string*/ &$ip, /*string*/ &$port) {
		
		include_once('Credentials.php');
		include_once('ServerManagement.php');
		
		$cred = new Credentials();
		$serv = new ServerManagement();
		if (!($serv->getServer($serverID, $ip, $port)))
		{
			return false;
		}
		if (!($cred->getServerCredentials($username, $serverID, $serverUser, $serverPass)))
		{
			return false;
		}
		return true;
	}
	
	public function sshExec(/*string*/ $ip, /*int*/ $port, /*string*/ $input, /*string*/ $username, /*string*/ $password) {
		include_once('Net/SSH2.php');
		//include_once('database');
	
		
		$ssh = new Net_SSH2($ip, $port);
		if (!$ssh->login($username, $password)) {
			exit('Login Failed');
		}
		else {
			$output = $ssh->exec($input);
			return $output;
		}
	}
	
	public function sshScreen(/*string*/ $ip, /*int*/ $port, /*string*/ $input, /*string*/ $username, /*string*/ $password) {
		include_once('Net/SSH2.php');
		include_once('File/ANSI.php');
	
		$ansi = new File_ANSI();
		
		$ssh = new Net_SSH2($ip, $port);
		if (!$ssh->login($username, $password)) {
			exit('Login Failed');
		}
		else {

			$ssh->read(" ");
			$ssh->write($input . " \n");
			$ssh->setTimeout(5);
			$ansi->appendString($ssh->read());
			return $ansi->getScreen();

		}
	}
}
//$ssh = new SSH();
//$username = "testUser";
//$serverID = 11;
//$input = "service --status-all";
//$output = explode("\n",$ssh->sshStart($serverID, $username, $input));
//foreach ($output as $line) {
//	echo $line;
//}

//echo $output
?>