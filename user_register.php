<title>Register | SYMPU-To-Do-List</title>

<?php
session_start();
include('partials/head.php');
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
            <form class="form-horizontal" action="handlers/registration_handler.php" method="POST" name=>
              <div class="box-body">

                <div class="form-group">
                  <label  name= "first_name" class="col-sm-4 control-label">First Name</label>

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
                  <button  type="submit" class="btn btn-info pull-right" name="login">Register</button>
              </div>
              <span><a href="user_login.php">Already have an account? Login here!</a></span>
            </form>

      </div>
    </div>
		
	<!--Free Space-->
	<div class="col-sm-4">
	</div>

</div>