<?PHP
	if(!is_logged()){
		redirect("login/failed?title=Error&r=You%20Must%20Sign%20In%20To%20View%20This%20Page");
	}
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
<div class="pull-left" style="">
<div style="width: 700px;">
<div class="bluebox">
    	<p>SUBMIT A TICKET</p>
    </div>
    <div style="padding-left: 65px; padding-top: 5px;padding-bottom: 3px;">
    <p><span style="color: #A3BACF; font-size:20px;">Welcome to the Cyber Gaming League Player Support Center</span><br />
<span style="color: #A3BACF;">Here you can manage your tickets, find answers to common questions, or create a ticket.</span></p>
</div>
<div style="padding-bottom: 3px; padding-top: 10px;">
	<div class="bluebox">
    	<p>MANAGE TICKETS</p>
    </div>
    <table class="table table-condensed" style="color: #E7E7E7;margin-top: 6px;">
              <thead>
                <tr>
                  <th>Ticket ID</th>
                  <th>Date</th>
                  <th>Title</th>
                  <th>Status</th>
                  <th>Last Response</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
              <?PHP foreach($gtickets as $gticket): ?>
                <tr>
                  <td><?PHP echo $gticket["id"]; ?></td>
                  <td><?PHP echo date("F j, Y", $gticket["cdate"]); ?></td>
                  <td><?PHP echo $gticket["title"]; ?></td>
                  <td><?PHP if($gticket["status"] == "staff") { echo "<span class='label label-success'>Staff Reply</span>"; } else { echo "<span class='label label-success'>User Reply</span>"; } if($gticket["closed"] == "1") { echo " <span class='label label-important'>Closed</span>"; } else { echo " <span class='label label-success'>Open</span>"; } ?></td>
                  <td><?PHP echo $gticket["last"]; ?></td>
                  <td><a href="vticket?s=<?PHP echo $gticket["id"]; ?>" class="btn btn-inverse btn-small">View Ticket</a></td>
                </tr>
                <?PHP endforeach; ?>
              </tbody>
            </table>
            </div>
	<div class="bluebox">
    	<p>CREATE A TICKET</p>
    </div>
	<form method="POST" action="processticket.php" class="form-horizontal" style="margin-left: -115px;padding-top: 15px;">
  <div class="control-group" style="margin-left: -53px;">
    <div class="controls">
      <select name="issue" class="input-xlarge" required>
      	<option value="null">- Select Issue -</option>
  		<option value="Issue 1">Issue 1</option>
  		<option value="Issue 2">Issue 2</option>
  		<option value="Issue 3">Issue 3</option>
  		<option value="Issue 4">Issue 4</option>
	</select>
    </div>
  </div>
  
  <div class="control-group">
    <div class="controls">
      <input type="text" style="margin-left: -54px;" name="title" placeholder="Title" class="input-xlarge" required/>
    </div>
  </div>
  
  <div class="control-group" style="margin-left: -55px;">
    <div class="controls">
    	<textarea class="editor" style="width:600px;height:200px;" name="content"></textarea>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-inverse" style="margin-left: -55px;">Submit</button>
    </div>
  </div>
</form>
</div>
	<div class="bluebox">
    	<p>FREQUENTLY ASKED QUESTIONS</p>
    </div>
    <dl>
  <dt style="font-size: 16px; color: #6595C0;">Q: How Do I Register?</dt>
  <dd style="padding-top:4px;padding-bottom: 15px;font-size:15px;">You Can Visit The Register Page <a href="register">Here</a></dd>
  
    <dt style="font-size: 16px; color: #6595C0;">Q: How Do I Register?</dt>
  <dd style="padding-top:4px;padding-bottom: 15px;font-size:15px;">You Can Visit The Register Page <a href="register">Here</a></dd>
  
    <dt style="font-size: 16px; color: #6595C0;">Q: How Do I Register?</dt>
  <dd style="padding-top:4px;padding-bottom: 15px;font-size:15px;">You Can Visit The Register Page <a href="register">Here</a></dd>
  
    <dt style="font-size: 16px; color: #6595C0;">Q: How Do I Register?</dt>
  <dd style="padding-top:4px;padding-bottom: 15px;font-size:15px;">You Can Visit The Register Page <a href="register">Here</a></dd>
  
    <dt style="font-size: 16px; color: #6595C0;">Q: How Do I Register?</dt>
  <dd style="padding-top:4px;padding-bottom: 15px;font-size:15px;">You Can Visit The Register Page <a href="register">Here</a></dd>
</dl>
</div>