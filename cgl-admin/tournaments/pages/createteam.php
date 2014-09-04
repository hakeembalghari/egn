		
<?php
session_start();



?>
		
		
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4>Create Team </h4>
						<br><br>
						
					
						
						<form name="nt" method="post" action="newteam.php" >
						
						
						
						<div class="control-group">
						
						<label class="control-label" for="title">  Team Title</label>
						<div class="controls">
						<input class="form-control" type="text" required="" min="5" style="width:400px" name="title"></input>

						</div>


						<br>
						<label class="control-label" for="type">  Team Type</label>
						
						<div class="controls">
						<select name="type" class="select2" style="width: 300px; display: none;">
						<option value="Yes" >Confirmed</option>
						<option value="No">Unconfirmed</option>
						
						</select>

						</div>
						<br>
							<div class="control-group">
						
						<label class="control-label" for="mp">  Max Players</label>
						<div class="controls">
						<input class="form-control" type="text" required="" min="5" style="width:100px" name="mp"></input>

						</div><br>
						
						<label class="control-label" for="tournaments">  Select Tournament</label><br>
						
						<div class="controls">
						<select name="tournaments" class="select2" style="width:200px">
						
						<?php
						$q=mysqli_query($con,"select* from egn_tournaments");
						while($row=mysqli_fetch_row($q))
						{?>
						<option value="<?php echo $row[0]; ?>" ><?php echo $row[1]; ?></option>
						<?php }
						?>
						
					
						
						</select>

						</div><br>
				
						<label class="control-label" for="disc">  Description</label><br>
						<div class="controls">
			<textarea class="form-control" style="width:300px" name="disc" required=""></textarea>
						
					

						</div><br>
						
						
						<br>
						<input type="submit" name="submit" value="Submit" class="btn btn-primary" />
						</div>
	
						
						
						</form>
                    </div>
                </div>
                
              