<?php
	session_start();

	if (!isset($_SESSION['username'])) {
		$_SESSION['msg'] = "You must log in first";
		header('location: login.php');
	}

	if (isset($_GET['logout'])) {
		session_destroy();
		unset($_SESSION['username']);
		header("location: login.php");
	}

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<?php
		include "homepage.php";
	?>
</head>
<body>
	<div class="header">
	</div>
	<div class="content">

		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<!-- @ suppresses meaningless warning-->
		<?php  if (isset($_SESSION['username'])) :
			@header("Location: /distweb/homepage.php");
		endif ?>
	</div>

</body>
</html>
