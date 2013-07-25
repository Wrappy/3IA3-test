<?php
	class PortInfo {
		
		function getMask(/*string*/ $txt) {
			
			//REGEX FROM TXT2RE.COM
			$re1='.*?';	# Non-greedy match on filler
			$re2='(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)(?![\\d])';	# Uninteresting: ipaddress
			$re3='.*?';	# Non-greedy match on filler
			$re4='(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)(?![\\d])';	# Uninteresting: ipaddress
			$re5='.*?';	# Non-greedy match on filler
			$re6='((?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))(?![\\d])';	# IPv4 IP Address 1
			
			if ($c=preg_match_all ("/".$re1.$re2.$re3.$re4.$re5.$re6."/is", $txt, $matches))
			//END REGEX
			{
				return $matches[1][0];
			}
			else
			{
				return "";
			}
		}
  
		function getMac(/*string*/ $txt) {
			
			//REGEX FROM TXT2RE.COM
			$re1='.*?';	# Non-greedy match on filler
			$re2='((?:[0-9A-F][0-9A-F]:){5}(?:[0-9A-F][0-9A-F]))(?![:0-9A-F])';	# Mac Address 1
			
			if ($c=preg_match_all ("/".$re1.$re2."/is", $txt, $matches))
			//END REGEX
			{
				return $matches[1][0];
			}
			else
			{
				return "";
			}
		}

		function getIP($txt) {
			//REGES FROM TXT2RE.COM
			$re1='.*?';	# Non-greedy match on filler
			$re2='((?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?))(?![\\d])';	# IPv4 IP Address 1
				
			if ($c=preg_match_all ("/".$re1.$re2."/is", $txt, $matches))
			//END REGEX
			{
				return $matches[1][0];
			}
			else
			{
			}
		}
	}

?>