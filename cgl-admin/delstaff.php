<?PHP
	include('common.php');
	if(!is_logged()){
		redirect("login");
	}
	
	$query = " 
    	DELETE FROM pm_staff WHERE id = :s
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
	header("Location: mstaff");
?>