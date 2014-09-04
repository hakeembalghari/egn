<?php
session_start();
extract($_POST);
if($_POST['act'] == 'add-com'):
	$name = htmlentities($name);
    $email = htmlentities($email);
    $comment = htmlentities($comment);

	$name = addslashes($name);
	$email = addslashes($email);
	$comment = addslashes($comment);
    // Connect to the database
	require_once('myDb.php');
	
	// Get gravatar Image 
	// https://fr.gravatar.com/site/implement/images/php/

	if(strlen($name) <= '1'){ $name = 'Guest';}
    //insert the comment in the database
    mysqli_query($con,"INSERT INTO comments (name, email, comment, username)VALUES( '$name', '$email', '$comment', '$id_post')");
   
?>

<?php endif; ?>