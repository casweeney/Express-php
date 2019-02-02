<?php
	// Functions for all database communications

	//First require the config file where your database Constants have been declared
	require_once("config.php");

	//The MySQLDatabase Class contains Methods for database communications
	class MySQLDatabase {

		public static $connection;
        
        //The __construct function runs the database connection automatically
		function __construct(){
			$this->open_db_connection();
		}

		// open_db_connection method is used to create the database connection with all the database constants
		public static function open_db_connection(){
            self::$connection = new mysqli(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		}

		/*
			The query method is used to run run all MySQL query
		*/
		public static function query($sql){
			$result = mysqli_query(self::$connection, $sql);
			if(!$result){
				die("Query failed" . mysqli_error(self::$connection));
			}

			return $result;
		}

		/*
			The fetch_data method is used to fetch data from the database in an Associative Array format
		*/

		public static function fetch_data($result){
            $output = mysqli_fetch_assoc($result);
            return $output;
        }

        /*
        	The escaped_string method is used to sanitize data sent to the database via forms
        	The $string is the variable where the form is stored.
        */
		public static function escaped_string($string){
			$escaped_string = mysqli_real_escape_string(self::$connection, $string);
			$escaped_string = trim($escaped_string);
			$escaped_string = htmlspecialchars($escaped_string);
			return $escaped_string;
		}
	}

	$database = new MySQLDatabase();
?>