<?PHP
	include('common.php');
	if(!is_logged()){
		redirect("login/failed?title=Error&r=You%20Must%20Sign%20In%20To%20View%20This%20Page");
	}
	
	if(!isset($_POST["issue"]) or empty($_POST["issue"])){
		redirect("newticket/failed?title=Error&r=Please%20Fill%20In%20All%20Fields.");
	}

	$query = " 
    	INSERT INTO tickets VALUES (null,'".$_SESSION["user"]["username"]."', :issue, :title, '".time()."', '".time()."', :content, '".$_SESSION["user"]["username"]."', 'user', '0');
    "; 
	$query_params = array( 
            ':issue' => $_POST["issue"],
			':title' => $_POST["title"],
			':content' => $_POST["content"]
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
	
	header("Location: support");
	die();
?>