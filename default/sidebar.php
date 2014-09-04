<div style="float: right;">
  <div style="width:292px; float:left;">
            <div class="tabbable"> <!-- Only required for left/right tabs -->
   <div class="btn-group">
<a href="#tab1" data-toggle="tab" style="color: #eeeeee;"><div class="bluebox" style="width: 100px;">
    	<p>ALL EVENTS</p>
    </div></a>
    <a href="#tab2" data-toggle="tab" style="color: #eeeeee;"><div class="bluebox" style="width: 35px;margin-top:-35px;margin-left:112px;">
    	<p>CGL</p>
    </div></a>
   <a href="tv"  style="color: #eeeeee;"> <div class="bluebox" style="width: 70px;margin-top:-35px;margin-left:160px;">
    	<p>CGL - TV</p>
    </div></a>
</div>
  <div class="tab-content" style="margin-top:-1px;">
    <div class="tab-pane active" id="tab1">
      <!--
      
      -->
      
      <?php
	  $EventsQuery = $query = " 
        SELECT * FROM events WHERE StartDate >= '".date('Y-m-d')."' ORDER BY EventId DESC LIMIT 7 
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
	$Events = $stmt->fetchAll();
	
	  
	  ?>
      <div class="accordion" id="accordion2" style="margin-left: 1px;">
      
      <?php
	  $i=0;
	  foreach($Events as $Event)
	  {
		  $i++;
	  ?>
  <div class="accordion-group" style="border-top:1px solid black; margin-top: 0.1px;width:290px;">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion<?=$i.$i;?>" href="#collapse<?=$i.$i;?>">
        <img style="padding-right: 5px;" src="img/bf3.png" height="16" width="16" /><span style="color: #75aad4;"><?=$Event['EventName'];?></span> <span style="color:white;padding-left:30px;">Online</span> <span class="pull-right" style="color: #75aad4;padding-right: 5px; font-size:15px;">+</span>
      </a>
    </div>
    <div id="collapse<?=$i.$i;?>" class="accordion-body collapse <?=($i==1?'in':'');?>">
      <div class="accordion-inner">
      <img src="http://puu.sh/4V9dQ.jpg" width="289" height="75" style="margin-left:-4px;margin-top:-5px;"/>
        <p><span style="color: #75aad4;">Registration:</span> <span style="padding-left: 15px;"><?=date('F dS',strtotime($Event['StartDate']));?> - <?=date('F dS',strtotime($Event['EndDate']));?> </span></p>
        <p style="margin-top: -8px;"><span style="color: #75aad4;">Event:</span> <span style="padding-left: 15px;"><?=date('F dS',strtotime($Event['StartDate']));?> - <?=date('F dS',strtotime($Event['EndDate']));?></span></p>
        <p style="margin-top: -7px;"><span style="color: #75aad4;">Price:</span> <span style="padding-left: 15px;">$<?=number_format($Event['Price'],2);?></span></p>
        <p style="margin-top: -9px;"><span style="color: #75aad4;">Eligibility:</span> <span style="padding-left: 15px;"><?php
		if($Event['EligibilityCountry']=='-1')
		{
		echo 'All Countries can participate';	
		}
		else
		{
			
		echo str_replace(",",", ",$Event['EligibilityCountry']) .' can participate';
		}
		?> 
		</span></p>
        
        <p style="margin-top: -9px;"><span style="color: #75aad4;">Age Eligibility:</span> <span style="padding-left: 15px;">
        <?php
        if($Event['EligibilityAge']!='All Ages')
		{
		echo $Event['EligibilityAge'].' Years only.'; 
		}
		else
		{
		echo "No Age Restriction.";	
		}
		
		?></span></p>
        
        <?php
		if($Event['EventType']=='Paid')
		{
		?>
        <p style="margin-top: 0px; text-align:center;margin-bottom:0px">
        <img src="img/join-now.png" style="cursor:pointer" onclick="window.location='joinevent?id=<?=$Event['EventId'];?>'" />
        
        </p>
        <?php
		}
		?>
      </div>
    </div>
  </div>
  
  <?php
	  }
	  ?>
  
  
    
  
  
  
  
  
  
  
  
    </div>
    
    <!-- -->
      <!--
      
      -->
    </div>
    <div class="tab-pane" id="tab2">
      <p>Howdy, I'm in Section 2.</p>
    </div>
    <div class="tab-pane" id="tab3">
    	<p>Section 3</p>
    </div>
  </div>
</div>

<!-- -->

   <div style="width: 290px;margin-top:-10px;">
	<div class="bluebox">
    	<p>PREMIUM MEMBERSHIP</p>
    </div>
    <div style="background:url(img/banner.jpg) no-repeat; width: 285px; height: 112px; margin-left: 2px;"></div><a href="advertise"><div style="background: #41a5d3; border: 1px solid #000102; color: #efefef; height:26px; width: 150px;font-weight: 500;float: right;margin-right: 3px;margin-top: -27px;">
	<p style="margin-top: 3px;margin-left: 7px;">GET PREMIUM</p></div></a>
    </div>
    
    
    <!-- -->
    
       <div style="width: 290px;padding-top:10px;">
	<div class="bluebox">
    	<p>ADVERTISEMENTS</p>
    </div>
    <div style="background:url(img/intel.jpg) no-repeat; width: 285px; height: 242px; margin-left: 2px;"></div><a href="advertise"><div style="background: #41a5d3; border: 1px solid #000102; color: #efefef; height:26px; width: 150px;font-weight: 500;float: right;margin-right: 3px;margin-top: -27px;">
	<p style="margin-top: 3px;margin-left: 7px;">ADVERTISE WITH US</p>
	</div></a>
    <?php include('leaguerankings.php');?>
    	  
</div>
</div>
</div>
