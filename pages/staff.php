<?PHP
	$query = " 
        SELECT id,name,email,position,placement FROM pm_staff
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
    $gstaffs = $stmt->fetchAll();
?>
<div class="pull-left">
<div style="width: 700px;">
	<div class="bluebox">
    	<p>STAFF LIST</p>
    </div>
    <!-- -->
	<p style="color: #75aad4;padding-top:15px;padding-bottom: 8px;font-size:18px; ">Management</p>   
    <span style="padding-left: 10px;">Name</span> <span class="pull-right" style="padding-right: 60px;">Position</span> <span class="pull-right" style="padding-right: 200px;">E-Mail</span>  
    <div style="width: 100%; padding-top:6px; padding-bottom: 6px;">
    <?PHP foreach($gstaffs as $gstaff): 
		if($gstaff["placement"] == "management"){
	?>
    <div class="boxpill">
    	<span style="color: #75aad4;padding-left:10px;"><?PHP echo $gstaff["name"]; ?></span> <span class="pull-right" style="padding-right: 60px;"><?PHP echo $gstaff["position"]; ?></span> <span class="pull-right" style="padding-right: 170px;"><?PHP echo $gstaff["email"]; ?></span>
    </div>
    <?PHP } endforeach; ?>
  </div>
  <!-- -->
  
      <!-- -->
	<p style="color: #75aad4;padding-top:15px;padding-bottom: 8px;font-size:18px; ">Staff</p>   
    <span style="padding-left: 10px;">Name</span> <span class="pull-right" style="padding-right: 60px;">Position</span> <span class="pull-right" style="padding-right: 200px;">E-Mail</span>  
    <div style="width: 100%; padding-top:6px; padding-bottom: 6px;">
    <?PHP foreach($gstaffs as $gstaff): 
		if($gstaff["placement"] == "staff"){
	?>
    <div class="boxpill">
    	<span style="color: #75aad4;padding-left:10px;"><?PHP echo $gstaff["name"]; ?></span> <span class="pull-right" style="padding-right: 60px;"><?PHP echo $gstaff["position"]; ?></span> <span class="pull-right" style="padding-right: 170px;"><?PHP echo $gstaff["email"]; ?></span>
    </div>
    <?PHP } endforeach; ?>
  </div>
  <!-- -->
  
      <!-- -->
	<p style="color: #75aad4;padding-top:15px;padding-bottom: 8px;font-size:18px; ">Shoutcasters</p>   
    <span style="padding-left: 10px;">Name</span> <span class="pull-right" style="padding-right: 60px;">Position</span> <span class="pull-right" style="padding-right: 200px;">E-Mail</span>  
    <div style="width: 100%; padding-top:6px; padding-bottom: 6px;">
    <?PHP foreach($gstaffs as $gstaff): 
		if($gstaff["placement"] == "shoutcasters"){
	?>
    <div class="boxpill">
    	<span style="color: #75aad4;padding-left:10px;"><?PHP echo $gstaff["name"]; ?></span> <span class="pull-right" style="padding-right: 60px;"><?PHP echo $gstaff["position"]; ?></span> <span class="pull-right" style="padding-right: 170px;"><?PHP echo $gstaff["email"]; ?></span>
    </div>
    <?PHP } endforeach; ?>
  </div>
  <!-- -->
  
  

</div>
</div>




