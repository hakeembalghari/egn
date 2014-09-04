<?php
session_start();
require_once('myDb.php');

$Value = $_POST['value'];
$Id = $_POST['id'];
$Detail = explode("~",$Id);
$Table = $Detail[0];
$Column = $Detail[1];

mysqli_query($con,"UPDATE $Table SET $Column = '".$Value."' WHERE user_id='".$_SESSION['user']['id']."'");

echo str_replace("\\","",($Value));
?>