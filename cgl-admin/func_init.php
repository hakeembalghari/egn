<?PHP
	function is_logged(){
		if(isset($_SESSION["user"])) {
			return true;
		}
		else {
			return false;	
		}
	}
	
	function dbcmd($cmd){
	include_once('common.php');
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
?>