<?php
session_start();
require_once('myDb.php');
if($_GET['action']=='request')
{
mysqli_query($con,"INSERT INTO notifications (Type,UserId,SentBy) VALUES ('friend','".$_POST['user_id']."','".$_SESSION['user']['id']."')");
}

if($_GET['action']=='accept')
{
	
	mysqli_query($con,"INSERT INTO friends (UserId,FriendId) VALUES ('".$_POST['UserId']."','".$_POST['SentBy']."')");
	
	
	mysqli_query($con,"DELETE FROM notifications WHERE UserId='".$_POST['UserId']."' AND SentBy='{$_POST[SentBy]}'");
}


if($_GET['action']=='cancel')
{
	

	
	
	mysqli_query($con,"DELETE FROM notifications WHERE UserId='".$_POST['UserId']."' AND SentBy='{$_POST[SentBy]}'");
}
?>