<?php
  include 'admin.php';
  $admin = new Admin;

  $banners = $admin->getAllRecords("banner");
  $response = isset($_GET["response"])?$_GET['response']:'';
  $type = isset($_GET["type"])?$_GET['type']:'';

  $alertClasses = $alertMessage = "";
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

  $action = isset($_GET["action"])?$_GET["action"]:'';
  $id = isset($_GET["id"])?$_GET["id"]:'';

  $banner_title = $banner_desc = "";
  $form_action = "action.php?action=add_banner";

  if($action == "edit") {
    $banner = $admin->getRecordByID("banner", $id);
    $banner_title = $banner["banner_title"];
    $banner_desc = $banner["banner_desc"];

    $form_action = "action.php?action=update_banner&id=".$id;
  }
?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Home Banner Page</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/home">Home</a></li>
        <li class="breadcrumb-item active">Banner</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title"><?= ($action == "edit")?'Edit':'Add' ?> Banner</h5>
            <?php if($response != ''): ?>
            <div class="alert <?= $alertClasses ?> text-light border-0 alert-dismissible fade show" role="alert">
                <?= $alertMessage ?>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php endif; ?>
            <form class="row g-3" action="<?=$form_action?>" method="post" enctype="multipart/form-data">
              <div class="col-12">
                <label for="banner_title" class="form-label">Banner Title</label>
                <input type="text" class="form-control" id="banner_title" name="banner_title" placeholder="Enter Banner Title" value="<?=$banner_title?>" required>
              </div>
              <div class="col-12">
                <label for="banner_desc" class="form-label">Banner Description</label>
                <input type="text" class="form-control" id="banner_desc" name="banner_desc" placeholder="Enter Banner Description" value="<?=$banner_desc?>" required>
              </div>
              <div class="col-12">
                <label for="banner_image" class="form-label">Banner Image</label>
                <input type="file" class="form-control" id="banner_image" name="banner_image" required>
                <?php if($action == "edit") { ?>
                  <label for="banner_image" class="form-label">Current Image</label>
                  <img src="../../images/<?=$banner['banner_image']?>" width="100">
                <?php } ?>
              </div>
              <div>
                <button type="submit" class="btn btn-primary"><?= ($action == "edit")?'Update':'Add' ?> Banner</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div><!-- End Left side columns -->

      <!-- Right side columns -->
      <div class="col-lg-8">
        <!-- Banner List -->
        <div class="col-12">
          <div class="card overflow-auto">
            <div class="card-body">
              <h5 class="card-title">All Banner Items </h5>
              <table class="table table-borderless datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col">Banner Name</th>
                    <th scope="col">Banner Description</th>
                    <th scope="col">Image</th>
                    <th scope="col">Actions</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(empty($banners)): ?>
                    <tr>
                      <th class="text-center" colspan="5">No banner found. Please add banner first!</th>
                    </tr>
                  <?php else: 
                    foreach($banners as $banner):
                  ?>
                    <tr>
                      <td><?=$banner["id"]?></td>
                      <td><?=$banner["banner_title"]?></td>
                      <td><?=$banner["banner_desc"]?></td>
                      <td><img src="../../images/<?=$banner['banner_image']?>" width="100"></td>
                      <td><a href="action.php?action=edit_item&page=banner&id=<?=$banner['id']?>" class="btn btn-info"><i class="bi bi-pencil"></i></a><a href="action.php?action=delete_item&table=banner&field=id&id=<?=$banner['id']?>" onclick="del(this)" class="btn btn-danger"><i class="bi bi-trash"></i></a></td>
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