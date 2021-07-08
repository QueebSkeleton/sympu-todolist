<?php
  session_start();

  // Check if user is logged in first
  if(!isset($_SESSION["email"])) {
    die("<html><body><script>alert('You are not yet logged in.'); ".
    "window.location.replace('user_login.php');</script></body></html>");
  }

  class Todo {
    public $id;
    public $priority;
    public $date_assigned;
    public $time_allotment;
  }

  class GeneratedTodo {
    public $todo_id;
    public $partition_no;
    public $date_assigned;
    public $start_time;
    public $end_time;
  }

  class Knapsack {
    public $date;
    public $items;
    public $generated_items;
    public $remaining_work_minutes;
    public $time_tables;
  }

  class TimeTable {
    public $start_time;
    public $end_time;
    public $remaining_work_minutes;
  }

  // Get logged in user's email
  $logged_in_email = $_SESSION["email"];

  // Parse configuration file
  $config = parse_ini_file("../config.ini");

  // Create connection to database
  $mysqli = new mysqli(
    $config['db_server'],
    $config['db_user'],
    $config['db_password'],
    $config['db_name']);

  // Delete all current generated todo of logged in user
  $mysqli -> query("DELETE FROM `generated_todo` WHERE `todo_id` IN ".
    "(SELECT `id` FROM `todo` WHERE `student_username` = '$logged_in_email')");

  // Fetch the work hours of logged in user
  $work_hours_result =
    $mysqli -> query("SELECT `work_hours` FROM `student` WHERE `username` = '$logged_in_email'");
  $work_hours_row = $work_hours_result -> fetch_assoc();

  // If there are no work hours inputted yet, redirect to profile.
  if(is_null($work_hours_row["work_hours"])) {
    die("<html><body><script>alert('Input your work hours first.'); ".
      "window.location.replace('overview.php');</script></body></html>");
    // Close connection
    $mysqli -> close();
  }

  // Get time now
  date_default_timezone_set("Asia/Manila");
  $date_time_now = new DateTime("now");
  $total_work_minutes = 0;

  // Parse work hours
  $work_hours_str = $work_hours_row["work_hours"];
  // Placeholder for timetables later
  $time_tables = [];
  // Calculate total minutes from work hours
  $time_frames = explode(",", $work_hours_str);
  foreach($time_frames as $time_frame) {
    $times = explode("-", $time_frame);

    $time_table = new TimeTable();
    $time_table -> start_time = DateTime::createFromFormat('H:i', $times[0]);
    $time_table -> end_time = DateTime::createFromFormat('H:i', $times[1]);

    $date_diff = $time_table -> end_time -> diff($time_table -> start_time);
    $total_work_minutes += ($date_diff -> h) * 60;
    $time_table -> remaining_work_minutes = ($date_diff -> h) * 60;
    $total_work_minutes += $date_diff -> i;
    $time_table -> remaining_work_minutes += $date_diff -> i;

    $time_tables[] = $time_table;
  }

  // Fetch all pending assignments of logged in user
  $todo_result = $mysqli -> query("SELECT `id`, `priority`, `date_assigned`, ".
    " `time_allotment` FROM `todo` WHERE `student_username` = '$logged_in_email' ".
    " AND `type` = 'ASSIGNMENT' AND `status` = 'PENDING' AND DATE(`date_assigned`) >= '".$date_time_now -> format("Y-m-d")."'");

  // If there are no tasks to schedule, redirect back to overview page
  if($todo_result -> num_rows == 0) {
    die("<html><body><script>alert('You have no availble tasks to schedule.'); ".
    "window.location.replace('overview.php');</script></body></html>");
    // Close connection
    $mysqli -> close();
  }

  // Parse all rows into an array of Todo objects
  $todo_list = [];
  while($row = $todo_result -> fetch_assoc()) {
    $todo = new Todo();
    $todo -> id = intval($row["id"]);
    $todo -> priority = intval($row["priority"]);
    $todo -> date_assigned = new DateTime($row["date_assigned"]);
    $todo -> time_allotment = intval($row["time_allotment"]);
    $todo_list[] = $todo;
  }
  // Close connection
  $mysqli -> close();

  // START: Generator Greedy Algorithm

  // Sort tasks by due date first
  usort($todo_list, function($a, $b) {
    if($a -> date_assigned < $b -> date_assigned) return -1;
    else if($a -> date_assigned == $b -> date_assigned) {
      return $b -> priority - $a -> priority;
    }
    else return 1;
  });

  // Get last todo deadline
  $todo_list_size = count($todo_list);
  $last_todo_deadline = $todo_list[$todo_list_size - 1] -> date_assigned;
  // Get number of days from current day to last todo deadline
  $number_of_days_current_to_last =
    $last_todo_deadline -> diff($date_time_now) -> d + 1;


  /*
  // Output all todo
  echo "Tasks:<br><ol>";
  foreach($todo_list as $todo) {
      echo "<li>".$todo -> id." Due ".$todo -> date_assigned -> format("Y-m-d")." Prio: ".$todo -> priority."</li>";
  }
  echo "</ol>"; */

  // Generate knapsacks for each day
  $knapsacks = [];

  // Current index of todo being considered
  $current_index_todo = 0;

  // Assign the todo list to a proper knapsack
  for($i = 0; $i <= $number_of_days_current_to_last && $todo_list_size > 0; $i++) {
    $knapsack = new Knapsack();

    // Get date of this knapsack
    $knapsack -> date = clone $date_time_now;
    $knapsack -> date -> modify("+".$i." day");

    // Generate timetables for this knapsack, used later
    $knapsack -> time_tables = [];
    foreach($time_tables as $time_table) {
      $knapsack -> time_tables[] = clone $time_table;
    }

    // Placeholder to keep track while adding todo
    $knapsack -> remaining_work_minutes = $total_work_minutes;
    // Array of all todo to assign to this knapsack
    $knapsack -> items = [];
    // Array of all generated todo
    $knapsack -> generated_items = [];

    // Add this knapsack to all knapsacks array
    $knapsacks[] = $knapsack;

    // First loop - iterate over items due on this knapsack's date
    while($current_index_todo < $todo_list_size) {
      $todo = $todo_list[$current_index_todo];
      if($todo -> date_assigned -> format("Y-m-d") != $knapsack -> date -> format("Y-m-d")) {
        break;
      }

      $knapsack -> items[] = $todo;
      $knapsack -> remaining_work_minutes -= $todo -> time_allotment;
      unset($todo_list[$current_index_todo]);
      $todo_list = array_values($todo_list);
      $todo_list_size = count($todo_list);
    }

    // Second Loop - find additional items to add
    while($current_index_todo < $todo_list_size) {
      $todo = $todo_list[$current_index_todo];
      if($todo -> time_allotment <= $knapsack -> remaining_work_minutes) {
        $knapsack -> items[] = $todo;
        $knapsack -> remaining_work_minutes -= $todo -> time_allotment;
        unset($todo_list[$current_index_todo]);
        $todo_list = array_values($todo_list);
        $todo_list_size = count($todo_list);
      } else {
        $current_index_todo++;
      }
    }

    // Reset index to 0
    $current_index_todo = 0;
  }

  // SECOND HALF: Assign time frames for every knapsack
  foreach($knapsacks as $knapsack) {
    foreach($knapsack -> items as $item) {
      $partition_no = 0;
      $remaining_unfilled_time = $item -> time_allotment;

      for($i = 0; $i < count($time_tables); $i++) {
        if($knapsack -> time_tables[$i] -> remaining_work_minutes >= $remaining_unfilled_time) {
          // Create a generated todo entity
          $generated_todo = new GeneratedTodo();
          $generated_todo -> todo_id = $item -> id;
          $generated_todo -> partition_no = $partition_no;
          $generated_todo -> date_assigned = $knapsack -> date;
          $offset_minutes = ($time_tables[$i] -> remaining_work_minutes) - ($knapsack -> time_tables[$i] -> remaining_work_minutes);
          $generated_todo -> start_time = (clone $knapsack -> date) ->
            setTime(intval($time_tables[$i] -> start_time -> format("H")),
              intval($time_tables[$i] -> start_time -> format("i"))) -> modify("+".$offset_minutes." minutes");
          $generated_todo -> end_time = (clone $generated_todo -> start_time) ->
            modify("+".$remaining_unfilled_time." minutes");

          // Add this to knapsack generated todo list
          $knapsack -> generated_items[] = $generated_todo;

          // Subtract the timetables with occupied minutes
          $knapsack -> time_tables[$i] -> remaining_work_minutes -= $remaining_unfilled_time;

          // Break out of loop since the whole todo is now assigned
          break;
        } else if($knapsack -> time_tables[$i] -> remaining_work_minutes == 0) {
          continue;
        } else {
          // Create a generated todo entity
          $generated_todo = new GeneratedTodo();
          $generated_todo -> todo_id = $item -> id;
          $generated_todo -> partition_no = $partition_no++;
          $generated_todo -> date_assigned = $knapsack -> date;
          $offset_minutes = ($time_tables[$i] -> remaining_work_minutes) - ($knapsack -> time_tables[$i] -> remaining_work_minutes);
          $generated_todo -> start_time = (clone $knapsack -> date) ->
            setTime(intval($time_tables[$i] -> start_time -> format("H")),
              intval($time_tables[$i] -> start_time -> format("i"))) -> modify("+".$offset_minutes." minutes");
          $generated_todo -> end_time = (clone $generated_todo -> start_time) ->
            modify("+".$knapsack -> time_tables[$i] -> remaining_work_minutes." minutes");

          // Add this to knapsack generated todo list
          $knapsack -> generated_items[] = $generated_todo;

          // Subtract remaining unfilled time to how much was occupied
          $remaining_unfilled_time -= $knapsack -> time_tables[$i] -> remaining_work_minutes;

          // Set the timetable filled to 0, since every minute is now filed
          $knapsack -> time_tables[$i] -> remaining_work_minutes = 0;
        }
      }
    }
  }

  // LAST STEP! SAVE TO DATABASE

  // Create connection to database
  $mysqli = new mysqli(
    $config['db_server'],
    $config['db_user'],
    $config['db_password'],
    $config['db_name']);

  // Prepare a generic insert statement for every generated todo
  $insert_stmt = $mysqli -> prepare("INSERT INTO `generated_todo` VALUES (?, ?, ?, ?, ?)");
  $insert_stmt -> bind_param("iisss", $g_todo_id, $g_partition_no, $g_date_to_perform, $g_start_time, $g_end_time);

  foreach($knapsacks as $knapsack) {
    foreach($knapsack -> generated_items as $generated_todo) {
      $g_todo_id = $generated_todo -> todo_id;
      $g_partition_no = $generated_todo -> partition_no;
      $g_date_to_perform = $generated_todo -> date_assigned -> format("Y-m-d");
      $g_start_time = $generated_todo -> start_time -> format("H:i");
      $g_end_time = $generated_todo -> end_time -> format("H:i");
      $insert_stmt -> execute();
    }
  }

  $insert_stmt -> close();
  $mysqli -> close();

  die("<html><body><script>alert('A schedule has been generated for your tasks. Redirecting you to the calendar.'); ".
    "window.location.replace('schedule-calendar.php');</script></body></html>");
?>
