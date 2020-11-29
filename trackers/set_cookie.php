<?php

$cookie_name = "user_id";
$expire_time = time() + (86400 * 30);

if(!isset($_COOKIE[$cookie_name])) {
  //set the user_id to track the user
	$random_number = rand();
	$timestamp = strtotime("now");
	$cookie_value = $random_number.".".$timestamp;
	setcookie($cookie_name, $cookie_value, $expire_time , "/"); // 86400 = 1 day
	
	include 'tracker.php';

} else {
	// everytime the user visit the website, the cookie will set to expire in next month.
	$cookie_value =  $_COOKIE[$cookie_name];
	setcookie($cookie_name, $cookie_value, $expire_time , "/");

	// // Register the session_id
	// if(!isset($_COOKIE["session_id"])) { // if not set then set it.
	// 	$user_id = $_COOKIE['user_id'];
	// 	$sql = "INSERT INTO sessions (user_id) VALUES ('$user_id')";
	// 	if ($conn->query($sql) === TRUE) {
	// 	  $session_id = $conn->insert_id;

	// 	  setcookie("session_id", $session_id, time() + (30*60), "/");
	// 	}

	// } else { // otherwise change the expire time for the cookie 
	// 	// check the source- how the user is coming....

	// 	$session_id = $_COOKIE["session_id"];
	// 	setcookie("session_id", $session_id, time()+(30*60), "/");
	// }
}

?>