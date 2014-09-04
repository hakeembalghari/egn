



<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4> Tournament Detail </h4>
				
				<?php
				
				if(isset($_GET['id']))
				{
				
				$q=mysqli_query($con,'select* from egn_tournaments where id='.$_GET['id']);
				
				$row=mysqli_fetch_row($q);
				//var_dump($row);
				?>
				
				<table width="90%" class="table table-hover">
				<tr><td></td><td><img src="<?php echo $row[11];?>" width="80" height="80" /></td></tr>
				<tr>
						<td>Tournament ID</td><td><?php echo $row[0];?></td>
						</tr>
						<tr>
						<td>Tournament Title</td><td><?php echo $row[1];?></td></tr>
						<tr><td>Elimination Type</td><td><?php echo $row[2];?></td></tr>
						<tr><td>Discription</td><td><?php echo $row[3];?></td></tr>
						<tr><td>Date</td><td><?php echo $row[4];?></td></tr>
						<tr><td>Bronze</td><td><?php echo $row[6];?></td></tr>
						<tr><td>Active</td><td><?php echo $row[7];?></td></tr>
						<tr><td>Max Round</td><td><?php echo $row[9];?></td></tr>
						<tr><td>Min Round</td><td><?php echo $row[10];?></td></tr>
						
						
					
						
				</table>
				<?php
				}
				
				?>
				<ul class="list-inline">
				<li><a href="">Edit</a></li>
				<li><a href="">Delete</a></li>
				<li><a href="">New</a></li>
				</ul>
						
						
                    </div>
                </div>
                