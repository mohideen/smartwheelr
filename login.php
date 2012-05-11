<?php
require_once 'includes/businesslogics.php';

//Hardcoded username / passwords 
$userPass = array("john"=>"pass", "greg"=>"pass");


if(isset($_POST["login"])) {
	$username = $_POST["username"];
	$password = $_POST["password"];
	if(isset($userPass[$username])) {
		if($userPass[$username] == $password)	{
			echo "Welcome ".$username;
			//Start session if session not started already
			if(!isset($_SESSION)) session_start();
			$userId = getUserId($username);
			//Add user to the session
			$_SESSION["userId"] = $userId;
			$_SESSION["username"] = $username;
			header("location:index.php");
		} else {
			echo "Invalid login credentials";
		}
	} else {
		echo "Invalid login credentials";
	}
}


?>


<!doctype HTML>
<html>
<head>
</head>
<body>
<form action="login.php" method="post">
username: <input type="text" name="username" /><br/>
password: <input type="password" name="password" /><br/>
<input type="hidden" name="login" value="true" />
<input type="submit" value="Login" />
</form>
</body>
</html>