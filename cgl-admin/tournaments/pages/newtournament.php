	
    
    


	
       
		
		
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4>Create Tournament </h4>
						
						<br><br>
                        
                 <?php
	 
	 if($_SESSION['tc']=="tfound")
	 {?>
        
            <div class="alert alert-warning">

        <a href="#" class="close" data-dismiss="alert">&times;</a>
    <strong>Warning!</strong>
<?php
	 echo " Tournament already exists try with another name";
	 }
	 echo " </div>";
	
	 
	 if($_SESSION['tc']=="tsuccess")
	 {?>
        
            <div class="alert alert-success">

        <a href="#" class="close" data-dismiss="alert">&times;</a>
   <strong>Success!</strong>
<?php
	 echo " Tournament created successfully";
	 }
	 echo " </div>";
	 ?>

   

        
		
		
        
		
	
						
						<form name="ct" method="post" action="newt.php" class="form-horizontal" enctype="multipart/form-data">
						
					
					<div class="control-group">
						
						<label class="control-label" for="ttitle">  Tournament Title</label><br>
						<div class="controls">
						<input class="form-control" type="text" required="" min="5" style="width:400px" name="ttitle"></input>

						</div><br>
					
					
					
					
						<label class="control-label" for="ttype">  Tournament Type</label><br>
						
						<!--<div class="controls">
						<select name="ttype" class="select2">
						<option value="Single" >Single Elimination</option>
						<option value="Double">Double Elimination</option>
						
						</select>

						</div>-->
						
						 <div class="btn-group" data-toggle="buttons">

        <label class="btn btn-default active">

            <input type="radio" name="ttype" value="Single" checked="true"> Single Elimination

        </label>

        <label class="btn btn-default">

            <input type="radio" name="ttype" value="Double"> Double Elimination

        </label>

       

    </div><br><br>
	
	<label class="control-label" for="mxplayers">  Max Player(s)</label><br>
						<div class="controls">
									<input type="number" class="form-control" id="mxplayers" name="mxplayers" min="0" step="1" data-bind="value:replyNumber"  style="width:20%;display:inline;"/>

						</div><br>
						
						
						<label class="control-label" for="tmode">  Team Mode</label><br>
						<?php 
						$team_mode=array("1 v 1","2 v 3","3 v 3","4 v 4","5 v 5","6 v 6","7 v 7","8 v 8","9 v 9","10 v 10","11 v 11","12 v 12","13 v 13","14 v 14","15 v 15");
						?>
					<div class="controls">
						<select name="tmode" class="select2" style="width:200px">
						<?php
						foreach($team_mode as $m)
						{
						?>
						<option value="<?php echo $m; ?>" ><?php echo $m; ?></option>
						<?php } ?>
						
						</select>

						</div><br>
						
						
						<label class="control-label" for="sgame">  Select Game</label><br>
						
						<div class="controls">
						<select name="sgame" class="select2" style="width:200px">
						
						<?php
						$q=mysqli_query($con,"select* from egn_games");
						while($row=mysqli_fetch_row($q))
						{?>
						<option value="<?php echo $row[0]; ?>" ><?php echo $row[1]; ?></option>
						<?php }
						?>
						
					
						
						</select>

						</div>
						
					
						
						<label class="control-label" for="mxround">  Round (Max)</label><br>
						<div class="controls">
									<input type="number" class="form-control" id="mxround" name="mxround" min="0" step="1" data-bind="value:replyNumber"  style="width:20%;display:inline;"/>

						</div><br>
						<label class="control-label" for="mnround">  Round (Min)</label><br>
						<div class="controls">
						
						<input type="number" class="form-control" id="mnround" name="mnround" min="0" step="1" data-bind="value:replyNumber"  style="width:20%;display:inline;"/>
						<!--
						<input class="form-control" type="text" required="" min="5" style="width:20%;display:inline;" name="mnround"></input>
-->
						</div><br>
						<label class="control-label" for="sdate"> Starting Date</label><br>
						<div class="controls">
						<input class="form-control input-datepicker" type="text" required="" min="5" style="width:100px" name="sdate"></input>

						</div><br>
						
						<label class="control-label" for="disc">  Description</label><br>
						<div class="controls">
			<textarea class="form-control" style="width:300px" name="disc" required=""></textarea>
						
					

						</div><br>
						
						
<label>Bronze</label><br>
    <div class="btn-group" data-toggle="buttons">

        <label class="btn btn-default active">

            <input type="radio" name="bronze" value="true"> True

        </label>

        <label class="btn btn-default">

            <input type="radio" name="bronze" value="false"> False

        </label>

       

    </div><br /><br /><br />
    
    <label class="control-label" for="img"> Image of Tournament</label><br>
						<div class="controls">
						
    <input type="file" data-filename-placement="inside" name="img">

						</div><br>
    


						<br><br>
						
						<input type="submit" name="submit" value="Submit" class="btn btn-primary" />
						</form>
                    </div>
                </div>
				</div>
              <?php
			  $_SESSION['tc']="";
			  ?>
                
         
              