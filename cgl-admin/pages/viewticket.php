<?PHP
	$query = " 
        SELECT 
            id,creator,issue,title,cdate,ldate,content,last,status,closed
        FROM tickets WHERE id = :s
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
        die("Failed to run querydfdfd: " . $ex->getMessage()); 
    } 
    $gmticket = $stmt->fetch();
	
	$query = " 
        SELECT 
            replyto,user,message
        FROM ticket_reply WHERE replyto = '".$_GET["s"]."' ORDER BY  `ticket_reply`.`id` ASC 
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
		<div class="content">     
        	<div id="pad-wrapper">
            
<div class="table-wrapper orders-table">
                <div class="row head">
                
                	
                
                    <div class="col-md-12">
                        <h3><?PHP echo $gmticket["title"]; ?> <small style="margin-left: -0.1px;">by <?PHP echo $gmticket["creator"]; ?></small></h3>
                    </div>
                    
                </div>
                
                
                <div class="row" style="padding-top: 10px;">
            <!-- header -->
            <div class="row header">
                <div class="col-md-8">
                    <h4 class="name"><?PHP echo $gmticket["creator"]; ?>&nbsp;<small style="margin-left: -0.1px;">said</small></h4>
                </div>
            </div>

            <div class="row profile" style="padding-bottom: 15px;">
                <!-- bio, new note & orders column -->
                <div class="col-md-9 bio" style="margin-top: -145px;">
                    <div class="profile-box">
                        <!-- biography -->
                        <div class="col-md-12 section">
                            <p><?PHP echo $gmticket["content"]; ?></p>
                        </div>
                </div>
                </div>
                </div>
                <?PHP foreach($gtickets as $gticket): ?>
                <!-- -->
                <div class="row header">
                <div class="col-md-8">
                    <h4 class="name"><?PHP echo $gticket["user"]; ?>&nbsp;<small style="margin-left: -0.1px;">said</small></h4>
                </div>
            </div>

            <div class="row profile">
                <!-- bio, new note & orders column -->
                <div class="col-md-9 bio" style="margin-top: -145px;">
                    <div class="profile-box">
                        <!-- biography -->
                        <div class="col-md-12 section">
                            <p><?PHP echo $gticket["message"]; ?></p>
                        </div>
                </div>
               <!-- --> 
               
               <?PHP endforeach; ?>
               <div class="section"></div>
               <div class="row header">
                <div class="col-md-8">
                <?PHP if($gmticket["closed"] == "0"){ ?>
                    <h4 class="name">Reply</h4>
                </div>
            </div>
            <div style="margin-top: -40px;">
            
				<form action="replyticket.php?s=<?PHP echo $_GET["s"]; ?>" method="POST" style="width: 700px;">
               <textarea class="wys" name="content" style="height: 200px; width: 600px;"></textarea>
               
               <br />
				<br />
               <input type="submit" class="btn btn-primary" value="Reply" />
			<? } ?>
             
               
               <a href="tickets" class="btn btn-primary">View Tickets</a> 
               <?PHP if($gmticket["closed"] == "0"){ ?>
				   <a href="closeticket?s=<?PHP echo $_GET["s"]; ?>" style="margin-left: 318px;" class="btn btn-danger">Close Ticket</a>
			   <? } ?>
               
               <?PHP if($gmticket["closed"] == "1"){ ?>
				   <a href="openticket?s=<?PHP echo $_GET["s"]; ?>" class="btn btn-success">Open Ticket</a>
			   <? } ?>
               
               </form> 
              </div>
            </div>
          </div>  
          <!-- -->
          
                
                