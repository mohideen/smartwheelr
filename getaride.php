<?php
require_once 'includes/businesslogics.php';
require_once 'includes/dbi.php';
//Start session if session not started already
if(!isset($_SESSION)) session_start();
//If not logged in redirect him to home page / login page.
if(!isset($_SESSION["username"]))	{
	header("location:index.php"); //or header("location:login.php");
}

//Get user information from the session array
$username = $_SESSION["username"];
$userId = $_SESSION["userId"];

//Initialize location add request status
$addLocationStatus = "";
//If the HTML form is POSTed by the user, add it to database
if(isset($_POST["getRide"])) {
	$ride = new ride();
	$ride->startLocation = $_POST["startlocation"];
	$latlng = $_POST["startlocationLatLng"];
	$latlng = explode(",",$latlng);
	$ride->startLat = doubleval($latlng[0]);
	$ride->startLng = doubleval($latlng[1]);
	$ride->destinationLocation = $_POST["destinationlocation"];
	$latlng = $_POST["destinationlocationLatLng"];
	$latlng = explode(",",$latlng);
	$ride->destinationLat = doubleval($latlng[0]);
	$ride->destinationLng = doubleval($latlng[1]);
	$timestamp = strtotime($_POST["date"]); 
	$ride->tripStartDate = date("Y-m-d", $timestamp);
	$timeHH = intval($_POST["timeHH"]); //Get the integer value of the string
	$timeMM = $_POST["timeMM"];
	$timeAMPM = $_POST["timeAMPM"];
	if($timeAMPM == "PM" && $timeHH!=12) {
		$timeHH = $timeHH+12;
	}
	$ride->tripStartTime = $timeHH.":".$timeMM.":"."00";
	$ride->tripFrequency = "onetime"; //Hardcoding as a one time trip
	$ride->tripType = "oneway"; //Hardcoding as a one way trip
	//Add the ride search information to session, and transfer control
	//to search results page
	$_SESSION["searchRide"] = $ride;
	header("location: rides.php");
}


?>


<!DOCTYPE HTML>
<html>
<head>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCDfgVTnoOm4H0M8h45tgcPwn5UhxwmpCI&sensor=false"></script>
	<script src="js/map.js"></script>
</head>
<body>
<form action="offeraride.php" method="post">
<h3>Get a ride</h3>
Start Location:<br/>
<input type="text" name="startlocation" onblur="getLatLng('startlocationLatLng',this);" /><br/>
<input type="hidden" name="startlocationLatLng" id="startlocationLatLng" /><br/>
Destination Location:<br/>
<input type="text" name="destinationlocation" onblur="getLatLng('destinationlocationLatLng',this);" /><br/>	
<input type="hidden" name="destinationlocationLatLng" id="destinationlocationLatLng" /><br/>	
Trip Date and Start Time<br/>
<input type="date" name="date" />(mm/dd/yyyy)<br/>
<select name="timeHH">
	<option value="01">01</option>
	<option value="02">02</option>
	<option value="03">03</option>
	<option value="04">04</option>
	<option value="05">05</option>
	<option value="06">06</option>
	<option value="07">07</option>
	<option value="08">08</option>
	<option value="09">09</option>
	<option value="10">10</option>
	<option value="11">11</option>
	<option value="12">12</option>
</select>
<select name="timeMM">
	<option value="00">00</option>
	<option value="05">05</option>
	<option value="10">10</option>
	<option value="15">15</option>
	<option value="20">20</option>
	<option value="25">25</option>
	<option value="30">30</option>
	<option value="35">35</option>
	<option value="40">40</option>
	<option value="45">45</option>
	<option value="50">50</option>
	<option value="55">55</option>
</select>
<select name="timeAMPM">
	<option value="AM">AM</option>
	<option value="PM">PM</option>
</select><br/>
<input type="hidden" name="getRide" value="true" /><br/>
<input type="submit" value="Get a ride" />
<span style="color:red;">
</span>
</form>
<br/><a href="index.php">Home</a>
</body>
</html>