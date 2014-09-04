<?PHP
	if(!is_logged()){
		redirect("login/failed?title=Error&r=You%20Must%20Sign%20In%20To%20View%20This%20Page");
	}
	if(!isset($_GET["s"]) or empty($_GET["s"])){
		redirect("support");	
	}
	$query = " 
        SELECT 
            id,creator,issue,title,cdate,ldate,content,last,status,closed
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
		redirect("support");
	}
	
	$query = " 
        SELECT 
            replyto,user,level,message
        FROM ticket_reply WHERE replyto = :s ORDER BY  `ticket_reply`.`id` ASC 
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
    $gtickets = $stmt->fetchAll();
?>
<div class="pull-left" style="">
<div style="width: 700px;">
<div class="bluebox">
    	<p><?PHP echo $gmticket["title"]; ?> - Ticket #<?PHP echo $gmticket["id"]; ?></p>
    </div>
            
        <ul class="unstyled" style="padding-left: 5px;padding-top:5px;font-size:15px;">
        	<li>Date: <?PHP echo date("F j, Y, g:i a", $gmticket["cdate"]); ?></li>
            <li>Last Date Replied: <?PHP echo date("F j, Y, g:i a", $gmticket["ldate"]); ?></li>
            <li>Status: <?PHP if($gmticket["closed"] == "0"){ echo "Open"; } else { echo "Closed"; } ?></li>
            <li>Last Response By: <?PHP echo $gmticket["last"]; ?></li>
        </ul>
        
        <!--
        	MAIN Response
            		-->

        <div style="width: 350px; margin-bottom: 7px;">
        <div class="bluebox">
    		<p>You Said</p>
    	</div>
        <div style="background: #181818;margin-top: 7px; width: 650px; padding: 5px; padding-right: 15px;min-height: 85px;padding-bottom: 5px;padding-left: 5px;padding-top: 5px;"><?PHP echo $gmticket["content"]; ?></div>
        </div>
        </div>
        <!-- -->
        
        <?PHP foreach($gtickets as $gticket): ?>
    	<!--
        	Response
            		-->
        <div style="width: 350px;">
        <div class="bluebox" style="margin-bottom: 7px;">
    		<p><?PHP 
			
			if($gticket["user"] == $_SESSION["user"]["username"]){
				$newuser = "You";	
			}
			
			if($gticket["level"] == "admin") { echo "[Staff] ".$gticket["user"].""; } else { echo $newuser; } ?> Said</p>
            </div>
        <div style="background: #181818;width: 650px; padding: 5px; padding-right: 15px;min-height: 85px;padding-bottom: 5px;padding-left: 5px;padding-top: 5px;"><?PHP echo $gticket["message"]; ?></div>
        </div>
        <!-- -->
        <?PHP endforeach; ?>
        
        <?PHP if($gmticket["closed"] == "0"){ ?>
			 <form class="pull-left" style="padding-top: 20px; width: 700px;" action="replyticket.php?s=<?PHP echo $_GET["s"]; ?>" method="POST">
    	<textarea class="editor" name="content" style="width: 568px; height: 175px;"></textarea>
        <br>

        <input type="submit"  class="bluebox" style="color: #eee; height: 33px;outline:none; font-size: 16px; line-height: 1.1; -webkit-border-radius: 3px; border-radius: 3px;" value="Reply" />
        
    </form>
    <a href="closeticket.php?s=<?PHP echo $_GET["s"]; ?>"><input type="submit"  class="redbox" style="color: #eee; height: 33px;outline:none; font-size: 16px; line-height: 1.1; -webkit-border-radius: 3px; border-radius: 3px;margin-left: 60px; margin-top: -95px;" value="Close Ticket"></a>
		<? } else { ?>
        	<a href="openticket.php?s=<?PHP echo $_GET["s"]; ?>"><input type="submit"  class="bluebox" style="color: #eee; height: 33px;outline:none; font-size: 16px; line-height: 1.1; -webkit-border-radius: 3px; border-radius: 3px;margin-top:7px;" value="Open Ticket"></a>
        <? } ?>
   
    </div>

    </div>
    </div>
    </div>