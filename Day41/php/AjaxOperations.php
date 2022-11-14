<?php

include 'admin.php';
$admin = new Admin;

$action = $admin->getIssetValue($_GET["action"]);

switch($action) {
	case "populateData":
		$table = $admin->getIssetValue($_POST["table"]);
		$search = $admin->getIssetValue($_POST["search"]);
		$sort = $admin->getIssetValue($_POST["sort"]);
		$limit = $admin->getIssetValue($_POST["limit"]);

		$orderField = explode('-', $sort)[0];
		$orderType = explode('-', $sort)[1];
		
		$filters = ["search"=>$search, "field1"=>'name', "field2"=>'email', "orderField"=>$orderField, "orderType"=>$orderType, "limit"=>$limit];

		$data = $admin->getSearchedRecords($table, $filters);
		$result = "";

		if(!empty($data)):
			foreach($data as $row):
				$result .= "<tr>
					<td>".$row["id"]."</td>
					<td>".$row["name"]."</td>
					<td>".$row["email"]."</td>
					<td>".$row["created_at"]."</td>
					<td><a href='#/' onclick='editThis(".$row["id"].")'>EDIT</a></td>
					<td><a href='#/' onclick='deleteThis(".$row["id"].")'>DELETE</a></td>
				</tr>";
			endforeach;
		else:
			$result .= "<tr>
				<th colspan='6' style='font-size: 1.2rem; color:red;'> No records found! </th>
			</tr>";
		endif;

		echo $result;
		break;

	case 'insert':
		$name = $admin->getIssetValue($_POST["name"]);
		$email = $admin->getIssetValue($_POST["email"]);

		$data = ["name"=>$name, "email"=>$email];

		if($admin->addRecords("test", $data)) {
			echo "Successfully Inserted";
		}

		break;

	case 'edit':
		$id = $admin->getIssetValue($_POST["id"]);

		$data = $admin->getRecordByID("test", $id);

		echo json_encode($data);
		break;

	case 'update':
		$id = $admin->getIssetValue($_POST["id"]);
		$name = $admin->getIssetValue($_POST["name"]);
		$email = $admin->getIssetValue($_POST["email"]);

		$data = ["name"=>$name, "email"=>$email];
		$check = ["id"=>$id];

		if($admin->updateRecords("test", $data, $check)) {
			echo "Successfully Updated";
		}

		break;

	case 'delete':
		$id = $admin->getIssetValue($_POST["id"]);

		if($admin->deleteRecord("test", "id", $id)) {
			echo "Successfully Deleted";
		}

		break;
}