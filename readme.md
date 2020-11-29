##How to use Tracking Files in your Project::
1.  Add '<?php include("tracker/set_cookie.php") ?>' first thing in your php file.
2. Add  '<script src="js/startTimer.js"></script>' first thing inside of Head tag.
2. Add '<script src="js/TrackUserBehevior.js"></script>' at the end of your file.


##Example - index.php
	<?php include("tracker/set_cookie.php") ?>
	<!DOCTYPE html>
	<html>
	<head>
	  <script src="js/startTimer.js"></script>
		<title>Home Page</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div class="container">
			<div class="text-center mt-5 mb-3">
				<a href="index.php">Home</a><span> | </span> 
				<a href="contact.php">Contact</a><span> | </span>
				<a href="about.php">About</a>	
			</div>
				
			<div class="text-center mt-5 mb-3">
				<a href="index.php">Home</a><span> | </span> 
				<a href="contact.php">Contact</a><span> | </span>
				<a href="about.php">About</a>	
			</div>
		</div>
		
		<script src="js/TrackUserBehevior.js"></script>
	</body>
	</html>
