<?php
  function logIn($username, $password, $ip) {
    // When any user logs in, check for accounts that hasn't logged in for more than 30 minutes and remove them
    require_once('connect.php');
    //$deleteInactiveUserString = "DELETE FROM tbl_user WHERE user_last_login IS NULL AND TIMESTAMPDIFF(MINUTE,user_date,NOW()) > 30;";
    $deleteInactiveUserString = "UPDATE tbl_user SET user_suspended = 1 WHERE user_last_login IS NULL AND TIMESTAMPDIFF(MINUTE,user_date,NOW()) > 30;";
    $deleteInactiveUserQuery= mysqli_query($link, $deleteInactiveUserString);
        
     $username = mysqli_real_escape_string($link, $username);
     $password = mysqli_real_escape_string($link, $password);
     $loginString = "SELECT * FROM tbl_user WHERE user_name = '{$username}'";
     $user_set = mysqli_query($link, $loginString);
     //echo mysqli_num_rows($user_set);
     if(mysqli_num_rows($user_set)) {
       $founduser = mysqli_fetch_array($user_set, MYSQLI_ASSOC);
       $id = $founduser['user_id'];
       // Check if the user is locked out    
       if($founduser['user_failed_login_attempts'] >= 3) {
         $message = 'Your account has been suspended because of too many failed login attempts.';
          return $message;
       } else if($founduser['user_suspended'] >= 1) {
         $message = 'Your account has been suspended because you didn\'t login for more than 30 minutes after creating your account.';
          return $message;
       } else {
           // Check if user password matches password field
           if($founduser['user_pass'] == $password) {
             $_SESSION['user_id'] = $id;
             $_SESSION['user_name'] = $founduser['user_fname'];
             $_SESSION['user_last_login'] = $founduser['user_last_login'];
             if(mysqli_query($link, $loginString)) {
               // Update IP
           $updateIp = "UPDATE tbl_user SET user_ip='{$ip}' WHERE user_id={$id}";
           $updateIpQuery = mysqli_query($link, $updateIp);
           // Update Last Login
           $updateLastLogin = "UPDATE tbl_user SET user_last_login = NOW() WHERE user_id = {$id}";
           $updateLastLoginQuery = mysqli_query($link, $updateLastLogin);
           // Set failed attempts back to 0          
                 $resetFailedAttempts = "UPDATE tbl_user SET user_failed_login_attempts = 0 WHERE user_id = {$id}";
                 $resetFailedAttemptsQuery = mysqli_query($link, $resetFailedAttempts);
             }
             redirect_to('admin_index.php');
           } else { // Invalid password
             $message = 'You have entered an invalid username or password.';
             // Increment failed login attempts
             $incrementFail = "UPDATE tbl_user SET user_failed_login_attempts = user_failed_login_attempts + 1 WHERE user_id = {$id}";
             $runIncrement = mysqli_query($link, $incrementFail);
             return $message;
         }
       }
     } else { // User does not exist.
         $message = 'Username does not exist.';
        return $message;
     }
    mysqli_close($link);
  }
?>