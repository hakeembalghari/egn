
<?php


if(isset($_GET['id']))
{

$q="delete from egn_teams where id=".$_GET['id'];

if(mysqli_query($con,$q))
{
//echo "Team deleted successfully";

header('Location: teams');
}

}

?>
                