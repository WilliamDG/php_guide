<?php
	//	classe DB
	//	https://codeshack.io/super-fast-php-mysql-database-class/
	
	
	

	
	
	$createTables = false;

	
	
	//Create DB if not exist
	$conn = new mysqli($configs->{'host'}, $configs->{'username'}, $configs->{'password'});
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 


	$sql = "CREATE DATABASE IF NOT EXISTS ". $configs->{'database'} . ";";
	if ($conn->query($sql)) {
		if ($conn->warning_count) { 
			if ($result = $conn->query("SHOW WARNINGS")) {
				$row = $result->fetch_row();
				printf("%s (%d): %s\n", $row[0], $row[1], $row[2]);		//1 - Level, 2 - Code, 3 - Message
				$result->close();
				//$createTables = true;
			}
		}
		else if($conn->warning_count == 0){
			echo "Database created successfully!!!";
			$createTables = true;
		}		
		
	} 
	else {
		echo "Error creating database: " . $conn->error;
		exit();
	}
	
	$conn->close();
	
	
	
	
	echo "<br><br>";
	
	
		
	
	
	
	
	
	
	
	//Create tables 
	if(!$createTables)
		exit();
		
	
	$conn = new mysqli(
	$configs->{'host'}, 
	$configs->{'username'}, 
	$configs->{'password'},
	$configs->{'database'}
	);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	} 


	
	
	$sql = "
	CREATE TABLE Users (
		idUser INT NOT NULL AUTO_INCREMENT,
		firstname VARCHAR(30) NOT NULL,
		lastname VARCHAR(30) NOT NULL,
		email VARCHAR(30) UNIQUE NOT NULL,
		password VARCHAR(60) NOT NULL,
		PRIMARY KEY (idUser)
	)
	";
	
	
	if ($conn->query($sql) === TRUE) {
		echo "Table MyGuests created successfully";
	} 
	else {
		echo "Error creating table: " . $conn->error;
	}
	
	$conn->close();
	
	
	
	
	
	
	
	
	
	//Insert Data
	$conn = new mysqli(
	$configs->{'host'}, 
	$configs->{'username'}, 
	$configs->{'password'},
	$configs->{'database'}
	);
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	} 
	
	echo "<br><br>";
	
	
	
	$sql = "
	INSERT INTO 
		Users(firstname, lastname, email, password)
	VALUES 
		('Mario', 'Rossi', 'mario.rossi@mail.com', 'ciao'),
		('Giuseppe', 'Verdi', 'giuseppe.verdi@mail.com', 'ciao'),
		('Fabio', 'Marchesi', 'fabio.marchesi@mail.com', 'ciao'),
		('Beata', 'Bianchi', 'beata.bianchi@mail.com', 'ciao')
	";
	
	
	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} 
	else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
	
	$conn->close();

		
		


?>