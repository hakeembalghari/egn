<?PHP
	$query = " 
        SELECT id,belongsto,title,madeby,lastby,sticky,locked,identifier,date FROM forum_threads WHERE belongsto = :identifier
    ";   
	$query_params = array(
		":identifier" => $_GET["s"]
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
    $gthreads = $stmt->fetchAll();
	
	$query = " 
        SELECT id,name FROM forum_topic WHERE id = :identifier
    ";   
	$query_params = array(
		":identifier" => $_GET["s"]
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
    $gtopicname = $stmt->fetch();
	
	
?>
<div class="mcontain">
	<h4><?PHP echo $gtopicname["name"]; ?></h4>
    <div class="bluebox">
    	<p><?PHP echo $gtopicname["name"]; ?></p>
    </div>
    <div style="border: 1px solid black;margin-top: -1px;">
<table class="table" style="margin-bottom: 0px;">
              <tbody>
			<?PHP foreach($gthreads as $gthread): ?>
                <tr>
                  <td><i class="icon-comments"></i></td>
                  <td width="50%"><span style="font-size: 15px; color: #75aad4;"><?PHP echo $gthread["title"]; ?></span></td>
                  <td><span style="font-size: 12px;">Made By: <span style="color: #75aad4;"><?PHP echo $gthread["madeby"]; ?></span></span></td>
                  <td><span style="font-size: 12px;">Last Post By: <span style="color: #75aad4;"><?PHP echo $gthread["lastby"]; ?></span></td>
                  <td><span style="font-size: 12px;">Created On <span style="color: #75aad4;"><?PHP echo date("F j, Y, g:i a", $gthread["date"]); ?></span></td>
                </tr>
		  <?PHP endforeach; ?>
              </tbody>
            </table>
            </div> 
            <br>
			
</div>