<?php
	include_once 'DBConnector.php';
	include_once 'user.php';
	include_once 'fileUploader.php';

	$conn = new DBConnector; 

	if (isset($_POST['btn-save'])){
		$first_name = $_POST['first_name'];
		$last_name = $_POST['last_name'];
		$city = $_POST['city_name'];
		$username=$_POST['username'];
		$password=$_POST['password'];

		$image = $_FILES['fileToUpload']['name'];
		//$image_name  = $_FILES['fileToUpload']['tmp_name'];
		$tmp_name  = $_FILES['fileToUpload']['tmp_name'];

		$file_original_name = basename($_FILES['fileToUpload']['name']);
		$file_type = strtolower(pathinfo($file_original_name,PATHINFO_EXTENSION));
		$file_size = $_FILES['fileToUpload']['size'];
		$tmp_name = $_FILES["fileToUpload"]["tmp_name"];

		$utc_timestamp = $_POST['utc_timestamp'];
		$offset = $_POST['time_zone_offset'];

		$user = new User($first_name,$last_name,$city,$username,$password,$image,$utc_timestamp,$offset);

		//$uploader = new FileUploader;
		//$uploader = new FileUploader($file_original_name,$file_type,$file_size,$image);
		$uploader = new FileUploader($file_original_name,$file_type,$file_size,$tmp_name,$image);

		if(!$user->valiteForm()){
			$user->createFormErrorSessions();
			header("Refresh:0");
			die();
		}

		$file_upload_response = $uploader->uploadFile($tmp_name,$image);

		if (!$user->isUserExist()){
			$res = $user -> save();

			if ($res){
				echo "Save operation was successful";
			}else{
				echo "An error occurred!";
			}
		}
			else{
				echo "The username already exists";
			}
		
	}
	/*$check = $uploader->moveFile();
		if($check == "")
		{
			$res = $user->save();
			$username = $user->getUsername();
			$file_upload_response = $uploader->uploadFile($conn,$username);
			if($res && $file_upload_response)
			{
				echo "Save operation was successful";
			}
		}
		else
		{
			echo $check;
		}
	}*/
?>

<html>
	<head>
		<title>New User</title>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	    <link rel="stylesheet" type="text/css" href="validate.css">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	</head>
	
	<body style="background-image:url('bg.png');background-size: cover;">
		<div class="row">
			<div class="col s12 m11"> 
				<div class="card" style="margin-left:10%!important;margin-top:10%!important;">			
			
		<form enctype="multipart/form-data" method="post" name="user_details" id="user_details" onsubmit="return validateForm()" action="<?=$_SERVER['PHP_SELF']?>">
			<a class="waves-effect waves-light btn-small" href="Homepage.php"><i class="material-icons left">navigate_before</i></a>
			<p class="card-title center"><b>User's Details Form</b></p>
			<table align="center"style="width:95%!important;">
				<tr>
					<td>
						<div id="form_errors">
							<?php
								session_start();
								if(!empty($_SESSION['form_errors'])){
									echo " " . $_SESSION['form_errors'];
									unset($_SESSION['form_errors']);
								}
							?>
						</div>
					</td>
				</tr>

				<tr>
					<td><i class="material-icons left">person</i>First Name:</td> <td><input type="text" name="first_name" required placeholder="First Name"/></td>
					<td><i class="material-icons left">person</i>Last Name:</td> <td><input type="text" name="last_name" placeholder="Last Name"/></td>
					<td><i class="material-icons left">add_location</i>City Name:</td> <td><input type="text" name="city_name" placeholder="City"/></td>
				</tr>

				<tr>
					<td><i class="material-icons left">assignment_ind</i>Username:</td> <td><input type="text" name="username" placeholder="Username"/></td>
					<td><i class="material-icons left">https</i>Password:</td> <td><input type="password" name="password" placeholder="Password"/></td>					
					<td>Profile image:</td><td><input type="file" name="fileToUpload" id="fileToUpload" /></td>
				</tr>	

				<tr>
					<td ><button class="waves-effect waves-light btn" type="submit" name="btn-save"><i class="material-icons left">person_add</i><strong>SAVE</strong></button></td>

					<input type="hidden" name="utc_timestamp" id="utc_timestamp" value=""/>
					<input type="hidden" name="time_zone_offset" id="time_zone_offset" value=""/>

					<td class="card-action"><a href = "login.php">LogIn</td>
				</tr>
			</table>
		</form>
				</div>
			</div>
		</div>

		<script type="text/javascript" src="validate.js"></script>
		<script type="text/javascript" src="js/materialize.min.js"></script>

		<!--include jquery here. cnd network is used-->
		<script src= "https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<!--your new js file comes after including your jquery-->
		<script type="text/javascript" src="timezone.js"></script>

	</body>
</html>