<?php

	if(isset($_GET['id']))
	{
	$q="select* from egn_teams where id=".$_GET['id'];
	
	
	$res=mysqli_query($con,$q);
//	$row=mysqli_fetch_row($res);
	if($res)
	{
	$row= mysqli_fetch_row($res);

	//var_dump($row);
	
	
	}
	else
	{
	$_GET['id']=000;
	}
	?>


<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4> Edit Team </h4>
						
						
						<form name="nt" method="post" action="editteamex.php" >
						
						
						
						<div class="control-group">
						
						<label class="control-label" for="title">  Team Title</label>
						<div class="controls">
						<input class="form-control" type="text" required="" min="5" style="width:400px" name="title" value="<?php echo $row[1] ?>"></input>

						</div>


						<br>
					<label class="control-label" for="type">  Tournament Type</label><br>
				 <div class="btn-group" data-toggle="buttons">

				 <?php if($row[3]=="Yes")
				{?>
        <label class="btn btn-default active">
				<?php }
				else
				{?>
				<label class="btn btn-default">
				<?php
				
				}
				?>
				
            <input type="radio" name="type" value="Yes"> Confirmed

        </label>

       <?php if($row[3]=="No")
				{?>
        <label class="btn btn-default active">
				<?php }
				else
				{?>
				<label class="btn btn-default">
				<?php
				
				}
				?>

            <input type="radio" name="type" value="No"> Un Confirmed

        </label>

       

    </div>
						<br>
							<div class="control-group">
						
						<label class="control-label" for="mp">  Max Players</label>
						<div class="controls">
						<input class="form-control" type="text" required="" min="5" style="width:100px" name="mp" value="<?php echo $row[5]?>"></input>

						</div><br>
						
						<label class="control-label" for="tournaments">  Select Tournament</label><br>
						
						<div class="controls">
						<select name="tournaments" class="select2" style="width:200px">
						
						<?php
						$q=mysqli_query($con,"select* from egn_tournaments");
						while($row1=mysqli_fetch_row($q))
						{?>
						<option value="<?php echo $row1[0]; ?>"
						<?php
						if($row1[0]==$row[4])
						{
						echo "selected";
						}
						?>
						
						><?php echo $row1[1]; ?></option>
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
                    </div>
                </div>
				
				<?php }?>