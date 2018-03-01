<?php
	require_once('phpscripts/config.php');
	// confirmLoggedIn();
	$tbl = 'tbl_user';
	$users = getAll($tbl);
	echo $_SESSION['user_id'];
?>
<html class="no-js">
	<head>
		<meta charset="UTF-8">
		<title>Delete User Page</title>
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
						<h4>Delete User</h4>
						<a href="phpscripts/caller.php?caller_id=logout" class="button hollow float-right">Sign Out</a>
					</div>
					<div class="card-section">
						<form action="admin_createuser.php" method="post">
							<div class="grid-container">
								<div class="grid-x grid-padding-x">
									<div class="medium-12 cell">
										<table class="stack">
											<thead>
											    <tr>
											      <th>First Name</th>
											      <th>Username</th>
											      <th>E-mail</th>
											      <th></th>											      
											    </tr>
											</thead>
											<tbody>
												<?php
													while($row = mysqli_fetch_array($users)) {
														echo "<tr><td>{$row['user_fname']}</td><td>{$row['user_name']}</td><td>{$row['user_email']}</td><td><a href=\"phpscripts/caller.php?caller_id=delete&id={$row['user_id']}\">Delete<i style=\"margin-left:5px\"class=\"fas fa-trash-alt\"></i></a></td></tr>";
													}
												?>											    
											</tbody>
										</table>										
									</div>
									<div class="medium-12 cell">
										<a href="admin_index.php" class="button large">Go Back</a>
									</div>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</body>
	<!-- Compressed JQuery & Foundation JavaScript -->
	<script src="http://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/foundation/6.4.3/js/foundation.min.js"></script>
</html>