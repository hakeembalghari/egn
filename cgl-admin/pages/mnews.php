<?PHP
	$query = " 
        SELECT 
            id,title,contents,image FROM pm_news ORDER BY  `pm_news`.`id` DESC LIMIT 20
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
?>
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        <h4>Add News</h4>
                    </div>
                    <div class="section" style="margin-top: 20px; padding-top: 10px;"></div>
                    </div>
                    <br>
         <form class="form-horizontal" action="cnews.php" method="POST" enctype="multipart/form-data">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Title</label><br>

    <div class="controls">
      <input type="text" style="width: 600px;"class="form-control" placeholder="Title" name="title" autocomplete="off">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Content</label><br>

    <div class="controls">
      <textarea class="wys" style="width: 600px; height: 150px;" name="content"></textarea>
    </div>
  </div>
  
  <div class="control-group">
    <label class="control-label" for="inputPassword">Image Thumbnail (Recommended 75x100)</label><br>
        <div class="controls">
     <input type="file" name="file">

    </div>
  </div>
  
  <div class="control-group">
  <br>

    <div class="controls">
      <button type="submit" class="btn btn-primary">Submit News</button>
    </div>
  </div>
</form>
                      <div class="section" style="margin-top: 45px;"></div>
                      <div class="row head">
                    <div class="col-md-12">
                    <h4>Manage News Articles</h4>
                    <br />

	<table class="table table-hover">
                        <thead>
                        
                            <tr>
                            <th class="col-md-1">
                            	News ID
                            </th>
                                <th class="col-md-2">
                                    Title
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                   Content
                                </th>
                                <th class="col-md-2">
                                	<span class="line"></span>
                                    Image Preview
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                    
                                </th>
                            </tr>
                       
                        </thead>
                        <tbody>
                            <!-- row -->
                            <?PHP foreach($gnews as $gnew): ?>
                            <tr class="first">
                            	<td>
                                	<?PHP echo $gnew["id"]; ?>
                                </td>
                                <td>
                                    <div class="comments" data-title="Modify Title" data-type="text" data-pk="<?PHP echo $gnew["id"]; ?>" data-url="ajax.php?r=mnewstitle"><?PHP echo $gnew["title"]; ?></div>
                                </td>
                                <td>
                                	<div class="comments" data-title="Modify Content" style="height: 64px;overflow-y: auto;overflow-x: scroll; width:600px;" data-type="wysihtml5" data-pk="<?PHP echo $gnew["id"]; ?>" data-url="ajax.php?r=mnewscontent"><?PHP echo $gnew["contents"]; ?></div>
                                </td>
								<td>
                                	<img src="data:image/jpeg;base64,<?PHP echo base64_encode($gnew["image"]); ?>" width="64" height="64"/>
                                </td>
                                <td>
                                   <a class="btn btn-danger" href="delnews.php?s=<?PHP echo $gnew["id"]; ?>"><i class="icon-trash"></i></a>
                                </td>
                         	</tr>
                            <?PHP endforeach; ?>
                      </tbody>
                      </table>
                            </div> 
                </div>
                </div>