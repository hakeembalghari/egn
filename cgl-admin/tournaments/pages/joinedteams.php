

<?php

$q="SELECT* from egn_teams where tournament_id=".$_GET['id'];

$res=mysqli_query($con,$q);

?>



<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4> Teams in the Tournaments </h4>
						
						<table width="90%" class="table table-hover">
						<tr>
					<th>ID</th>
					<th>Team</th>
				
					<th>Joinded Date</th>
					<th></th>
					<th></th>
						</tr>
						
						<?php
					
					
					while($row=mysqli_fetch_row($res))
					{

?>
<tr>
<td><?php echo $row[0];?></td>
<td>

<?php
echo $row[1];

?>

</td>

<td><?php echo $row[6];?></td>
<td>Remove</td>
<td></td>
</tr>
<?php

   // echo '<a href="/my/path/to/viewing/a/tournament?id=' . $tournament->id . '">' . $tournament->title . '</a><br>';
}
						?>
						</table>

						
						
                    </div>
                </div>
                