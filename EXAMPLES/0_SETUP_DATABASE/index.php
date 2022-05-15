<html>
	<head>
	</head>
	<body>

		
		<?php
			include_once("config.php");
			
			
			
		
			if (file_exists("install/")) {
				include_once("install/start.php");
			}
			else {
				echo "The folder install does not exists!";
			}
			
			
		?>
	</body>
</html>