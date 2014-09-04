<?php
ob_start();
require_once('config.php');

if(isset($_POST['update']))
{

//echo $_POST['bronze'];
$tid=   		mysqli_real_escape_string($con,$_POST['tid']);
$title= 		mysqli_real_escape_string($con,$_POST['ttitle']);
$disc=			mysqli_real_escape_string($con,$_POST['disc']);
$image=			mysqli_real_escape_string($con,$_POST['dbimage']);

$path="gimages/";


if (mysqli_connect_errno()) {
  //echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
$dbimage=mysqli_query($con,"select icon from egn_games where id=".$tid);

while($row=mysqli_fetch_array($dbimage))
{
$image=$row['image'];


}

//die($image);


$allowedExts = array("gif", "jpeg", "jpg", "png");

//$ext=$_FILES['img']['type'];
$temp = explode(".", $_FILES["img"]["name"]);
$extension = end($temp);


if(in_array($extension,$allowedExts))
{


 //if (file_exists("timages/" . $_FILES["img"]["name"])) {
     // echo $_FILES["img"]["name"] . " already exists. ";
    //} else {
      move_uploaded_file($_FILES["img"]["tmp_name"], $path . $_FILES["img"]["name"]);
      $image= $path. $_FILES["img"]["name"];
   // }
	
//	die($image."dferdd test");


}



$q="update egn_games set  icon='$image', disc='$disc' where id='$tid'";
if(mysqli_query($con,$q))
	{
header('Location:games');
	}

	else

	{

echo "error";
	}
}




?>