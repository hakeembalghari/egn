<?PHP
	include('common.php');
	if(!isset($_SESSION["user"]["username"])){
		$reallyignore = true;	
	}
	if(!$reallyignore){
	$query = " 
    	SELECT sa,perms FROM admin_users WHERE username = '".$_SESSION["user"]["username"]."'
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
	
	$gperms = $stmt->fetch();
	
	if($gperms["sa"] == "1"){
		$ignore = true;	
	}
	if($_GET["p"] == "login"){
		$ignore = true;	
	}
	if(!$ignore){
		
		$page = $_GET["p"];
		
		$core = json_decode($gperms["perms"]);
		
		if(!in_array($page, $core)){
			header("Location: home");
		}		
	}
	}
	
?>