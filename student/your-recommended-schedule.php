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

  <style>
  .fc-timegrid-slot {
    height: 50px; // 1.5em by default
    border-bottom: 0 !important;
  }
  </style>

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
              <h1 class="m-0">Your Generated Schedule</h1>
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
          <a href="actions/generate-schedule.php" class="btn btn-primary mb-4">Suggest a schedule</a>

          <div class="card">
            <div class="card-header">
              <h6 class="card-title">
                <i class="fas fa-calendar"></i>
                Recommended plan
              </h6>
            </div>
            <div class="card-body p-0">
              <!-- THE CALENDAR -->
              <div id="calendar"></div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
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
        initialView: 'timeGridWeek',
        headerToolbar: {
          left: 'prev,next today',
          center: 'title',
          right: 'timeGridWeek'
        },
        themeSystem: 'bootstrap',
        //Random default events
        events: [
          <?php
            //add database + connect
            $conn = new mysqli($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);
            $result = $conn -> query("SELECT `generated_todo`.`todo_id`, `generated_todo`.`date_to_perform`, `generated_todo`.`start_time`, `generated_todo`.`end_time`, `todo`.`name`, `todo`.`type` ".
            "FROM `generated_todo` INNER JOIN `todo` ON `todo`.`id` = `generated_todo`.`todo_id` ".
            "WHERE `todo`.`student_username` = '".$_SESSION["email"]."' AND `todo`.`status` = 'PENDING'");

            while ($row = $result -> fetch_assoc()) {
              // Get year,month,day,hour,minutes and seconds\
              $intdate = strtotime($row["date_to_perform"]);
              $year = date("Y", $intdate);
              $month = date("m-1", $intdate);
              $day = date("d", $intdate);

              $start_time = DateTime::createFromFormat('H:i:s', $row["start_time"]);
              $end_time = DateTime::createFromFormat('H:i:s', $row["end_time"]);

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
              "id: ".$row["todo_id"].",\n".
              "title          : '".$row["name"].
              "',\n".
              "start          : new Date(".$year.
              ",".$month.
              ",".$day.
              ",".$start_time -> format('H').
              ",".$start_time -> format('i').
              ",".$start_time -> format('s').
              "),\n".
              "end          : new Date(".$year.
              ",".$month.
              ",".$day.
              ",".$end_time -> format('H').
              ",".$end_time -> format('i').
              ",".$end_time -> format('s').
              "),\n".
              "backgroundColor: '".$bgcolor.
              "', \n". //this is working
              "borderColor    : '".$bdcolor.
              "', \n".
              "allDay         : false\n".
              "},";


            }

            $result -> close();
            $conn -> close();
          ?>
        ],
        eventClick: function(info) {
          window.location.replace("view-task.php?id=" + info.event.id + "&callback=your-recommended-schedule");
        }
      });
      calendar.render();
      // $('#calendar').fullCalendar()
    })
  </script>
</body>

</html>
