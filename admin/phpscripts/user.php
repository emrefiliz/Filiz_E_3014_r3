<?php
function createUser($fname, $username, $email,  $password, $lvllist){
    include('connect.php');
    $createUserString = "INSERT INTO tbl_user (user_fname, user_name, user_pass, user_email, user_date, user_ip, user_level) VALUES ('${fname}', '${username}', '${password}', '${email}', NOW(), 'no', ${lvllist})";
    $createUserQuery= mysqli_query($link, $createUserString);
    if($createUserQuery){
        $message = "User creation successful.";
        return $message;
    }else{
        $message = "User creation failed.";
        return $message;
    }
    mysqli_close($link);
}

function editUser($id, $fname, $username, $email, $password) {
    include('connect.php');
    $editUserString = "UPDATE tbl_user SET user_fname = '{$fname}', user_name = '{$username}', user_email = '{$email}', user_pass = '{$password}' WHERE user_id = {$id}";
    $editUserQuery= mysqli_query($link, $editUserString);
    if($editUserQuery){
        $message = "User details are updated.";
        return $message;
    }else{
        $message = "User update failed.";
        return $message;
    }
    mysqli_close($link);
}

function deleteUser($id) {
    include('connect.php');
    $deleteString = "DELETE FROM tbl_user WHERE user_id = {$id}";
    $deleteQuery = mysqli_query($link, $deleteString);    
    if($deleteQuery) {
        if($_SESSION['user_id'] == $id){ // If the logged in user is deleted, redirect to login page            
            redirect_to('../admin_login.php');
        }else{
            redirect_to('../admin_deleteuser.php');
        }        
    }else{
        $message = 'Delete operation failed.';
        return $message;
    }
    mysqli_close($link);
}

function generatePassword($length = 8) {
    // start with a blank password
    $password = "";

    // define possible characters - any character in this string can be
    // picked for use in the password, so if you want to put vowels back in
    // or add special characters such as exclamation marks, this is where
    // you should do it
    $possible = "012346789abcdfghjkmnpqrtvwxyzABCDFGHJKLMNPQRTVWXYZ";

    // we refer to the length of $possible a few times, so let's grab it now
    $maxlength = strlen($possible);

    // check for length overflow and truncate if necessary
    if ($length > $maxlength) {
        $length = $maxlength;
    }

    // set up a counter for how many characters are in the password so far
    $i = 0;

    // add random characters to $password until $length is reached
    while ($i < $length) {
        // pick a random character from the possible ones
        $char = substr($possible, mt_rand(0, $maxlength-1), 1);
        // have we already used this character in $password?
        if (!strstr($password, $char)) {
            // no, so it's OK to add it onto the end of whatever we've already got...
            $password .= $char;
            // ... and increase the counter by one
            $i++;
        }
    }
    // done!
    return $password;
}

function encrypt($plaintext, $password){
    $td = mcrypt_module_open('cast-256', '', 'ecb', '');
    $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    mcrypt_generic_init($td, $password, $iv);
    $encrypted_data = mcrypt_generic($td, $plaintext);
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
    $encoded_64 = base64_encode($encrypted_data);
    return trim($encoded_64);
}

function decrypt($crypttext, $password){
    $decoded_64=base64_decode($crypttext);
    $td = mcrypt_module_open('cast-256', '', 'ecb', '');
    $iv = mcrypt_create_iv (mcrypt_enc_get_iv_size($td), MCRYPT_RAND);
    mcrypt_generic_init($td, $password, $iv);
    $decrypted_data = mdecrypt_generic($td, $decoded_64);
    mcrypt_generic_deinit($td);
    mcrypt_module_close($td);
    return trim($decrypted_data);
}
?>