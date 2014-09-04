<?PHP

if(isset($_GET['action']) and $_GET['action']=='save')

{
	if($_POST['id']=='')
	{
		$query = "INSERT INTO embedtv (title,channel_name) VALUES ('".$_POST['title']."','".$_POST['channel_name']."')";
			
	}
	else
	{
		$query = "UPDATE embedtv SET title='".$_POST['title']."', channel_name='".$_POST['channel_name']."' WHERE id='".$_POST['id']."'";
		
	}
	
	$stmt = $db->prepare($query); 
            $result = $stmt->execute();
			
			if($result)
			{
			echo "<script>window.location='embedtv';</script>";	
				
			}
			exit;
	
	
}
	$query = " 
        SELECT 
            id,title,channel_name FROM embedtv ORDER BY id  
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
    $Tv = $stmt->fetchAll();
	$Tv = $Tv[0];
	
	
?>
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        <h4>Embed TV</h4>
                    </div>
                    <div class="section" style="margin-top: 20px; padding-top: 10px;"></div>
                    </div>
                    <br>
         <form class="form-horizontal" action="?action=save" method="POST">
         <input type="hidden" name="id" value="<?php echo $Tv['id'];?>" />
  <div class="control-group">
    <label class="control-label" for="inputEmail">Channel Title</label><br><br>

    <div class="controls">
      <input type="text" style="width: 400px;"class="form-control" placeholder="Title" name="title" autocomplete="off" value="<?=$Tv['title'];?>">
    </div>
  </div><br>
  
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Channel Name</label><br><br>

    <div class="controls">
       <input type="text" style="width: 400px;"class="form-control" placeholder="Title" name="channel_name" autocomplete="off" value="<?=$Tv['channel_name'];?>">
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