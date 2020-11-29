<script src="TrackUserBehevior.js"></script>

<?php
$cookie_name = "user_id";
$expire_time = time() + (86400 * 30);

if(!isset($_COOKIE[$cookie_name])) {
  //set the user_id to track the user
	$random_number = rand();
	$timestamp = strtotime("now");
	$cookie_value = $random_number.".".$timestamp;
	setcookie($cookie_name, $cookie_value, $expire_time , "/"); 
	
	include 'tracker.php';

} else {
	// everytime the user visit the website, the cookie will set to expire in next month.
	$cookie_value =  $_COOKIE[$cookie_name];
	setcookie($cookie_name, $cookie_value, $expire_time , "/");
}

?>