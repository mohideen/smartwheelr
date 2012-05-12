<?php
//DBI.PHP acts as the data access layer. 
include '../config.php';
require_once 'dataobjects.php';
require_once 'businesslogics.php';

mysql_connect($dbserver,$dbuser,$dbpass) or die(mysql_error());
mysql_select_db($dbname) or die(mysql_error());

/*****************************************/
/* User & User Profile related functions */
/*****************************************/
/* Function to get the ID of user from DB by username */
function getUserIdfromDB($username)
{
	$query = "SELECT UID FROM user WHERE Username=".addQuote($username);
	$result = mysql_query($query) or die(mysql_error());
	if($row = mysql_fetch_array($result)) {
		return $row["UID"]; //Success
	}
	return -1; //User doesn't exist in database.
}
/* Function to add a new user to database */
function addUserToDB($username)
{
	$query = "INSERT INTO user (Username) VALUES (".addQuote($username).")";
	$result = mysql_query($query) or die(mysql_error());
	return true;
}
/* Function to add a new location to user's profile */
function addLocationtoDB($userId, $address)
{
	$query = "INSERT INTO location" . " "; // [" " - Adding a trailing whitespace]
	$query .= "(UID, Label, Street, City, State, Zip) VALUES" . " ";
	$query .= "(".$userId.", ";
	$query .= addQuote($address->label).", ";
	$query .= addQuote($address->street). ", ";
	$query .= addQuote($address->city). ", ";
	$query .= addQuote($address->state). ", ";
	$query .= addQuote($address->zip). ")";
	$result = mysql_query($query) or die(mysql_error());
	return true;
}
/******************************************/
/* Ride and Reservation related functions */
/******************************************/
/* Function to add a new ride offer to DB */
function addNewRidetoDB($ride)
{
	$query = "INSERT INTO ride" . " "; // [" " - Adding a trailing whitespace]
	$query .= "(OffererID, StartLocation, StartLat, StartLng".", ";
	$query .= "DestinationLocation, DestinationLat, DestinationLng".", ";
	$query .= "TripStartDate, TripStartTime, Price, MaxSeats) VALUES" . " ";
	$query .= "(".$ride->offererId.", ";
	$query .= addQuote($ride->startLocation).", ";
	$query .= $ride->startLat.", ";
	$query .= $ride->startLng.", ";
	$query .= addQuote($ride->destinationLocation). ", ";
	$query .= $ride->destinationLat. ", ";
	$query .= $ride->destinationLng. ", ";
	$query .= addQuote($ride->tripStartDate). ", ";
	$query .= addQuote($ride->tripStartTime). ", ";
	$query .= addQuote($ride->price). ", ";
	$query .= addQuote($ride->maxSeats). ")";	
	$result = mysql_query($query) or die(mysql_error());
	$rideId = mysql_insert_id();
	return $rideId;
}
/* Function to add a instance of a ride */
function addRideInstance($rideId, $date)
{
	$query = "INSERT INTO rideinstances" . " "; // [" " - Adding a trailing whitespace]
	$query .= "(RideID, Date) VALUES" . " ";
	$query .= "(".$rideId.", ";
	$query .= addQuote($date).")";
	$result = mysql_query($query) or die(mysql_error());
	return true;
}

/* Function to search for rides */
function getFilteredRidesfromDB($searchRide)
{
	//First match rides that are offered in the required date
	//Then further match it with rides that are close to the
	//locations of the requirements
	//Calculate time period for search
	$fromTime = calculateNewTime($searchRide->tripStartTime, -30);
	$toTime = calculateNewTime($searchRide->tripStartTime, 30);
	$query = "SELECT * FROM ride R" . " ";
	$query .= "JOIN (";
	$query .= "SELECT RideID FROM rideinstances" . " ";
	$query .= "WHERE Date=".$searchRide->tripStartDate;
	$query .= ") I ON I.RideID = R.RideID" . " ";
	$query .= "WHERE " . " ";
	$query .= "R.TripStartTime BETWEEN ".$fromTime." AND ".$toTime . " ";
	$query .= "AND R.StartLat BETWEEN ".($searchRide->startLat-0.03)." AND ".($searchRide->startLat+0.03) . " ";
	$query .= "AND R.StartLng BETWEEN ".$searchRide->startLng-0.03." AND ".$searchRide->startLng+0.03 . " ";
	$query .= "AND R.DestinationLat BETWEEN ".$searchRide->destinationLat-0.03." AND ".$searchRide->destinationLat+0.03 . " ";
	$query .= "AND R.DestinationLng BETWEEN ".$searchRide->destinationLng-0.03." AND ".$searchRide->destinationLng+0.03 . " ";
	$result = mysql_query($query) or die(mysql_error());
	if($row = mysql_fetch_array($result)) {
		return $row["UID"]; //Success
	}
	return -1; //User doesn't exist in database.
}

?>