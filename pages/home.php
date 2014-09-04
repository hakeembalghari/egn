<?PHP
	$query = " 
        SELECT id,title,contents,image,imagetype FROM pm_news ORDER BY  `pm_news`.`id` DESC LIMIT 8
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
    $gnews = $stmt->fetchAll();
	
	$query = " 
        SELECT id,name,decisions FROM polls ORDER BY id DESC LIMIT 3 
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
    $gpolls = $stmt->fetchAll();
	
	try{
		
		$EmbedTv = $db->prepare("SELECT channel_name FROM embedtv WHERE main_channel=1");
		$EmbedTv->execute();
		
	}
	catch(PDOException $ex)
	{
		die("Failed to run query: " . $ex->getMessage()); 
		
	}
	$EmbedTv = $EmbedTv->fetchAll();
	
	$EmbedTv = $EmbedTv[0];
	$ChannelName = $EmbedTv['channel_name'];
	
	$TvCode = '<object type="application/x-shockwave-flash" height="268" width="690" id="live_embed_player_flash" data="http://www.twitch.tv/widgets/live_embed_player.swf?channel='.$ChannelName.'" bgcolor="#000000"><param name="allowFullScreen" value="true" /><param name="allowScriptAccess" value="always" /><param name="allowNetworking" value="all" /><param name="movie" value="http://www.twitch.tv/widgets/live_embed_player.swf" /><param name="flashvars" value="hostname=www.twitch.tv&channel='.$ChannelName.'&auto_play=false&start_volume=25" /></object>';
	
?>
<div class="mcontain">


<!--<img src="img/bf4.jpg" width="690" height="268" />-->

