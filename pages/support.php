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
	
	$query = " 
        SELECT id,question,answer FROM pm_support
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
    $gpmsupports= $stmt->fetchAll();
?>
<div class="pull-left" style="">
<div style="width: 700px;">
<div class="bluebox">
    	<p>SUPPORT CENTER</p>
    </div>
    <div style="padding-left: 65px; padding-top: 5px;padding-bottom: 3px;">
    <p><span style="color: #A3BACF; font-size:20px;">Welcome to the Cyber Gaming League Player Support Center</span><br />
<span style="color: #A3BACF;">Here you can manage your tickets, find answers to common questions, or create a ticket.</span></p>
</div>
<div style="padding-bottom: 3px; padding-top: 10px;">
	<div class="bluebox">
    	<p>MANAGE TICKETS</p>
    </div>
    <?PHP if(empty($gtickets)){ ?>
		<div style="padding-left: 65px; padding-top: 5px;padding-bottom: 3px;">
    <p>
<center><span style="font-size:17px;padding-right:42px;">- No Open Support Tickets - </span></p></center>
</div>
	<? } else { ?>
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
                  <td><?PHP if($gticket["status"] == "staff") { echo "<span class='label label-success'>Staff Reply</span>"; } else { echo "<span class='label label-info'>User Reply</span>"; } if($gticket["closed"] == "1") { echo " <span class='label label-important'>Closed</span>"; } else { echo " <span class='label label-success'>Open</span>"; } ?></td>
                  <td><?PHP echo $gticket["last"]; ?></td>
                  <td><a href="vticket?s=<?PHP echo $gticket["id"]; ?>" class="btn btn-inverse btn-small">View Ticket</a></td>
                </tr>
                <?PHP endforeach; ?>
              </tbody>
            </table>
            </div>
            <? } ?>
	<div class="bluebox">
    	<p>CREATE A TICKET</p>
    </div>
	<form method="POST" action="processticket.php" class="form-horizontal" style="margin-left: -115px;padding-top: 15px;">
  <div class="control-group" style="margin-left: -53px;">
    <div class="controls">
      <select name="issue" class="input-xlarge" required>
      	<option value="null">- Select Issue -</option>
  		<option value="Account Issues">Account Issues</option>
  		<option value="Website Issues">Website Issues</option>
  		<option value="Anticheat Issues">Anticheat Issues</option>
  		<option value="Disputes">Disputes</option>
        <option value="Feedback">Feedback</option>
        <option value="Abuse">Abuse</option>
        <option value="Appeals">Appeals</option>
        <option value="Other">Other</option>
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
      <button type="submit" class="bluebox" style="color: #eee; height: 33px;outline:none; font-size: 16px; line-height: 1.1; -webkit-border-radius: 3px; border-radius: 3px;margin-top: -10px;margin-left: -55px;">Submit</button>
    </div>
  </div>
</form>
</div>
	<div class="bluebox" style="margin-top: -7px;">
    	<p>LIVE SUPPORT</p>
    </div>
    <div style="background: #111111; width: 700px; min-height: 100px;">
    	<p style="padding-top: 5px; padding-left: 7px;"><b>Cyber Gaming League provides live support on our ventrilo server from 5PM EST - 11PM EST</b></p>
        
        <div style="border: 1px solid #363636; width: 500px;/* padding: 5px; */height: 85px;font-size: 13px;margin-left: 10px;width: 665px;padding-left: 10px;padding-top: 2px;margin-top: 15px;">
        	<p>Server Name: Cyber Gaming League Ventrilo</p>
            <p>Server IP: vent.c-gl.org</p>
            <p>Server Port: 3405</p>
        </div>
        <p style="padding-left: 7px; padding-top: 15px; padding-bottom: 20px; font-size: 13px;">Please Note, all ban appeals, feedback, general inquiries, disputes, and abuse are handled through the support ticket system</p>
    </div>
    
	<div class="bluebox">
    	<p>FREQUENTLY ASKED QUESTIONS</p>
    </div>
    <dl>
    <div style="margin-top: -14px;margin-left: 1px;">
    <?PHP foreach($gpmsupports as $gmsupport): ?>
  <div class="accordion-group" style="border-top:1px solid #616161; margin-top: 0.1px; width: 698px;"><a data-toggle="collapse" data-target="#<?PHP echo $gmsupport["id"]; ?>"><dt style="font-size: 16px; color: #6595C0;padding-bottom: 7px;padding-top: 6px; padding-left: 5px;">Q: <?PHP echo $gmsupport["question"]; ?> <span class="pull-right slidedown" style="padding-right:50px; margin-top: -4px;">__</span></dt></a></div>
  <dd id="<?PHP echo $gmsupport["id"]; ?>"  class="collapse out accordion-inner" style="font-size: 15px; border: none; padding-top: 0px;  margin-left: -0.1px; padding-bottom: 0px;"><div style="padding: 5px;"><?PHP echo $gmsupport["answer"]; ?></div></dd>
  <? endforeach; ?>
  </div>
   </dl>
</div>