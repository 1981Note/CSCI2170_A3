<?php
	/*
	 * @file: 	index.php
	 * 
	 * @author: Raghav V. Sampangi (raghav@cs.dal.ca)
	 * 
	 * @desc:	This file must contain the login processing script.
	 * 
	 * @notes:	As a student working on A3 in CSCI 2170, you are allowed to edit this file.
	 * 			When you edit/modify, include block comments to summarize changes. 
	 * 			Clearly highlight what changed and why, and state assumptions if you make any.
	 */
	require_once "db.php";

	//sanitizeData function
	function sanitizeData($data) {
		$cleanData = trim($data);
		$cleanData = stripslashes($cleanData);
		$cleanData = htmlspecialchars($cleanData);

		return $cleanData;
	}

	/**
	 * login script from zybook
	 * URL: https://learn.zybooks.com/zybook/DALCSCI2170SampangiFall2021/chapter/8/section/1
	 * Date Accessed: 2021-10-25
	 * Author: Raghav V. Sampangi (raghav@cs.dal.ca)
	 * 
	 */
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		//session_start()
		session_start();
		// Get values submitted from the login form
		$username = sanitizeData($_POST["username"]);
		$password = sanitizeData($_POST["password"]);

		//find the row which have correct login username and correct password
		$SQL = "SELECT * FROM mylist_login WHERE m_login_username = '$username' AND m_login_password = '$password'";
		$result = $conn->query($SQL);
		//if the row of result is 0
		if ($result->num_rows == 0) {
			//then header index.php loginerroe=true, echo the wrong message
			header("Location: ../index.php?loginerror=true");
			die;
			//if there exist result
		}else{
			$row = $result->fetch_assoc();
			//check the username and password equal to users enter in
			if ($row['m_login_username'] === $username && $row['m_login_password'] === $password){
				//set $_SESSION[] = $row[];
				$_SESSION["username"] = $row['m_login_username'];
				$_SESSION["password"] = $row['m_login_password'];
				$_SESSION["firstname"] = $row['m_login_firstname'];
				$_SESSION["lastname"] = $row['m_login_firstname'];
				$_SESSION["email"] = $row['m_login_email'];
				$_SESSION["id"] = $row['m_login_id'];
				//header the to do list part of index.php
				header("Location: ../index.php");
				die;
				//else there exist loginerror message
			}else{
				header("Location: ../index.php?loginerror=true");
				die;
			}
		}
	}

	

?>

		

