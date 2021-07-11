<?php
  session_start();

  if(isset($_SESSION["email"])) {
    die("<html><body><script>alert('You\'re already logged in. Redirecting you to dashboard.');
      window.location.replace('student/dashboard.php');</script></body></html>");
  }

  if(isset($_POST['login'])) {
    #database/config.ini access
    $config = parse_ini_file('../config.ini');
    $connect = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);

  	$email=$_POST['email'];
  	$password=$_POST['password'];

  	$sql="SELECT * FROM student WHERE username='$email' AND password='$password'";
  	$results=$connect->query($sql);
  	$final=$results->fetch_assoc();

  	if ($email==$final['username'] AND $password==$final['password']) {
      $_SESSION['email'] = $final['username'];
      $results->close();
      $connect->close();
      die("<script>alert('Successfully logged in.');
        window.location.href='student/dashboard.php'</script>");
  	} else{
      $results->close();
      $connect->close();
      die("<script>alert('Credentials are invalid. Please make sure that your credentials are correct. ');
      window.location.href='login.php'</script>");
  	}
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SYMPU Todo List | Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!--Google Font: Merriweather -->

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="student/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
   <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="student/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="student/dist/css/adminlte.min.css">

  <link rel="stylesheet" href="dist/style.css">

  <title>Login | SYMPU-To-Do-List</title>

  <style>
    #header-branding{
      border-bottom:  none;
        border-bottom-width: initial;
        border-bottom-style: none;
        border-bottom-color: initial;
      margin:  0 -9999rem;
      padding:  0.25rem 9999rem;
      background:  #0677ba;
    }

    #login-container .login-content {
    border:  1px solid;
    padding: 19px 30px 25px;
    background: #f8f8ff;
    margin-bottom: 3px;
    animation:  shadow-move 5s infinite;
    }

    @keyframes shadow-move{
      25% {box-shadow: 5px 10px #888888;}
      75% {box-shadow: 5px 10px #000000;}
    }


    .statusmsg{
    font-size: 12px;
    padding: 3px;
    background: #EDEDED;
    border: 1px solid #DFDFDF;
    }
  </style>

</head>

<body>
  <!-- TODO: [Design] create a header for the logo -->
  <!-- Header Navbar -->
  <div class="ClsTHeader">
    <div class="ClsContainer">
      <div class="ClsNavbar">
        <div class="ClsLogo">

          <!-- Website Logo -->
          <img src="images/sympu-todolist.png" width="225px">
        </div>
        <nav>
          <ul id="MenuButtons">
            <li><a href="register.php" class="BtnSignUp">Sign Up</a></li>
            <li><a href="login.php" class="BtnLogin">Login</a></li>
          </ul>
        </nav>

        <p class="BtnMenu" onclick="MenuToggle()">Menu</p>
      </div>
    </div>
  </div>

  <!--Login Col-->
  <div class="row">

    <div class="col-sm-4">
    </div>
    <!-- Login Form -->
    <div class="col-sm-4">
      <!--- temporary block pusher-->
      <br><br><br><br>

      <!--login block-->
      <div id="login-container">
        <div class="box box-info login-content">
          <div class="box-header with-border">
            <h3 class="box-title">Welcome to SYMPU-todolist!</h3>
          </div>
          <!-- /.box-header -->

          <!-- form start -->
          <br>
          <form class="form-horizontal" action="" method="POST">
            <div class="box-body">
              <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                <div class="col-sm-10">
                  <input type="email" class="form-control" id="inputEmail3" placeholder="Email" name="email">
                </div>
              </div>

              <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Password</label>

                <div class="col-sm-10">
                  <input type="password" class="form-control" id="inputPassword3" placeholder="Password" name="password">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                </div>
              </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
              <button type="submit" class="btn btn-info pull-right" name="login">Login</button>
            </div>
            <span><a href="register.php">No account yet? Register now!</a></span>
          </form>
        </div>
      </div>

      <!--Free Space-->
      <div class="col-sm-4">
      </div>

    </div>
</body>

</html>
