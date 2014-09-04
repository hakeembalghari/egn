<?PHP
	$query = " 
        SELECT 
            id,name,decisions FROM polls ORDER BY id DESC LIMIT 3 
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
	
	
?>
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                                <div class="row" style="padding-top: 10px;">
                    <div class="col-md-12">
                        <h4>Add Polls</h4>
                    </div>
                    <div class="section" style="margin-top: 20px; padding-top: 10px;"></div>
                    </div>
                    <br>
         <form class="form-horizontal" action="cpoll.php" method="POST">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Poll Title</label><br><br>

    <div class="controls">
      <input type="text" style="width: 400px;"class="form-control" placeholder="Title" name="title" autocomplete="off">
    </div>
  </div><br>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Poll Decisions (Please Seperate By Comma)</label><br><br>

    <div class="controls">
      <input type="text" style="width: 400px;"class="form-control" placeholder="choice1,choice2,choice3" name="choices" autocomplete="off">
    </div>
  </div>
  
  <div class="control-group">
  <br>

    <div class="controls">
      <button type="submit" class="btn btn-primary">Submit Poll</button>
    </div>
  </div>
</form>
                      <div class="section" style="margin-top: 45px;"></div>
                      <div class="row head">
                    <div class="col-md-12">
                    <h4>Manage Polls <span class="muted" style="font-size: 11px;">*3 Maximum</span></h4>
                    <br />

	<table class="table table-hover">
                        <thead>
                        
                            <tr>
                                <th class="col-md-2">
                                    Poll Title
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                   Decisions
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                    
                                </th>
                            </tr>
                       
                        </thead>
                        <tbody>
                            <!-- row -->
                            <?PHP foreach($gpolls as $gpoll): 	
							$polldecarrays = json_decode($gpoll["decisions"]);
							?>
                            <tr class="first">
                                <td>
                                    <div class="comments" data-title="Modify Title" data-type="text" data-pk="<?PHP echo $gpoll["id"]; ?>" data-url="ajax.php?r=mpollname"><?PHP echo $gpoll["name"]; ?></div>
                                </td>
                                <td>
									<?PHP foreach($polldecarrays as $polldecarray){  
									if($polldecarray == end($polldecarrays)){
										echo $polldecarray;
									} else {	
								        echo "".$polldecarray.", ";
								     }
								    }
									?>
                                </td>
                                <td>
                                   <a class="btn btn-danger" href="delpoll.php?s=<?PHP echo $gpoll["id"]; ?>"><i class="icon-trash"></i></a>
                                </td>
                         	</tr>
                            <?PHP endforeach; ?>
                      </tbody>
                      </table>
                            </div> 
                </div>
                </div>