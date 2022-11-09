<?php
	require_once 'database.php';
	$message = "";

	$name = $email = $id = "";

	$type = isset($_GET["type"])?$_GET["type"]:''; 
	$id = isset($_GET["id"])?$_GET["id"]:''; 
	$search = isset($_GET["search"])?$_GET["search"]:''; 
	$sort = isset($_GET["sort"])?$_GET["sort"]:''; 
	$limit = isset($_GET["limit"])?$_GET["limit"]:''; 

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
		$namee = $_POST["name"];
		$emaill = $_POST["email"];
		$id = $_POST["id"];

		$updateSQL = "UPDATE test SET name='$namee', email='$emaill' WHERE id=$id";
		// echo $updateSQL;

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
		$id = $data["id"];
	}

	if($type == "delete") {
		$deleteSQL = "DELETE FROM test WHERE id=$id";
		$conn->query($deleteSQL);
		header("location: index.php");
	}

	$searchSQL = "";
	if($search != "") {
		$searchSQL = " AND (name LIKE '%$search%' OR email LIKE '%$search%')";
	}

	$sortSQL = " ID ASC";
	if($sort != ""){
		$sort_parts = explode("-", $sort);
		$sortSQL = $sort_parts[0]." ".$sort_parts[1];
	}

	$limitSQL = "";
	if($limit != "") {
		$limitSQL = " LIMIT $limit";
	}

	$dataSQL = "SELECT t.*, t2.id AS tid, t2.user_id, t2.mobile, t2.postcode FROM test t LEFT JOIN test2 t2 ON t.id=t2.user_id WHERE t.id <> 0".$searchSQL." ORDER BY ".$sortSQL.$limitSQL;
	$data = $conn->query($dataSQL);

	$totalDataSQL = "SELECT COUNT(*) AS total_records FROM test WHERE id <> 0".$searchSQL." ORDER BY ".$sortSQL.$limitSQL;
	$totalData = $conn->query($totalDataSQL);
	$totalRecords = $totalData->fetch_assoc();
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
		.searchBox {
			display: flex;
    		justify-content: space-between;
    		margin-bottom: 20px;
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
			<input type="hidden" name="id" value="<?=$id?>">
			<input type="submit" name="<?php if($type == "edit"): echo 'updateBtn'; else: echo 'saveBtn'; endif; ?>" value="<?php if($type == "edit"): echo 'Update'; else: echo 'Save'; endif; ?> Data">
		</form>
	</div>
	<div class="crud_table">
		<h1> List of Data (<?=$totalRecords["total_records"]?> Records) </h1>
		<div class="searchBox">
			<div class="search">
				<input type="search" id="search" name="search" value="<?=$search?>" placeholder="Enter name or email">
				<button type="button" onclick="search()"> Search </button>
			</div>
			<div class="sorting">
				<select name="sort" id="sort" onchange="sortResults(this)">
					<option value="ID-ASC" <?php if($sort == "ID-ASC"): echo "selected"; endif; ?>>ID ASCENDING</option>
					<option value="ID-DESC" <?php if($sort == "ID-DESC"): echo "selected"; endif; ?>>ID DESCENDING</option>
					<option value="CREATED_AT-ASC" <?php if($sort == "CREATED_AT-ASC"): echo "selected"; endif; ?>>DATE ASCENDING</option>
					<option value="CREATED_AT-DESC" <?php if($sort == "CREATED_AT-DESC"): echo "selected"; endif; ?>>DATE DESCENDING</option>
				</select>
			</div>
			<div class="limiting">
				<select name="limit" id="limit" onchange="limit(this)">
					<option value="1" <?php if($limit == "1"): echo "selected"; endif; ?>> 1 </option>
					<option value="5" <?php if($limit == "5"): echo "selected"; endif; ?>> 5 </option>
					<option value="10" <?php if($limit == "10"): echo "selected"; endif; ?>> 10 </option>
					<option value="15" <?php if($limit == "15"): echo "selected"; endif; ?>> 15 </option>
				</select>
			</div>
			<button onclick="location.href='index.php'"> Reset </button>
		</div>
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>NAME</th>
					<th>EMAIL</th>
					<th>CREATED DATE</th>
					<th>MOBILE</th>
					<th>POSTCODE</th>
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
							<td><?=$row["mobile"]?></td>
							<td><?=$row["postcode"]?></td>
							<td><a href="?type=edit&id=<?=$row['id']?>">EDIT</a></td>
							<td><a href="?type=delete&id=<?=$row['id']?>" onclick="deleteThis(this)">DELETE</a></td>
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

	<script>
		function deleteThis(el) {
			event.preventDefault();
			if(confirm("Are you sure to delete?")) {
				location.href = el.href;
			}
		}

		function search() {
			search_value = document.getElementById('search').value;

			if(search_value.trim() == "") {
				location.href = "index.php";
			} else {
				location.href = "index.php?search="+search_value;
			}
		}

		function sortResults(el) {
			sort = el.value;

			location.href = "index.php?sort="+sort;
		}

		function limit(el) {
			location.href = "index.php?limit="+el.value;
		}
	</script>
</body>
</html>