<?php
	session_start();
	if(!isset($_SESSION['username'])){
		header("Location:login.php");
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Private_Page</title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	<link rel="stylesheet" type="text/css" href="validate.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>
<body>
	<p>This is a private page</p>
	<p>We want to protect it</p>
	<p><a href="logout.php">Logout</a></p>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript" src="validate.js"></script>
</body>
</html>>