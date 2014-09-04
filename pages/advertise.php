<?PHP
	if(isset($_POST["requests"]) || !empty($_POST["title"])){
	$to      = 'necrohhh@gmail.com';
	$subject = "".strip_tags($_POST["title"])."";
	$message = "Name: ".strip_tags($_POST["name"])."\r\n_______________________________\r\n\r\nE-Mail: ".strip_tags($_POST["email"])."\r\n_______________________________\r\n\r\nType of Ad: ".$_POST["type"]."\r\n_______________________________\r\n\r\nLength of Time: ".$_POST["length"]."\r\n_______________________________\r\n\r\nBudget Range: ".$_POST["budget"]."\r\n_______________________________\r\n\r\nAdditional Requests: ".$_POST["requests"]."";
		$finalmessage = wordwrap($message, 70, "\r\n");
	$headers = 'From: submission@ncms.us';
	mail($to, $subject, $message, $headers);
	echo "<script>window.location.replace('test?success=1')</script>";
	}	
?>
<div class="pull-left">
<div style="width: 700px;">
	<div class="bluebox">
    	<p>APPLY FOR ADVERTISEMENT <?PHP if($_GET["success"] == "1") { echo "- Message Sent Successfully"; }; ?></p>
    </div>
<form class="form-horizontal" method="POST" style="margin-left: -15px;padding-top:20px;">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Full Name</label>
    <div class="controls">
      <input type="text" id="inputEmail" name="name" placeholder="Name">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputEmail">E-Mail</label>
    <div class="controls">
      <input type="text" id="inputEmail" name="email" placeholder="E-Mail">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Type of Advertisement</label>
    <div class="controls">
      <input type="text" name="type" id="inputEmail" placeholder="Type of Advertisement">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Length of Time</label>
    <div class="controls">
      <input type="text" id="inputEmail" name="length" placeholder="Length of Time">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Budget Range</label>
    <div class="controls">
      <input type="text" id="inputEmail" name="budget" placeholder="Budget Range">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Additional Requests</label>
    <div class="controls">
      <textarea name="requests"></textarea>
    </div>
  </div>
  <div class="control-group">
    <div class="controls">
      <button type="submit" class="btn btn-inverse">Submit</button>
    </div>
  </div>
</form>
</div>




