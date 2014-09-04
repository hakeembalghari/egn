

<?php

include('bb/BinaryBeast.php');
		
		
		$bb=new BinaryBeast();
                
                
                
//$bb->enable_dev_mode();
$bb->disable_ssl_verification();
$tournaments = $bb->tournament->list_my(null, 300, true);


?>



<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4> Tournaments </h4>
						
						<table width="90%" class="table table-hover">
						<tr>
						<th>Tournament ID</th>
						<th>Tournament Title</th>
						<th>Delete</th>
						<th>Update</th>
						
						</tr>
						
						<?php
						$tournaments = $bb->tournament->list_my(null, 300, true);
foreach($tournaments as $tournament) {

?>
<tr>
<td><a href="tdetail?id=<?php echo $tournament->id; ?>"><?php echo $tournament->id; ?></a></td>
<td><?php echo $tournament->title ; ?></td>
<td><a href="deltournament?id=<?php echo $tournament->id; ?>" class="btn btn-danger"><i class="icon-trash"></i></a></td>
<td><a href="edittournament?id=<?php echo $tournament->id; ?>" class="btn btn-danger"><i class="icon-edit"></i></a></td>

</tr>
<?php

   // echo '<a href="/my/path/to/viewing/a/tournament?id=' . $tournament->id . '">' . $tournament->title . '</a><br>';
}
						?>
						</table>

						
						
                    </div>
                </div>
                