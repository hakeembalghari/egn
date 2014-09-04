<?PHP
$page = 'award-category';
if(isset($_GET['action']) and $_GET['action']=='save')
{
	$query = "INSERT INTO award_category (Title,Description)
	
	VALUES (:title,:description)
	";	
	
	$params = array(
	':title' =>$_POST['award-title'],
	':description' => $_POST['award-description']
	);
	
	try{
			$stmt = $db->prepare($query);
			$stmt->execute($params);	
		
	}
	catch(PDOException $ex)
	{
		die($ex->getMessage());	
		
	}
	
	echo "<script>window.location='$page'</script>";exit;
}

if(isset($_GET['action']) and $_GET['action']=='delete')
{
$id = $_GET['id'];

$query="DELETE FROM award_category WHERE Id=:id";

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
            * FROM award_category ORDER BY Id DESC 
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
	
	
?>
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        <h4>Add Award Category</h4>
                    </div>
                    <div class="section" style="margin-top: 20px; padding-top: 10px;"></div>
                    </div>
                    <br>
         <form class="form-horizontal" action="<?=$page;?>?action=save" method="POST">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Category Title</label><br><br>

    <div class="controls">
      <input type="text" style="width: 400px;"class="form-control" placeholder="Title" name="award-title" autocomplete="off" required>
    </div>
  </div><br>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Category Description</label><br><br>

    <div class="controls">
      <input type="text" style="width: 400px;"class="form-control" placeholder="Provide Category description" name="award-description" autocomplete="off">
    </div>
  </div>
  
  <div class="control-group">
  <br>

    <div class="controls">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>
                      <div class="section" style="margin-top: 45px;"></div>
                      <div class="row head">
                    <div class="col-md-12">
                    <h4>Manage Categories </h4>
                    <br />

	<table class="table table-hover">
                        <thead>
                        
                            <tr>
                                <th class="col-md-2">
                                    Title
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                   Description
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                    
                                </th>
                            </tr>
                       
                        </thead>
                        <tbody>
                            <!-- row -->
                            <?PHP foreach($categories as $category): 	
							?>
                            <tr class="first">
                                <td>
                                    <div class="comments" data-title="Modify Title" data-type="text" data-pk="<?PHP echo $category["Id"]; ?>" data-url="ajax.php?page=<?=$page;?>&field=title"><?PHP echo $category["Title"]; ?></div>
                                </td>
                                <td>
					<div class="comments" data-title="Modify Description" data-type="text" data-pk="<?PHP echo $category["Id"]; ?>" data-url="ajax.php?page=<?=$page;?>&field=description"><?PHP echo substr($category["Description"],0,30).'...'; ?></div>				
                                </td>
                                <td>
                                   <a class="btn btn-danger" href="javascript:void(0);" onClick="if(confirm('Your Record will be deleted and might affect its children. Are you sure?')){window.location='<?=$page;?>?action=delete&id=<?PHP echo $category["Id"]; ?>'}" ><i class="icon-trash"></i></a>
                                </td>
                         	</tr>
                            <?PHP endforeach; ?>
                      </tbody>
                      </table>
                            </div> 
                </div>
                </div>