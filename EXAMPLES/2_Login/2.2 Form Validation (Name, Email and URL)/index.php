 <html>
	<head>
		<style>
			.error {
				color: #FF0000;
			}
		</style>
	</head>
	<body>


	<?php
		// define variables and set to empty values
		
		$name = $email = $password = $website = "";
		$nameErr = $emailErr = $passwordErr = $websiteErr = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {  
		
		  
		  
			if (empty($_POST["name"])) {
				$nameErr = "Name is required";
			} 
			else {
				$name = test_input($_POST["name"]);
				// check if name only contains letters and whitespace
				if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
				  $nameErr = "Only letters and white space allowed";
				}
			}
			
			if (empty($_POST["email"])) {
				$emailErr = "Email is required";
			} 
			else {
				$email = test_input($_POST["email"]);
				// check if e-mail address is well-formed
				if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				  $emailErr = "Invalid email format";
				}
			}
			
			if (empty($_POST["password"])) {
				$passwordErr = "Password is required";
			} 
			else {
				$password = test_input($_POST["password"]);
			}
			
			if (empty($_POST["website"])) {
				$website = "";
			} 
			else {
				$website = test_input($_POST["website"]);
				// check if URL address syntax is valid (this regular expression also allows dashes in the URL)
				if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
				  $websiteErr = "Invalid URL";
				}
			}

		  
		}

		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
	?>


	<h1> LOGIN </h1>
	<p><span class="error">* required field</span></p>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		Name: <input type="text" name="name"> <span class="error">* <?php echo $nameErr;?></span> <br>
		E-mail: <input type="text" name="email"> <span class="error">* <?php echo $emailErr;?></span> <br>
		Password: <input type="password" name="password"> <span class="error">* <?php echo $passwordErr;?></span> <br>
		Website: <input type="text" name="website"> <span class="error"> <?php echo $websiteErr;?></span> <br>
		<input type="submit" value="Test">
	</form>



	<?php
		/*
		echo "<h2>Your Input:</h2>";
		echo $name;
		echo "<br>";
		echo $email;
		echo "<br>";
		echo $password;
		echo "<br>";
		echo $website;
		echo "<br>";
		*/
	?>


	</body>
</html> 