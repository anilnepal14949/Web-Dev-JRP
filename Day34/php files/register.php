<?php
	session_start();
	$_SESSION['title'] = "Registration Form";
	include_once 'includes/header.inc';

	// define variables and set to empty values
	$nameErr = $emailErr = $mobileErr = $photoErr = $passwordErr = $confirmPasswordErr = "";
	$name = $email = $mobile = $password = $confirm_password = "";

	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$name = test_input($_POST["name"]);
		$email = test_input($_POST["email"]);
		$mobile = test_input($_POST["mobile"]);
		$password = test_input($_POST["password"]);
		$confirm_password = test_input($_POST["confirm_password"]);
		$photo = isset($_FILES['photo'])?$_FILES['photo']:'';

		if(empty($name)) {
			$nameErr = "Name is required";
		} else {
			if(!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
				$nameErr = "Only letters and white spaces allowed";
			}
		}

		if(empty($email)) {
			$emailErr = "Email is required";
		} else {
			$email = filter_var($email, FILTER_SANITIZE_EMAIL);
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$emailErr = "Invalid Email Format";
			}
		}

		if(empty($mobile)) {
			$mobileErr = "Mobile is required";
		} else {
			if(!preg_match("/^[0-9]+$/", $mobile)) {
				$mobileErr = "Only numbers allowed";
			} else if(strlen($mobile) < 10 || strlen($mobile) > 10) {
				$mobileErr = "Must be 10 Digits";
			}
		}

		if(empty($password)) {
			$passwordErr = "Password is required";
		}

		if(empty($confirm_password)) {
			$confirmPasswordErr = "Password Confirmation is required";
		} else {
			if(!empty($password)) {
				if($password != $confirm_password) {
					$confirmPasswordErr = "Passwords donot match";
				}
			}
		}

		if($photo && $photo["error"] == 0) {
			$allowed = ["jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png"];

			$filename = $photo["name"];
			$filetype = $photo["type"];
			$filesize = $photo["size"];

			$ext = pathinfo($filename, PATHINFO_EXTENSION);
			if(!array_key_exists($ext, $allowed)) {
				$photoErr = "Please select a valid image";
			}

			$maxsize = 5 * 1024 * 1024;
			if($filesize > $maxsize) {
				$photoErr = "Must be less than 5mb";
			}

			if(in_array($filetype, $allowed)) {
				if(file_exists("images/".$filename)) {
					$photoErr = "File Already Exists";
				}
			} else {
				$photoErr = "Please select a valid image";
			}
		} else {
			$photoErr = "Please select an image";
		}

		if(($nameErr || $emailErr || $mobileErr || $photoErr || $passwordErr || $confirmPasswordErr) == "") {
			if(move_uploaded_file($photo["tmp_name"], "images/".$filename)) {
				header("location: login.php");
			} else {
				$photoErr = "Error Uploading File";
			}
		}
	}
?>
	<div class="container">
		<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
			<h2> Register Form </h2>
			<div class="form-group">
				<label for="name"> Name: </label>
				<input type="text" name="name" id="name" placeholder="Enter Full Name..." value="<?=$name?>">
				<p class="error"><?php echo $nameErr; ?></p>
			</div>
			<div class="form-group">
				<label for="email"> Email: </label>
				<input type="text" name="email" id="email" placeholder="Enter Email..." value="<?=$email?>">
				<p class="error"><?= $emailErr ?></p>
			</div>
			<div class="form-group">
				<label for="mobile"> Mobile: </label>
				<input type="text" name="mobile" id="mobile" placeholder="Enter Mobile..." value="<?=$mobile?>" maxlength="10">
				<p class="error"><?= $mobileErr ?></p>
			</div>
			<div class="form-group">
				<label for="password"> Password: </label>
				<input type="password" name="password" id="password" placeholder="Enter Password..." value="<?=$password?>">
				<p class="error"><?= $passwordErr ?></p>
			</div>
			<div class="form-group">
				<label for="confirm_password"> Confirm Password: </label>
				<input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm Password" value="<?=$confirm_password?>">
				<p class="error"><?= $confirmPasswordErr ?></p>
			</div>
			<div class="form-group">
				<label for="photo"> Photo: </label>
				<input type="file" name="photo" id="photo" accept="image/*">
				<p class="error"><?=$photoErr?></p>
				<p><strong> Note: </strong> Only .jpg, .jpeg, .png formats allowed. Max 5mb.</p>
			</div>
			<div class="form-group">
				<input type="submit" value="Register">
				<input type="button" value="Already Have Account?" onclick="location.href='login.php'">
			</div>
		</form>
	</div>
<?php
	include_once 'includes/footer.inc';
?>
	
