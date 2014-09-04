	
	<?php

	if(isset($_GET['id']))
	{
	$q="select* from egn_tournaments where id=".$_GET['id'];
	
	
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
                        <h4>Edit Tournament </h4>
						
						         <?php if(isset($_SESSION['tu']))		
		{
		
		?>
        
            <div class="alert alert-info">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong>Note!</strong> <?php echo $_SESSION['tu']; $_SESSION['tu']=null; ?>

    </div>

        <?php }?>
		
		
        
		
						
						
						
						<form name="et" method="post" action="editt.php" class="form-horizontal" enctype="multipart/form-data">
						
					
					<input type="hidden" value="<?php echo $row[0];?>" name="tid">
					<div class="control-group">
						
						<label class="control-label" for="ttitle">  Tournament Title</label><br>
						<div class="controls">
						<input class="form-control" type="text" required="" min="5" style="width:400px" name="ttitle" value="<?php echo $row[1];?>"></input>

						</div><br>
					
					
					
					
						<!--<label class="control-label" for="ttype">  Tournament Type</label><br>
						
						<div class="controls">
						<select name="ttype" class="select2">
						<?php //echo $row[2]; 
						
					//	if($row[2]=='Single')
						//?>
						<option value="Single" selected >Single Elimination</option>
						<?php
						
					//	if($row[2]=='Double')
					//	{
						?>
						
				
					
						<option value="Double" selected>Double Elimination</option>
						<?php 
						//}?>
						</select>
-->
<label class="control-label" for="ttype">  Tournament Type</label><br>
				 <div class="btn-group" data-toggle="buttons">

				 <?php if($row[2]=="Single")
				{?>
        <label class="btn btn-default active">
				<?php }
				else
				{?>
				<label class="btn btn-default">
				<?php
				
				}
				?>
				
            <input type="radio" name="ttype" value="Single" checked="true"> Single Elimination

        </label>

       <?php if($row[2]=="Double")
				{?>
        <label class="btn btn-default active">
				<?php }
				else
				{?>
				<label class="btn btn-default">
				<?php
				
				}
				?>

            <input type="radio" name="ttype" value="Double"> Double Elimination

        </label>

       

    </div>









						</div><br>
						
						<label class="control-label" for="mxround">  Round (Max)</label><br>
						<div class="controls">
						<input class="form-control" type="text" required="" min="5" style="width:20%;display:inline;" name="mxround" value="<?php echo $row[9];?>"></input>

						</div><br>
						<label class="control-label" for="mnround">  Round (Min)</label><br>
						<div class="controls">
						<input class="form-control" type="text" required="" min="5" style="width:20%;display:inline;" name="mnround" value="<?php echo $row[10];?>"></input>

						</div><br>
						<label class="control-label" for="sdate"> Starting Date</label><br>
						<div class="controls">
						<input class="form-control input-datepicker" type="text" required="" min="5" style="width:100px" name="sdate" value="<?php echo $row[4];?>"></input>

						</div><br>
						
						<label class="control-label" for="disc">  Description</label><br>
						<div class="controls">
<textarea  class="form-control" style="width:300px" name="disc"><?php echo $row[3]; ?></textarea>
						
					

						</div><br>
						
						




<label class="control-label" for="bronze"> Bronze</label><br>
				 <div class="btn-group" data-toggle="buttons">

				 <?php if($row[8]=="True")
				{?>
        <label class="btn btn-default active">
				<?php }
				else
				{?>
				<label class="btn btn-default">
				<?php
				
				}
				?>
				
            <input type="radio" name="bronze" value="True"> True

        </label>

       <?php if($row[8]=="False")
				{?>
        <label class="btn btn-default active">
				<?php }
				else
				{?>
				<label class="btn btn-default">
				<?php
				
				}
				?>

            <input type="radio" name="bronze" value="False"> False

        </label>

       

    </div>







    <br /><br /><br />
	
	<img src="<?php echo $row[11]?>" width="50" height="50"><br><br>
    
    <label class="control-label" for="img"> Image of Tournament</label><br>
						<div class="controls">
						
    <input type="file" data-filename-placement="inside" name="img" class="btn btn-default" />

						</div><br>
    
<input type="hidden" value="<?php echo $row[11]?>" name="dbimage" />

						<br><br>
						
						<input type="submit" name="update" value="Update" class="btn btn-primary" />
						</form>
				
						
						
                    </div>
                </div>
				
				<?php }?>