<?php 

    require("common.php"); 
     
    unset($_SESSION['user']); 
     
    // We redirect them to the login page 
    header("Location: login"); 
    die("Redirecting to the home page.");
	?>
	
    
 
