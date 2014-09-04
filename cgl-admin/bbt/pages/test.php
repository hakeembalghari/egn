
		
<?php
include('../bb/BinaryBeast.php');
		
		
		$bb=new BinaryBeast();
$bb->disable_ssl_verification();
$bb->enable_dev_mode();
?>

<?php

//BBTournament::embed();


$tournament=$bb->$tournaments('xHotS1408061');
//$tournament->embed();
//BBHelper::embed_brackets($tournament);
//$foreach($tournament->open_matches() as $match) 
//{
  //  echo $match->team->display_name . ' vs ' . $match->team2->display_name . ' in round ' . ($match->round->round + 1) . '<br />';
//}

$tournament->embed();
?>