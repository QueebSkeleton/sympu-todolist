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
      <!-- PLACE YOUR PAGE CONTENTS HERE -->
      <?php
          $servername = "localhost";
          $username = "id16885056_sympu_todolist";
          $password = "9&%?njtn$)HDiz}Q";
          $dbname = "id16885056_sympu_todolist_db";

          $conn = new mysqli($servername, $username, $password, $dbname);

          if ($conn -> connect_error) 
          {
            die("Connection failed: " . $conn->connect_error);
          }
          
          $id = $_GET['id'];

          $sql = 'SELECT name, description, time_allotment, date_assigned, source FROM todo WHERE id= "'.$id.'"';
          $result = $conn->query($sql);

          if ($result->num_rows > 0)
          {
            while($row = $result->fetch_assoc())
            {
      
      ?>        

      <div class="card">
        <div class="card-header">
          <h2 class="card-title"><?php echo $row ['name']; ?> &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp; &ensp;  <h7>Due Date: </h7> <?php echo $row ['date_assigned']; ?> </h2>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
        </div>

        <div class="card-body">
          <h7>Instruction(s): </h7> <?php echo $row ['description']; ?> <br>
          <h7>Time Allotment: </h7> <?php echo $row ['time_allotment']; ?> minutes<br>
        </div>
          <!-- /.card-body -->

        <div class="card-footer">
          <h7>Source: </h7> <?php echo $row ['source']; ?> 
        </div>
        <!-- /.card-footer-->

      </div>
      <!-- /.card -->

        

      <?php    
        }
      }

        $conn->close();
      ?>

        <br>

      
      <div class="container-fluid">
        
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