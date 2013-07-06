<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<title>Main Test Page</title>
		<link rel="stylesheet" type="text/css" href="default.css"/>
		<body>
		
			<div id="header">
				Administration Panel
			</div>
			
			<div id="menu">
				<ul id="menuList">
					<li>Web Server</li>
					<li>Linux Server</li>
					<li>Windows Server</li>
					<li>TS3 Server</li>
				</ul>
			</div>
			
			<div id="main">
			
				<?php include 'telnet.php'; 
					$ip = "xxx.xxx.xxx.xxx";
					$port = 00000;
					$input = array("","login serveradmin xxxxx\r\n","use port=xxxx\r\n","serverinfo\r\n");
					$session = new Telnet;
					$output = $session->telnetClient($ip,$port,$input);
					//echo "hello ";
					//echo $output;
					
					//virtualserver settings
					$subject = $output;
					$pattern = '/virtual.\S*/';
					preg_match_all($pattern, $subject, $matches);
					$counter = 0;
					foreach ($matches as $i) {
						foreach ($i as $i2) {
							$i2 = preg_split('/=/', $i2, 0);
							if (count($i2) == 2) {
								echo "$i2[0]: ";
								echo "$i2[1]<br>";
							}
							
						}
					}
				?>
		
			</div>
		</body>
		
	</head>

</html>