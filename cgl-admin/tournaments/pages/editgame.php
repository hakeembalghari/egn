	
	<?php

	if(isset($_GET['id']))
	{
	$q="select* from egn_games where id=".$_GET['id'];
	
	
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
                        <h4>Edit Game </h4>
						
						         <?php if(isset($_SESSION['tu']))		
		{
		
		?>
        
            <div class="alert alert-info">

        <a href="#" class="close" data-dismiss="alert">&times;</a>

        <strong>Note!</strong> <?php echo $_SESSION['tu']; $_SESSION['tu']=null; ?>

    </div>

        <?php }?>
		
		
        
		
						
						
						
						<form name="et" method="post" action="editg.php" class="form-horizontal" enctype="multipart/form-data">
						
					
					<input type="hidden" value="<?php echo $row[0];?>" name="tid">
					<div class="control-group">
						
						<label class="control-label" for="title">  Game Title</label><br>
						<div class="controls">
						<input class="form-control" type="text" required="" min="5" style="width:400px" name="title" value="<?php echo $row[1];?>"></input>

						</div><br>
					
						<label class="control-label" for="disc">  Description</label><br>
						<div class="controls">
<textarea  class="form-control" style="width:300px" name="disc"><?php echo $row[3]; ?></textarea>
						
					

						</div><br>
						
						






       









    <br /><br /><br />
	
	<img src="<?php echo $row[2]?>" width="50" height="50"><br><br>
    
    <label class="control-label" for="img"> Image of Tournament</label><br>
						<div class="controls">
						
    <input type="file" data-filename-placement="inside" name="img" class="btn btn-default" />

						</div><br>
    
<input type="hidden" value="<?php echo $row[2]?>" name="dbimage" />

						<br><br>
						
						<input type="submit" name="update" value="Update" class="btn btn-primary" />
						</form>
				
						
						
                    </div>
                </div>
				
				<?php }?>