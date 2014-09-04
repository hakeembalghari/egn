<?PHP
	include('common.php');
	if(!is_logged()){
		redirect("login/failed?title=Error&r=You%20Must%20Sign%20In%20To%20View%20This%20Page");
	}
	
	if(!isset($_POST["content"]) or empty($_POST["content"])){
		redirect("vtickets/failed?title=Error&r=Please%20Fill%20In%20All%20Fields.");
	}

	$query = " 
        SELECT 
            id,creator,issue,title,cdate,content,last,status,closed
        FROM tickets WHERE id = :s AND creator = :creator
    ";      
	$query_params = array(
	':s' => $_GET["s"],
	':creator' => $_SESSION["user"]["username"]
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
    $gmticket = $stmt->fetch();
	
	if($gmticket["creator"] !== $_SESSION["user"]["username"]){
		redirect("vtickets");
		die();
	}
	
	$query = " 
    	INSERT INTO ticket_reply VALUE (null, '".$_GET["s"]."', '".$_SESSION["user"]["username"]."', 'user', :message);
    "; 
	$query_params = array( 
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
    	UPDATE tickets SET status = 'user', last = '".$_SESSION["user"]["username"]."', ldate = '".time()."' WHERE id = :s
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
	
	header("Location: vticket?s=".$_GET["s"]."");
	die();
?>