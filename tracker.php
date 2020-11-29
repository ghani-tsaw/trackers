<?php
	include("library/Mobile_Detect.php");
	include("library/BrowserDetection.php");
	include("db.php");

	$browser = new Wolfcast\BrowserDetection;

	$browser_name = $browser->getName();
	$browser_version = $browser->getVersion();
	

	$d = new Mobile_Detect();
	$device_type;
	if($d->isMobile()) {
		$device_type="Mobile";
	} elseif($d->isTablet()) {
		$device_type= "Tablet";
	} else {
		$device_type="PC";
	}


	$os;
	if($d->isIOS()) {
		$os = "IOS";
	} elseif($d->isAndroidOS()) {
		$os = "Android";
	} else {
		$os = "Windows";
	}
	

	// $ip = $_SERVER["REMOTE_ADDR"];
	// echo "IP Address: ".$ip."<br>";

	$ip = getenv('HTTP_CLIENT_IP')?:
	getenv('HTTP_X_FORWARDED_FOR')?:
	getenv('HTTP_X_FORWARDED')?:
	getenv('HTTP_FORWARDED_FOR')?:
	getenv('HTTP_FORWARDED')?:
	getenv('REMOTE_ADDR');

	// echo $_SERVER['HTTP_USER_AGENT'] . "<br><br>";

	// $browser = get_browser(null, true);
	// print_r($browser);



	// Set-up the Browser name
	$browser_id;
	$sql = "SELECT id FROM browsers WHERE browser='$browser_name'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
   			$browser_id =  $row["id"];
  		}
	} else {
		$sql = "INSERT INTO browsers (browser) VALUES ('$browser_name')";
		if ($conn->query($sql) === TRUE) {
	  		$browser_id = $conn->insert_id;	
		}
	}


	// Set-up the device type
	$device_id;
	$sql = "SELECT id FROM devices WHERE device='$device_type'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
   			$device_id =  $row["id"];
  		}
	} 


	// Set-up the operating system
	$os_id;
	$sql = "SELECT id FROM operating_systems WHERE os='$os'";
	$result = $conn->query($sql);
	if($result->num_rows > 0) {
		while($row = $result->fetch_assoc()) {
   			$os_id =  $row["id"];
  		}
	}


	// Fill the user table - 
	$sql = "INSERT INTO users (id, ip_address, browser_id, browser_version, os_id, device_id, latitude, longitude) VALUES ('$cookie_value','$ip','$browser_id','$browser_version','$os_id','$device_id','88.80', '-70.26')";
	if($conn->query($sql) == FALSE) {
		// user_id is not unique so change it and make it unique
		while(True) {
			$random_number = rand();
			$timestamp = strtotime("now");
			$cookie_value = $random_number.".".$timestamp;
			$sql = "INSERT INTO users (id, ip_address, browser_id, browser_version, os_id, device_id, latitude, longitude) VALUES ('$cookie_value','$ip','$browser_id','$browser_version','$os_id','$device_id','88.80', '-70.26')";
			if($conn->query($sql) == True) {
				setcookie($cookie_name, $cookie_value, $expire_time, "/");
				break;
			}
		}
	}

	$conn->close();


?>