<?php
session_start();
require_once('myDb.php');
$SessionId = session_id();
$Time = time();
$status = 'false';
$SessionCheck = mysqli_query($con,"SELECT * FROM sessions WHERE SessionId='".$SessionId."'");

$Session = mysqli_fetch_array($SessionCheck);
if(count($Session)==0)
{
	$status = 'false';
}
else
{
	
	if($Session['Guest']==1)
	{
		$status = 'true';	
		mysqli_query($con,"UPDATE sessions SET Time='$Time' WHERE SessionId='$SessionId'");
	}
	else
	{
	
		$to_time = ($Session['Time']);

		$DifferenceInMin = round(abs($Time - $to_time) / 60,2);
		
		if($DifferenceInMin>5)
		{
			mysqli_query($con,"DELETE FROM sessions WHERE SessionId='$SessionId'");
			
			$status = 'false';
		}
		else
		{
			
				mysqli_query($con,"UPDATE sessions SET Time='$Time' WHERE SessionId='$SessionId'");
			
			$status = 'true';
			
			
		}
	
		
	}
	
}
echo $status;

?>