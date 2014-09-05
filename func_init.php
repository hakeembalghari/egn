<?PHP

	function is_logged(){
		if(isset($_SESSION["user"])) {
			return true;
		}
		else {
			return false;	
		}
	}
	
	function update_info(){
	if(is_logged()){
		include('common.php');
	$query = "
           UPDATE users SET ip = '".$_SERVER['REMOTE_ADDR']."', timestamp = '".date("F j, Y, g:i a")."', page = :page WHERE id = '".$_SESSION["user"]["id"]."'
    ";  
	$query_params = array(
	":page" => $_GET["p"]
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
	}
	
	function dbcmd($cmd){
	include('common.php');
	$query = $cmd;      
    try 
    {
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    {  
        die("Failed to run query: " . $ex->getMessage()); 
    }		
}
	function redirect($url){
		echo "<script>window.location.replace('".$url."');</script>";	
	}
	
	function search_array($needle, $haystack) {
     if(in_array($needle, $haystack)) {
          return true;
     }
     foreach($haystack as $element) {
          if(is_array($element) && search_array($needle, $element))
               return true;
     }
   return false;
}
?>