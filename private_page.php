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
<body style="background-image:url('bg.png');background-size: cover;">

<div class="row">
    <div class="col s12 m9">
      <div class="card"style="margin-left:40%!important;margin-top:20%!important;">
        <div class="card-content">
          <br><span class="card-title"><i class="material-icons right large">warning</i>This is a private page</span>
          <p>We want to protect it.</p>
        </div>
        <div class="card-action">
          <a href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript" src="validate.js"></script>
</body>
</html>