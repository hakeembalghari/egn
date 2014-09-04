

<?php

include('../bb/BinaryBeast.php');
		
		
		$bb=new BinaryBeast();
                
                
                
//$bb->enable_dev_mode();
$bb->disable_ssl_verification();
//$tournaments = $bb->tournament->list_my(null, 300, true);


?>



<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4> Games </h4>
						
						
<?php
$games = $bb->game->list_top(40);
foreach($games as $game) {
	echo $game->icon.' ';
    echo $game->game . ' (' . $game->game_code . ')<br />';
}
?>
						
						
                    </div>
                </div>
                