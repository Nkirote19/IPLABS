<?php 
   include_once "user.php";
   include_once "DBConnector.php";
   include_once "FileUploader.php";

   //Activate Database instance
   $con = new DBConnector();

   //Check for button click
   if(isset($_POST['btn-save'])){
      $first_name = $_POST['first_name'];
      $last_name  = $_POST['last_name'];
      $city       = $_POST['city_name'];
      $pass       = $_POST['password'];
      $uname       = $_POST['username'];

      $utc_timestamp = $_POST['utc_timestamp'];
      $offset = $_POST['time_zone_offset'];
      //Initialize session to set as temporary username
      $_SESSION['username'] = $uname;
      
      //Image file parameters
      $file_name = $_FILES['fileToUpload']['name'];
      $file_size = $_FILES['fileToUpload']['size'];
      $final_file_name = $_FILES['fileToUpload']['tmp_name'];
      $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));


      //Create User class instance
      $user = new User($first_name, $last_name, $city, $uname, $pass);

      //Pass timezone information to database
      $user->setUtcTimestamp($utc_timestamp);
      $user->setTimezoneOffset($offset);

      //FileUpload Instance
      $fileUpload = new FileUploader();

      //Setting the username
      $fileUpload->setUsername($uname);

      //Using setter methods
      $fileUpload->setOriginalName($file_name);
      $fileUpload->setFileType($file_type);
      $fileUpload->setFinalFileName($final_file_name);
      $fileUpload->setFileSize($file_size);

      //Check for valid criteria without Javascript
      if(!$user->validateForm())
      {
         $user->createFormErrorSessions();
         header("Location:lab1.php");
         die();
      }else{
		if ($fileUpload->fileWasSelected()) {
			// echo "SELECTED"."<br>";
			if ($fileUpload->fileTypeisCorrect()) {
				// echo "CORRECT TYPE"."<br>";
				if ($fileUpload->fileSizeIsCorrect()) {
					// echo "CORRECT SIZE"."<br>";

					if (!($fileUpload->fileAlreadyExists())) {
						// echo "FILE DOESNT EXIST"."<br>";
				    $user->save();
					 $fileUpload->uploadFile() ;

					}else{
						echo "FILE EXISTS"."<br>";
					}
				}else{
					echo "PICK A SMALLER SIZE"."<br>";
				}

			}else{
				echo "INCORRECT TYPE"."<br>";
			}

		}else{echo "NO FILE DETECTED"."<br>";}
	}
   $con->closeDatabase();
   }

?>

