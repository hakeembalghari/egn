		
<?php
session_start();



?>
		
		
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="pull-left">
                        <h4 style="margin-left:40px;">Create Team </h4>
						<br><br>
						
					
						
						<form name="nt" method="post" action="newteam.php" class="form-horizontal" enctype="multipart/form-data">
						
						
						
						<table style="margin-left:40px;" width="70%" class="table table-condensed">
						<tr>
						<td>Team Title</td>
						<td><input class="form-control" type="text" required="" min="5" style="width:400px" name="title"></input></td>
						</tr>
						
						<tr>
						<td>Max Players</td>
						<td>	<input class="form-control" type="text" required="" min="5" style="width:100px" name="mp"></input></td>
						</tr>
						<tr>
						<td>Select Tournament</td>
						<td>
						<select name="tournaments" class="select2" style="width:200px">
						
						<?php
						$q=mysqli_query($con,"select* from egn_tournaments");
						while($row=mysqli_fetch_row($q))
						{?>
						<option value="<?php echo $row[0]; ?>" ><?php echo $row[1]; ?></option>
						<?php }
						?>
						
					
						
						</select>
						</td>
						</tr>
						
						<tr>
						<td>Facebook Link</td>
						<td><input class="form-control" type="text" required="" min="5" style="width:400px" name="flink" ></input></td>
						</tr>
						<tr>
						<td>Twitter Link</td>
						<td><input class="form-control" type="text" required="" min="5" style="width:400px" name="tlink" ></input></td>
						</tr>
						
						<tr>
						<td>Discription</td>
						<td><textarea class="form-control" style="width:300px" name="disc" required=""></textarea></td>
						</tr>
					<tr>
					<td></td>
					<td><input type="file" name="img"></td>
					</tr>
							<tr>
						<td>Team's Motto</td>
						<td><textarea class="form-control" style="width:300px" name="tmotto" required=""></textarea></td>
						</tr>
						<tr>
						<td></td>
						<td><input type="submit" name="submit" value="Submit" class="btn btn-primary" /></td>
						</tr>


						</table>
					
			
						
						
	
						
						
						</form>
                    </div>
                </div>
                
              