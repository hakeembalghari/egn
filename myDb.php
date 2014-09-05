<?php
$server = true;
$con = null;
if(!$server)
{
	$con = mysqli_connect("localhost","root","","") or die ("Connection Failed"); 
}
else
{
	$con = mysqli_connect("localhost","elect150_core","root","") or 
			die ("Connection Failed");
}

foreach($_GET as $Key => $Value)
{
	$Value = htmlspecialchars($Value);
	$_GET[$Key] = addslashes($Value);
	
}
foreach($_POST as $Key => $Value)
{
	$Value = htmlspecialchars($Value);
	$_POST[$Key] = addslashes($Value);
	
}
require('general_classes.php');
?>
