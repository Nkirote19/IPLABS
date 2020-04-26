<?php
	//we write the login codes here
	include_once 'DBConnector.php';
	include_once 'user.php';

	$conn = new DBConnector;

	if(isset($_POST['btn-login'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$instance = User::create();
		$instance -> setPassword($password);
		$instance -> setUsername($username);

		if($instance-> isPassWordCorrect()){
			$instance->login();

			$conn -> closeDatabase();
			$instance->createUserSession();
		}else{
			$conn->closeDatabase();
			header("Location:login.php");
		}
	}
?>
<html>
	<head>
		<title>LogIn_Page</title>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	    <link rel="stylesheet" type="text/css" href="validate.css">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>

	<body style="background-image:url('https://video-images.vice.com/articles/5d44c9622980b0000824a7e3/lede/1564789576071-GettyImages-949118068.jpeg?crop=1xw:0.8419xh;0xw,0.1581xh');background-size: cover;">
	<div class="row">
		<div class="col s12 m9"> 
			<div class="card" style="margin-left:40%!important;margin-top:10%!important;">	
				<form method="post" name="login" id="login"action="<?=$_SERVER['PHP_SELF']?>"><br>
					<p class="card-title center"><b>LogIn Page</b></p>
					<table align="center"style="width:80%!important;">
						<tr>
							<td><input type="text" name="username" placeholder="Username" required></td>
						</tr>

						<tr>
							<td><input type="password" name="password" placeholder="Password" required></td>
						</tr>

						<tr>
							<td ><button class="waves-effect waves-light btn" type="submit" name="btn-login"><i class="material-icons left">person_add</i><strong>LOGIN</strong></button></td>					
						</tr>
					</table>
				</form>
			</div>
		</div>
	</div>


		<script type="text/javascript" src="js/materialize.min.js"></script>
		<script type="text/javascript" src="validate.js"></script>
	</body>
</html>