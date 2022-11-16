<?php
  include 'admin.php';
  $admin = new Admin;

  $menus = $admin->getAllRecords("menu");
  $response = isset($_GET["response"])?$_GET['response']:'';
  $type = isset($_GET["type"])?$_GET['type']:'';

  $alertClasses = $alertMessage = "";
  if($response == "success") {
    $alertClasses = "alert-success bg-success";
    if($type == "add") {
      $alertMessage = "Menu added successfully";
    } else if($type == "update") {
      $alertMessage = "Menu updated successfully";
    } else if($type == "delete") {
      $alertMessage = "Menu deleted successfully";
    } else if($type == "order") {
      $alertMessage = "Menu order updated successfully";
    }
  } else if($response == "failed") {
    $alertClasses = "alert-danger bg-danger";
    if($type == "add") {
      $alertMessage = "Error adding menu";
    } else if($type == "update") {
      $alertMessage = "Error updating menu";
    } else if($type == "delete") {
      $alertMessage = "Error deleting menu";
    } else if($type == "order") {
      $alertMessage = "Error updating menu order";
    }
  }

  $action = isset($_GET["action"])?$_GET["action"]:'';
  $id = isset($_GET["id"])?$_GET["id"]:'';

  $menu_title = $menu_link = $parent_menu = "";
  $form_action = "action.php?action=add_menu";

  if($action == "edit") {
    $menu = $admin->getRecordByID("menu", $id);
    $menu_title = $menu["menu_title"];
    $menu_link = $menu["menu_link"];
    $parent_menu = $menu["parent_menu"];

    if($parent_menu == 0) {
      $parent_menu = "";
    }

    $form_action = "action.php?action=update_menu&id=".$id;
  }
?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Menu Page</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item active">Menu</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?= ($action == "edit")?'Edit':'Add' ?> Menu</h5>
            <?php if($response != ''): ?>
            <div class="alert <?= $alertClasses ?> text-light border-0 alert-dismissible fade show" role="alert">
                <?= $alertMessage ?>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            <form class="row g-3" action="<?=$form_action?>" method="post">
              <div class="col-12">
                <label for="menu_title" class="form-label">Menu Title</label>
                <input type="text" class="form-control" id="menu_title" name="menu_title" placeholder="Enter Menu Title" value="<?=$menu_title?>">
              </div>
              <div class="col-12">
                <label for="menu_link" class="form-label">Menu Link</label>
                <input type="text" class="form-control" id="menu_link" name="menu_link" placeholder="Enter Menu Link" value="<?=$menu_link?>">
              </div>
              <div class="col-12">
                <label for="parent_menu" class="form-label">Choose Parent</label>
                <select class="form-select" id="parent_menu" name="parent_menu">
                  <option value="" <?php if($parent_menu == "") { echo "selected"; } ?>>Choose Parent</option>
                  <?php
                    foreach($menus as $menu) {
                      $selected = "";
                      if($parent_menu == $menu["id"]) { $selected = " selected"; } 
                      echo "<option value='".$menu["id"]."'".$selected.">".$menu["menu_title"]."</option>";
                    }
                  ?>
                </select>
              </div>
              <div>
                <button type="submit" class="btn btn-primary"><?= ($action == "edit")?'Update':'Add' ?> Menu</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-8">
        <!-- Menu List -->
        <div class="col-12">
          <div class="card overflow-auto">
            <div class="card-body">
              <h5 class="card-title">All Menu Items </h5>
              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Menu Name</th>
                    <th scope="col">Menu Link</th>
                    <th scope="col">Parent</th>
                    <th scope="col">Order</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(empty($menus)): ?>
                    <tr>
                      <th class="text-center" colspan="4">No menu found. Please add menu first!</th>
                    </tr>
                  <?php else: 
                    foreach($menus as $menu):
                      $parent = '';
                      if($menu["parent_menu"] == 0): 
                        $parent = '-';
                      else:
                        $menu_parent = $admin->getRecordByID('menu', $menu["parent_menu"]);
                        $parent = $menu_parent["menu_title"];
                      endif;
                  ?>
                    <tr>
                      <td><?=$menu["id"]?></td>
                      <td><?=$menu["menu_title"]?></td>
                      <td><?=$menu["menu_link"]?></td>
                      <td><?= $parent ?></td>
                      <td><input type="number" class="order" value='<?= $menu["menu_order"] ?>' onchange="changeOrder('menu', 'menu', <?=$menu['id']?>, 'menu_order', this.value)"></td>
                      <td><a href="action.php?action=edit_item&page=menu&id=<?=$menu['id']?>" class="btn btn-info"><i class="bi bi-pencil"></i></a><a href="action.php?action=delete_item&table=menu&field=id&id=<?=$menu['id']?>" onclick="del(this)" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
                    </tr> 
                  <?php 
                    endforeach;
                  endif; ?>
                </tbody>
              </table>

            </div>

          </div>
        </div><!-- End Recent Sales -->
      </div><!-- End Right side columns -->
    </div>
  </section>

</main><!-- End #main -->