<?php 
	include_once('common.php');
	date_default_timezone_set('America/New_York');
	include_once('perms.php');
	if(!is_logged() && $_GET["p"] !== "login"){
		header("Location: login");
		die();
	}
	include('default/header.php');
	if(!isset($_GET["p"])) {
		include('pages/home.php');
	} else if(file_exists('pages/'.$_GET["p"].'.php')) {
		include('pages/'.$_GET["p"].'.php');	
	} else {
		include('default/404.php');	
	}

	include('default/footer.php');
	
?>