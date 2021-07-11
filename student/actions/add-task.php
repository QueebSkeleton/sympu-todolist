<?php

	// Only allow logged in users
	session_start();
	if(!isset($_SESSION["email"])) {
		http_response_code(401);
		die("You are not authorized to perform requests on this endpoint.");
	}

	// Only allow POST requests
	if($_SERVER["REQUEST_METHOD"] != 'POST') {
		http_response_code(400);
		die("Only POST requests are allowed for this endpoint.");
	}

	// Retrieve request parameters
	// TODO: Add validation layer for inputs
	$student_username = $_SESSION["email"];
	$type = $_POST["type"];
	$name = $_POST["name"];
	$priority = $_POST["priority"];
	$time_allotment = $_POST["time_allotment"];
	$description = $_POST["description"];
	$date_assigned = $_POST["date_assigned"];
	$status = "PENDING";

	// Save to database

	// Parse config file
	$config = parse_ini_file("../../../config.ini");

	// Create connection to database
	$conn = mysqli_connect($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);

	// Prepare insert statement
	$insert_stmt = mysqli_prepare($conn, "INSERT INTO `todo`(`student_username`, `priority`, `name`, `time_allotment`, `description`, `date_assigned`, `type`, `status`) VALUES (?,?,?,?,?,?,?,?)");

	// Bind parameters
	mysqli_stmt_bind_param($insert_stmt, "sisissss", $student_username, $priority, $name, $time_allotment, $description, $date_assigned, $type, $status);

	// Execute insert statement
	mysqli_stmt_execute($insert_stmt);

	// Close statement
	mysqli_stmt_close($insert_stmt);
	// Close connection
	mysqli_close($conn);

  // Redirect back to overview.php
  die("<html><body><script>alert('Successfully added task.'); ".
    "window.location.replace('../dashboard.php');</script></body></html>");

?>
