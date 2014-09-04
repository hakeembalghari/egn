<?PHP
$page = 'awards';
if(isset($_GET['action']) and $_GET['action']=='save')
{
	
	$name = $_FILES["Image"]["name"];
        //$extension = end(explode(".", $_FILES["images"]["name"]));
        $ran1 = rand(1111, 99999999);

        $filename = $ran1 . "_" . $name;
		$filepath = '../uploads/';
		
		$allowedExtension = array('jpg','png','gif','jpeg');
	$extension = pathinfo($filename,PATHINFO_EXTENSION);	
		
		
		if(!in_array($extension,$allowedExtension))
		{
			echo "<script>alert('Only images are allowed please check');window.location='$page';</script>";exit;	
			
		}
		
	
        
		if(move_uploaded_file( $_FILES["Image"]["tmp_name"], $filepath.$filename))
		{
		$query = "INSERT INTO awards (CategoryId,Title,Image,Description)
	
	VALUES (:category_id,:title,:image,:description)
	";	
	
	$params = array(
	':category_id'=>$_POST['CategoryId'],
	':title' =>$_POST['Title'],
	':image' => $filename,
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

$query="DELETE FROM awards WHERE AwardId=:id";

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
            * FROM awards ORDER BY AwardId DESC 
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
	
	$query = "SELECT * FROM award_category";
	
	try{
		$stmt = $db->prepare($query);
		$stmt->execute();	
		
	}
	catch(PDOException $ex)
	{
		
		die($ex->getMessage());	
		
	}
	$Categories = $stmt->fetchAll();
	
	
?>
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        <h4>Add Award</h4>
                    </div>
                    <div class="section" style="margin-top: 20px; padding-top: 10px;"></div>
                    </div>
                    <br>
         <form class="form-horizontal" action="<?=$page;?>?action=save" method="POST" enctype="multipart/form-data">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Award Category</label><br><br>

    <div class="controls">
      <select style="width: 400px;"class="form-control"  name="CategoryId" autocomplete="off" required>
    <option value="">Please Select</option>
    <?php
	foreach($Categories as $Category)
	{
	?>
    <option value="<?=$Category['Id'];?>"><?=$Category['Title'];?></option>
    
    <?php	
		
	}
	
	?>
    </select>
    </div>
  </div><br>
  
  <div class="control-group">
    <label class="control-label" for="inputEmail">Award Title</label><br><br>

    <div class="controls">
      <input type="text" style="width: 400px;"class="form-control" placeholder="Name of Award" name="Title" autocomplete="off" required>
    </div>
  </div><br>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Image</label><br><br>

    <div class="controls">
      <input type="file" style="width: 400px;"class="form-control" placeholder="Provide Category description" name="Image" autocomplete="off" required="required">
    </div>
  </div>
  <br />
  <div class="control-group">
    <label class="control-label" for="Description">Answer</label><br>

    <div class="controls">
      <textarea  style="width: 600px; height: 150px;" name="Description"></textarea>
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
                    <h4>Manage Awards </h4>
                    <br />

	<table class="table table-hover">
                        <thead>
                        
                            <tr>
                                <th class="col-md-2">
                                    Category
                                </th>
                                
                                <th class="col-md-2">
                                    <span class="line"></span>
                                   Title
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                   Image
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
                                    <div class="comments" data-title="Modify Title" data-type="text" data-pk="<?PHP echo $category["Id"]; ?>" data-url="ajax.php?page=<?=$page;?>&field=title"><?PHP echo $category["CategoryId"]; ?></div>
                                </td>
                                <td>
					<div class="comments" data-title="Modify Description" data-type="text" data-pk="<?PHP echo $category["Id"]; ?>" data-url="ajax.php?page=<?=$page;?>&field=description"><?PHP echo substr($category["Title"],0,30).'...'; ?></div>				
                                </td>
                                
                                <td>
					<div class="comments" ><img src="../uploads/<?=$category['Image'];?>" width="50%" height="50%" /></div>				
                                </td>
                                <td>
                                   <a class="btn btn-danger" href="javascript:void(0);" onClick="if(confirm('Your Record will be deleted and might affect its children. Are you sure?')){window.location='<?=$page;?>?action=delete&id=<?PHP echo $category["AwardId"]; ?>'}" ><i class="icon-trash"></i></a>
                                </td>
                         	</tr>
                            <?PHP endforeach; ?>
                      </tbody>
                      </table>
                            </div> 
                </div>
                </div>