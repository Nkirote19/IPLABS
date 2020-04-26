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
<body style="background-image:url('https://video-images.vice.com/articles/5d44c9622980b0000824a7e3/lede/1564789576071-GettyImages-949118068.jpeg?crop=1xw:0.8419xh;0xw,0.1581xh');background-size: cover;">
	<!--<p>This is a private page</p>
	<p>We want to protect it</p>
	<p><a href="logout.php">Logout</a></p>-->

<div class="row">
    <div class="col s12 m6">
      <div class="card">
        <div class="card-content white-text">
          <span class="card-title">This is a private page</span>
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
</html>>