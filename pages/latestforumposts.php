
<?php
$vbserver="localhost";
$vbuser="elect150_zaman";
$vbpass="ilovepakistan123";

$vbdb="elect150_vbulletin";

$vbcon=mysqli_connect($vbserver,$vbuser,$vbpass,$vbdb);

$q="select* from post limit 20";
$res=mysqli_query($vbcon,$q);

while($row=mysqli_fetch_array($res))
{
?>

<div class="boxpill">
    	<a href="posts?id=<?php echo $row['postid'];?>"><img style="padding-right: 5px;" src="img/bf3.png" height="16" width="16" /><?php echo $row['title'];?></a><span class="pull-right"></span></a>
    </div>
   <?php }?>