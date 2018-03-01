<?php
  require_once('phpscripts/config.php');
  $ip = $_SERVER['REMOTE_ADDR'];
  //echo $ip;
  if(isset($_POST['submit'])){
  //echo "Works";
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if($username !== "" && $password !== ""){
      $result = logIn($username, $password, $ip);
      $message = $result;
    }else{
      $message = "Please fill out the required fields.";
    }
  }
?>
<!doctype html>
<html class="no-js">
  <head>
    <meta charset="UTF-8">
    <title>Welcome to your admin panel login</title>
    <!-- Font & Icons -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
    <!-- Compressed CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css"/>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
  </head>
  <body>
    <div class="grid-x grid-margin-x">
      <div class="cell medium-4 large-offset-4" style="margin-top: 10%;">
        <div class="card" style="width: auto;">
          <div class="card-divider">
            <div class="medium-12 cell">
              <h3 class="text-center">Log In</h3>
            </div>
          </div>
          <div class="card-section">
            <div class="grid-container">
              <form action="admin_login.php" method="post">
                <div class="grid-x grid-padding-x">
                  <div class="medium-12 cell">
                    <h5>Username<small class="asterix">*</small></h5>
                    <div class="input-group">
                      <span class="input-group-label"><i style="color:white" class="fa fa-user"></i></span>
                      <input class="input-group-field" type="text" name="username">
                    </div>
                  </div>
                  <div class="medium-12 cell">
                    <h5>Password<small class="asterix">*</small></h5>
                    <div class="input-group">
                      <span class="input-group-label"><i style="color:white" class="fa fa-key"></i></span>
                      <input class="input-group-field" type="password" name="password">
                    </div>
                  </div>
                  <div class="medium-12 cell">
                    <p style="margin-top:1em"><p class="help-text" id="passwordHelpText"><?php if(!empty($message)){ echo $message;} ?></p><input type="submit" name="submit" class="button expanded" value="Log in"></input></p>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </body>
    <!-- Compressed JQuery & Foundation JavaScript -->
    <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js"></script>
  </html>