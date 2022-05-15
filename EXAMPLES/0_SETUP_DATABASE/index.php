<html>
	<head>
	</head>
	<body>
		
		
		<?php
			//Install the DB
		
		
			include_once("config.php");
			
			$path = "install";
		
			if (file_exists("$path/")) {
				include_once("$path/start.php");
				
				//then delete it (or remove it)
				//if(!rmdir("$path")) 
				//	echo ("Could not remove \"$path\" folder");
				
							
				echo "<br><br><br><br>";			
						
				if(!rename("$path",".$path"))
					echo "Error renaming \"$path\" folder...";
				else
					echo "Renaming \"$path\" folder to \".$path\"";
				
				
				
			}
			else {
				echo "Be sure the \"$path\" folder exist!";
			}
			
			
		?>
	</body>
</html>