<?php
  session_start();

  #database/config.ini access
  $config = parse_ini_file('../../../config.ini');
  $user_logged_in_email = $_SESSION['email'];
  $connect = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);

  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];

  $sql="UPDATE student SET first_name = '$first_name', last_name = '$last_name' WHERE username = '".$_SESSION["email"]."'";
  $connect->query($sql);

  echo "<html><body><script>alert('Successfully updated name fields.'); window.location.replace('../profile.php');</script></body></html>";
?>
