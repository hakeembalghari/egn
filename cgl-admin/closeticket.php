<?PHP
	include('common.php');
	if(!is_logged()){
		redirect("login");
	}
	
	if(!isset($_POST["s"])){
		header("Location: tickets");
	}

	$query = " 
    	UPDATE tickets SET closed = 1 WHERE id = :s
    "; 
	$query_params = array( 
            ':s' => $_GET["s"]
        ); 
    try 
    {
        $stmt = $db->prepare($query); 
        $stmt->execute($query_params); 
    } 
    catch(PDOException $ex) 
    {  
        die("Failed to run query: " . $ex->getMessage()); 
    } 
	header("Location: viewticket?s=".$_GET["s"]."");
	die();
?>