<?php


  // Only allow logged in users
  session_start();
  if(!isset($_SESSION["email"])) {
    http_response_code(401);
    die("You are not authorized to perform requests on this endpoint.");
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> Add Task | SYMPU-To-Do-List </title>

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
            <h1 class="m-0">Add a Task</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="overview.php">Home</a></li>
              <li class="breadcrumb-item active">Add</li>
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

        <div class="card">
          <div class="card-header">
            <h6 class="card-title">
              <i class="fas fa-list"></i>
              Task details
            </h6>
          </div>

          <form method="POST" action="actions/add-task.php">

            <div class="card-body">

              <div class="form-group">
                <label for="type">Task Type</label>
                <select name="type" required class="form-control">
                  <option value="ASSIGNMENT">Assignment</option>
                  <option value="QUIZ">Quiz</option>
                  <option>Uncategorized</option>
                </select>
              </div>

              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name" required class="form-control" id="name">
              </div>

              <div class="form-group">
                <label for="date_assigned">Date Assigned</label>
                <input type="datetime-local" name="date_assigned" required class="form-control" id="date_assigned">
              </div>

              <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" class="summernote" id="description"></textarea>
              </div>

              <div class="form-group">
                <label for="priority">Priority</label>
                <select name="priority" required class="form-control" id="priority">
                  <option value="0">Unprioritized</option>
                  <option value="1">Unimportant</option>
                  <option value="2">Important</option>
                  <option value="3">Of Utmost Importance</option>
                </select>
              </div>

              <div class="form-group">
                <label for="time_allotment">Time Allotment</label>
                <input type="number" min="5" max="120" name="time_allotment" required class="form-control" id="time_allotment">
              </div>

            </div>

            <div class="card-footer">
              <button type="submit" class="btn btn-primary">Finalize</button>
            </div>

          </form>
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
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- Page specific script -->
<script>
  $("textarea.summernote").summernote();
</script>
</body>
</html>