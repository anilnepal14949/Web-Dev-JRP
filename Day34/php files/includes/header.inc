<?php
	$title = isset($_SESSION['title'])?$_SESSION['title']:'Form Validation';
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?=$title?></title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
	<?php
		function test_input($input) {
			$input = trim($input);
			$input = stripslashes($input);
			$input = htmlspecialchars($input);

			return $input;
		}
	?>