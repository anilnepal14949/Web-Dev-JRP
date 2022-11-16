<?php
  session_start();
  
  $url = $_SERVER['REQUEST_URI'];
  $url_parts = explode("/", $url);
  $page = end($url_parts); // reset($url_parts);
  $query = explode("?", $page);
  if($query != '') {
    $page = $query[0];
  }
    
  if($page == "") { $page = "home"; }

  if(!isset($_SESSION["username"])) {
    include_once 'login.php';  
  } else if($page == "logout") {
    if(isset($_SESSION["username"])) {
      unset($_SESSION["username"]);
      header("location: /admin/login");
    }
  } else {
    include_once 'includes/head.inc';
    include_once 'includes/header.inc';
    include_once 'includes/sidebar.inc';
    include_once $page.'.php';  
    include_once 'includes/footer.inc';
  }
?>