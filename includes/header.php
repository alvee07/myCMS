
<?php
session_start();
//ini_set('display_errors', 1);
	/* Process data submitted by login form */
global $loggedIn;
global $loginError;

$current_page = basename($_SERVER['PHP_SELF']);

?>

<?php require_once "includes/db.php"; ?>
<?php require_once "includes/constants.php"; ?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/mystyles.css">
		<title>myCMS</title>
	</head>
	<body>
		<!-- Container -->
		<div class="container">
			<div class="row">

				<!--************************************************
					Standard Bootstrap Navigation - customized
					for this CMS website assignment
					Available: http://getbootstrap.com/components/#nav
				*************************************************-->
				<header style="padding-bottom: 70px">

				<?php require_once "navigation.php"; ?>


				</header>
