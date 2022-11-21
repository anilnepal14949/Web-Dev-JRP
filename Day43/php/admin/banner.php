<?php
  include_once 'includes/head.inc';
  include_once 'includes/header.inc';
  include_once 'includes/sidebar.inc';

  $banners = $admin->getAllRecords("banner");

  $alertClasses = $alertMessage = "";
  $response = isset($_GET["response"])?$_GET["response"]:"";
  $type = isset($_GET["type"])?$_GET["type"]:"";

  if($response == "success") {
    $alertClasses = "alert-success bg-success";
    if($type == "add") {
      $alertMessage = "Banner added successfully";
    } else if($type == "update") {
      $alertMessage = "Banner updated successfully";
    } else if($type == "delete") {
      $alertMessage = "Banner deleted successfully";
    } else if($type == "order") {
      $alertMessage = "Banner order updated successfully";
    }
  } else if($response == "failed") {
    $alertClasses = "alert-danger bg-danger";
    if($type == "add") {
      $alertMessage = "Error adding banner";
    } else if($type == "update") {
      $alertMessage = "Error updating banner";
    } else if($type == "delete") {
      $alertMessage = "Error deleting banner";
    } else if($type == "order") {
      $alertMessage = "Error updating banner order";
    }
  }

  $action = isset($_GET["action"])?$_GET["action"]:"";
  $id = isset($_GET["id"])?$_GET["id"]:"";

  $form_action = "actions.php?action=add_banner";
  $banner_title = $banner_desc = $banner_image = "";
  if($action == "edit") {
    $banner = $admin->getRecordByID("banner", $id);
    $banner = $banner[0];
    $banner_title = $banner["banner_title"];
    $banner_desc = $banner["banner_desc"];
    $banner_image = $banner["banner_image"];

    $form_action = "actions.php?action=update_banner&id=".$id;
  }
?>
  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Banner</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Banner</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-4">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?= ($action == "edit")?'Edit':'Add' ?> Banner</h5>
              <?php if($response != ''): ?>
              <div class="alert <?=$alertClasses?> text-light border-0 alert-dismissible fade show" role="alert">
                <?=$alertMessage?>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              <?php endif; ?>
              <form class="row g-3" method="post" action="<?=$form_action?>" enctype="multipart/form-data">
                <div class="col-12">
                  <label for="banner_title" class="form-label">Banner Title</label>
                  <input type="text" class="form-control" name="banner_title" id="banner_title" placeholder="Enter Banner Title" value="<?=$banner_title?>">
                </div>
                <div class="col-12">
                  <label for="banner_link" class="form-label">Banner Description</label>
                  <input type="text" class="form-control" name="banner_desc" id="banner_desc" placeholder="Enter Banner Description" value="<?=$banner_desc?>">
                </div>
                <div class="col-12">
                  <label for="banner_image" class="form-label">Banner Image</label>
                  <input type="file" class="form-control" name="banner_image" id="banner_image">
                </div>
                <?php if($action == "edit") { ?>
                  <div class="col-12">
                    <img src="../../images/banner/<?=$banner['banner_image']?>" width="100">
                  </div>
                <?php } ?>
                <div>
                  <button type="submit" class="btn btn-primary"><?= ($action == "edit")?'Update':'Add' ?> Banner</button>
                  <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="col-lg-8">
          <div class="card overflow-auto">
            <div class="card-body">
              <h5 class="card-title">All Banner Items </h5>
              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Banner Title</th>
                    <th scope="col">Banner Desc</th>
                    <th scope="col">Banner Image</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                    if(empty($banners)):
                  ?>
                    <tr>
                      <th colspan="6" class="text-center"> No banner found. Please add some banner items first! </th>
                    </tr>
                  <?php
                    else:
                    foreach($banners as $banner):
                  ?> 
                      <tr>
                        <td><?=$banner["id"]?></td>
                        <td><?=$banner["banner_title"]?></td>
                        <td><?=$banner["banner_desc"]?></td>
                        <td><?=$banner["banner_image"]?></td>
                        <td><a href="actions.php?action=edit_item&page=banner&id=<?=$banner['id']?>" class="btn btn-info"><i class="bi bi-pencil"></i></a><a href="actions.php?action=delete_banner&table=banner&field=id&id=<?=$banner['id']?>" onclick="del(this)" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
                      </tr>
                  <?php
                      endforeach;
                    endif;
                  ?>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </section>

  </main><!-- End #main -->

  <?php include_once 'includes/footer.inc'; ?>