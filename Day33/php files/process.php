<?php
session_start();
$username = $_POST['username'];
$password = $_POST['password'];

if($username == "john" && $password == "password") {
	$_SESSION["username"] = $username;
	header('location: index.php');
} else {
	header('location: index.php');
}