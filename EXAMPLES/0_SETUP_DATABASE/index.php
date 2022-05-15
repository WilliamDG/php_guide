<html>
	<head>
	</head>
	<body>

		
		<?php
			include("config.php");
			$configs = require('config.php');
			
			
		
			if (file_exists("install/")) {
				include("install/start.php");
			}
			else {
				echo "The folder install does not exists!";
			}
			
			
		?>
	</body>
</html>