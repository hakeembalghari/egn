<?php
//ob_start();
require_once('config.php');

if(isset($_POST['update']))
{

//echo $_POST['bronze'];
$tid=   		mysqli_real_escape_string($con,$_POST['tid']);
$title= 		mysqli_real_escape_string($con,$_POST['ttitle']);
$type=  		mysqli_real_escape_string($con,$_POST['ttype']);
$mxround= 		mysqli_real_escape_string($con,$_POST['mxround']);
$mnround= 		mysqli_real_escape_string($con,$_POST['mnround']);
$ssdate= 		mysqli_real_escape_string($con,$_POST['sdate']);
$disc=			mysqli_real_escape_string($con,$_POST['disc']);
$bronze=		mysqli_real_escape_string($con,$_POST['bronze']);
$sdate=date("Y-m-d",strtotime($ssdate));

$path="timages/";


if (mysqli_connect_errno()) {
  //echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}
$dbimage=mysqli_query($con,"select image from egn_tournaments where id=".$tid);

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



$q="update egn_tournaments set e_type='$type',disc='$disc',sdate='$sdate',bronze='$bronze',image='$image',mxround='$mxround',mnround='$mnround' where id='$tid'";
if(mysqli_query($con,$q))
	{
header('Location: edittournament?id='.$tid);
	}

	else

	{

echo "error";
	}
}

?>