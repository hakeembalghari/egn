<?php
require_once('config.php');
if(isset($_POST['submit']))
{

$_SESSION['tc']="";

//$image="default.jpg";
$path="gimages/";
$image=$path."default.jpg";

//$tid=   		mysql_real_escape_string($_POST['tid']);
$title= 		mysqli_real_escape_string($con,$_POST['title']);
$disc=			mysqli_real_escape_string($con,$_POST['disc']);
//var_dump($_FILES['img']);

$sdate=date("Y-m-d");

$dbtitle="";
$found=false;
$fq="select* from egn_games where name='".$title."'";
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
header('Location: newgames?e=y');
}


else
{
//echo mysql_error();
//die("else part");



$allowedExts = array("gif", "jpeg", "jpg", "png");

//$ext=$_FILES['img']['type'];
$temp = explode(".", $_FILES["img"]["name"]);
$extension = end($temp);

$ext = explode('.',$_FILES['img']['name']);
$extension = $ext[1];
$newname = $ext[0].'_'.time();

if(in_array($extension,$allowedExts))
{


 //if (file_exists("gimages/" . $_FILES["img"]["name"])){
     // echo $_FILES["img"]["name"] . " already exists. ";
   // } else {
      move_uploaded_file($_FILES["img"]["tmp_name"],  $path.$newname.".".$extension);
      $image= $path.$newname.".".$extension;
    //}

}





if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}




$q="INSERT INTO egn_games (name, icon, disc, cdate) VALUES('$title','$image','$disc','$sdate')";
if(mysqli_query($con,$q))
	{
	$_SESSION['tc']="tsuccess";
	header('Location: games');
	}

	




else
{

header('Location: games');
}
}
}
?>