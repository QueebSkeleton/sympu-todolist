<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title> SYMPU Todo List | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!--Google Font: Merriweather -->

  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
   <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="./plugins/fontawesome-free/css/all.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="./plugins/fullcalendar/main.css">
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
      <section class="content-header">
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
      </section>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
              <div class="sticky-top mb-3">
                <!-- LEGEND OF THE TASKS -->
                <div class="card">
                  <div class="card-body">
                    <span class="d-block" style="color:#E77471;font-size: 15.5px;"><i class="fas fa-square"></i> Online Meeting </span>
                    <span class="d-block" style="color:#00a65a;font-size: 15.5px;"><i class="fas fa-square"></i> Assignment</span>
                    <span class="d-block" style="color:#f39c12;font-size: 15.5px;"><i class="fas fa-square"></i> Quiz</span>
                  </div>
                </div>
                <!-- THE PENDING TASKS -->
                <div class="card">
                  <div class="card-header">
                    <h4 class="card-title">Pending</h4>
                  </div>
                  <div class="card-body">
                    <div id="external-events">
                      <?php
                        $config = parse_ini_file('../../config.ini');
                        $conn = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);

                        $date = date('y-m-d h:i:s');
                        $stmt = $conn->prepare("SELECT name,id FROM todo WHERE student_username = ? and status = 'PENDING' and date_assigned <= ?
                                ORDER BY date_assigned DESC");
                        $stmt -> bind_param("ss",$_SESSION["email"],$date);
                        $stmt->execute();
                        $result = $stmt->get_result();
                      ?>
                      <ul>
                        <?php while($row = $result -> fetch_assoc()):?>
                        <li>
                          <?="<a href= \"view-task.php?id=". $row["id"] ."\">"?>
                          <?= $row["name"] ?>
                          <?="</a>"?>
                        </li>
                        <?php endwhile; ?>
                      </ul>
                      <?php
                        $result -> close();
                        $stmt -> close();
                        $conn -> close();
                      ?>
                    </div><!-- the events-->

                  </div>
                  <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!--THE UPCOMING EVENTS -->
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Upcoming</h3>
                  </div>
                  <div class="card-body">
                    <?php
                      $conn = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);

                      $date = date('y-m-d h:i:s');
                      $_SESSION["email"];

                      $stmt = $conn->prepare("SELECT name,id FROM todo WHERE student_username = ? and status = 'PENDING' and date_assigned >= ? ORDER BY date_assigned ASC");

                      $stmt -> bind_param("ss",$_SESSION["email"],$date);
                      $stmt->execute();
                      $result = $stmt->get_result();
                    ?>
                    <ul>
                      <?php while($row = $result -> fetch_assoc()): ?>
                      <li>
                        <?="<a href= \"view-task.php?id=". $row["id"] ."\">"?>
                        <?= $row["name"] ?>
                        <?="</a>"?>
                      </li>
                      <?php endwhile; ?>
                    </ul>
                    <?php
                      $result -> close();
                      $stmt -> close();
                      $conn -> close();
                    ?>
                  </div>
                  <!--card-body-->
                </div>
                <!--card-->
              </div>
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card card-primary">
                <div class="card-body p-0">
                  <!-- THE CALENDAR -->
                  <div id="calendar"></div>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
    </div>
    <!-- /.content-wrapper -->

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
  </div>
  <!-- ./wrapper -->


  <!-- jQuery -->
  <script src="./plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="./plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- jQuery UI -->
  <script src="./plugins/jquery-ui/jquery-ui.min.js"></script>
  <!-- AdminLTE App -->
  <script src="./dist/js/adminlte.min.js"></script>
  <!-- fullCalendar 2.2.5 -->
  <script src="./plugins/moment/moment.min.js"></script>
  <script src="./plugins/fullcalendar/main.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="./dist/js/demo.js"></script>

  <!-- Page specific script -->
  <script>
    $(function() {
      /* initialize the calendar
       -----------------------------------------------------------------*/
      //Date for the calendar events (dummy data)
      var date = new Date()
      var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear()

      var Calendar = FullCalendar.Calendar;
      var calendarEl = document.getElementById('calendar');

      var calendar = new Calendar(calendarEl, {
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        themeSystem: 'bootstrap',
        //Random default events
        events: [
          <?php
            //add database + connect
            $conn = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);
            $stmt = $conn -> prepare("SELECT date_assigned, name, type FROM todo WHERE student_username = ? and status = 'PENDING'");
            $stmt -> bind_param("s", $_SESSION["email"]);
            $stmt -> execute();
            $result = $stmt -> get_result();

            while ($row = $result -> fetch_assoc()) {
              // Get year,month,day,hour,minutes and seconds
              $year = date("Y", strtotime($row["date_assigned"]));
              $month = date("m-1", strtotime($row["date_assigned"]));
              $day = date("d", strtotime($row["date_assigned"]));
              $hour = date("H", strtotime($row["date_assigned"]));
              $minutes = date("i", strtotime($row["date_assigned"]));
              $seconds = date("s", strtotime($row["date_assigned"]));

              // Corresponding color to different tasks
              if ($row["type"] == "SYNCHRONOUS_MEET") {
                //Storing colors
                $bgcolor = "#E77471"; //pink coral
                $bdcolor = " #E77471";
              } else if ($row["type"] == "QUIZ") {
                //Storing colors
                $bgcolor = "#f39c12"; //yellow
                $bdcolor = "#f39c12";
              } else if ($row["type"] == "ASSIGNMENT") {
                //Storing colors
                $bgcolor = "#00a65a"; // green
                $bdcolor = "#00a65a";
              }

              // add the data in the calendar
              echo "{\n".
              "title          : '".$row["name"].
              "',\n".
              "start          : new Date(".$year.
              ",".$month.
              ",".$day.
              ",".$hour.
              ",".$minutes.
              ",".$seconds.
              "),\n".
              "backgroundColor: '".$bgcolor.
              "', \n". //this is working
              "borderColor    : '".$bdcolor.
              "', \n".
              "allDay         : false\n".
              "},";


            }

            $result -> close();
            $stmt -> close();
            $conn -> close();
          ?>
        ],
      });
      calendar.render();
      // $('#calendar').fullCalendar()
    })
  </script>
</body>

</html>
