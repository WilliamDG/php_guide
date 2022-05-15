	 
<html>
	<head>		
	</head>
	<body>

		<h1> Search User </h1>
		<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
			Nome: <input type="text" name="name" placeholder="Inser User firstname"><br>
			<input type="submit" value="Search">
		</form>



		<?php 

	 		if(!isset($_POST["name"]) || $_POST["name"]==""){	//if here $_POST["name"]==""   --> use elseif
				echo "Search user!";
				echo "<br><br><br>";
				//$testString = "Mario' OR '1' = '1";
				$testString = "Mario&apos; OR &apos;1&apos; = &apos;1";
				echo "Use this to test the Injection: <input type='text' value='"; echo $testString; echo "' id='myInput'>";
				echo "<button onclick='copyToClipboard()'>Copy to Clipboard</button>";
				echo "<br>";
				echo "You will see all users informations";

				 
			}								
			else{
				include_once('config.php');
				require_once('Database.php');

				$GLOBALS['db'] = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);	
				$GLOBALS['db']->open();


				$sql = $_POST["name"];			//here you assign the string to a php variable
				
				echo "<hr>";
				echo "Not escaped str: " . $sql . "<br>";
				$sql = $GLOBALS['db']->escape($sql);
				echo "Escaped str: " . $sql . "<br>";
				echo "<hr>";
				echo "<br><br><br>";
				
				$GLOBALS['db']->query("SELECT * FROM Users WHERE firstname = '" . $sql . "';", false);




				if($GLOBALS['db']->getNumRows() <= 0)
					die("No results");
					

				$rows = $GLOBALS['db']->resultSet();


				foreach ($rows as $row) {
					echo "id: " . $row["idUser"] . 
					" - Name: " . $row["firstname"] .
					" " . $row["lastname"] .
					"<br>";
				}

				$GLOBALS['db']->close();

			}




			





		?>





		<script>
			function copyToClipboard() {
				/* Get the text field */
				var copyText = document.getElementById("myInput");

				/* Select the text field */
				copyText.select();
				copyText.setSelectionRange(0, 99999); /* For mobile devices */

				/* Copy the text inside the text field */
				navigator.clipboard.writeText(copyText.value);

				/* Alert the copied text */
				//alert("Copied the text: " + copyText.value);
			} 
		</script>



	</body>
</html>


