<?php
	// include_once("include_this.php");
	// includeThis();
	// echo "<br>";
	// require_once("include_that.inc");
	// echo "<br>";
	// include_once("include_this.php");
	// includeThis();
	// $file = fopen($file_path, "r");
	// fwrite($file, "Created by PHP & HTML & CSS");

	// $file_path = "test.txt";
	// if(file_exists($file_path)) {
	// 	unlink($file_path);
	// } else {
	// 	file_put_contents($file_path, "Let's say this and that");
	// }

	// if(isset($_SESSION["username"])) {
	// 	echo "Hello, ".$_SESSION["username"]."!";
	// 	echo "<a href='logout.php'> Logout </a>";
	// } else {
	// 	echo "Hello, User!";
	// 	echo '<a href="login.php"> Login </a>';
	// }

?>
<?php 
include_once 'includes/header.inc';

if(isset($_SESSION['username'])):
	echo "Hello, ".$_SESSION['username'];
	echo '<a href="logout.php"> Logout </a>';
else: ?> 
	<form action="process.php" method="post">
		<label for="username"> Username </label>
		<input type="text" name="username" id="username">
		<label for="password"> Password </label>
		<input type="password" name="password" id="password">
		<input type="submit" value="Login">
	</form>
<?php 
endif; 
include_once 'includes/footer.inc';
?>
