	 <?php 



	include_once('config.php');
	require_once('Database.php');
	
	$GLOBALS['db'] = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME, "", false);
	
	$GLOBALS['db']->open();

	$GLOBALS['db']->query("SELECT * FROM Usersz WHERE firstname = 'Mario'");
	//$GLOBALS['db']->query("SELECT * FROM Users", true);
	
	
	//get qery Data in array
	if($GLOBALS['db']->getNumRows() <= 0)
		die("No results");
	$rows = $GLOBALS['db']->resultSet();
	
	
	//Display with for
	for ($i = 0; $i < count($rows); $i++) {
		echo "id: " . $rows[$i]["idUser"] . 
		" - Name: " . $rows[$i]["firstname"] .
		" " . $rows[$i]["lastname"] .
		"<br>";
    }
	
	echo "<br><br>";
	
	//Or with foreach
	foreach ($rows as $row) {
		echo "id: " . $row["idUser"] . 
		" - Name: " . $row["firstname"] .
		" " . $row["lastname"] .
		"<br>";
    }
	
	
	$GLOBALS['db']->close();
	//$GLOBALS['db']->__destruct();

?> 