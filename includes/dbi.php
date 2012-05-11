<?php
//DBI.PHP acts as the data access layer. 
include '/config.php';
require_once 'dataobjects.php';
require_once 'businesslogics.php';

mysql_connect($dbserver,$dbuser,$dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());


/* User related functions */
function getUserIdFromDB($username)
{
	$query = "SELECT UID FROM user WHERE Username=".addQuote($username);
	$result = mysql_query($query) or die(mysql_error());
	if($row = mysql_fetch_array($result)) {
		return $row["UID"]; //Success
	}
	return -1; //User doesn't exist in database.
}

function addUserToDB($username)
{
	$query = "INSERT INTO user (Username) VALUES (".addQuote($username).")";
	$result = mysql_query($query) or die(mysql_error());
	return true;
}


/* Ride related functions */


?>