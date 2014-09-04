<?PHP
	include('common.php');
	if(!is_logged()){
		redirect("login");
	}
	
	if(!isset($_POST["content"])){
		header("Location: viewticket?s=".$_GET["s"]."");
	}

	$query = " 
    	INSERT INTO ticket_reply VALUE (null, :s, :user, 'admin', :message);
    "; 
	$query_params = array( 
            ':s' => $_GET["s"],
			':user' => $_SESSION["user"]["username"],
			':message' => $_POST["content"]
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
    	UPDATE tickets SET status = 'staff', ldate = '".time()."' WHERE id = :s
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
	
	$query = " 
    	UPDATE tickets SET last = '".$_SESSION["user"]["username"]."' WHERE id = :s
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