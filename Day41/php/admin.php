<?php

include 'database.php';

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

    public function getSearchedRecords($table, $data) {
        $field1 = $data["field1"];
        $field2 = $data["field2"];
        $search = $data["search"];
        $orderField = $data["orderField"];
        $orderType = $data["orderType"];
        $limit = $data["limit"];
        $limitSQL = '';
        if($limit != "") { $limitSQL = " LIMIT $limit"; }

        if($field2 == "") {
            $sql = "SELECT * FROM $table WHERE id<>0 AND $field1 LIKE '%$search%' ORDER BY ".$orderField." ".$orderType.$limitSQL;
        } else {
            $sql = "SELECT * FROM $table WHERE id<>0 AND ($field1 LIKE '%$search%' OR $field2 LIKE '%$search%') ORDER BY ".$orderField." ".$orderType.$limitSQL;
        }
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
    
    public function getAllOrderedRecords($table, $order_field, $order_type) {
        $sql = "SELECT * FROM $table ORDER BY $order_field $order_type";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }
    
    public function getAllRecordsByRange($table, $fieldName, $value1, $value2) {
        $sql = "SELECT * FROM $table WHERE $fieldName >= :value1 AND $fieldName <= :value2";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['value1'=>$value1, 'value2'=>$value2]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getAllRecordsWithLimit($table, $limit) {
        $sql = "SELECT * FROM $table LIMIT $limit";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getRecordByFieldName($table, $fieldName, $value) {
        $sql = "SELECT * FROM $table WHERE $fieldName=:value LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['value'=>$value]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }

    public function getRecordByID($table, $id) {
        $sql = "SELECT * FROM $table WHERE id=:id LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id'=>$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result;
    }


    public function addRecords($table, $data) {
        $fields = $this->getArrayKeys($data);
        $values = $this->getArrayValues($data);

        $sql = "INSERT INTO $table ($fields) VALUES ($values)";
        // $this->dump_data($sql);
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();   
        $id = $this->conn->lastInsertId();

        return $id;
    }

    public function updateRecords($table, $data, $check) {
        $fields = explode(', ', $this->getArrayKeys($data));
        $values = explode(', ', $this->getArrayValues($data));
        $checkField = $this->getArrayKey($check);
        $checkValue = $this->getArrayValue($check);

        // $this->dump_data($fields);
        for($i=0;$i<count($values);$i++) {
            $sql = "UPDATE $table SET $fields[$i]=$values[$i] WHERE $checkField=$checkValue";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
        }
        
        return true;

    }

    public function deleteRecord($table, $field, $value) {
    	$sql = "DELETE FROM $table WHERE $field=$value";

    	$stmt = $this->conn->prepare($sql);
    	$stmt->execute();

    	return true;
    }

    public function show($data) {
    	echo "<pre>";
    	print_r($data);
    	echo "</pre>";
    }

    // check input
    public function clean_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    public function getIssetValue($data) {
        if(isset($data)) return $data;
        return false;
    }

    public function getArrayKeys($data) {
        return implode(', ', array_keys($data));
    }

    public function getArrayValues($data) {
        return "'" . implode("', '", array_values($data)) ."'";
    }

    public function getArrayKey($data) {
        return implode('', array_keys($data));
    }

    public function getArrayValue($data) {
        return implode('', array_values($data));
    }
}
