<?php
/**
 * this is index.php from Assignment 3 CSCI2170
 * Beginning code given from Raghav V. Sampangi (raghav@cs.dal.ca)
 * Developed code given by Siyuan Chen (sy611254@dal.ca)
 */
	require_once "includes/header.php";
	
?>

	<!--
		this is nav bar for the home page
	-->
	<nav id="primary-nav">
		<a href="index.php">Home</a>
		<?php
			//session_start
			session_start();
			//if session username is not set
			if (!isset($_SESSION["username"])) {
				//then header login.php
				header("includes/login.php");
				//else if session username is set
			}else{
				//then $firstname is session firstname
				$firstname = $_SESSION["firstname"];
				//then echo the sentence with logout href 
				echo "<a href='includes/logout.php' id='whiteColor'>Hello $firstname! (click here to logout)</a>";
			}
	   ?>
	</nav>

	<!--
		this is main page for home page
	-->
	<main id="pg-main">

		<?php
		//if session username is not set
			if (!isset($_SESSION['username'])) {
		?>
		<!--
			then give login form for the users to login
		-->
			<h3>You must login to continue...</h3>
			<?php 
				//if get loginerror
				if(isset($_GET["loginerror"])){
					//and the loginerror is true
					if($_GET["loginerror"] == "true"){
						//then echo the sentence for the usersname or password is wrong
						echo "<i><p id='incorrectInput'>*** The username and/or password that you have entered is incorrect. Please try again. ***</p></i>";
					}
				}
			?>
			<!--
				form for login, using post method and login.php action

				How to create login form from w3school
				URL: https://www.w3schools.com/howto/howto_css_login_form.asp
				Date Accessed: 2021-10-31
			-->
			<form id="form-flex-container2" action="includes/login.php" method="post">
				<div>
					<label for="username" id="input-username-text">Enter your username: </label>
					<input type="text" name="username" id="input-username">
				</div>
				<div>
					<label for="password" id="input-password-text">Enter your password: </label>
					<input type="password" name="password" id="input-password">
				</div>
				<input type="submit" name="button" id="input-submit-form" value="Login" class="login">
			</form>
		<?php 
			}
			//if session username is set
			//give the to do list instruction and to do list
			else {
				
		?>
			<!--
				the form is given by CSCI2170 Assignment 3
				I made change of action to processform for add to do list (insert, delete, update items to toDoList)
			-->
			<h3>Submit a new item to your to do list:</h3>
			<form id="form-flex-container" action="includes/processform.php" method="post">
				<input type="text" placeholder="Enter list item" name="listItem" id="value">
				<input type="submit" name="submitListItem" id="add" value="Submit list item">
			</form>

			<!--
				This section is about to do list
			-->
			<section id="list-container">
				<h3>Your list:</h3>
				<table id='table'>
					<?php
							//select all from mylist using ASC order
							/**
							 * Knowleage about order by to do list using l_id ASC order
							 * URL: https://www.w3schools.com/sql/sql_orderby.asp
							 * Date Accessed: 2021-10-31
							 */
							$querySQL = "SELECT * FROM mylist ORDER BY l_id ASC";
							$result = $conn->query($querySQL);
							//echo all the result
							//knowledge from CSCI2170 while loop the table
							if($result){
								if (mysqli_num_rows($result) > 0) {
									while ($row = $result->fetch_assoc()){
										//first echo the row tag for the toDoList with different id, because for the while loop every row or items need different id, so add l_id from table
										echo "<tr id='tableRow" . $row['l_id'] . "'>";
										//if l_done equal to 0, then it means it not complete, so it have no complete class
										if($row['l_done'] == 0) {
											//echo the column 1 (checkbox and its label) if checkbox is clicked, then use the changeStatus method in scripts.js 
											echo "<td>" . "<label for='checkbox".$row['l_id']."' id='needToCheck".$row['l_id']."'><input onclick='changeStatus(" . $row['l_id'] . ")' class='checkbox' id='checkbox" . $row['l_id'] . "' type='checkbox' " . $row['l_id'] ." '> ". $row['l_item'] ."</label></td>";
										}
										//else if l_done equal to 1, then it means it is complete, it have complete class
										else {
											//echo the column 1 (checkbox and its label) if checkbox is clicked, then use the changeStatus method in scripts.js 
											echo "<td>" . "<label class='complete' for='checkbox".$row['l_id']."' id='needToCheck".$row['l_id']."'><input onclick='changeStatus(" . $row['l_id']. ")' class='checkbox' id='checkbox" . $row['l_id'] . "' type='checkbox' checked " . $row['l_id'] ." '> ". $row['l_item'] ."</label></td>";
										}
										//echo the column 2 (delete this item button) if button is clicked, then use the deleteItem method in scripts.js
										echo "<td>" . "<button onclick='deleteItem(" . $row['l_id'] .  ")'>Delete this item</button></td>";
										echo "</tr>";
									}
									//if row number not bigger than 0, which means row number is 0
								}else{
									//echo "is currently empty!"
									echo "<p>is currently empty!</p>";
								}
							}
						
						// Update this code to display the list if list items are available in the DB
						// And echo the list is empty if there is no list item
					?>
				</table>
			</section>
			<?php 
			}
			?>
	</main>

<?php
	require_once "includes/footer.php";
?>

	