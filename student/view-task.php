<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> SYMPU Todo List | View Task</title>

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
            <h1 class="m-0">Calendar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Calendar</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <!-- PLACE YOUR PAGE CONTENTS HERE -->
      <?php

          $config = parse_ini_file('../../config.ini');
          $conn = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);

          if ($conn -> connect_error)
          {
            die("Connection failed: " . $conn->connect_error);
          }

          $id = $_GET['id'];

          $sql = 'SELECT * FROM todo WHERE id= "'.$id.'"';
          $result = $conn->query($sql);

          if ($result->num_rows > 0)
          {
            while($row = $result->fetch_assoc())
            {

      ?>

      <div class="card">
        <div class="card-header">
          <h2 class="card-title">
            <i class="fas fa-list"></i>
            View Task
            <?php if($row['source'] == 'EDMODO'): ?>
            <span class="badge badge-warning">Edmodo</span>
            <?php elseif($row['source'] == 'SCHOOLOGY'): ?>
            <span class="badge badge-primary">Schoology</span>
            <?php else: ?>
            <span class="badge badge-secondary">Local</span>
            <?php endif; ?>
          </h2>
        </div>
        <div class="card-body">
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="name">Task Name:</label>
                <input type="text" id="name" class="form-control" value="<?= $row["name"] ?>" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="date_assigned">Deadline:</label>
                <?php date_default_timezone_set('Asia/Manila'); ?>
                <input type="text" id="date_assigned" class="form-control" value="<?= date('M d, Y - h:m a', strtotime($row["date_assigned"])) ?>" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="type">Type:</label>
                <input type="text" id="type" class="form-control" value="<?= $row["type"] ?>" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" id="status" class="form-control" value="<?= $row["status"] ?>" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="priority">Priority:</label>
                <input type="text" id="priority" class="form-control" value="<?php
                  switch($row["priority"]) {
                    case 0: echo 'Unprioritized'; break;
                    case 1: echo 'Unimportant'; break;
                    case 2: echo 'Important'; break;
                    case 3: echo 'Of Utmost Importance'; break; } ?>" readonly>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="time_allotment">Time Allotment for Scheduler:</label>
                <input type="text" id="time_allotment" class="form-control" value="<?= $row["time_allotment"] ?> minutes" readonly>
              </div>
            </div>
            <div class="col-12">
              <div class="form-group">
                <label for="description">Instructions or description:</label><br><br>
                <?php echo $row ['description']; ?>
              </div>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <?php if($row["status"] == "PENDING"): ?>
          <a href="actions/finish-task.php?id=<?= $row["id"] ?>" class="btn btn-primary">Done</a>
          <?php else: ?>
          <a href="actions/undo-task.php?id=<?= $row["id"] ?>" class="btn btn-warning">Undo</a>
          <?php endif; ?>
        </div>
      </div>
      <!-- /.card -->
      <?php
          }
        }
      $conn->close();
      ?>
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
