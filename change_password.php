<!DOCTYPE html>
<html lang="en">

<?php
  include("partials/head.php");
?>

<body class="hold-transition sidebar-mini">

<div class="wrapper">

   <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="dist/img/smile.png" alt="SYMPU-List Logo" height="100" width="100">
  </div>

  <?php include("partials/headnav.php"); ?>

  <?php include("partials/sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Change password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Change Password</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <!-- PLACE YOUR PAGE CONTENTS HERE -->
      <div class="container-fluid">
         <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal" method="POST" action="handlers/change_password_handler.php">
          <div class="card-body">

            <div class="form-row mb-4">
              <label class="col-sm-2 col-form-label">Current</label>
              <div class="col-sm-10">
                <input type="password" name="current_password" class="form-control">
              </div>
            </div>

            <div class="form-row mb-4">
              <label class="col-sm-2 col-form-label">New</label>
              <div class="col-sm-10">
                <input type="password" min='6' max='16' name="new_password" class="form-control">
              </div>
            </div>

            <div class="form-row mb-4">
              <label class="col-sm-2 col-form-label">Re-type new</label>
              <div class="col-sm-10">
                <input type="password" min='6' max='16' name="retype_new" class="form-control">
              </div>
            </div>



            <div class="form-group row">
              <div class="offset-sm-2 col-sm-10">
                <div class="col mb-2">
                  <div class="btn-group">
                    <button type="submit" class="btn btn-primary">Confirm</button><a href="profile.php" class="btn btn-danger">Back</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
        
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <?php
   include ('partials/footer.php');
  ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>