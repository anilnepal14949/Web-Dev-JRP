<?php
include 'admin.php';
$admin = new Admin;

$action = $admin->getIssetValue($_GET["action"]);

switch ($action) {
	case 'add_menu':
		$menu_title = $admin->getIssetValue($_POST["menu_title"]);
		$menu_link = $admin->getIssetValue($_POST["menu_link"]);
		$parent_menu = $admin->getIssetValue($_POST["parent_menu"]);

		if($parent_menu == ""): 
			$parent_menu = 0;
		endif;

		$data = ["menu_title"=>$menu_title, "menu_link"=>$menu_link, "parent_menu"=>$parent_menu];

		if($admin->addRecords("menu", $data)) {
			header("location: menu?response=success&type=add");
		} else {
			header("location: menu?response=failed&type=add");
		}

		break;

	case 'add_banner':
		$banner_title = $admin->getIssetValue($_POST["banner_title"]);
		$banner_desc = $admin->getIssetValue($_POST["banner_desc"]);

		$data = ["banner_title"=>$banner_title, "banner_desc"=>$banner_desc];

		if(isset($_FILES["banner_image"])) {
			$banner_image = $_FILES["banner_image"];
			
			$uploaded_image = $admin->uploadFile($banner_image);

			if($uploaded_image != '') {
				$data["banner_image"] = $uploaded_image;

				if($admin->addRecords("banner", $data)) {
					header("location: banner?response=success&type=add");
				} else {
					header("location: banner?response=failed&type=add");
				}
			}
		}

		break;

	case 'edit_item':
		$id = $admin->getIssetValue($_GET["id"]);
		$page = $admin->getIssetValue($_GET["page"]);
		header("location: $page?action=edit&id=".$id);
		break;

	case 'update_menu':
		$menu_id = $admin->getIssetValue($_GET["id"]);
		$menu_title = $admin->getIssetValue($_POST["menu_title"]);
		$menu_link = $admin->getIssetValue($_POST["menu_link"]);
		$parent_menu = $admin->getIssetValue($_POST["parent_menu"]);

		if($parent_menu == ""): 
			$parent_menu = 0;
		endif;

		$data = ["menu_title"=>$menu_title, "menu_link"=>$menu_link, "parent_menu"=>$parent_menu];
		$check = ["id"=>$menu_id];

		if($admin->updateRecords("menu", $data, $check)) {
			header("location: menu?response=success&type=update");
		} else {
			header("location: menu?response=failed&type=update");
		}

		break;

	case 'delete_item':
		$table = $admin->getIssetValue($_GET["table"]);
		$field = $admin->getIssetValue($_GET["field"]);
		$id = $admin->getIssetValue($_GET["id"]);

		if($admin->deleteRecord($table, $field, $id)) {
			header("location: menu?response=success&type=delete");
		} else {
			header("location: menu?response=failed&type=delete");
		}
		break;

	case 'change_order':
		$page = $admin->getIssetValue($_GET["page"]);
		$table = $admin->getIssetValue($_GET["table"]);
		$field = $admin->getIssetValue($_GET["field"]);
		$id = $admin->getIssetValue($_GET["id"]);
		$order = $admin->getIssetValue($_GET["order"]);

		$data = [$field=>$order];
		$check = ["id"=>$id];

		if($admin->updateRecords($table, $data, $check)) {
			header("location: $page?response=success&type=order");
		} else {
			header("location: $page?response=failed&type=order");
		}

		break;

	case 'contact':
		$full_name = $admin->getIssetValue($_POST["full_name"]);
		$email = $admin->getIssetValue($_POST["email"]);
		$phone_number = $admin->getIssetValue($_POST["phone_number"]);
		$message = $admin->getIssetValue($_POST["message"]);

		$data = ["full_name"=>$full_name, "email"=>$email, "phone_number"=>$phone_number, "message"=>$message, "date"=>date('Y-m-d H:i:s')];

		if($admin->addRecords("messages", $data)) {
			header("location: /#contact?response=success");
		} else {
			header("location: /#contact?response=failed");
		}

		break;

}