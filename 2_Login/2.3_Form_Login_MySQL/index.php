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
		
		$loginErr = "";

		if ($_SERVER["REQUEST_METHOD"] == "POST") {  
		
		  
		  

			
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
			
			if($email != "" && $password != "" && $emailErr == "" && $passwordErr == ""){
	
				//SQL
				$servername = "localhost";
				$username = "root";
				$dbpw = "";
				$dbname = "php_guide";

				// Create connection
				$conn = new mysqli($servername, $username, $dbpw, $dbname);
				// Check connection
				if ($conn->connect_error) {
				  die("Connection failed: " . $conn->connect_error);
				}

				$sql = "SELECT * FROM Users WHERE email = '" . $email ."';";
				$result = $conn->query($sql);
				
				if($result){		
					if ($result->num_rows == 1) {
					  $account = $result->fetch_assoc();
					  if($password == $account["password"]){
						  $login = true;
						  echo "Benvenuto " . $account["firstname"] . $account["lastname"];
					  }
					  else{
						  $loginErr = "Password is not correct";
					  }
	
					} 
					else if($result->num_rows == 0)  {		//This user is not registered here
					  $loginErr = "This mail does not exist!";
					}
					else{
						echo "More then 1 results";			//Should not be there  (email UNIQUE)
					}
				}
				else{
					echo "0 results";
				}
				$conn->close();
			
			}
			


		  
		}

		function test_input($data) {
		  $data = trim($data);
		  $data = stripslashes($data);
		  $data = htmlspecialchars($data);
		  return $data;
		}
		
		

		
		if(!isset($login)){
	?>


	<h1> LOGIN </h1>
	<p><span class="error">* required field</span></p>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
		E-mail: <input type="text" name="email"> <span class="error">* <?php echo $emailErr;?></span> <br>
		Password: <input type="password" name="password"> <span class="error">* <?php echo $passwordErr;?></span> <br>
		<input type="submit" value="Login">
	</form>

	<?php
		}
		
		echo $loginErr;
	?>




	</body>
</html> 