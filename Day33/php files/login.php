<?php
	session_start();
	$_SESSION["username"] = "John";
	// echo $_SESSION["username"];
	header('location: index.php');
?>