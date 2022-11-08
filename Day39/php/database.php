<?php

	$servername = "localhost";
	$username = "root";
	$password = "";
	$database = "practice";

	$conn = new mysqli($servername, $username, $password, $database);

	if($conn->connect_errno) {
		die("Couldn't connect to database");
	}