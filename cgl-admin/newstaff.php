<?PHP
	include('common.php');
	if(!is_logged()){
		redirect("login");
	}
	
	$query = " 
    	INSERT INTO pm_staff VALUES (null, :name, :email, :position, :placement);
    "; 
	$query_params = array( 
            ':name' => $_POST["name"],
			':email' => $_POST["email"],
			':position' => $_POST["position"],
			':placement' => $_POST["placement"]
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