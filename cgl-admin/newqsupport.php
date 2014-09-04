<?PHP
	include('common.php');
	if(!is_logged()){
		redirect("login");
	}
	
	$query = " 
    	INSERT INTO pm_support VALUES (null, :question, :answer);
    "; 
	$query_params = array( 
            ':question' => $_POST["question"],
			':answer' => $_POST["answer"]
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
	header("Location: msupport");
?>