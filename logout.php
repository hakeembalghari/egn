<?php 

    // First we execute our common code to connection to the database and start the session 
    require("common.php"); 
     
    // We remove the user's data from the session 
    
	$Query = "DELETE FROM sessions WHERE UserID='".$_SESSION['user']['id']."'";
	try
	{
		$query = $db->prepare($Query);
		$query->execute();
	}
	catch(PDOException $ex)
	{
	die("Error:".$ex->getMessage());	
	}
	unset($_SESSION['user']);
	
	include("vbulletin4/includes/class.vbulletin-bridge.php");
			$forum = new vBulletin_Bridge();
			
			$forum->logout(); 
     
    // We redirect them to the login page 
    header("Location: home"); 
    die("Redirecting to the home page.");
	?>
	
    
 
