<?php
//Start session if session not started already
if(!isset($_SESSION)) session_start();
/* Check if user has requested to logout, if YES clear current session */
if(isset($_GET["logout"])) {
	unset($_SESSION['username']);
	session_destroy();
}
//Initiaze username as empty string
$username = "";
//If the user is already logged in get his username from session.
if(isset($_SESSION["username"])) {
	$username = $_SESSION["username"];
	$userId = $_SESSION["userId"];
	
}
/* Function to dsplay welcome meessage based on login status */
function printWelcomeMessage()
{
	global $username;
	if($username == "") { //Guest user welcome
		echo "Hi Guest";
		echo "<br/>Welcome to smartwheelr!";
		echo "<br/><a href='login.php'>login</a>";
	} else { //Logged in user welcome
		echo "Hi ".$username;
		echo "<br/>Welcome to smartwheelr!";
		echo "<br/><a href='addlocation.php'>Add Location</a>";
		echo "<br/><a href='offeraride.php'>Offer a ride</a>";
		echo "<br/><a href='getaride.php'>Get a ride</a>";
		echo "<br/><a href='index.php?logout=true'>logout</a>";
	}
}
 
?>




<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
 <?php printWelcomeMessage(); ?>
</body>
</html>