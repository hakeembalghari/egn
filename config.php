<?php 

if(!session_start())
{
session_start();
}

define("SERVER","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DATABASE","elect150_core");

$con=mysqli_connect(SERVER,USERNAME,PASSWORD,DATABASE);


	?>
	
	
	
	
