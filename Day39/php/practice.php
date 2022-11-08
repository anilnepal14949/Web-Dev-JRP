<?php

// the parameters are servername, username and password
// $conn = new mysqli("localhost", "root", "", "practice");

// if($conn->connect_errno) {
// 	die("Connection failed");
// }

// echo "Connected Successfully";

// $getDataSQL = "SELECT * FROM test ORDER BY id DESC LIMIT 5";
// $data = $conn->query($getDataSQL);
// echo "<table>";
// echo "<tr><th> ID </th><th> NAME </th><th> EMAIL </th></tr>";
// if($data->num_rows > 0) {
// 	while($row = $data->fetch_assoc()) {
// 		echo "<tr><td>".$row["id"]."</td><td>".$row["name"]."</td><td>".$row["email"]."</td></tr>";
// 	}
// 	echo "<table>";
// } else {
// 	echo "No data retrieved";
// }

// $updateSQL = "UPDATE test SET name='Bird', email='bird@gmail.com' WHERE id=3";
// if($conn->query($updateSQL)) {
// 	echo "Data updated successfully";
// } else {
// 	echo "Data updation failed";
// }

// $deleteSQL = "DELETE FROM test WHERE email LIKE '%email%'";
// if($conn->query($deleteSQL)) {
// 	echo "Data deleted successfully";
// } else {
// 	echo "Data deletion failed";
// }

// $conn->close();