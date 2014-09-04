<?PHP
	$query = " 
        SELECT 
            id,creator,issue,title,cdate,content,last,status,closed
        FROM tickets WHERE creator = '".$_SESSION["user"]["username"]."' ORDER BY `tickets`.`id` ASC 
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
    $gtickets = $stmt->fetchAll();
?>
<div class="pull-left">
<div style="width: 700px;">
	<div class="bluebox">
    	<p>VIEW TICKETS</p>
    </div>
    <div style=" padding-top: 15px;">
    <?PHP if(empty($gtickets)){
		echo "<center style='padding-top: 15px;'><h4>No Tickets. Make a <a href='newticket'>New Ticket?</a></h4></center>";
	} ?>
    <?PHP foreach($gtickets as $gticket): ?>
    <div class="boxpill">
    	<a href="vticket?s=<?PHP echo $gticket["id"]; ?>"><span style="color: #75aad4; padding-right: 77px;"><? echo$string = substr($gticket["title"],0,20).'...'; ?></span></a> <span style="padding-left: 40px;">Status: <?PHP if($gticket["closed"] == "0"){ echo "Open"; } else { echo "Closed"; } ?></span> <span style="padding-left: 60px;">Last Reply: <?PHP echo $gticket["last"]; ?></span> <span style="padding-left:60px;"><?PHP echo date("F j, Y", $gticket["cdate"]); ?></span>
    </div>
    <?PHP endforeach; ?>
</div>
</div>