<?PHP
	include('common.php');
	if(!is_logged()){
		redirect("login");
	}
		$name = $_FILES['file']['name'];
		$type = $_FILES['file']['type'];
		$tmp_name = $_FILES['file']['tmp_name'];
		$allowed = array("image/gif", "image/jpeg", "image/jpg", "image/png");
		if(!in_array($type, $allowed)){
			header("Location mnews?s=ift");
		}
		$rawfile = file_get_contents($tmp_name);
	$query = " 
    	INSERT INTO pm_news VALUES (null,:title,:contents,:image,:imagetype)
    "; 
	$query_params = array( 
            ':title' => $_POST["title"],
			':contents' => $_POST["content"],
			':image' => $rawfile,
			':imagetype' => $type
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
			header("Location: mnews");
?>