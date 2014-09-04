<?php

function dbdate($Date)
{
return date('Y-m-d',strtotime($Date));	
	
}
	$query = " 
        SELECT 
            * FROM countries ORDER BY CountryName     ";      
    try 
    {
        $stmt = $db->prepare($query); 
        $stmt->execute(); 
    } 
    catch(PDOException $ex) 
    {  
        die("Failed to run query: " . $ex->getMessage()); 
    } 
    $Countries = $stmt->fetchAll();
	
	
	if(isset($_GET['action']) and $_GET['action']=='save')
	{
		
				
		$EventName = $_POST['GameName'];
		$StartDate = $_POST['StartDate'];
		$EndDate = $_POST['EndDate'];
		
		$StartDate = dbdate($StartDate);
		$EndDate = dbdate($EndDate);
		$EligibleCountry = implode(",",$_POST['EligibleCountry']);
		$EligibleAge = $_POST['EligibleAge'];
		$GamePrice = $_POST['GamePrice'];
		
		if($GamePrice >0)
		{
		$GameType='Paid';	
			
		}
		else if($GamePrice<=0)
		{
			$GameType='Free';	
		}
		
		
		$query = "INSERT INTO events (EventName,StartDate,EndDate,EligibilityCountry,EligibilityAge,EventType,Price)
		
		VALUES
		('$EventName','$StartDate','$EndDate','$EligibleCountry','$EligibleAge','$GameType','$GamePrice')
		
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
		
		
			echo "<script>window.location='events';</script>";	
				
			exit;
		
	}
	
?>
		<div class="content">     
        	<div id="pad-wrapper">
<div class="col-md-8 column">
                <div class="row head">
                                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        <h4>Events</h4>
                    </div>
                    <div class="section" style="margin-top: 20px; padding-top: 10px;"></div>
                    </div>
                    <br>
         <form class="form-horizontal" id="EventsForm" action="?action=save" method="POST">
         <input type="hidden" name="id" value="<?php echo $Tv['id'];?>" />
  <div class="control-group">
    <label class="control-label" for="StartDate">Events Date</label><br><br>

    <div class="controls">
      <input type="text"  class="form-control input-datepicker" name="StartDate"  value="" style="display:inline;width:20%" required /> to <input type="text"  class="form-control input-datepicker" name="EndDate" style="display:inline;width:20%"  value="" required /> 
    </div>
  </div><br>
  
  
  <div class="control-group">
    <label class="control-label" for="EligibleCountry">Country Eligible</label><br><br>

    <div class="controls">
     <select name="EligibleCountry[]" class="select2" multiple style="width:400px;height:20px">
    <option value="-1">All Countries</option>
     <?php
	 foreach($Countries as $Country)
	 {
		 
		?>
        <option  ><?=$Country['CountryName'];?></option>
        
        <?php 
		 
	 }
	 
	 ?>
     
     </select>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="EligibleAge">Age Eligibility</label><br><br>

    <div class="controls">
     <?php
	 $AllowedAges = array(
	 
	 '13+','18+','20+','22+','25+'
	 
	 );
	 
	 ?>
     <select name="EligibleAge" class="select2" style="width:400px">
     <option >All Ages</option>
     <?php
	 foreach($AllowedAges as $Key =>$Value)
	 {
		?>
        <option ><?=$Value;?></option>
        <?php 
		 
	 }
	 ?>
     
     </select>
    </div>
  </div>
  
  
  <div class="control-group">
    <label class="control-label" for="GameName">Game</label><br><br>

    <div class="controls">
     <input type="text" class="form-control " name="GameName" style="width:400px" min="5" required />
    </div>
  </div>
  
  
  <div class="control-group">
    <label class="control-label" for="GameName">Game Type</label><br><br>
<div class="controls">
   <div class="slider-frame primary">
                            <span data-on-text="PAID" data-off-text="FREE" class="slider-button">FREE</span>
                        </div>
                        
                        
                        </div>
  </div>
  
  
  <div class="control-group" id="GamePricingDiv">
    <label class="control-label" for="GamePrice">Game Price</label><br><br>
<div class="controls">
   <input type="text" class="form-control" name="GamePrice" id="GamePrice" style="width:200px" />
                        
                        
                        </div>
  </div>
  
  
  <div class="control-group">
  <br>

    <div class="controls">
      <button type="submit" class="btn btn-primary">Submit </button>
    </div>
  </div>
</form>
                      
                      
                      
                </div>
                
                 <script>
				 $(document).ready(function(e) {
					 $('#GamePricingDiv').hide();
                    $('.slider-button').click(function() {
                if ($(this).hasClass("on")) {
                    $(this).removeClass('on').html($(this).data("off-text"));   
					$('#GamePrice').val('0.00');
					$('#GamePricingDiv').hide('slow');
                } else {
					$('#GamePricingDiv').show('slow');
                    $(this).addClass('on').html($(this).data("on-text"));
                }
            });
			
			 //$("input,select,textarea").not("[type=submit]").jqBootstrapValidation();
			
			
			
                });
				 
				 </script>