<?php
require_once('config.php');
if(isset($_POST['submit']))
{
$_SESSION['tc']="";
$image="default.jpg";
$path="timages/";
$image=$path."default.jpg";
//$tid=   		mysql_real_escape_string($_POST['tid']);
$title= 		mysqli_real_escape_string($con,$_POST['ttitle']);
$type=  		mysqli_real_escape_string($con,$_POST['ttype']);
$mxround= 		mysqli_real_escape_string($con,$_POST['mxround']);
$mnround= 		mysqli_real_escape_string($con,$_POST['mnround']);
$ssdate= 		mysqli_real_escape_string($con,$_POST['sdate']);
$disc=			mysqli_real_escape_string($con,$_POST['disc']);
$bronze=		mysqli_real_escape_string($con,$_POST['bronze']);
$sdate=date("Y-m-d",strtotime($ssdate));
$dbtitle="";
$found=false;
$fq="select* from egn_tournaments where title='".$title."'";
$check=mysqli_query($con,$fq);

if($check)
{
$row=mysqli_fetch_array($check);

 $dbtitle=$row['title'];
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
header('Location: newtournament');
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


 if (file_exists("timages/" . $_FILES["img"]["name"])){
     // echo $_FILES["img"]["name"] . " already exists. ";
    } else {
      move_uploaded_file($_FILES["img"]["tmp_name"],  $path.$newname.".".$extension);
      $image= $path.$newname.".".$extension;
    }

}
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
			}

$q="INSERT INTO egn_tournaments (title, e_type,disc,sdate,bronze,image,mxround,mnround) VALUES('$title','$type','$disc','$sdate','$bronze','$image','$mxround','$mnround')";
if(mysqli_query($con,$q))
	{
	$_SESSION['tc']="tsuccess";
	header('Location: newtournament');
	}
else
{
header('Location: newtournament');
}
}
} ?>