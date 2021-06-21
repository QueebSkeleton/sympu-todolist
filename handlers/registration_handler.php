<?php

#database/config.ini access
$config = parse_ini_file('../config.ini');
$connect = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);


$Fname = $_POST['first_name']; 
$Lname = $_POST['last_name']; 
$email = $_POST['email'];              
$password=$_POST['password'];
              
 
  $sql="INSERT INTO student (username,password,first_name,last_name) VALUES ('$email', '$password', '$Fname','$Lname')";
  $connect->query($sql);

  echo "<script>alert('Registration success! Please log-in using your saved credentials. Redirecting you back now.');
    window.location.href= 'user_login.php';
    </script>";
             
?>