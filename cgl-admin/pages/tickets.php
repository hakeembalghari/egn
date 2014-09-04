<?PHP
	if(isset($_GET["sort"])){
		
	  if($_GET["sort"] == "date"){
		$query = " 
        SELECT 
            id,creator,issue,title,cdate,ldate,content,last,status,closed
        FROM tickets ORDER BY  `tickets`.`ldate` DESC LIMIT 20
    ";
	  }
	  
	  if($_GET["sort"] == "made"){
		$query = " 
        SELECT 
            id,creator,issue,title,cdate,ldate,content,last,status,closed
        FROM tickets ORDER BY  `tickets`.`creator` ASC LIMIT 20
    ";
	  }
	  
	  if($_GET["sort"] == "title"){
		$query = " 
        SELECT 
            id,creator,issue,title,cdate,ldate,content,last,status,closed
        FROM tickets ORDER BY  `tickets`.`title` ASC LIMIT 20
    ";
	  }
	  
	  if($_GET["sort"] == "issue"){
		$query = " 
        SELECT 
            id,creator,issue,title,cdate,ldate,content,last,status,closed
        FROM tickets ORDER BY  `tickets`.`issue` ASC  LIMIT 20
    ";
	  }
	
	} else {
	$query = " 
        SELECT 
            id,creator,issue,title,cdate,ldate,content,last,status,closed
        FROM tickets ORDER BY  id DESC LIMIT 20
    ";      
	}
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
                        <h4>Tickets</h4>
                    </div>
                </div>


                <div class="row" style="padding-top: 10px;">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                    <a href="?sort=date" style="color: #333;">Last Date Replied</a>
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                    <a href="?sort=made" style="color: #333;">Made By</a>
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                    <a href="?sort=title" style="color: #333;">Title</a>
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                    <a href="?sort=issue" style="color: #333;">Issue</a>
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                    Status
                                </th>
                                <th class="col-md-2">
                                	<span class="line"></span>
                                    
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- row -->
                            <?PHP foreach($gtickets as $gticket): ?>
                            <tr class="first">
                                <td>
                                    <?PHP echo date("F j, Y, g:i a", $gticket["ldate"]); ?>
                                </td>
                                <td>
                                    <a href="../users/<?PHP echo $gticket["creator"]; ?>"><?PHP echo $gticket["creator"]; ?></a>
                                </td>
                                <td>
                                   <?PHP echo $gticket["title"]; ?>
                                </td>
                                <td>
                                	<?PHP echo $gticket["issue"]; ?>
                                </td>
                                <td>
                                	<?PHP if($gticket["status"] == "user"){
										echo "<span class='label label-warning'>User Reply</span>";
									} else {
										echo "<span class='label label-success'>Staff Reply</span>";	
									}?>
                                    
                                    <?PHP if($gticket["closed"] == "0"){
										echo " <span class='label label-success'>Ticket Open</span>";
									} else {
										echo " <span class='label label-danger'>Ticket Closed</span>";	
									}?>
                                </td>
                                <td>
                                	<a class="btn btn-primary" href="viewticket?s=<?PHP echo $gticket["id"]; ?>">View Ticket</a>
                                    <a class="btn btn-danger" href="delticket.php?s=<?PHP echo $gticket["id"]; ?>"><i class="icon-trash"></i></a>
                                </td>
                            </tr>
                            <? endforeach; ?>
                        </tbody>
                    </table>
                    
                </div>
            </div>
          </div>
        </div>