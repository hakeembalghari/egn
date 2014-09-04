<?php

$query = "SELECT * FROM events WHERE EventId='".$_GET['id']."'";  
	    
    try 
    {
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 	
	catch(PDOException $ex) 
    {  
        die("Failed to run query: " . $ex->getMessage()); 
    }
	$Event = $stmt->fetch();
	if(empty($Event))
	{
		echo "<script>window.location='home';</script>";exit;		
		
	}
	$_SESSION['Payment_Amount']=$Event['Price'];
?>
<div class="pull-left">
<div style="width: 700px;">
	<div class="bluebox">
    	<p>JOIN AN EVENT</p>
    </div>
   
    


    <div style="background: #111111; width: 700px; min-height: 100px;">
    	<p style="padding-top: 5px; padding-left: 7px;"><b><?=$Event['EventName'];?> - <?=date('F dS',strtotime($Event['StartDate'])).' - ' . date('F dS',strtotime($Event['EndDate']));?></b></p>
        
      <div style="border: 1px solid #363636; width: 500px;/* padding: 5px; */height: 85px;font-size: 13px;margin-left: 10px;width: 665px;padding-left: 10px;padding-top: 2px;margin-top: 15px;">
        	<p>Price: $<?=number_format($Event['Price'],2);?></p>
        <p>Countries: <?php
		if($Event['EligibilityCountry']=='-1')
		{
		echo 'All Countries can participate';	
		}
		else
		{
			
		echo str_replace(",",", ",$Event['EligibilityCountry']) .' can participate';
		}
		?></p>
          <p>Age: 
              <?php
        if($Event['EligibilityAge']!='All Ages')
		{
		echo $Event['EligibilityAge'].' Years only.'; 
		}
		else
		{
		echo "No Age Restriction.";	
		}
		
		?>
          </p>
        </div>
        <p style="padding-left: 7px; padding-top: 15px; padding-bottom: 20px; font-size: 13px;"><form action='expresscheckout.php' METHOD='POST'>
<input type='image' name='submit' src='https://www.paypal.com/en_US/i/btn/btn_xpressCheckout.gif' border='0' align='top' alt='Check out with PayPal'/>
</form></p>
    </div>  
  
  
  
  
  
  
  
  
  
  
  
  
  

</div>




