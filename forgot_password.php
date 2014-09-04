<?php
session_start();
require_once('myDb.php');
$Action = $_GET['action'];
$Email = $_POST['Email'];
if($Action=='reset')
{
	$EmailCheck = mysqli_query($con,"SELECT * FROM users WHERE email='$Email' AND verified=1");
	$Records = mysqli_fetch_array($EmailCheck);
	if(count($Records)==0)
	{
	echo 'Email invalid or not verified';
	exit;	
	}
	else
	{
		mail($Records["email"], "Account Reset", "Please Visit This Link To Reset Your EGN Account http://electronicgaming.net/beta/forgot_password.php?id=".$Records['verifyid']."&action=new");

echo 'Please go check your Email for the new password. Redirecting...';		
		exit;
	}
	
}
if($Action=='new')
{
	$VerifyId=$_GET['id'];
	$TokenCheck = mysqli_query($con,"SELECT * FROM users WHERE verifyid='$VerifyId'");
	
	$Records = mysqli_fetch_array($TokenCheck);
	if(count($Records)==0)
	{
	echo 'Invalid Token';
	exit;	
		
	}
	else
	{
		
		  $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647)); 
		 
    

		  $new_password = substr( md5(rand()), 0, 7);

        $password = hash('sha256', $new_password . $salt); 

        for($round = 0; $round < 65536; $round++) 
        { 
            $password = hash('sha256', $password . $salt); 
        } 	
		
		mysqli_query($con,"UPDATE users SET Salt='$salt',Password='$password' WHERE verifyid='$VerifyId'");
		
		
		mail($Records["email"], "Login Details", "Dear User, here is your login details. Username: ".$Records['username'].", Password: ".$new_password);

header("Location: index.php");
		
	}
	
	
}



?>