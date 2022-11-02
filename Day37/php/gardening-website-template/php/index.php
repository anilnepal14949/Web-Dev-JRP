<?php
	$url = $_SERVER["REQUEST_URI"];
	$url_parts = explode('/', $url);
    $page = $url_parts[1];
    $page_words = explode("_", $page);
    
    if(!empty($page_words[1])) {
        $pageName = ucwords($page_words[0]." ".$page_words[1]); 
    } else {
    	$pageName = ucwords($page_words[0]);
    }

    if($page == "") { $page = "home"; }

    if(!file_exists($page.'.php')) {
    	$page = "404";
    	$pageName = "Page Not Found";
    }

	include_once 'includes/head.inc';
    include_once 'includes/topbar.inc';
    include_once 'includes/navbar.inc';

    include_once $page.".php";

    include_once 'includes/footer.inc';
    include_once 'includes/footer_bottom.inc';