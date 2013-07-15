<?php

	class Telnet
	{
		//method declaration
		
		public function telnetClient( /*string*/ $ip, /*int*/ $port, /*array*/ &$input ) {
			
			//open connection
			$fp = fsockopen("$ip", $port, $errno, $errstr, 5);
			if (!$fp) {
				echo "$errstr ($errno)<br />\n";
			} 
			
			//send data through, capture and return output
			else {
				foreach ($input as $line) {
					fputs($fp,"$line");
					sleep(2);
				}
				$output = '';
				$start = NULL;
				$timeout = ini_get('default_socket_timeout');
				
				sleep(1);
				$output .= fread($fp, 100028);
				
				fclose($fp);
				file_put_contents( 'output.txt', $output);
				
				return $output;
			}
		}
				
			
			
	}
	
?>