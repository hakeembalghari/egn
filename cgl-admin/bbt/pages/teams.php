		
<?php

include('bb/BinaryBeast.php');
		
		//echo "hello";
		$bb=new BinaryBeast();
                
                
                
$bb->enable_dev_mode();

$bb->disable_ssl_verification();

          
?>		
		
		
		<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4>Team </h4>
						
						<form name="team" action="" method="post" class="well form-search">
						
						Select Tournament<br>
						<select name="steam" class="select2" style="width: 400px; display: none;">
						<?php $tournaments = $bb->tournament->list_my(null, 300, true);
						
						foreach($tournaments as $tournament) {
						?>
						<option value="<?php echo $tournament->id; ?>"><?php echo $tournament->title;?></option>
						
						<?php }?>
						</select>
						
						<input type="submit" value="Search" name="submit" class="btn btn-primary" />
						
						
						</form>
						
					
					
						
						
						<table width="80%" class="table table-striped table-bordered">
						
						<tr>
						<th>Team ID</th>
						<th>Team Title</th>
						<th>Delete</th>
						<th>Update</th>
						</tr>
					<?php	
					
					if(isset($_POST['steam'])):
					$tournament=$bb->tournament($_POST['steam']);
						$teams = $tournament->teams();
echo sizeof($teams) . ' teams found in the tournament';
foreach($teams as $team) {
?>
<tr>

<td><a href="viewteam?tn=<?php echo $team->display_name; ?>"><?php echo $team->display_name; ?></a></td>

<td>n/a</td>
<td><a href='delteam?team=<?php echo $team->display_name; ?>' class="btn btn-danger"><i class="icon-trash"></i></a></td>
<td><a href='editteam?team=<?php echo $team->display_name; ?>' class="btn btn-danger" ><i class="icon-edit"></i></a></td>

</tr>
<?php
    //$team is a BBTeam instance, do whatever you want with it now
}
endif;
?>
						
						</table>
			
						
                    </div>
                </div>
                
              