<div class="mbox">
	<!--
    	EVENT POLLS
            -->
    <div style="width:210px; padding-top: 2px; float:left;">
	<div class="bluebox float-left">
		<p>EVENT POLLS</p>
	</div>
    <div class="accordion" id="accordion2" style="margin-left: 1px; margin-top: 1px;">
    <?PHP $i = 0; foreach($gpolls as $gpoll): 
	
	// Json Decode Decision Array
	$polldec = json_decode($gpoll["decisions"]);
	
	$query = " 
        SELECT id,belongsto,ip FROM poll_limit WHERE belongsto = '".$gpoll["id"]."' AND ip = '".$_SERVER["REMOTE_ADDR"]."' LIMIT 550 
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
    $gpolldup = $stmt->rowCount();
	
	if($gpolldup > 0) {
     	$voted = true;
	} else{
		$voted = false;	
	}
	
	
	
	 $i++ 
	?>
    
    <?PHP if(!$voted){ ?>
  <div class="accordion-group" <?PHP if($i != "1") { echo "style='border-top:1px solid #616161; margin-top: 0.1px;'"; } ?>>
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?PHP echo $gpoll["id"]; ?>">
        <?PHP echo $gpoll["name"]; ?> <span class="pull-right" style="color: #75aad4;padding-right: 5px; font-size:15px;">+</span>
      </a>
    </div>
    <div id="collapse<?PHP echo $gpoll["id"]; ?>" class="accordion-body collapse <?PHP if($i == "1") { echo "in"; } ?>">
      <div class="accordion-inner">
    <div style="padding-left: 5px;">
    <form action="dopoll/<?PHP echo $gpoll["id"]; ?>" method="POST" style="margin: 0; padding-bottom: 3px;">
    <?PHP foreach($polldec as $polldecs): ?>
	<label class="radio">
  		<input type="radio" name="choice" value="<?PHP echo $polldecs ?>">
 		 <?PHP echo $polldecs ?>
	</label>
    <?PHP endforeach; ?>
    
    <input type="submit" class="bluebox" style="color: #eee; height: 24px;outline:none; font-size: 12px; line-height: 0.9; -webkit-border-radius: 3px; border-radius: 3px;margin-left: 3px;" value="Submit" />
    </form>
    </div>
      </div>
    </div>
  </div>
  
   <?PHP } else { ?>
  <div class="accordion-group" <?PHP if($i != "1") { echo "style='border-top:1px solid #616161; margin-top: 0.1px;'"; } ?>>
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapse<?PHP echo $gpoll["id"]; ?>">
        <?PHP echo $gpoll["name"]; ?> <span class="pull-right" style="color: #75aad4;padding-right: 5px; font-size:15px;">+</span>
      </a>
    </div>
    <div id="collapse<?PHP echo $gpoll["id"]; ?>" class="accordion-body collapse<?PHP if($i == "1") { echo " in"; } ?>">
      <div class="accordion-inner">
    <div style="padding-left: 5px;">
   
  		<?PHP $b = 0; foreach($polldec as $polldecs): $b++?>
        <?PHP
		
	$query = " 
        SELECT id,choice,total FROM poll_results WHERE belongsto = '".$gpoll["id"]."' AND choice = '".$polldecs."'
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
    $gtot = $stmt->fetch();
	$query = " 
        SELECT SUM(total) FROM poll_results WHERE belongsto = '".$gpoll["id"]."'
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
    $gtotals = $stmt->fetch();
	$divised = $gtot["total"]/$gtotals["SUM(total)"];
	$filteredtot = $divised*100;
	$newfilteredtot = substr($divised*100, 0,2);
	if($filteredtot == "100"){
		$ftot = "100";
	} else {
	$ftot = str_replace(".", "", $newfilteredtot);
	} ?>
        
        <p <?PHP if($b != "1") { echo "style='margin-top: -11px;'"; } ?>><?PHP echo $polldecs; ?></p>
        <?PHP if($gtot["total"] == "0"){ ?>
			<div class="bluebox" style="height: 6px; width:5px;"><p style="font-size: 12px;margin-top: -7px;">0</p></div>
            <br />
		<? } else { ?>
		<div class="progress" style="background-color: transparent;">
 		   <div class="bar bluebox" style="width: <?PHP echo $ftot; ?>%"><p style="margin-top: -7px;"><?PHP echo $gtot["total"]; ?> Votes</p></div>
		</div>
        <?PHP } endforeach; ?>
    <?PHP if($voted){
		echo "<div style='margin-top: -15px;'></div>";
	} ?>
    
    </div>
      </div>
    </div>
  </div>
    
   <?php } endforeach; ?>

  </div>
    <!-- -->
    
    <!--
    	FORUM POSTS
            -->
      <div style="width: 210px; margin-top: -10px; padding-bottom: 10px;">
	<div class="bluebox">
    	<p>LATEST FORUM POST</p>
    </div>
	
	<?php include('latestforumposts.php');?>
   
</div>
    <!-- -->  
    
    <!--
    	SPONSORS
          -->   
          <div style="width: 210px;">
	<div class="bluebox">
    	<p>SPONSORS</p>
    </div>
    <img style="border-bottom: 1px solid #3f3f3f; margin-top: -4px;" src="img/aeria-games.png" width="210" height="74" />
    <img style="border-bottom: 1px solid #3f3f3f; margin-top: -4px;" src="img/Beast-node.png" width="210" height="74" />
    <img style="border-bottom: 1px solid #3f3f3f; margin-top: -4px;" src="img/ecstacy.png" width="210" height="74" />
    <img style="border-bottom: 1px solid #3f3f3f; margin-top: -4px;" src="img/usf-united.png" width="210" height="74" />
</div>
    <!-- -->   
          
</div>

<div class="tabbable" style="padding-left: 220px; padding-top: 2px;"> <!-- Only required for left/right tabs -->
  <div class="btn-group">

    <a href="#tabuno" data-toggle="tab"><div class="tabbuttonactive tbuttontwo" style="width: 100px;"><p class="activetabp pbuttontwo">CGL NEWS</p></div></a>

<a href="#tabdos" data-toggle="tab"><div class="tabbutton tbuttonone" style="width: 128px;margin-top:-34px;margin-left:101px;"><p class="inactivetabp pbuttonone">SITE ACTIVITY</p></div></a>
</div>
 <?php include('siteactivity.php');?>
      <!-- -->
      <div class="newssep"></div>
      <div style="height: 105px;line-height:3.4; padding-left:15px;">
      	
      </div>
    </div>
</div></div></div></div></div>