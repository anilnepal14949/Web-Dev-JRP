<?php

	include_once 'admin.php';
  	$admin = new Admin;

  	$action = $admin->getValue($_GET['action']);

  	switch($action) {
  		case 'add_menu':
  			$menu_title = $admin->getValue($_POST["menu_title"]);
  			$menu_link = $admin->getValue($_POST["menu_link"]);
  			$parent_menu = $admin->getValue($_POST["parent_menu"]);

  			$data = ["menu_title"=>$menu_title, "menu_link"=>$menu_link, "parent_menu"=>$parent_menu];

  			if($admin->addRecords("menu", $data)) {
  				header("location: menu?response=success&type=add");
  			} else {
  				header("location: menu?response=failed&type=add");
  			}

  			break;

  		case 'add_banner':
  			$banner_title = $admin->getValue($_POST["banner_title"]);
  			$banner_desc = $admin->getValue($_POST["banner_desc"]);

  			$data = ["banner_title"=>$banner_title, "banner_desc"=>$banner_desc];

  			if(isset($_FILES["banner_image"])) {
  				$banner_image = $_FILES['banner_image'];

  				$uploaded_image = $admin->uploadFile($banner_image, ROOT."/images/banner/");

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
  			$id = $admin->getValue($_GET["id"]);
  			$page = $admin->getValue($_GET["page"]);

  			header("location: $page?action=edit&id=".$id);
  			break;

  		case 'update_menu':	
  			$menu_id = $admin->getValue($_GET["id"]);
  			$menu_title = $admin->getValue($_POST["menu_title"]);
  			$menu_link = $admin->getValue($_POST["menu_link"]);
  			$parent_menu = $admin->getValue($_POST["parent_menu"]);

  			$data = ["menu_title"=>$menu_title, "menu_link"=>$menu_link, "parent_menu"=>$parent_menu];
  			$check = ["id"=>$menu_id];

  			if($admin->updateRecords("menu", $data, $check)) {
  				header("location: menu?response=success&type=update");
  			} else {
  				header("location: menu?response=failed&type=update");
  			}
  			break;

  		case 'update_banner':	
  			$id = $admin->getValue($_GET["id"]);
  			$banner_title = $admin->getValue($_POST["banner_title"]);
  			$banner_desc = $admin->getValue($_POST["banner_desc"]);
  			$banner_image = $admin->getValue($_FILES["banner_image"]);

  			$data = ["banner_title"=>$banner_title, "banner_desc"=>$banner_desc];
  			$check = ["id"=>$id];

  			$banner = $admin->getRecordByID("banner", $id);
  			$banner = $banner[0];

  			if(isset($_FILES["banner_image"]) && $banner_image["error"] == 0) {
  				if(file_exists(ROOT."/images/banner/".$banner["banner_image"])) {
  					unlink(ROOT."/images/banner/".$banner["banner_image"]);
  				}

  				$uploaded_image = $admin->uploadFile($banner_image, ROOT."/images/banner/");

  				if($uploaded_image != '') {
  					$data["banner_image"] = $uploaded_image;
  				}
  			}

  			if($admin->updateRecords("banner", $data, $check)) {
  				header("location: banner?response=success&type=update");
  			} else {
  				header("location: banner?response=failed&type=update");
  			}

  			break;

  		case 'delete_item':
  			$table = $admin->getValue($_GET["table"]);
  			$field = $admin->getValue($_GET["field"]);
  			$id = $admin->getValue($_GET["id"]);

  			if($admin->deleteRecord($table, $field, $id)) {
  				header("location: menu?response=success&type=delete");
  			} else {
  				header("location: menu?response=failed&type=delete");
  			}
  			break;

  		case 'delete_banner':
  			$table = $admin->getValue($_GET["table"]);
  			$field = $admin->getValue($_GET["field"]);
  			$id = $admin->getValue($_GET["id"]);

  			$banner = $admin->getRecordByID("banner", $id);
  			$banner = $banner[0];

  			if($admin->deleteRecord($table, $field, $id)) {
  				if(file_exists(ROOT."/images/banner/".$banner["banner_image"])) {
  					unlink(ROOT."/images/banner/".$banner["banner_image"]);
  				}
  				header("location: banner?response=success&type=delete");
  			} else {
  				header("location: banner?response=failed&type=delete");
  			}
  			break;

  		case 'change_order':
  			$page = $admin->getValue($_GET["page"]);
  			$table = $admin->getValue($_GET["table"]);
  			$field = $admin->getValue($_GET["field"]);
  			$id = $admin->getValue($_GET["id"]);
  			$order = $admin->getValue($_GET["order"]);

  			$data = [$field=>$order];
  			$check = ["id"=>$id];

  			if($admin->updateRecords($table, $data, $check)) {
  				header("location: $page?response=success&type=order");
  			} else {
  				header("location: $page?response=failed&type=order");
  			}
  			break;
  	}