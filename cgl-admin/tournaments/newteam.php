<?php
require_once('config.php');
if(isset($_POST['submit']))
		{
		
		
		
		
		
$title= 		mysqli_real_escape_string($con,$_POST['title']);
$disc=  		mysqli_real_escape_string($con,$_POST['disc']);

$type= 		mysqli_real_escape_string($con,$_POST['type']);
$tournament_id=mysqli_real_escape_string($con,$_POST['tournaments']);
$max_players= 		mysqli_real_escape_string($con,$_POST['mp']);
$cdate=date("Y-m-d");

$dbtitle="";
$found=false;
$fq="select* from egn_teams where name='".$title."'";
$check=mysqli_query($con,$fq);

if($check)
{
$row=mysqli_fetch_array($check);

 $dbtitle=$row['name'];
 //echo $dbtitle;
 //echo "<br>".$title;
// die("error");
 if($dbtitle===$title)
 {
$found=true;
}
//die("found");
}

if($found)
{
$_SESSION['tc']="tfound";
header('Location: creategame?f=y');
}


else
{
//echo mysql_error();
//die("else part");

if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

$q="INSERT INTO egn_teams (name,disc,confirmed,tournament_id,max_players,cdate) VALUES('$title','$disc','$type','$tournament_id','$max_players','$cdate')";
if(mysqli_query($con,$q))
	{
	$_SESSION['tc']="tsuccess";
	header('Location: teams');
	}
else
{
header('Location: createteam?f=y');
}
}
} ?>