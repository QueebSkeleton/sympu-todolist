<?php
  session_start();
  #database/config.ini access
  $config = parse_ini_file('../../../config.ini');
  $user_logged_in_email = $_SESSION['email'];
  $connect = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);

  $email = $_POST['email'];

  $sql="UPDATE student SET username = '$email' WHERE username = '".$_SESSION["email"]."'";
  $connect -> query($sql);
  $_SESSION['email']= $email;

  echo "<html><body><script>alert('Successfully updated email.'); window.location.replace('../profile.php');</script></body></html>";
?>
