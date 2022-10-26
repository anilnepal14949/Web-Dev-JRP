<?php
	session_start();
	$_SESSION['title'] = "Login Form";
	include_once 'includes/header.inc';

	if(isset($_SESSION['username'])) {
		header('location: index.php');
	}

	// define variables and set to empty values
	$emailErr = $passwordErr = $loginError = "";
	$email = $password = "";

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$email = test_input($_POST["email"]);
		$password = test_input($_POST["password"]);
		
		if(empty($email)) {
			$emailErr = "Email is required";
		} else {
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid Email Format";
			}
		}

		if(empty($password)) {
			$passwordErr = "Password is required";
		}

		if(($emailErr || $passwordErr) == "") {
			if($email == "admin@nepal.com" && $password == "nepal123") {
				$_SESSION["username"] = "Admin";
				header('location: index.php');
			} else {
				$loginError = "Invalid Email or Password";
			}
		}
	}
?>
	<div class="container">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
			<h2> Login Form </h2>
			<div class="form-group">
				<label for="email"> Email: </label>
				<input type="text" name="email" id="email" placeholder="Enter Email..." value="<?=$email?>">
				<p class="error"><?= $emailErr ?></p>
			</div>
			<div class="form-group">
				<label for="password"> Password: </label>
				<input type="password" name="password" id="password" placeholder="Enter Password..." value="<?=$password?>">
				<p class="error"><?= $passwordErr ?></p>
			</div>
			<div class="form-group">
				<div class="error"><?=$loginError?></div>
				<input type="submit" value="Login">
				<input type="button" value="Create New Account" onclick="location.href='register.php'">
			</div>
		</form>
	</div>
<?php
	include_once 'includes/footer.inc';
?>
	
