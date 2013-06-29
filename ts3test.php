<?php

	class Telnet
	{
		//method declaration
		
		public function telnetClient( /*string*/ $ip, /*int*/ $port, /*array*/ &$input ) {
			
			function safe_feof($fp, &$start = NULL) {
				$start = microtime(true);

				return feof($fp);
			}
			
			$fp = fsockopen("$ip", $port, $errno, $errstr, 5);
			if (!$fp) {
				echo "$errstr ($errno)<br />\n";
			} else {
				foreach ($input as $line) {
					fputs($fp,"$line");
					sleep(2);
				}
				$output = '';
				$start = NULL;
				$timeout = ini_get('default_socket_timeout');
				
				sleep(1);
				$output .= fread($fp, 1028);
				
				fclose($fp);
				file_put_contents( 'output.txt', $output);
				
				return $output;
			}
		}
				
			
			
	}
	
	$ip = "192.168.1.1";
	$port = 1062;
	$input = array("","hello world\r\n","hi\r\n");
	$session = new Telnet;
	$output = $session->telnetServer($ip,$port,$input);
	echo "hello ";
	echo $output
	
?>