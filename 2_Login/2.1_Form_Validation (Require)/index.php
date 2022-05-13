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
		
		$email = $password = "";
		$emailErr = $passwordErr = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {  
		
		  
			if (empty($_POST["email"])) {
				$emailErr = "Email is required";
			} 
			else {
				$email = test_input($_POST["email"]);
			}
			if (empty($_POST["password"])) {
				$passwordErr = "Password is required";
			} 
			else {
				$password = test_input($_POST["password"]);
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
		E-mail: <input type="text" name="email"> <span class="error">* <?php echo $emailErr;?></span> <br>
		Password: <input type="password" name="password"> <span class="error">* <?php echo $passwordErr;?></span> <br>
		<input type="submit" value="Login">
	</form>

	</body>
</html> 