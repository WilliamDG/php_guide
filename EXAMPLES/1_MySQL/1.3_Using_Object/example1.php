 <?php 



	include_once('config.php');
	require_once('Database.php');
	
	$GLOBALS['db'] = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, "", false);
	
	$GLOBALS['db']->open();

	$result = $GLOBALS['db']->query("SELECT * FROM Users");
	//$result = $GLOBALS['db']->query("SELECT * FROM Users", true);
	

	
	
	
	if ($result->num_rows > 0) {
	  while($row = $result->fetch_assoc()) {
		echo 
		"id: " . $row["idUser"] . 
		" - Name: " . $row["firstname"]. 
		" " . $row["lastname"]. "<br>";
	  }
	} 
	else {
		echo "0 results";
	}


	$GLOBALS['db']->close();
	//$GLOBALS['db']->__destruct();

?> 