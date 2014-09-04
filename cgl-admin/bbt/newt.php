
<?php

if(isset($_POST['submit']))
		{
		
		include('../bb/BinaryBeast.php');
		
		//echo "hello";
		$bb=new BinaryBeast();
                
                
                
$bb->enable_dev_mode();
$bb->disable_ssl_verification();


//$tournaments = $bb->tournament->list_popular();

//foreach($tournaments as $tournament) {
    //echo '<a href="' . $tournament->url . '">' . $tournament->title . '</a><br />';
//}
             
		$tournament       = $bb->tournament();
		$tournament->title          = $_POST['ttitle'];			 
		if($_POST['ttype']=="Single")
		{
		$tournament->elimination    = BinaryBeast::ELIMINATION_SINGLE;
		}
		if($_POST['ttype']=="Double")
		{
		$tournament->elimination    = BinaryBeast::ELIMINATION_DOUBLE;
		}
              foreach($tournament->rounds->winners as $round) {
    $round->best_of = $_POST['tround'];
}
$tournament->rounds->finals->best_of = $_POST['troundf'];;  
		
		$bronze=null;
		if($_POST['bronze']=="true")
		{
		$bronze=true;
		}
		if($_POST['bronze']=="false")
		{
		$bronze=false;
		}
		
		//$tournament->elimination    = BinaryBeast::ELIMINATION_SINGLE;
		$tournament->bronze         = $bronze;
		if($tournament->save()) {
		//var_dump($bb->last_error);
		//BinaryBeast::results_history();
                 echo "Tournament Created Successfully";  
					header('Location: tournaments');
		}

		else
		{
		
		echo "Error";
		
		}
		
		}


?>