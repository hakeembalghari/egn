
<?php

if(isset($_POST['submit']))
		{
		
		include('bb/BinaryBeast.php');
		
		//echo "hello";
		$bb=new BinaryBeast();
                
                
                
$bb->enable_dev_mode();
$bb->disable_ssl_verification();


//echo $_POST['tid'];


             
		$tournament       = $bb->tournament($_POST['tid']);
		$team = $tournament->team();
		$team->display_name = 		 $_POST['ttitle'];
		if($_POST['ttype']=="Confirmed")
		{
		$team->confirm();
		}
		if($_POST['ttype']=="Unconfirmed")
		{
		$team->unconfirm();
		}
                
		
		
		
		if($tournament->save()) {
		//var_dump($bb->last_error);
		//BinaryBeast::results_history();
               
		}
		
		if($tournament->save_teams()) {
		
	
			header('Location: teams');
}

		else
		{
		
		echo "Error";
		
		}
		
		}


?>