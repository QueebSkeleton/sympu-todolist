<?php
session_start();
include('partials/head.php');

if(isset($_POST['login'])){
	
  #database/config.ini access
  $config = parse_ini_file('../config.ini');
  $connect = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);

	$email=$_POST['email'];
	$password=$_POST['password'];

	$sql="SELECT * FROM student WHERE username='$email' AND password='$password'";
	$results=$connect->query($sql);
	$final=$results->fetch_assoc();

  

	if ($email==$final['username'] AND $password==$final['password']){

    $_SESSION['email']=$final['username'];
    
		header('location: overview.php');
	}else{
    echo "<script>alert('Credentials are invalid. Please make sure that your credentials are correct. ');
    window.location.href='user_login.php'</script>";
		
	}

  $sql->close();
  $results->close();
  $final->close();


}


?>
<!-- TODO: [Design] create a header for the logo -->
<!-- Header --> 
<header id="header" class="clearfix">
  <div id="header-branding" class="container clearfix">
    <!--Insert Logo Here-->
    <a>Hi
      <span>SYMPU-todolist</span>
    </a>
  </div>
</header>

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
            <form class="form-horizontal" action="user_login.php"method="POST">
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
              <span><a href="user_register.php">No account yet? Register now!</a></span>
            </form>
      </div>
    </div>
		
	<!--Free Space-->
	<div class="col-sm-4">
	</div>

</div>