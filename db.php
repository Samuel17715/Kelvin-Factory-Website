<?php
	header("Access-Control-Allow-Origin: *");
	
	// Report all errors
	error_reporting(E_ALL);

	require_once ('server.php');
	require_once ('credentials.php');

	// Creating a object of PDODatabaseConnection Class
	$pdo = new serverProcessing($dbhost, $dbname, $dbuser, $dbpass);

    // Connect to the Database
	$pdo->connect(); //If connection fails give error message and exit