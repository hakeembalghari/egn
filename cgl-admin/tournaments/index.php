<?php
ob_start();
include_once('common.php');
require_once('config.php');

//include_once('common.php');
	date_default_timezone_set('America/New_York');
	include_once('perms.php');
	if(!is_logged() && $_GET["p"] !== "login"){
		header("Location: http://www.electronicgaming.net/beta/cgl-admin/login");
//die();
	}
	//if(!isset($_SESSION['user']))
	//{
	//header("Location: http://www.electronicgaming.net/beta/cgl-admin/login");
	//}
		
	include('default/header.php');
	if(!isset($_GET["p"])) {
		include('pages/tournaments.php');
	} else if(file_exists('pages/'.$_GET["p"].'.php')) {
		include('pages/'.$_GET["p"].'.php');	
	} else {
		include('default/404.php');	
	}

	include('default/footer.php');
?>
	
	
	
	
