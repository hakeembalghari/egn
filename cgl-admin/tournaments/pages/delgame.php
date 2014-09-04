<?php

if(isset($_GET['id'])) {
 
 $q="delete from egn_games where id=".$_GET['id'];
 
 if(mysqli_query($con,$q))
 {
 header('Location:games');
 }
 else
 {
  header('Location:games?del=f');
 }
 
 }
 ?>
						
						
						
						

						
                