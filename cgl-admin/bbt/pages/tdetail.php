

<?php

include('bb/BinaryBeast.php');
		
		
		$bb=new BinaryBeast();
        $bb->enable_dev_mode();
		$bb->disable_ssl_verification();
		$tournament = $bb->tournament($_GET['id']);

//echo $_GET['id'];

?>

<div class="content">     
        	<div id="pad-wrapper">
<div class="table-wrapper orders-table">
                <div class="row head">
                    <div class="col-md-12">
                        <h4> Tournament Detail </h4>
						
				<?php
				foreach($tournament as $t)
				{
				//echo $t->id.'<br>';
				}
			
				var_dump($t->default_values);
				
				}
				//var_dump($tournament);
				
				echo "<br>";
				echo $bb->error_history;
				?>

						
						
                    </div>
                </div>
                