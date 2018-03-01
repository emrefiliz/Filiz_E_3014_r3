<?php
  require_once('phpscripts/config.php');
  // confirm_logged_in();
  if(isset($_POST['submit'])){
    $fname = trim($_POST['fname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $lvllist = $_POST['lvllist'];

    if(empty($lvllist)){
      $message = "Please select the user level.";
    }else {
      $password = generatePassword();
      $crypted_password = encrypt("YOUR_PASSWORD", $password);
      $result = createUser($fname, $username, $email,  $crypted_password, $lvllist);

      if($result = "User creation successful.") {
        $to = $email;
        $from = "admin@test.com";
        $url = "http://localhost/admin/admin_login.php";
        $headers  = "From: " . $from;
        $subject  = "Welcome, " . $fname;
        $message  = $fname.",\n\nYour account details are as below;\n\nUsername: ".$username."\nPassword: ".$password."\n\nPlease visit ".$url." to login.";
        //mail($to, $subject, $message , $headers);
      }
      $message = $result;
    }
  }
?>
<html class="no-js">
  <head>
    <meta charset="UTF-8">
    <title>Create User Page</title>
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
            <h4>Create User</h4>
            <a href="phpscripts/caller.php?caller_id=logout" class="sign-out button hollow float-right">Sign Out</a>
          </div>
          <div class="card-section">
            <form action="admin_createuser.php" method="post">
              <div class="grid-container">
                <div class="grid-x grid-padding-x">
                  <div class="medium-6 cell">
                    <label>First Name
                      <div class="input-group">
                        <span class="input-group-label"><i style="color:white" class="fa fa-id-card fa-lg"></i></span>
                        <input class="input-group-field" type="text" name="fname" value="" required>
                      </div>
                    </label>
                  </div>
                  <div class="medium-6 cell">
                    <label>Username
                    <div class="input-group">
                      <span class="input-group-label"><i style="color:white" class="fa fa-user fa-lg"></i></span>
                      <input class="input-group-field" type="text" name="username" value="" required>
                    </div>
                    </label>
                  </div>
                  <div class="medium-6 cell">
                    <label>E-mail
                      <div class="input-group">
                        <span class="input-group-label"><i style="color:white" class="fa fa-envelope fa-lg"></i></span>
                        <input class="input-group-field" type="email" name="email" value="" required>
                      </div>
                    </label>
                  </div>
                  <div class="medium-6 cell">
                    <label>Select User Level
                      <select class="select" name="lvllist" required>
                        <option value="1">Web Master</option>
                        <option value="2">Web Admin</option>
                      </select>
                    </label>
                  </div>
                  <div class="medium-6 cell">
                    <a href="admin_index.php" class="button large">Go Back</a>
                  </div>
                  <div class="medium-6 cell">
                    <input type="submit" class="button large float-right" name="submit" value="Create User">
                  </div>
                  <div class="medium-12 cell">
                    <p class="help-text"><?php if(!empty($message)){ echo $message;} ?></p>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </body>
  <!-- Compressed JQuery & Foundation JavaScript -->
  <script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js"></script>
</html>