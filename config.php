<?php 

if(!session_start())
{
session_start();
}

define("SERVER","localhost");
define("USERNAME","elect150_zaman");
define("PASSWORD","ilovepakistan123");
define("DATABASE","elect150_core");

$con=mysqli_connect(SERVER,USERNAME,PASSWORD,DATABASE);


	?>
	
	
	
	