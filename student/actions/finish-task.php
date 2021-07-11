<?php

	// Only allow logged in users
	session_start();
	if(!isset($_SESSION["email"])) {
		http_response_code(401);
		die("You are not authorized to perform requests on this endpoint.");
	}

	// Only allow GET requests
	if($_SERVER["REQUEST_METHOD"] != 'GET') {
		http_response_code(400);
		die("Only GET requests are allowed for this endpoint.");
	}

	// Retrieve task id
  $id = $_GET["id"];

	// Save to database

	// Parse config file
	$config = parse_ini_file("../../../config.ini");

	// Create connection to database
	$conn = mysqli_connect($config['db_server'], $config['db_user'], $config['db_password'], $config['db_name']);

	// Prepare insert statement
	mysqli_query($conn, "UPDATE `todo` SET `status` = 'FINISHED' WHERE `id` = '$id'");

	// Close connection
	mysqli_close($conn);

  // Redirect back to overview.php
  die("<html><body><script>alert('Successfully finished task.'); ".
    "window.location.replace('../dashboard.php');</script></body></html>");

?>
