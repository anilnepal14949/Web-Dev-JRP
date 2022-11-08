<?php
	require_once 'database.php';
	$message = "";

	$name = $email = "";

	$type = $_GET["type"] ?? $_GET["type"]; 
	$id = $_GET["id"] ?? $_GET["id"]; 

	if(isset($_POST["saveBtn"])) {
		$name = $_POST["name"];
		$email = $_POST["email"];

		$insertSQL = "INSERT INTO test (name, email) VALUES ('$name', '$email')";
		if($conn->query($insertSQL)) {
			$message = "Inserted Successfully";
		} else {
			$message = "Not Inserted";
		}
	}

	if(isset($_POST["updateBtn"])) {
		$name = $_POST["name"];
		$email = $_POST["email"];

		$updateSQL = "UPDATE test SET name='$name', email='$email' WHERE id=$id";
		if($conn->query($updateSQL)) {
			$message = "Updated Successfully";
		} else {
			$message = "Not Updated";
		}
	}

	if($type == "edit") {
		$fetchSingleSQL = "SELECT * FROM test WHERE id=$id LIMIT 1";
		$fetchSingle = $conn->query($fetchSingleSQL);

		$data = $fetchSingle->fetch_assoc();
		$name = $data["name"];
		$email = $data["email"];
	}

	$dataSQL = "SELECT * FROM test";
	$data = $conn->query($dataSQL);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP Crud Practice</title>
	<style>
		.crud {
			width: 30%;
			margin: 0 auto;
		}
		.crud form input {
			width: 100%;
			margin: 10px 0;
		}
		.crud_table {
			width: 30%;
			margin: 0 auto;
		}
		.crud_table table {
			width: 100%;
		}
	</style>
</head>
<body>
	<div class="crud">
		<h1><?php if($type == "edit"): echo 'Edit'; else: echo 'Add'; endif; ?> Data </h1>
		<form method="post" action="<?=htmlspecialchars($_SERVER['PHP_SELF'])?>">
			<div class="form-group">
				<label for="name"> Full Name </label>
				<input type="text" name="name" id="name" placeholder="Enter your name..." value="<?=$name?>" required>
			</div>
			<div class="form-group">
				<label for="email"> Email </label>
				<input type="email" name="email" id="email" placeholder="Enter your email..." value="<?=$email?>" required>
			</div>
			<p><?=$message?></p>
			<input type="submit" name="<?php if($type == "edit"): echo 'updateBtn'; else: echo 'saveBtn'; endif; ?>" value="<?php if($type == "edit"): echo 'Update'; else: echo 'Save'; endif; ?> Data">
		</form>
	</div>
	<div class="crud_table">
		<h1> List of Data </h1>
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>EMAIL</th>
					<th>CREATED DATE</th>
					<th>EDIT#</th>
					<th>DELETE#</th>
				</tr>
			</thead>
			<tbody>
				<?php
					if($data->num_rows > 0):
						while($row = $data->fetch_assoc()):
				?>
						<tr>
							<td><?=$row["id"]?></td>
							<td><?=$row["name"]?></td>
							<td><?=$row["email"]?></td>
							<td><?=$row["created_at"]?></td>
							<td><a href="?type=edit&id=<?=$row['id']?>">EDIT</a></td>
							<td><a href="?type=delete&id=<?=$row['id']?>">DELETE</a></td>
						</tr>
				<?php
						endwhile;
					else:
				?>
					<tr>
						<th colspan="6" style="font-size: 1.2rem; color:red;"> No records found! </th>
					</tr>
				<?php
					endif;
				?>
			</tbody>
		</table>
	</div>
</body>
</html>