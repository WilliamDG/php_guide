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
	
				include_once('config.php');
				require_once('Database.php');

				$GLOBALS['db'] = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);	
				$GLOBALS['db']->open();
				$sql = "SELECT * FROM Users WHERE email = '" . $email ."';";
				$GLOBALS['db']->query($sql);

				if($GLOBALS['db']->getNumRows() <= 0){
					$loginErr = "This mail does not exist!";	//This user is not registered here
				}
				else if($GLOBALS['db']->getNumRows() > 1){
					$loginErr = "More then 1 results";			//Should not be there  (email UNIQUE)
				}
				else{			//$GLOBALS['db']->getNumRows() == 1
						
					$rows = $GLOBALS['db']->resultSet();


					foreach ($rows as $row) {
						if($password == $row["password"]){
							$login = true;
							echo "Benvenuto: " . $row["firstname"] . " " . $row["lastname"];
						}	
						else{
							$loginErr = "Password is not correct";
						}
					}
				}
				
				
				$GLOBALS['db']->close();

				/*
				$result = $GLOBALS['db']->query($sql);
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
					else if($result->num_rows == 0)  {		
					  $loginErr = "This mail does not exist!";	//This user is not registered here
					}
					else{
						echo "More then 1 results";			//Should not be there  (email UNIQUE)
					}
				}
				else{
					echo "0 results";
				}
				*/


			
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
		
		echo $loginErr;		//print the variable here to be shown under the form
	?>




	</body>
</html> 