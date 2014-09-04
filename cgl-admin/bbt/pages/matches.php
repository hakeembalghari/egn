

<?php

include('../bb/BinaryBeast.php');
		
		
		$bb=new BinaryBeast();
                
                
                $bb->enable_dev_mode();
$bb->disable_ssl_verification();
//$tournaments = $bb->tournament->list_my(null, 300, true);


?>



<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4> Matches </h4>
						
						
						<form name="matches" action="" method="post" class="well form-search">
						<div class="control-group">
						
					<label class="control-label" for="tid">  Matches</label>
						
						<div class="controls">
						<select name="tid" class="select2" style="width: 300px; display: none;">
						<?php $tournaments = $bb->tournament->list_my(null, 300, true);
						
						foreach($tournaments as $tournament) {
						?>
						<option value="<?php echo $tournament->id; ?>"><?php echo $tournament->title;?></option>
						
						<?php }?>
						</select>

						</div>
						
						
						
						
						
						
						</div><br>
						<input type="submit" name="submit" value="Search" class="btn btn-primary" />
						</form>
						
						
						
						
						<br>
						
						
						<?php
						if(isset($_POST['tid']))
						{
						//echo $_POST['tid'];
						$tournament=$bb->tournament($_POST['tid']);
						
						if(!$tournament->start()) {
							var_dump($bb->last_error);
							}
						
						$matches = $tournament->open_matches();
						foreach($matches as $match) {
						echo $match->team->display_name . ' vs ' . $match->team2->display_name . ' in round ' . $match->round_format->round . '<br />';
													}
												
							
							
							

						}							
					?>
						<h3>Reaching here</h3>
                    </div>
                </div>
                