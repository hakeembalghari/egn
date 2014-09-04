<?php

if(isset($_GET['id'])) {
 
 $q="delete from egn_tournaments where id=".$_GET['id'];
 
 if(mysqli_query($con,$q))
 {
 header('Location: tournaments');
 }
 else
 {
 //echo "error deleting tournaments";
  header('Location: tournaments?d=f');
 }
 
 }
 ?>
                