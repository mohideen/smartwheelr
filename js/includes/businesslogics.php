<?php
require_once '../config.php';
require_once 'dataobjects.php';
require_once 'dbi.php';

/* Functions for dbi.php */
function addQuote($str)
{
	return "'".$str."'";
}


/* Functions for login.php files */
//Function to get user id of a user,
//if this a firsttime user add him to DB and get user id
function getUserId($username)
{
	$userId = getUserIdfromDB($username);
	//if $userId is -1, this is a new user
	if($userId == -1) {
		//create user in DB
		if(addUserToDB($username)) { //addUser function returns true on success
			$userId = getUserIdFromDB($username);
		}
	}
	return $userId;
}

/* Functions for Offer a ride page */
//Function to add a ride and ride instances to DB
function addNewRide($ride)
{
	$rideId = addNewRidetoDB($ride);
	$ride->rideId = $rideId;
	if($ride->tripFrequency == "onetime") {
		//If this is a one time trip just add a single ride instance
		addRideInstance($rideId, $ride->tripStartDate);
		
	} else { 
		//if this is a recurring trip add instances for each date the ride occurs
	
	}
	//If this is a two way trip repeat the above two steps for the return trip.
	if($ride->tripType == "roundtrip") {
		if($ride->tripFrequency == "onetime") {
			//If this is a one time trip just add a single return ride instance
		
		} else {
			//if this is a recurring trip add return instances for each date the ride occurs
		
		}
	}
}

/* Functions for rides.php (search results) page */
//Function to search rides
function getMatchingRides($searchRide)
{
	$result = getFilteredRidesfromDB($searchRide);
	return $result;
}

/* Functions for dbi.php page */
//Function to calculate new time by adding/subracting minutes
function calculateNewTime($timeString, $minutes)
{
	$timeArray = explode(":",$timeString);
	$timeArray[1] = intval($timeArray[1]); //Parse minutes string as int
	if($minutes<0) { //If minutes needs to subracted
		if(($timeArray[1]+$minutes)<0)	{ //hour needs to decremented
			$timeArray[1]=$timeArray[1]+$minutes+60;
			$timeArray[0] = intval($timeArray[1])-1; //Will not work if time is < 1AM
			$$timeArray[0] = sprintf("%02d", $timeArray[0]);
		} else {
			$timeArray[1]=$timeArray[1]+$minutes;
		}
	} else { //if minutes needs to be added
		if(($timeArray[1]+$minutes)>60)	{ //hour needs to incremented
			$timeArray[1]=$timeArray[1]+$minutes-60;
			$timeArray[0] = intval($timeArray[1])+1; //Will not work if time is > 11PM
			$$timeArray[0] = sprintf("%02d", $timeArray[0]);
		} else {
			$timeArray[1]=$timeArray[1]+$minutes;
		}
	}
	$$timeArray[1] = sprintf("%02d", $timeArray[1]);
	return $timeArray[0].":".$timeArray[1].":".$timeArray[2];
}

?>