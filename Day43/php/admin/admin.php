<?php

include 'database.php';

define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

class Admin {
	use Database;

	public function getRecordsBySQL($sql) {
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getAllRecords($table) {
		$sql = "SELECT * FROM $table";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getSingleRecord($table) {
		$sql = "SELECT * FROM $table ORDER BY id DESC LIMIT 1";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getSearchedRecords($table, $data) {
		$field = $data["field"];
		$search = $data["search"];
		$orderField = $data["orderField"];
		$orderType = $data["orderType"];
		$limit = $data["limit"];

		$limitSQL = "";
		if($limit != "") {
			$limitSQL = "LIMIT $limit";
		}

		$sql = "SELECT * FROM $table WHERE $field LIKE '%$search%' ORDER BY $orderField $orderType $limitSQL";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getAllRecordsByFieldName($table, $fieldName, $value) {
		$sql = "SELECT * FROM $table WHERE $fieldName=:value";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute(['value'=>$value]);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getAllOrderedRecords($table, $orderField, $orderType) {
		$sql = "SELECT * FROM $table ORDER BY $orderField $orderType";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function getRecordByID($table, $id) {
		$sql = "SELECT * FROM $table WHERE id=$id LIMIT 1";

		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return $result;
	}

	public function addRecords($table, $data) {
		$keys = $this->getArrayKeys($data);
		$values = $this->getArrayValues($data);

		$sql = "INSERT INTO $table ($keys) VALUES ($values)";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		$id = $this->conn->lastInsertId();

		return $id;
	}

	public function updateRecords($table, $data, $check) {
		$keys = explode(", ", $this->getArrayKeys($data));
		$values = explode(", ", $this->getArrayValues($data));

		$checkField = implode("",array_keys($check));
		$checkValue = implode("",array_values($check));

		$fields = "";
		for($i=0;$i<count($values);$i++) {
			$fields .= $keys[$i]."=".$values[$i].", ";
		}
		
		$fields = trim($fields, ", ");

		$sql = "UPDATE $table SET $fields WHERE $checkField=$checkValue";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return true;
	}

	public function deleteRecord($table, $field, $value) {
		$sql = "DELETE FROM $table WHERE $field=$value";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();

		return true;
	}

	public function uploadFile($file, $target_dir) {
		$target_file = $target_dir.basename($file["name"]);
		
		if(move_uploaded_file($file["tmp_name"], $target_file)) {
			return basename($file["name"]);
		} else {
			echo "Sorry, there was an error uploading your file.";
			exit;
		}
	}

	public function getArrayKeys($data) {
		return implode(", ", array_keys($data));
	}

	public function getArrayValues($data) {
		return "'".implode("', '", array_values($data))."'";
	}

	public function show($data) {
		echo '<pre>';
		print_r($data);
		echo '</pre>';
	}

	public function getValue($data) {
		if(isset($data)) return $data;
		return "";
	}
}

// $admin = new Admin;
// $sql = "SELECT * FROM test";
// $data = $admin->getRecordByID("test", 12);
// $admin->show($data);

// $arr = ["name"=>"Hello", "email"=>"hello@hello.com"];
// $check = ["id"=>12];
// $admin->show($admin->updateRecords("test", $arr, $check));