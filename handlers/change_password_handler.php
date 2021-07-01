<?php
session_start();
#database/config.ini access
$config = parse_ini_file('../../config.ini');
$user_logged_in_email = $_SESSION['email'];
$connect = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);
$sql = "SELECT password FROM student WHERE username = '$user_logged_in_email'";
$result = $connect->query($sql);
$row = $result->fetch_assoc();


$current_password = $_POST['current_password'];
$new_password = $_POST['new_password'];
$retype_new = $_POST['retype_new'];

//Checks if your current password is correct
if($current_password == $row['password']){

  //Checks if your new password matches with retype password
  if($new_password == $retype_new){

    //checks if your length is at least 6
    if(strlen($new_password) < 6 && strlen($retype_new) < 6){
      echo "<script>alert('Password should be at least 6 characters');
      window.location.replace('../change_password.php');
      </script>";
    }
    else{
      $sql="UPDATE student SET password = '$new_password' WHERE username = '".$_SESSION["email"]."'";
      $connect->query($sql);
      echo "<script>alert('Password updated successfully! Redirecting you back now');
      window.location.replace('../profile.php');
      </script>";
    }
  }
  else{
    echo "<script>alert('Password does not match');
    window.location.replace('../change_password.php');
    </script>";
  } 
}
else{
  echo "<script>alert('Incorrect Password');
  window.location.replace('../change_password.php');
  </script>";
}






?>