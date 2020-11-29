<?php
    $conn;
	$servername = "localhost";
	$username = "remote_user";
	$password = "umPuAaa1gEIZCJlw";
	$dbname = "tracker";


	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	  die("Connection failed: " . $conn->connect_error);
	}

?>
