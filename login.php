<?php 

  include_once  'DBConnector.php';
  include_once  'user.php';

  $con = new DBConnector;
  if(isset($_POST['btn-login'])){
   $username = $_POST['username'];
   $password = $_POST['password'];

   $instance = User::create();
   $instance->setPassword($password);
   $instance->setUsername($username);

   if($instance->isPasswordCorrect()){
      $instance->login();

      $con->closeDatabase();

      $instance->createUserSession();
   }else{
     $con->closeDatabase();
     header("Location:login.php");
   }

  }
?>

<html>
   <head>
    <meta charset="utf-8">
     <title>Login Page</title>
      <script type="text/javascript" src="validate.js"></script>

      <link rel="stylesheet" type="text/css" href="validate.js">
          <meta name="description" content="Login">
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
        <!-- Place favicon.ico in the root directory -->
        <link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
        <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
        <link rel="stylesheet" media="screen, print" href="css/page-login-alt.css">
        <link media="screen, print" href="css/fa-regular.css" rel="stylesheet">
        <link media="screen, print" href="css/fa-solid.css" rel="stylesheet">
   </head>

   <body>
    <div class="blankpage-form-field">
      <div class="page-logo m-0 w-100 align-items-center justify-content-center rounded border-bottom-left-radius-0 border-bottom-right-radius-0 px-4">
        <img src="img/logo.png" alt="SmartAdmin WebApp" aria-roledescription="logo">
        <span class="page-logo-text mr-1">User's Log In</span>
        <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
      </div>

      <div class="card p-4 border-top-left-radius-0 border-top-right-radius-0">
        <form method="post" name="login" id="login" action="<?=$_SERVER['PHP_SELF'] ?>">
          <table align="center">
            <tr >
              <td><input class="form-control" type="text" name="username" placeholder="Username" required></td>
            </tr><br>
             <tr>
              <td><input class="form-control" type="password" name="password" placeholder="Password" required></td>
            </tr>

             <tr>
              <td><button type="submit" name="btn-login" class="btn btn-primary"> <i class="fas fa-arrow-alt-to-right p-1"></i><strong>LOGIN</strong></button></td>
            </tr>
          </table>
        </form>
      </div>
    </div>

    <video poster="img/backgrounds/clouds.png" id="bgvid" playsinline autoplay muted loop>
      <source src="media/video/cc.webm" type="video/webm">
      <source src="media/video/cc.mp4" type="video/mp4">
    </video>
   </body>

<script src="js/vendors.bundle.js"></script>
        <script src="js/app.bundle.js"></script>
</html>