<?php
  session_start();
  #database/config.ini access
  $config = parse_ini_file('../../../config.ini');
  $user_logged_in_email = $_SESSION['email'];
  $connect = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);

  $work_hours = $_POST['work_hours'];

  $sql="UPDATE student SET work_hours = '$work_hours' WHERE username = '".$_SESSION["email"]."'";
  $connect->query($sql);

  echo "<script>alert('Work hours has been successfully set.');
    window.location.replace('../profile.php');
    </script>";

?>
