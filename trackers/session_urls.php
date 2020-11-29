	<!-- file will be called before unload using ajax -->
<?php
	include("db.php");
	$website_name = "tsaw.tech/";

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	  // collect value of input field
		$page_load_time= $_POST['page_load_time'];
    	$page_ready_time= $_POST['page_ready_time'];
    	$stay_duration= $_POST['user_stay_time'];
		$max_scroll= $_POST['user_maxScroll']; 
		$user_scroll_unload= $_POST['user_scroll_unload'];

		$url = $_POST["url"];
		$ref = $_POST["ref"];



		// get the url_id by checking the database. if not exist then add url in the database.
		$url_id;
		$sql = "SELECT id FROM website_urls WHERE url='$url'";
		$result = $conn->query($sql);
		if($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
	   			$url_id =  $row["id"];
	  		}
		} else {
			$sql = "INSERT INTO website_urls (url) VALUES ('$url')";
			if ($conn->query($sql) === TRUE) {
		  		$url_id = $conn->insert_id;	
			}
		}

		// get a new session id if the user came from a different source.
		// ref and create new session based on it.

		if(isset($_COOKIE["session_id"])) {
			// Two things can happen - set new cookie or update existing cookie
			// Condition to set new - person came again from another referral
			$session_id = $_COOKIE["session_id"];
			if($ref && (!strpos($ref, $website_name) !== false)) { // if the referral link is not from our website. 
				
				$sql = "SELECT id FROM referral_links WHERE session_id='$session_id' and referral_link='$ref'";		// user coming from same link again so just update the cookie otherwise set a new cookie.
				$result = $conn->query($sql);
				if($result->num_rows > 0) {
					$session_id = updateCookie_session_id();	
			  	} else {
					$session_id = setCookie_session_id();
					send_referral_url($url, $session_id);
			  	}
				
			}else {
				$session_id = updateCookie_session_id();
			}
			
		} else {
			$session_id = setCookie_session_id();

			if($ref && (!strpos($ref, $website_name) !== false)) { 
				send_referral_url($url, $session_id);
			}
		}
		echo "here";

		$sql = "INSERT INTO session_urls (session_id, url_id, page_load_time, page_ready_time, stay_duration, max_scroll, exit_scroll_position) VALUES ('$session_id','$url_id','$page_load_time','$page_ready_time','$stay_duration','$max_scroll', '$user_scroll_unload')";
		$conn->query($sql);

	}


function setCookie_session_id() {
	
	$user_id = $_COOKIE["user_id"];
	
	$sql = "INSERT INTO sessions (user_id) VALUES ('$user_id')";
	if ($GLOBALS['conn']->query($sql) === TRUE) {
	  $session_id = $GLOBALS['conn']->insert_id;

	  setcookie("session_id", $session_id, time()+(30*60), "/");

	} else {
	  echo "Error: " . $sql . "<br>" . $GLOBALS['conn']->error;
	}
	return $session_id;
}

function updateCookie_session_id() {
	$session_id = $_COOKIE["session_id"];
	setcookie("session_id", $session_id, time()+(30*60), "/");
	return $session_id;		
}

function send_referral_url($ref, $session_id) {

	$sql = "INSERT INTO referral_links (session_id, referral_link) VALUES ('$session_id', '$ref')";
	$GLOBALS['conn']->query($sql);
}

$conn->close();

?>