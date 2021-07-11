<?php
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SYMPU Todo List | Register</title>

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

  <style>
    #header-branding {
      border-bottom: none;
      border-bottom-width: initial;
      border-bottom-style: none;
      border-bottom-color: initial;
      margin: 0 -9999rem;
      padding: 0.25rem 9999rem;
      background: #0677ba;
    }

    #login-container .login-content {
      border: 1px solid;
      padding: 19px 30px 25px;
      background: #f8f8ff;
      margin-bottom: 3px;
      animation: shadow-move 5s infinite;
    }

    @keyframes shadow-move {
      25% {
        box-shadow: 5px 10px #888888;
      }

      75% {
        box-shadow: 5px 10px #000000;
      }
    }
    .statusmsg {
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
      <br><br>
      <!--login block-->
      <div id="login-container">
        <div class="box box-info login-content">

          <div class="box-header with-border">
            <h3 class="box-title">Welcome new user!</h3>
          </div>
          <!-- /.box-header -->

          <!-- form start -->
          <br>
          <form class="form-horizontal" action="actions/register-user.php" method="POST" name=>
            <div class="box-body">

              <div class="form-group">
                <label name="first_name" class="col-sm-4 control-label">First Name</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="first_name" placeholder="Your First Name" name="first_name">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-4 control-label">Last Name</label>

                <div class="col-sm-10">
                  <input type="text" class="form-control" id="last_name" placeholder="Your Last Name" name="last_name">
                </div>
              </div>

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
              <button type="submit" class="btn btn-info pull-right" name="login">Register</button>
            </div>
            <span><a href="login.php">Already have an account? Login here!</a></span>
          </form>

        </div>
      </div>

      <!--Free Space-->
      <div class="col-sm-4">
      </div>

    </div>
</body>

</html>
