<?PHP
$page = 'assign-award';
if(isset($_GET['action']) and $_GET['action']=='save')
{
	for($i=0;$i<=count($_POST['UserId'])-1;$i++)
	{
		$query = "INSERT INTO assign_award (AwardId,UserId,Description)
	
	VALUES (:award_id,:user_id,:description)
	";	
	
	$params = array(
	':award_id'=>$_POST['AwardId'],
	':user_id' =>$_POST['UserId'][$i],
	':description'=>$_POST['Description']
	);
	
	try{
			$stmt = $db->prepare($query);
			$stmt->execute($params);	
		
	}
	catch(PDOException $ex)
	{
		die($ex->getMessage());	
		
	}
	}
	
	
	echo "<script>window.location='$page'</script>";exit;
}

if(isset($_GET['action']) and $_GET['action']=='delete')
{
$id = $_GET['id'];

$query="DELETE FROM assign_award WHERE Id=:id";

$params = array(':id'=>$id);
try
{
	
	$stmt = $db->prepare($query);
	$stmt->execute($params);	
	
}
catch(PDOException $ex)
{
	
die($ex->getMessage());	
	
}
	
	echo "<script>window.location='$page'</script>";exit;
	
}

	$query = " 
        SELECT 
            * FROM assign_award ORDER BY Id DESC 
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
    $categories = $stmt->fetchAll();
	
	$query = "SELECT * FROM awards";
	
	try{
		$stmt = $db->prepare($query);
		$stmt->execute();	
		
	}
	catch(PDOException $ex)
	{
		
		die($ex->getMessage());	
		
	}
	$Awards = $stmt->fetchAll();
	
	
	$query = "SELECT * FROM users WHERE verified=1";
	
	try{
		$stmt = $db->prepare($query);
		$stmt->execute();	
		
	}
	catch(PDOException $ex)
	{
		
		die($ex->getMessage());	
		
	}
	$Users = $stmt->fetchAll();
	
	
?>
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        <h4>Assign Award</h4>
                    </div>
                    <div class="section" style="margin-top: 20px; padding-top: 10px;"></div>
                    </div>
                    <br>
         <form class="form-horizontal" action="<?=$page;?>?action=save" method="POST" enctype="multipart/form-data">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Award Name</label><br><br>

    <div class="controls">
      <select style="width: 400px;"class="form-control"  name="AwardId" autocomplete="off" required>
    <option value="">Please Select</option>
    <?php
	foreach($Awards as $Award)
	{
	?>
    <option value="<?=$Award['AwardId'];?>"><?=$Award['Title'];?></option>
    
    <?php	
		
	}
	
	?>
    </select>
    </div>
  </div><br>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">User</label><br><br>

    <div class="controls">
      <select style="width: 400px;"class=" select2"  name="UserId[]" multiple autocomplete="off" required>
    <option value="">Please Select</option>
    <?php
	foreach($Users as $User)
	{
	?>
    <option value="<?=$User['id'];?>"><?=$User['username'];?></option>
    
    <?php	
		
	}
	
	?>
    </select>
    </div>
  </div>
  <br />
  <div class="control-group">
    <label class="control-label" for="Description">Description</label><br>

    <div class="controls">
      <textarea style="width: 600px; height: 150px;" name="Description"></textarea>
    </div>
  </div>
  
  <br>
  
  
  <div class="control-group">
  <br>

    <div class="controls">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
                      <div class="section" style="margin-top: 45px;"></div>
                      
                </div>