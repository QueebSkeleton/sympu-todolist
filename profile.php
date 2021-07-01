<?php  
session_start();
$user_logged_in_email = $_SESSION['email'];
#database/config.ini access
$config = parse_ini_file('../config.ini');
$connect = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);
$sql = "SELECT first_name, last_name, username, work_hours FROM student WHERE username = '$user_logged_in_email'";
$result = $connect->query($sql);

$row = $result->fetch_assoc();
//$row["username"]." ".$row["first_name"]." ".$row["last_name"];

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
            <h1 class="m-0">Profile</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Profile</li>
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
        <div class="row">
          <div class="col-md-3">
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <i class="fas fa-user-tie fa-5x"></i>
                </div>
              </div>
            </div>
          </div>
          <div class="col-md-9">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">
                  Personal information
                </h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <div class="card-body">

                <!-- Name Field -->
                <div class="row mb-2">
                  <div class="col-md-2 "><label for="name">Name:</label></div>
                  <div class="col-md-8">
                    <input type="text" readonly class="form-control" id="name" value="<?= $row['first_name'].' '.$row['last_name'] ?>">
                  </div>
                  <div class="col-md-2">
                    <a href="change_name.php" class="btn btn-primary">
                      <i class="fas fa-edit"></i>
                      Edit
                    </a>
                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-md-2 "><label for="name">Email:</label></div>
                  <div class="col-md-8">
                    <input type="text" readonly class="form-control" id="name" value="<?= $row['username'] ?>">
                  </div>
                  <div class="col-md-2">
                    <a href="change_email.php" class="btn btn-primary">
                      <i class="fas fa-edit"></i>
                      Edit
                    </a>
                  </div>
                </div>

                <div class="row mb-2">
                  <div class="col-md-2 "><label for="name">Name:</label></div>
                  <div class="col-md-8">
                    <input type="text" readonly class="form-control" id="name" value="<?= $row['first_name'].' '.$row['last_name'] ?>">
                  </div>
                  <div class="col-md-2">
                    <a href="change-name.php" class="btn btn-primary">
                      <i class="fas fa-edit"></i>
                      Edit
                    </a>
                  </div>
                </div>

              </div>         
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <a href="change_password.php" class="btn btn-primary">Change Password</a>
            </div>

          </div>
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
<?php
$connect -> close();
?>