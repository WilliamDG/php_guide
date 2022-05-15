<?php
	class Database
	{

		private $servername   	= ""; 	//database server
		private $username     	= ""; 	//database login name
		private $password     	= ""; 	//database login password
		private $database 		= ""; 	//database name
		private $port			= 3306;	//database port

		private $conn;
		public $result;

		/**
		* Sets the connection credentials to connect to your database.
		*
		* @param string $servername - the host of your database
		* @param string $username - the username of your database
		* @param string $password - the password of your database
		* @param string $database - your database name
		* @param integer $port - the port of your database
		* @param boolean $autoconnect - to auto connect to the database after settings connection credentials
		*/
		public function __construct($servername, $username, $password, $database, $port = 3306, $autoconnect = true)
		{
			$this->servername=$servername;
			$this->username=$username;
			$this->password=$password;
			$this->database=$database;
			$this->port=$port;
			
			if($autoconnect) 
				$this->connect();
		}
		
		public function __destruct()
		{
			unset($this->conn);
		}
		/*
		public function __get($name) {
			if ($this->hasProperty($name))
				return $this->$name;
			return null;
		}

		public function __set($name, $value) {
			if ($this->hasProperty($name))
				$this->$name = $value;
			return null;
		}
		*/
		

		/**
		* Open the MySQL connection
		*
		* @return boolean
		*/
		public function open()
		{
			$this->conn = new mysqli($this->servername, $this->username, $this->password, $this->database);

			// Check connection
			if ($this->conn->connect_error) {
			  die("Connection failed: " . $conn->connect_error);
			}
			//echo "Connected successfully";
			return true;
		}
		
		/**
		* Close the MySQL connection
		*
		* @return boolean
		*/
		public function close() {
			//echo $this->conn->close();
			return $this->conn->close();
		}
		
		
		
		/**
		* Escape your parameters to prevent SQL Injections! 
		*
		* @param string $string -parameter to escape
		* @return the escaped string 
		*/
		function escape($string) {
			return $this->conn->escape_string($string);
		}
		
		
		/**
		*
		* Execute query
		*
		* @param string $sql - sql query
		* @return the result of the executed query 
		*/
		public function query($sql, $auto_escape_string = false)
		{
			/*
			if($this->conn){
				die("Connection failed: " . $this->conn->connect_error);
				return 0;
			}
			*/
			
			if(!$auto_escape_string)			
				$this->result = $this->conn->query($sql);			
			else
				$this->result = $this->conn->query($this->escape($sql));
			
			
			
			if(!$this->result){
				$this->result = NULL;
				echo "Query result NULL";
			}
				
			return $this->result;

		
		}
		
		
		
		public function getNumRows()
		{
			if($this->result)
				return $this->result->num_rows;
		}
		
		public function resultSet()
		{
			//if($this->getNumRows() <= 0)
			//	return NULL;
			
			$rows = array();
			while ($row = $this->result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}
		
		
		
		

		
	}
	
	
	
	?>
	
	
	
	
	
	