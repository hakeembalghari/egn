<?PHP
	include('common.php');
	
	$query = " 
        SELECT verifyid FROM users where username = :username
    ";      
	$query_params = array(
	':username' => $_GET["username"]
	);
    try 
    {
        $stmt = $db->prepare($query); 
        $stmt->execute($query_params); 
    } 
    catch(PDOException $ex) 
    {  
        die("Failed to run querydfdfd: " . $ex->getMessage()); 
    } 
    $gvid = $stmt->fetch();
	
	$rowcount = $stmt->rowCount();
	
	
	if($gvid["verifyid"] == $_GET["id"]){
		
	$query = " 
        UPDATE users SET verified = 1 WHERE username = :username
    ";      
	$query_params = array(
	':username' => $_GET["username"]
	);
    try 
    {
        $stmt = $db->prepare($query); 
        $stmt->execute($query_params); 
    } 
    catch(PDOException $ex) 
    {  
        die("Failed to run querydfdfd: " . $ex->getMessage()); 
    } 
		header("Location: home/success?title=Success!&r=You%20May%20Now%20Login%20Securely.");
	} else{
		header("home");	
	}
?>