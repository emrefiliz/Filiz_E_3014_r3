<?php
	require_once('phpscripts/config.php');
	confirm_logged_in();
	// Set timezone to Eastern Standart Time
	date_default_timezone_set('est');
	$hour = idate("H");	
	switch (true) {
	case $hour <= 6:
		$message = "Good Night";
		break;
	case $hour <= 12:
		$message = "Good Morning";
		break;
	case $hour <= 16:
		$message = "Good Afternoon";
		break;
	case $hour <= 24:
		$message = "Good Evening";
		break;
	}
?>
<!doctype html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Welcome to your admin panel</title>
		<!-- Font & Icons -->
		<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
		<link href="https://use.fontawesome.com/releases/v5.0.7/css/all.css" rel="stylesheet">
		<!-- Compressed CSS -->
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/css/foundation.min.css"/>
		<!-- Custom CSS -->
		<link rel="stylesheet" href="css/style.css">
	</head>
	<body>
		<div class="grid-x grid-margin-x">
			<div class="cell medium-4 large-offset-4" style="margin-top: 10%;">
				<div class="card" style="width: auto;">
					<div class="card-divider">
						<h4><?php echo $message,', ', $_SESSION['user_name'];?></h4>
						<a href="phpscripts/caller.php?caller_id=logout" class="button hollow float-right">Sign Out</a>
					</div>
					<div class="card-section">
						<div class="grid-container">
                			<div class="grid-x grid-padding-x">
                  				<div class="medium-12 cell">
									Last Login: <?php echo $_SESSION['user_last_login'];  ?>
									<div class="button-group">
										<a href="admin_createuser.php" class="button">Create User<i style="margin-left:5px"class="fas fa-lg fa-plus-square"></i></a>
										<a href="admin_deleteuser.php" class="button alert">Delete User<i style="margin-left:5px"class="fas fa-lg fa-trash-alt"></i></a>
										<a href="admin_edituser.php" class="button">Edit User<i style="margin-left:5px"class="fas fa-lg fa-edit"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
	<!-- Compressed JQuery & Foundation JavaScript -->
	<script	src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js"></script>
</html>