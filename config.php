<?php
	// Database credentials
	define('DB_SERVER', 'localhost');
	define('DB_USERNAME', 'id16053710_arunkumar');
	define('DB_PASSWORD', 'Arundbbiomotionllog123*');
	define('DB_NAME', 'id16053710_login_system');

	// Attempt to connect to MySQL database
	$mysql_db = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

	if (!$mysql_db) {
		die("Error: Unable to connect " . $mysql_db->connect_error);
	}
