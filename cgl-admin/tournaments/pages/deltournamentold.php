<?php
ob_start();
if(isset($_GET['id']))
{ 
$q="delete from egn_tournaments where id=".$_GET['id']; 
if(mysqli_query($con,$q))
{
			// @flush();
header("Location: ".$tpath."/tournaments");
//exit();
}
else
{
								//echo "error deleting tournaments";
} 
} 
?>            