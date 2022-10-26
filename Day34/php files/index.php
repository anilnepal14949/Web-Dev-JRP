<?php
	session_start();
	$_SESSION['title'] = "Index";
	include_once 'includes/header.inc';
	if(isset($_SESSION['username'])) {
		echo "Successfully logged in!";
		echo "<h3> Hello ".$_SESSION['username']."</h3>";
		echo "<a href='logout.php'> Logout </a>";
	} else {
		header('location: login.php');
	}
	include_once 'includes/footer.inc';
?>