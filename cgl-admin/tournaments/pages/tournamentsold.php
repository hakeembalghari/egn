

<?php

$q="SELECT* from egn_tournaments";

$res=mysqli_query($con,$q);

?>



<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4> Tournaments </h4>
						
						<table width="90%" class="table table-hover">
						<tr>
						<th>Image</th>
						<th>Title</th>
						<th>Discription</th>
						<th>Delete</th>
						<th>Update</th>
						<th>Teams</th>
						</tr>
						
						<?php
					
					
					while($row=mysqli_fetch_assoc($res))
					{

?>
<tr>
<td><a href="tdetail?id=<?php echo $row['id']; ?>"><img src="<?php echo $row['image']; ?>"" width="40" height="40" ></a></td>
<td><a href="tdetail?id=<?php echo $row['id']; ?>" title="Click to view detail of this tournament"><?php echo $row['title']; ?></a></td>
<td><a title="<?php echo $row['disc'] ; ?>"><?php echo $row['disc'] ; ?></a></td>
<td><a href="deltournament?id=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="icon-trash"></i></a></td>
<td><a href="edittournament?id=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="icon-edit"></i></a></td>
<td><a href="joinedteams?id=<?php echo $row['id']; ?>" class="btn btn-danger">View Teams</a></td>
</tr>
<?php

   // echo '<a href="/my/path/to/viewing/a/tournament?id=' . $tournament->id . '">' . $tournament->title . '</a><br>';
}
						?>
						</table>

						
						
                    </div>
                </div>
                