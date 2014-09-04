<?PHP
	include('common.php');
	if($_GET["r"] == "mnewscontent"){
		
	$query = " 
        UPDATE pm_news SET contents = :value WHERE id = :pk
    ";      
	$query_params = array(
		':pk' => $_POST["pk"],
		':value' => $_POST["value"]
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
	


	if($_GET["r"] == "mnewstitle"){
		
	$query = " 
        UPDATE pm_news SET title = :value WHERE id = :pk
    ";      
	$query_params = array(
		':pk' => $_POST["pk"],
		':value' => $_POST["value"]
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
	


	if($_GET["r"] == "mstaffname"){
		
	$query = " 
        UPDATE pm_staff SET name = :value WHERE id = :pk
    ";      
	$query_params = array(
		':pk' => $_POST["pk"],
		':value' => $_POST["value"]
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
	
	
	
		if($_GET["r"] == "mstaffemail"){
		
	$query = " 
        UPDATE pm_staff SET email = :value WHERE id = :pk
    ";      
	$query_params = array(
		':pk' => $_POST["pk"],
		':value' => $_POST["value"]
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
	
	
	
	if($_GET["r"] == "mstaffposition"){
		
	$query = " 
        UPDATE pm_staff SET position = :value WHERE id = :pk
    ";      
	$query_params = array(
		':pk' => $_POST["pk"],
		':value' => $_POST["value"]
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
	
	
	
	if($_GET["r"] == "mstaffplacement"){
		
	$query = " 
        UPDATE pm_staff SET placement = :value WHERE id = :pk
    ";      
	$query_params = array(
		':pk' => $_POST["pk"],
		':value' => $_POST["value"]
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
	
	if($_GET["r"] == "msupportcontent"){
		
	$query = " 
        UPDATE pm_support SET answer = :value WHERE id = :pk
    ";      
	$query_params = array(
		':pk' => $_POST["pk"],
		':value' => $_POST["value"]
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
	
	if($_GET["r"] == "msupportquestion"){
		
	$query = " 
        UPDATE pm_support SET question = :value WHERE id = :pk
    ";      
	$query_params = array(
		':pk' => $_POST["pk"],
		':value' => $_POST["value"]
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


	if($_GET["r"] == "mpollname"){
		
	$query = " 
        UPDATE polls SET name = :value WHERE id = :pk
    ";      
	$query_params = array(
		':pk' => $_POST["pk"],
		':value' => $_POST["value"]
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


	if($_GET["r"] == "mpolldecisions"){
	
	$pollarray = explode(",", $_POST["value"]);
	$encodepoll = json_encode($pollarray);
	
	$query = " 
        UPDATE polls SET decisions = :value WHERE id = :pk
    ";      
	$query_params = array(
		':pk' => $_POST["pk"],
		':value' => $encodepoll
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
?>