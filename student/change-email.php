<?php
  session_start();
  $user_logged_in_email = $_SESSION['email'];
  #database/config.ini access
  $config = parse_ini_file('../../config.ini');
  $connect = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);
  $sql = "SELECT username FROM student WHERE username = '$user_logged_in_email'";
  $result = $connect->query($sql);

  $student_row = $result -> fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> SYMPU Todo List | Change Email</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Theme style -->
  <link rel="stylesheet" href="./dist/css/adminlte.min.css">
</head>

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
              <h1 class="m-0">Change Email Address</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Change Email</li>
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
              <form class="form-horizontal" method="POST" action="actions/change-email.php">

                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Current Email:</label>
                  <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" placeholder="Email" readonly value="<?= $student_row["username"] ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Change Email To:</label>
                  <div class="col-sm-10">
                    <input type="email" name="email" class="form-control" placeholder="Email" required>
                  </div>
                </div>
                <div class="form-group row">
                  <div class="offset-sm-2 col-sm-10">
                    <div class="btn-group">
                      <button type="submit" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                        Submit
                      </button>
                      <a href="profile.php" class="btn btn-warning">
                        <i class="fas fa-reply"></i>
                        Back
                      </a>
                    </div>
                  </div>
                </div>
              </form>
            </div>
            <!-- /.tab-pane -->
          </div>
          <!-- /.tab-content -->
        </div><!-- /.container-fluid -->

      </div><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?php include ('partials/footer.php'); ?>
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
