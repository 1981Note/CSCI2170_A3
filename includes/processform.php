<?php
	/*
	 * @file: 	processform.php
	 * 
	 * @author: Raghav V. Sampangi (raghav@cs.dal.ca)
	 * 
	 * @desc:	This file processes data submitted to add/edit/delete items to the list.
	 * 
	 * @notes:	As a student working on A3 in CSCI 2170, you are allowed to edit this file. 
	 * 			When you edit/modify, include block comments to summarize changes. 
	 * 			Clearly highlight what changed and why, and state assumptions if you make any.
	 */


	/*
	 * Processing submitted list item
	 */

	require_once "db.php";

	/**
	 * sanitizeData() function to sanitize data
	 * Learned from sanitizing and storing data submitted vai forms from Week 3 in CSCI2170
	 */
	function sanitizeData($data) {
		$cleanData = trim($data);
		$cleanData = stripslashes($cleanData);
		$cleanData = htmlspecialchars($cleanData);
		return $cleanData;
	}

	//if isset "submitListItem"
	if (isset($_POST['submitListItem'])) {
		//sanitizeData of uses' input
		$text = sanitizeData($_POST['listItem']);
		//if users' input is not empty
		if(!empty($text)){
			//then insert the value to mylist
			$submitSQL = "INSERT INTO `mylist`(`l_id`, `l_item`, `l_done`) VALUES (NULL,'$text', 0)";
			//echo $submitSQL;
			$conn->query($submitSQL);
		}
		//header to index.php
		header ("Location: ../index.php");
	}

	/*
	 *	Processes delete item requests
	 */

	//if isset "delete"
	if (isset($_GET['delete'])) {
		//get delete value which from scripts.js
		$id = $_GET['delete'];
		//delete the row which l_id equal to $id
		$deleteSQL = "DELETE FROM mylist WHERE l_id = " . $id;
		//echo $deleteSQL;
		$conn->query($deleteSQL);
		die();
	}
	

	/*
	 *	Processes completed item requests
	 *  "Mark as done" --> set l_done = 1
	 */

	//if isset "complete"
	if (isset($_GET['complete'])) {
		//if get done
		if(isset($_GET['done'])) {
			//id equal to get complete
			$id = $_GET['complete'];
			//done equal to get done (whether 1 or 0)
			$done = $_GET['done'];
			//update the mylist table using l_id equal to $id get from complete
			$updateSQL = "UPDATE `mylist` SET `l_done`= " . $done . " WHERE l_id = " . $id;
			//echo $updateSQL;
			$conn->query($updateSQL);
			die();
		}

	}


?>
