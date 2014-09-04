		
<?php

          
?>		
		
		
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4>Team </h4>
						
				
						
					
					<?php 
					$q="select* from egn_teams";
					
					$res=mysqli_query($con,$q);
					
					if($res)
					{
					
					
					
					?>
						
						
						<table width="90%" class="table table-striped table-bordered">
						
						<tr>
						<th>Team ID</th>
						<th>Team Title</th>
						<th>Discription</th>
					<th>Type</th>
					<th>Tournament ID</th>
					<th>Max Player</th>
					<th>Created On</th>
						<th>Delete</th>
						<th>Update</th>
						
						</tr>
					<?php
					while($row=mysqli_fetch_row($res))
					{
					?>
					<tr>
					<td><?php echo $row[0]; ?></td>
					<td><?php echo $row[1]; ?></td>
					<td><?php echo $row[2]; ?></td>
					<td><?php echo $row[3]; ?></td>
					<td><?php echo $row[4]; ?></td>
					<td><?php echo $row[5]; ?></td>
					<td><?php echo $row[6]; ?></td>
					<td><a href="delteam?id=<?php echo $row[0]; ?>" class="btn btn-danger"><i class="icon-trash"></i></a></td>
					<td><a href="editteam?id=<?php echo $row[0]; ?>" class="btn btn-danger"><i class="icon-edit"></i></a></td>
					
					</tr>
					<?php
					
					}
					?>

					
						</table>
			
						<?php } ?>
                    </div>
                </div>
                
              