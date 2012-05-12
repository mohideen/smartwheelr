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

//If ride search information not in the session
//redirect to get a ride page
if(!isset($_SESSION["searchRide"])) {
	header("location: getaride.php");
}
$searchRide = $_SESSION["searchRide"];
function displaySearchResults()
{
	global $searchRide;
	$foundRides = getMatchingRides($searchRide);
	if(!$foundRides) {
		//No results found redirect the user back to get a ride page
		header("location: getaride.php");
	}
	foreach($foundRides as $ride) {
		
	}
}

?>


<!DOCTYPE HTML>
<html>
<head>
	<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCDfgVTnoOm4H0M8h45tgcPwn5UhxwmpCI&sensor=false"></script>
	<script src="js/map.js"></script>
</head>
<body>
<?php displaySearchResults(); ?>

<br/><a href="index.php">Home</a>
</body>
</html>