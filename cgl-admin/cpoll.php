<?PHP
	include('common.php');
	if(!is_logged()){
		redirect("login");
	}
	
	$decarrays = explode(",", $_POST["choices"]);
	
	$jsondec = json_encode($decarrays);
	
	$query = " 
    	INSERT INTO polls VALUES (null,:name,:decisions)
    "; 
	$query_params = array( 
            ':name' => $_POST["title"],
			':decisions' => $jsondec
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
	
	
	
	$query = " 
    	SELECT id FROM polls WHERE decisions = '".$jsondec."'
    ";  
    try 
    {
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    {  
        die("Failed to run query: " . $ex->getMessage()); 
    }
	$getid = $stmt->fetch();
	
	foreach($decarrays as $decarray){
		
	$query = " 
    	INSERT INTO poll_results VALUES (null,:belongs,:decarray, 0)
    "; 
	$query_params = array( 
            ':belongs' => $getid["id"],
			':decarray' => $decarray
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
	
	}

			header("Location: polls");
?>