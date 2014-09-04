		
<?php
session_start();



?>
		
		
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4>Add New Game </h4>
						<br><br>
						
					
						
						<form name="ng" method="post" action="newg.php" >
						
						
						
						<div class="control-group">
						
						<label class="control-label" for="title">  Game Title</label>
						<div class="controls">
						<input class="form-control" type="text" required="" min="5" style="width:400px" name="title"></input>

						</div>


						<br>
					<label class="control-label" for="img"> Image of Game</label><br>
						<div class="controls">
						
      <span class="btn btn-default btn-file">
    Browse <input type="file" name="img">
    </span>

						</div><br>
						
						<label class="control-label" for="disc">  Description</label><br>
						<div class="controls">
			<textarea class="form-control" style="width:300px" name="disc" required=""></textarea>
						
					

						</div><br>
						<input type="submit" name="submit" value="Submit" class="btn btn-primary" />
						</div>
	
						
						
						</form>
                    </div>
                </div>
                
              