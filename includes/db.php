<?php
	/*
	 * @file: 	db.php
	 * 
	 * @author: Raghav V. Sampangi (raghav@cs.dal.ca)
	 * 
	 * @desc:	This file connects to the database and creates the connection object.
	 * 
	 * @notes:	DO NOT MODIFY THIS FILE.
	 * 			Create a database named 2170 and work using that database for A3.
	 */
	
	/*
	 *	db.php
	 *	Connects to the Database on localhost.
	 */

	$host = "localhost:3307";
	$username = "root";
	$password = "root";
	$dbname = "2170";

	$conn = new mysqli($host, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Nooooooooo!" . $conn->connect_error);
	}

?>