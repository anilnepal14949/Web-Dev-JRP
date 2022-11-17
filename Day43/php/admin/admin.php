<?php

include 'database.php';

define("ROOT", $_SERVER["DOCUMENT_ROOT"]);

require_once ROOT.'/phpmailer/src/Exception.php';
require_once ROOT.'/phpmailer/src/SMTP.php';
require_once ROOT.'/phpmailer/src/PHPMailer.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

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

    public function sendEmail($data) {
        $mail = new PHPMailer(true);
        $html = "";

        try {
            //Server settings
            $mail->SMTPDebug = 3;
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'your@gmail.com';
            $mail->Password   = 'yourpassword';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            //Recipients
            $mail->setFrom('your@gmail.com', 'Email Testing');
            $mail->addAddress("your@gmail.com");

            //Content
            $mail->isHTML(true);
            $mail->Subject = 'Here is the subject';
            $mail->Body    = 'This is the HTML message body';

            if($mail->send()) {
                return true;
            } else {
                echo $mail->ErrorInfo;
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        return false;
    }

    public function uploadFile($file) {
        $target_dir = ROOT."/images/";
        $target_file = $target_dir . basename($file["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            echo "Sorry, file already exists.";
            $uploadOk = 0;
        }

        // Check file size
        if ($file["size"] > 500000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif" ) {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($file["tmp_name"], $target_file)) {
                return basename($file["name"]);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
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
