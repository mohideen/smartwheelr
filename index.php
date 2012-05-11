<?php
//Start session if session not started already
if(!isset($_SESSION)) session_start();

$username = "Guest";
//If the user is already logged in get his username from session.
if(isset($_SESSION["username"])) {
	$username = $_SESSION["username"];
	$userId = $SESSION["userId"];
	
}
echo "Hi ".$username;
echo "<br/>Welcome to smartwheelr!";
 
?>