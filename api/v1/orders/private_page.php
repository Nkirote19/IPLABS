<?php
	include_once 'C:\xampp\htdocs\IPLABS\DBConnector.php';

	if($_SERVER['REQUEST_METHOD'] !== 'POST'){
		header('HTTP/1.0 403 Forbidden');
		echo 'You are forbidden';
	}else{
		$api_key = null;
		$api_key = generateApiKey(64);
		header ('Content-type: application/json');
		echo generateResponse($api_key);
	}


	function generateApiKey($str_length){
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$bytes = openssl_random_pseudo_bytes(3*$str_length/4+1);

		$repl = unpack('C2', $bytes);

		$first = $chars[$repl[1]%62];
		$second = $chars[$repl[2]%62];
		return strtr(substr(base64_encode($bytes),0,$str_length), '+/', "$first$second");
	}

	function saveApiKey(){
		//WRITE THE F(x) THAT SAVES THE API FOR USER RETURNS TRUE IF SAVED, FALSE OTHERWISE
	}

	function fetchUserApiKey(){
		
	}

	function generateResponse($api_key){
		if(saveApiKey()){
			$res = ['success' => 1, 'message' => $api_key];
		}else{
			$res = ['success' => 0, 'message' => 'Something went wrong. Please generate the API key'];
		}
		return json_encode($res);
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Private_Page</title>

	
	<link rel="stylesheet" type="text/css" href="validate.css">	
	<script type="text/javascript" src="apikey.js"></script>

	<!-- CSS only -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.css.map">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-theme.min.css.map">
</head>
<body>
	<p align="right"><a href="logout.php">Logout</a></p>
	
	<hr>
	<h3>Here, we will create an API that will allow users/developer to order items from external systems.</h3>
	<hr>
	<h4>We now put this feature of allowing users to generate an API key. Click the button to generate the API key.</h4>

	<button class="btn btn-primary" id="api-key-btn">Generate API key</button><br><br>

	<strong>Your API key:</strong>(Note that if your API key is already in use by already running applications, generating a new key will stop the application from functioning)<br>
	<textarea cols="100" row="2" id="api_key" name="api_key" readonly><?php echo fetchUserApiKey();?></textarea>

	<h3>Service Description</h3>
	We have a service/API that allows external applications to order food and also pull all order status by using order id. Let's do it.

	<hr>

</body>
	<script type="text/javascript" src="validate.js"></script>
	

	<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
	<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
	<script src="jquery-3.1.1.min.js"></script>
	
	<!-- JS, Popper.js, and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
</html>