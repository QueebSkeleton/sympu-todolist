<?php
  session_start();

  // If user is not logged in, redirect to login page
  if(!isset($_SESSION["email"])) {
    http_response_code(401);
       die();
  }

  // Get email from session
  $username = $_SESSION["email"];

  // Parse configuration file
  $config = parse_ini_file("../../../config.ini");

  // Generate random edmodo tasks

  /* HARDCODED ATTRIBUTES */
  $subjects = ['DAA', 'ArtApp', 'PolGov', 'Ecosystem'];
  $task_types = ['ASSIGNMENT', 'QUIZ'];
  $task_type_name = ['Assignment', 'Quiz'];

  /* RANDOMIZED NUMBER OF TASKS */
  $no_of_tasks_to_generate = rand(2, 10);
  $task_no_start = rand(1, 5);

  date_default_timezone_set("Asia/Manila");

  // Create connection to db
  $conn = mysqli_connect($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);

  // Prepare single insert statement for random tasks
  $insert_stmt = mysqli_prepare($conn, "INSERT INTO `todo`(`student_username`, `priority`, `name`, `time_allotment`, `description`, `date_assigned`, `type`, `source`, `status`) VALUES (?,?,?,?,?,?,?,?,?)");
  mysqli_stmt_bind_param($insert_stmt, "sisisssss", $username, $task_priority, $task_name, $task_allocated_time, $task_description, $task_due_date, $type, $task_source, $task_status);

  // Generate tasks
  for($i = 0; $i < $no_of_tasks_to_generate; $i++) {
    $source_generated_index = rand(0, 1);
    $type_generated_index = rand(0, 1);
    $subject_generated_index = rand(0, 3);

    $task_name = $subjects[$subject_generated_index]." ".$task_type_name[$type_generated_index]." #".($task_no_start++);
    $task_description = "<p>Task is imported from: <span class='badge badge-warning'>Edmodo</span><br>This task is auto-generated. Actual data will be fetched from real sources, but will be implemented soon when resources are available.";

    $task_due_date = (new DateTime('now')) -> setTime(rand(6,15), rand(0,59));
    date_add($task_due_date, date_interval_create_from_date_string(rand(0, 10)." days"));

    $task_source = 'EDMODO';
    $task_priority = 0;
    $task_allocated_time = rand(20, 60);
    $type = $task_types[$type_generated_index];
    $task_due_date = date_format($task_due_date, 'Y-m-d H:i:s');
    $task_status = 'PENDING';

    mysqli_stmt_execute($insert_stmt);
  }

  // Close statemenet
  mysqli_stmt_close($insert_stmt);
  // Close connection
  mysqli_close($conn);

  // Redirect back to profile.php
  die("<html><body><script>alert('Successfully imported tasks from Edmodo.'); ".
    "window.location.replace('../profile.php');</script></body></html>");

?>
