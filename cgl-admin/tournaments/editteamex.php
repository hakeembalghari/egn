<?php
ob_start();
require_once('config.php');

if(isset($_POST['update']))
{

//echo $_POST['bronze'];
		
$title= 		mysqli_real_escape_string($con,$_POST['title']);
$disc=  		mysqli_real_escape_string($con,$_POST['disc']);

$type= 		mysqli_real_escape_string($con,$_POST['type']);
$tournament_id=mysqli_real_escape_string($con,$_POST['tournaments']);
$max_players= 		mysqli_real_escape_string($con,$_POST['mp']);
$cdate=date("Y-m-d");
$path="gimages/";


if (mysqli_connect_errno()) {
  //echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}


//die($image);



$q="update egn_teams set disc='$disc' type='$type' max_players='$max_players' where id='$tid'";
if(mysqli_query($con,$q))
	{
header('Location:teams');
	}

	else

	{

echo "error";
	}
}




?>