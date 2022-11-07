<?php
  session_start();

  $url = $_SERVER['REQUEST_URI'];
  $url_parts = explode("/", $url);
  $page = end($url_parts); // reset($url_parts);
    
  if($page == "") { $page = "home"; }
  
  if(!isset($_SESSION["username"])) {
    include_once 'login.php';  
  } else {
    include_once $page.'.php';  
  }
?>