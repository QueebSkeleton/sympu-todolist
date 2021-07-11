<?php
  session_start();
  $user_logged_in_email = $_SESSION['email'];
  #database/config.ini access
  $config = parse_ini_file('../../config.ini');
  $connect = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);
  $sql = "SELECT first_name, last_name FROM student WHERE username = '$user_logged_in_email'";
  $result = $connect->query($sql);
  $student_row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title> SYMPU Todo List | Change Name</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!--Google Font: Merriweather -->

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
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
              <h1 class="m-0">Change Name</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Change Name</li>
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
              <form class="form-horizontal" method="POST" action="actions/change-name.php">
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Current name:</label>
                  <div class="col-sm-10">
                    <input type="text" name="current_name" class='form-control' readonly value="<?php echo  $student_row["first_name"]." ".$student_row["last_name"]?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">First name</label>
                  <div class="col-sm-10">
                    <input type="text" name="first_name" class="form-control" placeholder="<?php echo $student_row["first_name"]?>">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Last name</label>
                  <div class="col-sm-10">
                    <input type="text" name="last_name" class="form-control" placeholder="<?php echo $student_row["last_name"]?>">
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
        </div>

      </div><!-- /.content -->
    </div><!-- /.content-wrapper -->

    <!-- Main Footer -->
    <?php include ('partials/footer.php'); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->
  </div><!-- /.-wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
</body>

</html>
