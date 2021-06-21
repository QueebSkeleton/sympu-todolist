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
      <div class="container-fluid">
        <div class="row">
            <!-- TODO: Insert Calendar Plugin Here -->
            <div class="col-lg-12">
              #
              #
              #
              #
              #
              #
              #
              #
              <h1> Calendar Plugin here </h1>
              #
              #
              #
              #
              #
              #
              #
              #
            </div>
          </div>

            <!--- Event Form Starts -->
            <!--- El's Note: Ill just set this as a card here below the calendar as I dont know if this part is implemented as a pop up (once a button is clicked) or just here below the calendar-->
        
          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Create Event</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form>

                  <!--Task/Event Title-->
                  <div class="row">
                    <div class="col-sm-6" id="task_title">
                    <!-- text input -->
                      <div class="form-group">
                        <label>Title of Event</label>
                        <input type="text" class="form-control" placeholder="Enter title for event">
                      </div>
                    </div>
                  </div>

                  <!--Task Description-->
                  <div class="row" id="description">
                    <div class="col-sm-6" id="task_description">
                      <div class="form-group">
                          <label>Description</label>
                          <textarea class="form-control" rows="7" cols="250" placeholder="Add additional details for this event..."></textarea>
                      </div>
                    </div>
                  </div>
                  
                  <!--Due Date of Task -->


                  <!--Type --> 
                  <div class="col-sm-4 form-group">
                    <label>Select Type</label>
                        <select class="form-control">
                          <option>Assignment</option>
                          <option>Online Meeting</option>
                          <option>Quiz</option>
                        </select>    
                  </div>

                  <!-- Additional Settings -->
                  <div class="col-sm-4 form-group">
                    <label>Set Priority</label>
                    <div class="form-check">
                          <input class="form-check-input" type="radio" name="1-LesserImportance">
                          <label class="form-check-label">Of Lesser Importance</label>
                    </div>
                    <div class="form-check">
                          <input class="form-check-input" type="radio" name="2-Important">
                          <label class="form-check-label">Important</label>
                    </div>
                    <div class="form-check">
                          <input class="form-check-input" type="radio" name="3-AtMostImportant">
                          <label class="form-check-label">At Most Important (URGENT)</label>
                    </div>
                  </div>
                  
                  

                </form>
              </div><!-- ./card-body-->
          </div><!-- ./card-->  
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

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
  <?php
   include ('partials/footer.php');
  ?>
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