<html>
   <head>
    <meta charset="utf-8">
        <title>HomePage</title>
        <script type="text/javascript" src="validate.js"></script>
        <link rel="stylesheet" type="text/css" href="validate.css">
        <script src= "https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script> 
        <script type="text/javascript" src="timezone.js"></script>
        <meta name="description" content="Page Title">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, user-scalable=no, minimal-ui">
        <!-- Call App Mode on ios devices -->
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <!-- Remove Tap Highlight on Windows Phone IE -->
        <meta name="msapplication-tap-highlight" content="no">
        <!-- base css -->
        <link id="vendorsbundle" rel="stylesheet" media="screen, print" href="css/vendors.bundle.css">
        <link id="appbundle" rel="stylesheet" media="screen, print" href="css/app.bundle.css">
        <link id="mytheme" rel="stylesheet" media="screen, print" href="#">
        <link id="myskin" rel="stylesheet" media="screen, print" href="css/skins/skin-master.css">
        <link media="screen, print" href="css/fa-regular.css" rel="stylesheet">
        <link media="screen, print" href="css/fa-solid.css" rel="stylesheet">
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">

   </head>

   <body>
     <main id="js-page-content" role="main" class="page-content">
        <div class="col-xl-6" style="margin-top: 5%!important;">
          <!-- <div id="panel-1" class="panel" style="margin-right: 2%; margin-top: 4%!important;"> -->
          <div id="panel-1" class="panel" >
            <div class="panel-hdr"style="background-color: #826bb0;">
              <h2 style="color: white;">ADD <span class="fw-300"><i>New User</i></span></h2>
            </div>

            <div class="panel-container show">
              <div class="panel-content">
                   <form method="post" name="user_details" id="user_details" onsubmit="return validateForm()" enctype="multipart/form-data" action="<?=$_SERVER['PHP_SELF'] ?>">

                  <div id="form-errors">
                        <?php 
                        
                           session_start();
                             if(!empty($_SESSION['form_errors'])){
                              echo " ". $_SESSION['form_errors'] ."<br>";
                              unset($_SESSION['form_errors']);
                           }

                            if(!empty($_SESSION['exists'])){
                              echo " ". $_SESSION['exists'];
                              unset($_SESSION['exists']);
                           }
                           
                        ?>
                  </div>
                  <div class="row">                 
                    <div class="form-group col-4">
                      <section >
                        <label class="form-label" for="first_name">First Name</label>
                          <div class="input-group flex-nowrap">
                            <input id="first_name" name="first_name" type="text" class="form-control"aria-label="first_name" aria-describedby="addon-wrapping-right">
                            <div class="input-group-append">
                              <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                            </div>
                          </div>
                      </section>
                    </div>

                    <div class="form-group col-4">
                      <section >
                        <label class="form-label" for="last_name">Last Name</label>
                          <div class="input-group flex-nowrap">
                            <input id="last_name" name="last_name" type="text" class="form-control"aria-label="last_name" aria-describedby="addon-wrapping-right">
                            <div class="input-group-append">
                              <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                            </div>
                          </div>
                      </section>
                    </div>

                    <div class="form-group col-4">
                      <section >
                        <label class="form-label" for="city_name">City</label>
                          <div class="input-group flex-nowrap">
                            <input id="city_name" name="city_name" type="text" class="form-control"aria-label="city_name" aria-describedby="addon-wrapping-right">
                            <div class="input-group-append">
                              <span class="input-group-text"><i class="fas fa-map-marked-alt"></i></span>
                            </div>
                          </div>
                      </section>
                    </div>

                    <div class="form-group col-4">
                      <section >
                        <label class="form-label" for="uname">UserName</label>
                          <div class="input-group flex-nowrap">
                            <input id="uname" name="username" type="text" class="form-control"aria-label="uname" aria-describedby="addon-wrapping-right">
                            <div class="input-group-append">
                              <span class="input-group-text"><i class="fas fa-user-alt"></i></span>
                            </div>
                          </div>
                      </section>
                    </div>

                    <div class="form-group col-4">
                      <section >
                        <label class="form-label" for="password">Password</label>
                          <div class="input-group flex-nowrap">
                            <input id="password" name="password" type="password" class="form-control"aria-label="password" aria-describedby="addon-wrapping-right">
                            <div class="input-group-append">
                              <span class="input-group-text"><i class="fas fa-lock-alt"></i></span>
                            </div>
                          </div>
                      </section>
                    </div>

                     <div class="form-group col-4">
                      <section >
                        <label class="form-label" for="fileToUpload">Profile Image</label>
                          <div class="input-group flex-nowrap">
                            <input id="fileToUpload" name="fileToUpload" type="file"aria-label="fileToUpload" aria-describedby="addon-wrapping-right">
                          </div>
                      </section>
                    </div>

                  </div>
                  <div class="card-footer text-muted">                                     
                    <div style="text-align: right;">
                      <button id="submit" type="submit" name="btn-save" class="btn btn-primary "><i class="fas fa-user-plus"></i></i> SAVE</button>
                    </div>
                  </div>

          <table align="center">
             <tr><td></td>


             
             <!-- Added Form Inputs -->
             <tr>
                 <td> <input type="hidden" name="utc_timestamp" id="utc_timestamp" value=""> </td> 
             </tr>

             <tr>
                     <td> <input type="hidden" name="time_zone_offset" id="time_zone_offset" value=""> </td>
             </tr>
            
            <!---  End of Added Form inputs-->

             <tr>
                  <td><a href="login.php">Login</a></td>
             </tr>
          </table>
       </form>
              </div>
            </div>
          </div>
        </div>


       

       <p>Results from the database:</p>
      <?php 
      
         $user_disp= User::create();
         $user_disp->readAll();
      
      ?>

</main>
   </body>
 <script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
</html>