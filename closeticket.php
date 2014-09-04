<?PHP
	include('common.php');
	if(!is_logged()){
		redirect("login");
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
	header("Location: vticket?s=".$_GET["s"]."");
	die();
?>