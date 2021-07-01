<?php  
session_start();
$user_logged_in_email = $_SESSION['email'];
#database/config.ini access
$config = parse_ini_file('../config.ini');
$connect = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);
$sql = "SELECT username FROM student WHERE username = '$user_logged_in_email'";
$result = $connect->query($sql);

$row = $result->fetch_assoc();
// fetch user from database here using $user_logged_in_email
// then show the data in the form first



?>

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
            <h1 class="m-0">Name and Email</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Change Name and Email</li>
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
      	<div class="card-body">
          <div class="tab-pane active" id="settings">
            <form class="form-horizontal" method="POST" action="handlers/change_email_handler.php">
            
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label><?php echo  $row["username"]?>
                <div class="col-sm-10">
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="email" name="email" class="form-control" placeholder="Email">
                </div>
              </div>
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <div class="col mb-2">
                  <button type="submit" class="btn btn-danger">Submit</button> <a href="profile.php" class="btn btn-danger">Back</a>
                 
                </div>
              </div>
            </form>
          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
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