<?PHP
	$query = " 
        SELECT id,name FROM forum_topicsort
    ";      
    try 
    {
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    {  
        die("Failed to run query: " . $ex->getMessage()); 
    } 
    $gtopicsorts = $stmt->fetchAll();

	
?>
<div class="mcontain">
	<h4>CGL Discussion</h4>
    <?PHP foreach($gtopicsorts as $gtopicsort): 
	
	$query = " 
        SELECT id,name,belongsto FROM forum_topic WHERE belongsto = '".$gtopicsort["id"]."'
    ";      
    try 
    {
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    {  
        die("Failed to run query: " . $ex->getMessage()); 
    } 
    $gtopics = $stmt->fetchAll();
	
	?>
    <div class="bluebox">
    	<p><?PHP echo $gtopicsort["name"]; ?></p>
    </div>
    <div style="border: 1px solid black;margin-top: -1px;">
<table class="table" style="margin-bottom: 0px;">
              <tbody>
              <?PHP foreach($gtopics as $gtopic): ?>
                <tr>
                  <td><i class="icon-comments"></i></td>
                  <td width="50%"><span style="font-size: 15px; color: #75aad4;"><a style="color: #75aad4;" href="topics/<?PHP echo $gtopic["id"]; ?>"><?PHP echo $gtopic["name"]; ?></a></span></td>
                  <td><span style="font-size: 12px;">102 Topics</span></td>
                  <td><span style="font-size: 12px;">Last Post: <span style="color: #75aad4;">Test</span> by <span style="color: #75aad4;">Necro</span></span></td>
                </tr>
                <?PHP endforeach; ?>
              </tbody>
            </table>
            </div>
            <?PHP endforeach; ?>   
            <br>
			
</div>