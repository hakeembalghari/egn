<?php 
    error_reporting(E_ERROR | E_PARSE);
	include('config.php');
	include('default/header.php');
	
	if($_GET["p"] == "forums" or $_GET["p"] == "discussion" or $_GET["p"] == "topics" or $_GET['p']=='tv' or $_GET['p']=='settings' or $_GET['p']=='profile' ){ 
		
	} else {
		include('default/sidebar.php');	
	}
	
	if(!isset($_GET["p"])) {
		include('pages/home.php');
	} else if(file_exists('pages/'.$_GET["p"].'.php')) {
		include('pages/'.$_GET["p"].'.php');	
	} else {
		include('default/404.php');	
	}

	include('default/footer.php');
        
?>