<?php
require_once '/config.php';
require_once 'dataobjects.php';
require_once 'dbi.php';

/* Functions for dbi.php */
function addQuote($str)
{
	return "'".$str."'";
}


/* Functions for login.php files */
function getUserId($username)
{
	$userId = getUserIdFromDB($username);
	//if $userId is -1, this is a new user
	if($userId == -1) {
		//create user in DB
		if(addUserToDB($username)) { //addUser function returns true on success
			$userId = getUserIdFromDB($username);
		}
	}
	return $userId;
}



?>