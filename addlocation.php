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
if(isset($_POST["addLocation"])) {
	$address = new location();
	$address->label = $_POST["label"];
	$address->street = $_POST["street"];
	$address->city = $_POST["city"];
	$address->state = $_POST["state"];
	$address->zip = $_POST["zip"];
	$result = addLocationtoDB($userId, $address); //returns true on success 
	if($result) {
		$addLocationStatus = "Location added to your profile!";
	}
}

/* Function to show that the location was added
   successfully to the user's profile */
function showLocationAddedConfirmation()
{
	global $addLocationStatus;
	echo $addLocationStatus;
}
?>


<!DOCTYPE HTML>
<html>
<head>
</head>
<body>
<form action="addlocation.php" method="post">
<h3>Add Location</h3>
Add frequently travelled locations to your profile<br/>
Label: <input type="text" name="label" placeholder="E.g. Home" /><br/>
Street: <input type="text" name="street" /><br/>
City: <input type="text" name="city" /><br/>
State: <select name="state"> 
	<option value="" selected="selected">Select a State</option> 
	<option value="AL">Alabama</option> 
	<option value="AK">Alaska</option> 
	<option value="AZ">Arizona</option> 
	<option value="AR">Arkansas</option> 
	<option value="CA">California</option> 
	<option value="CO">Colorado</option> 
	<option value="CT">Connecticut</option> 
	<option value="DE">Delaware</option> 
	<option value="DC">District Of Columbia</option> 
	<option value="FL">Florida</option> 
	<option value="GA">Georgia</option> 
	<option value="HI">Hawaii</option> 
	<option value="ID">Idaho</option> 
	<option value="IL">Illinois</option> 
	<option value="IN">Indiana</option> 
	<option value="IA">Iowa</option> 
	<option value="KS">Kansas</option> 
	<option value="KY">Kentucky</option> 
	<option value="LA">Louisiana</option> 
	<option value="ME">Maine</option> 
	<option value="MD">Maryland</option> 
	<option value="MA">Massachusetts</option> 
	<option value="MI">Michigan</option> 
	<option value="MN">Minnesota</option> 
	<option value="MS">Mississippi</option> 
	<option value="MO">Missouri</option> 
	<option value="MT">Montana</option> 
	<option value="NE">Nebraska</option> 
	<option value="NV">Nevada</option> 
	<option value="NH">New Hampshire</option> 
	<option value="NJ">New Jersey</option> 
	<option value="NM">New Mexico</option> 
	<option value="NY">New York</option> 
	<option value="NC">North Carolina</option> 
	<option value="ND">North Dakota</option> 
	<option value="OH">Ohio</option> 
	<option value="OK">Oklahoma</option> 
	<option value="OR">Oregon</option> 
	<option value="PA">Pennsylvania</option> 
	<option value="RI">Rhode Island</option> 
	<option value="SC">South Carolina</option> 
	<option value="SD">South Dakota</option> 
	<option value="TN">Tennessee</option> 
	<option value="TX">Texas</option> 
	<option value="UT">Utah</option> 
	<option value="VT">Vermont</option> 
	<option value="VA">Virginia</option> 
	<option value="WA">Washington</option> 
	<option value="WV">West Virginia</option> 
	<option value="WI">Wisconsin</option> 
	<option value="WY">Wyoming</option>
</select>
Zip: <input type="text" name="zip" /><br/>
<input type="hidden" name="addLocation" value="true" />
<input type="submit" value="Add" />
<span style="color:red;">
<?php showLocationAddedConfirmation(); ?>
</span>
</form>
<br/><a href="index.php">Home</a>
</body>
</html>