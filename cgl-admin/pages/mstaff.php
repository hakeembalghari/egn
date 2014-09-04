<?PHP
	$query = " 
        SELECT 
            id,name,email,position,placement FROM pm_staff
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
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4>Modify Staff</h4>
                    </div>
                </div>
                
                <div class="row" style="padding-top: 10px;">
	<table class="table table-hover">
                        <thead>
                        
                            <tr>
                                <th class="col-md-2">
                                    Name
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                    Email
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                    Position
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                    Placement
                                </th>
                                <th class="col-md-2">
                                    <span class="line"></span>
                                </th>
                            </tr>
                       
                        </thead>
                        <tbody>
                            <!-- row -->
                            <?PHP foreach($gstaffs as $gstaff): ?>
                            <tr class="first">
                                <td>
                                    <div class="comments" data-title="Staff Name" data-type="text" data-pk="<?PHP echo $gstaff["id"]; ?>" data-url="ajax.php?r=mstaffname">
									<?PHP echo $gstaff["name"]; ?>
                                    </div>
                                </td>
                                <td>
                                	<div class="comments" data-title="Email" data-type="text" data-pk="<?PHP echo $gstaff["id"]; ?>" data-url="ajax.php?r=mstaffemail">
                                	<?PHP echo $gstaff["email"]; ?>
                                    </div>
                                </td>
                                <td>
                                	<div class="comments" data-title="Position" data-type="text" data-pk="<?PHP echo $gstaff["id"]; ?>" data-url="ajax.php?r=mstaffposition">
                                	<?PHP echo $gstaff["position"]; ?>
                                    </div>
                                </td>
                                <td>
                                	<div class="comments placement" data-title="Placement" data-type="select" data-pk="<?PHP echo $gstaff["id"]; ?>" data-url="ajax.php?r=mstaffplacement" data-original-title>
                                	<?PHP echo ucfirst($gstaff["placement"]); ?>
                                    </div>
                                </td>
                                <td>
                                   <a class="btn btn-danger" href="delstaff.php?s=<?PHP echo $gstaff["id"]; ?>"><i class="icon-trash"></i></a>
                                </td>
                         	</tr>
                            <?PHP endforeach; ?>
                      </tbody>
                      </table>
                      <div class="section"></div>
                      <div class="row head">
                    <div class="col-md-12">
                        <h4>Add Staff Member</h4>
                    </div>
                    <br>
         <form class="form-horizontal" action="newstaff.php" method="POST">
  <div class="control-group">
    <label class="control-label" for="inputEmail">Name</label><br>

    <div class="controls">
      <input type="text" style="width: 400px;"class="form-control" placeholder="Name" name="name" autocomplete="off">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Email</label><br>

    <div class="controls">
      <input type="text" style="width: 400px;"class="form-control" placeholder="Email" name="email" autocomplete="off">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Position</label><br>

    <div class="controls">
      <input type="text" style="width: 400px;"class="form-control" placeholder="Position" name="position" autocomplete="off">
    </div>
  </div>
  <div class="control-group">
    <label class="control-label" for="inputPassword">Placement</label><br>

    <div class="controls">
      <select name="placement" style="width: 200px;">
      	<option value="management">Management</option>
        <option value="staff">Staff</option>
        <option value="shoutcasters">Shoutcasters</option>
      </select>
    </div>
  </div>
  <div class="control-group">
  <br>

    <div class="controls">
      <button type="submit" class="btn btn-primary">Add Staff</button>
    </div>
  </div>
</form>
                            </div> 
                </div>
                </div>