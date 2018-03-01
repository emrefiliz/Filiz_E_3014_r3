<?php
  session_start ();
  function confirm_logged_in() {   
    if(!isset($_SESSION['user_id'])){
      redirect_to("../admin_login.php");
    }    

    // Redirect to edit user page on first login
    if($_SESSION['user_last_login'] == null){ 
      redirect_to('admin_edituser.php');      
    }
  }

  function logged_out(){
    session_destroy();
    redirect_to("../admin_login.php");
  }
?>