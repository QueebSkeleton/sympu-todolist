<?php
  session_start();
  $user_logged_in_email = $_SESSION['email'];
  #database/config.ini access
  $config = parse_ini_file('../../config.ini');
  $connect = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);
  $sql = "SELECT first_name, last_name, username, work_hours FROM student WHERE username = '$user_logged_in_email'";
  $result = $connect->query($sql);
  $student_row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> SYMPU Todo List | Profile</title>

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
                      <input type="text" readonly class="form-control" id="name" value="<?= $student_row['first_name'].' '.$student_row['last_name'] ?>">
                    </div>
                    <div class="col-md-2">
                      <a href="change-name.php" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                        Edit
                      </a>
                    </div>
                  </div>

                  <div class="row mb-2">
                    <div class="col-md-2 "><label for="name">Email:</label></div>
                    <div class="col-md-8">
                      <input type="text" readonly class="form-control" id="name" value="<?= $student_row['username'] ?>">
                    </div>
                    <div class="col-md-2">
                      <a href="change-email.php" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                        Edit
                      </a>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-2 "><label for="name">Workhours:</label></div>
                    <div class="col-md-8">
                      <input type="text" readonly class="form-control" id="name" value="<?= is_null($student_row['work_hours']) ? 'Not yet set.' : $student_row['work_hours'] ?>">
                    </div>
                    <div class="col-md-2">
                      <a href="change-workhours.php" class="btn btn-primary">
                        <i class="fas fa-edit"></i>
                        Edit
                      </a>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-2"><label for="name">Password:</label></div>
                    <div class="col-md-10">
                      <a href="change-password.php" class="btn btn-success">Change Password</a>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-2"><label for="name">Schoology:</label></div>
                    <div class="col-md-10">
                      <a href="actions/login-api-schoology.php" class="btn btn-primary">Login to Schoology</a>
                    </div>
                  </div>
                  <div class="row mb-2">
                    <div class="col-md-2"><label for="name">Edmodo:</label></div>
                    <div class="col-md-10">
                      <a href="actions/login-api-edmodo.php" class="btn btn-warning">Login to Edmodo</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>

      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

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
<?php $connect -> close(); ?>
