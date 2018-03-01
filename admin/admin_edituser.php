<?php
  require_once('phpscripts/config.php');
  // confirm_logged_in();
  $id = $_SESSION['user_id'];
  $ip = $_SERVER['REMOTE_ADDR'];
  $tbl = 'tbl_user';
  $col = 'user_id';
  $old = getSingle($tbl, $col, $id);
  $info = mysqli_fetch_array($old);
  
  if(isset($_POST['submit'])) {

    $fname = trim($_POST['fname']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);    
    $result = editUser($id, $fname, $username, $email, $password);
  
    if($result === 'success') {
      // update user login information
      updateLogin($id, $ip);
      redirect_to('admin_index.php');
    }

    $message = $result;
  }
?>
<html class="no-js">
  <head>
    <meta charset="UTF-8">
    <title>Edit User Details</title>
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
            <h4>Edit User</h4>
            <a href="phpscripts/caller.php?caller_id=logout" class="button hollow float-right">Sign Out</a>             
          </div>
          <div class="card-section">
            <form action="admin_edituser.php" method="post">
              <div class="grid-container">
                <div class="grid-x grid-padding-x">
                  <div class="medium-6 cell">
                    <label>First Name
                      <div class="input-group">
                        <span class="input-group-label"><i style="color:white" class="fa fa-id-card fa-lg"></i></span>
                        <input class="input-group-field" type="text" name="fname" value="<?php echo $info['user_fname'] ?>" required>                        
                      </div>                      
                    </label>                    
                  </div>
                  <div class="medium-6 cell">
                    <label>E-mail
                      <div class="input-group">
                        <span class="input-group-label"><i style="color:white" class="fa fa-envelope fa-lg"></i></span>
                        <input class="input-group-field" type="email" name="email" value="<?php echo $info['user_email'] ?>" required>
                      </div>
                    </label>
                  </div>                  
                  <div class="medium-6 cell">
                    <label>Username
                      <div class="input-group">
                        <span class="input-group-label"><i style="color:white" class="fa fa-user fa-lg"></i></span>
                        <input class="input-group-field" type="text" name="username" value="<?php echo $info['user_name'] ?>" required>
                      </div>
                    </label>
                  </div>
                  <div class="medium-6 cell">
                    <label>Password
                      <div class="input-group">
                        <span class="input-group-label"><i style="color:white" class="fa fa-key"></i></span>
                        <input class="input-group-field" id="passwordField" type="password" name="password" value="" required>
                      </div>
                      <input id="passwordToggle" type="checkbox" onclick="togglePassword();"><label for="passwordToggle">Show Password</label>
                    </label>
                  </div>                                    
                  <div class="medium-6 cell">
                    <a href="admin_index.php" class="button large">Go Back</a>
                  </div>
                  <div class="medium-6 cell">
                    <input type="submit" class="button large float-right" name="submit" value="Save">
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
  <script type="text/javascript">
  function togglePassword() {
    // Reference the password input field
    var passwordField = document.getElementById("passwordField");
    // Switch between types 'text' and 'password' to toggle visibility of password
    if (passwordField.type === "password") {
      passwordField.type = "text";
    }else{
      passwordField.type = "password";
    }
  }
  </script>
</html>