		
<?php
include('bb/BinaryBeast.php');
		
		
		$bb=new BinaryBeast();
$bb->disable_ssl_verification();
?>
		
		
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4>Add Teams to  Tournament</h4>
						<br><br>
						
					
						
						<form name="nt" method="post" action="newteam.php" >
						
						
						<div class="control-group">
						
						
						<label class="control-label" for="tid"> Select Tournament</label>
						
						<div class="controls">
						<select name="tid" class="select2" style="width: 300px; display: none;">
						<?php $tournaments = $bb->tournament->list_my(null, 300, true);
						
						foreach($tournaments as $tournament) {
						?>
						<option value="<?php echo $tournament->id; ?>"><?php echo $tournament->title;?></option>
						
						<?php }?>
						</select>

						</div><br>
						
						<label class="control-label" for="ttitle">  Team Title</label>
						<div class="controls">
						<input class="form-control" type="text" required="" min="5" style="width:400px" name="ttitle"></input>

						</div>
						<br>
						
						<label class="control-label" for="ttype">  Team Type</label><br>
						
						

    <div class="btn-group" data-toggle="buttons">

        <label class="btn btn-primary">

            <input type="radio" name="ttype"> Confirmed

        </label>

        <label class="btn btn-primary">

            <input type="radio" name="ttype"> Unconfirmed

        </label>

       

    </div>


						
						<br><br>
						<input type="submit" name="submit" value="Submit" class="btn btn-primary" />
						</div>
	
						
						
						</form>
                    </div>
                </div>
                
              