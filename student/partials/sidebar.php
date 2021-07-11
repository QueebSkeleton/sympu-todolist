
<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">

  <!-- Brand Logo -->
  <a href="dashboard.php" class="brand-link">
    <img src="dist/img/smile.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">List+</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/man.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="profile.php" class="d-block">
          <?php
          //Name of User Here

          $config = parse_ini_file('../../config.ini');
          $conn = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);
          $stmt = $conn->prepare("SELECT first_name, last_name FROM student WHERE username = ?");
          $stmt -> bind_param("s", $user_logged_in_email);
          $user_logged_in_email = $_SESSION["email"];
          $stmt->execute();
          $result = $stmt->get_result();
          $row = $result -> fetch_assoc();
        ?>
        <?= $row["first_name"]. " ". $row["last_name"];?>
       </a>
      </div>
    </div>


    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          <a href="dashboard.php" class="nav-link">
            <i class="nav-icon fas fa-calendar-alt"></i>
            <p>
              Calendar
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="add-a-task.php" class="nav-link">
            <i class="nav-icon fas fa-plus-circle"></i>
            <p>
              Add Tasks
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="generated-schedule.php" class="nav-link">
            <i class="nav-icon fas fa-th"></i>
            <p>
              View Schedule
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="logout.php" class="nav-link">
            <i class="nav-icon fas fa-power-off"></i>
            <p>
              Logout
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
<!-- /.sidebar -->
</aside>

<?php
 $result -> close();
 $stmt -> close();
 $conn -> close();
?>
